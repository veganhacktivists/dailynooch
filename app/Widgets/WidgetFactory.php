<?php

namespace App\Widgets;

class WidgetFactory
{
    public static function make(string $name): ?AbstractWidget
    {
        $className = 'App\\Widgets\\'.kebabToPascal($name);

        if (class_exists($className)) {
            return new $className(request()->query());
        }

        return null;
    }
}
