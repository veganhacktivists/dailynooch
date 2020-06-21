<?php

namespace App\Providers;

use App\Widgets\WidgetFactory;
use Illuminate\Http\JsonResponse;

class WidgetServiceProvider extends RouteServiceProvider
{
    /**
     * const widgets = [.
        ]
     */
    public function boot(): void
    {
        // Batch endpoint
        $this->app['router']->get('widgets', function () {
            // Takes a query parameter types={comma-seperated-widgets}
            $widget = WidgetFactory::make();
            if ($widget === null) {
                return new JsonResponse([], 404);
            }

            return $widget->action();
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
