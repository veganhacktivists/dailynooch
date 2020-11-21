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
        'art',
        'death-counter',
        'fact-of-the-day',
        'help-potential-vegans',
        'news',
        'nutrition-facts',
        'nutrition-facts-videos',
        'quote-of-the-day',
        'reddit-rvegan',
        'meme-of-the-day',
        'reddit-rveganrecipes',
        'doc-of-the-month',
        'vegan-bootcamp',
        'animal-rights-map',
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
                $widgetData = [];
                if (Cache::has(sprintf(self::CACHE_KEY, $type))) {
                    $widgetData = Cache::get(sprintf(self::CACHE_KEY, $type));
                } else {
                    $widget = WidgetFactory::make($type);
                    if ($widget === null) {
                        $missingWidgets[] = $type;
                        continue;
                    }

                    try {
                        $widgetData = [
                            'type' => $widget->getType(),
                            'name' => $widget->getName(),
                            'data' => $widget->getData(),
                        ];
                        Cache::put(sprintf(self::CACHE_KEY, $type), $widgetData, now()->addMinutes($widget->getTtl()));
                    } catch (\Throwable $th) {
                        Log::error($th);

                        if (app()->environment('production')) {
                            $widgetData['error'] = true;
                        } else {
                            $widgetData['error'] = [
                                'message' => $th->getMessage(),
                                'file' => $th->getFile(),
                                'line' => $th->getLine(),
                                'trace' => $th->getTraceAsString(),
                            ];
                        }
                    }
                }

                $widgets[] = $widgetData;
            }

            return new JsonResponse(['widgets' => $widgets, 'missing_widgets' => $missingWidgets]);
        });

        $this->app['router']->get('widgets/{name}', function (string $name) {
            $widgetData = [];
            if (Cache::has(sprintf(self::CACHE_KEY, $name))) {
                $widgetData = Cache::get(sprintf(self::CACHE_KEY, $name));
            } else {
                $widget = WidgetFactory::make($name);
                if ($widget === null) {
                    return new JsonResponse([], 404);
                }

                Cache::put(sprintf(self::CACHE_KEY, $name), $widget->action(), now()->addMinutes($widget->getTtl()));
            }

            return $widgetData;
        });

        parent::boot();
    }
}
