<?php

namespace App\Widgets;

class WidgetFactory
{
    public static function make(string $name): ?AbstractWidget
    {
        $className = 'App\\Widgets\\'.self::kebabToPascal($name);

        if (class_exists($className)) {
            return new $className(request()->query());
        }

        return null;
    }

    private static function kebabToPascal(string $str): string
    {
        return str_replace('-', '', ucwords($str, '-'));
    }
}
