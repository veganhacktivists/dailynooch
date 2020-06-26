<?php

namespace App\Providers;

use App\Widgets\WidgetFactory;
use Illuminate\Http\JsonResponse;

class WidgetServiceProvider extends RouteServiceProvider
{
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
            foreach ($types as $type) {
                $widget = WidgetFactory::make($type);
                if ($widget === null) {
                    return new JsonResponse(['error' => 'Widget type: `'.$type.'` doesn\'t exist'], 404);
                }

                $widgetData[] = $widget->getData();
            }

            return new JsonResponse($widgetData);
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
