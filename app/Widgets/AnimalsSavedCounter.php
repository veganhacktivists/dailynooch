<?php

namespace App\Widgets;

use App\Repositories\FaostatRepository;
use App\Repositories\WorldBankRepository;

class AnimalsSavedCounter extends AbstractWidget
{
    protected $name = 'Animals Saved Counter';
    protected $type = 'animals-saved-counter';
    protected $description = 'Number of lives saved by being vegan.';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        $population = (new WorldBankRepository)->population()
            ->groupBy('year')
            ->map(function ($population) {
                return $population->pluck('value')->sum();
            });

        $animals = (new FaostatRepository)->all()
            ->map(function ($animal) use ($population) {
                $animal->resource['value'] /= $population[$animal['year']];
                return $animal;
            })
            ->groupBy('name')
            ->map(function ($values, $name) {
                return [
                    'name' => $name,
                    'values' => $values->sortBy('year')->pluck('value'),
                ];
            })
            ->values();

        return [
            'animals' => $animals->toArray(),
        ];
    }
}
