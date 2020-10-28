<?php

namespace App\Providers;

use App\Widgets\WidgetFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class WidgetServiceProvider extends RouteServiceProvider
{
    // TODO: Add custom parameters to key when feature is available
    private const CACHE_KEY = 'widgets.%s';

    private $defaultTypes = [
        'death-counter',
        'news',
        'nutrition-facts-videos',
        'nutrition-facts',
        'quote-of-the-day',
        'reddit-rvegan',
    ];

    public function boot(): void
    {
        $this->app['router']->get('widgets', function () {
            $types = request()->query('types');
            if ($types !== null) {
                $types = explode(',', $types);
            } else {
                $types = $this->defaultTypes;
            }

            $widgets = [];
            $missingWidgets = [];
            foreach ($types as $type) {
                if (Cache::has(sprintf(self::CACHE_KEY, $type))) {
                    $widget = Cache::get(sprintf(self::CACHE_KEY, $type));
                } else {
                    $widget = WidgetFactory::make($type);
                    if ($widget === null) {
                        $missingWidgets[] = $type;
                        continue;
                    }

                    Cache::put(sprintf(self::CACHE_KEY, $type), $widget, now()->addMinutes($widget->getTtl()));
                }

                try {
                    $widgetData = $widget->getData();
                } catch (\Throwable $th) {
                    Log::error($th);

                    if (app()->environment('production')) {
                        $widgetData = [
                            'error' => true,
                        ];
                    } else {
                        $widgetData = [
                            'error' => [
                                'message' => $th->getMessage(),
                                'file' => $th->getFile(),
                                'line' => $th->getLine(),
                                'trace' => $th->getTraceAsString(),
                            ],
                        ];
                    }
                }

                $widgets[] = [
                    'type' => $widget->getType(),
                    'name' => $widget->getName(),
                    'data' => $widgetData,
                ];
            }

            return new JsonResponse(['widgets' => $widgets, 'missing_widgets' => $missingWidgets]);
        });

        $this->app['router']->get('widgets/{name}', function (string $name) {
            if (Cache::has(sprintf(self::CACHE_KEY, $name))) {
                $widget = Cache::get(sprintf(self::CACHE_KEY, $name));
            } else {
                $widget = WidgetFactory::make($name);
                if ($widget === null) {
                    return new JsonResponse([], 404);
                }

                Cache::put(sprintf(self::CACHE_KEY, $name), $widget, now()->addMinutes($widget->getTtl()));
            }

            return $widget->action();
        });

        parent::boot();
    }
}
