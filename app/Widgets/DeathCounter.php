<?php

namespace App\Widgets;

use App\Repositories\FaostatRepository;

class DeathCounter extends AbstractWidget
{
    protected $name = 'Death Counter';
    protected $type = 'death-counter';
    protected $description = 'Animals killed for food since this page opened.';

    public function getTtl(): int
    {
        return -1;
        return 24 * 60;
    }

    public function getData(): array
    {
        $animals = (new FaostatRepository)->all()
            ->sortBy('year')
            ->groupBy('year')
            ->last()
            ->values()
            // ->map(function ($animal) {
            //     $animal->resource['value'] /= 365 * 24 * 60 * 60;
            //     return $animal;
            // })
        ;

        return [
            'animals' => $animals->toArray(),
            'description' => $this->description,
        ];
    }
}
