<?php

namespace App\Providers;

use App\Widgets\WidgetFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class WidgetServiceProvider extends RouteServiceProvider
{
    // TTL in minutes
    private const CACHE_TTL = 10;

    // TODO: Add custom parameters to key when feature is available
    private const CACHE_KEY = 'widgets.%s';

    private $defaultTypes = [
        'nutritional-facts',
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

            $widgetData = [];
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

                    Cache::put(sprintf(self::CACHE_KEY, $type), $widget, now()->addMinutes(self::CACHE_TTL));
                }

                $widgetData[] = [
                    'type' => $widget->getType(),
                    'name' => $widget->getName(),
                    'data' => $widget->getData(),
                ];
            }

            return new JsonResponse(['widgets' => $widgetData, 'missing_widgets' => $missingWidgets]);
        });

        $this->app['router']->get('widgets/{name}', function (string $name) {
            $widget = WidgetFactory::make($name);
            if ($widget === null) {
                return new JsonResponse([], 404);
            }

            return $widget->action();
        });

        parent::boot();
    }
}
