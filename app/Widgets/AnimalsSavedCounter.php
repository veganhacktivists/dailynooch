<?php

namespace App\Widgets;

use App\Repositories\Faostat;
use App\Repositories\Population;

class AnimalsSavedCounter extends AbstractWidget
{
    protected $name = 'Saved Life Counter';
    protected $type = 'saved-life-counter';
    protected $description = 'Number of lives saved by being vegan.';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        $population = collect((new Population())->all())
            ->groupBy('year')
            ->map(function ($population) {
                return $population->pluck('value')->sum();
            });

        $animals = collect((new Faostat())->all())
            ->map(function ($animal) use ($population) {
                return array_merge($animal, [
                    'value' => $animal['value'] / $population[$animal['year']],
                ]);
            })
            ->groupBy('item')
            ->map(function ($animals, $item) {
                return [
                    'item' => $item,
                    'values' => $animals->sortBy('year')->pluck('value'),
                ];
            })
            ->values();

        return $animals->toArray();
    }
}
