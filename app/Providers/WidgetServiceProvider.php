<?php

namespace App\Providers;

use App\Widgets\RssFeed;
use App\Widgets\WidgetFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Router;

class WidgetServiceProvider extends RouteServiceProvider
{
    private $widgets = [
        RssFeed::class,
    ];

    public function boot(): void
    {
        $this->app['router']->group(['prefix' => 'widget-api'], function (Router $router) {
            foreach ($this->widgets as $widget) {
                $router->get('my-route', $widget.'@action');
            }
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
