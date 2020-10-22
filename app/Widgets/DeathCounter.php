<?php

namespace App\Widgets;

use App\Repositories\FaostatRepository;

class DeathCounter extends AbstractWidget
{
    protected $name = 'Death Counter';
    protected $type = 'death-counter';
    protected $description = 'Animals murdered since this page was opened.';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        $animals = (new FaostatRepository())->getAnimalMurders()
            ->sortBy('year')
            ->groupBy('year')
            ->last()
            ->values();

        return [
            'animals' => $animals->toArray(),
            'description' => $this->description,
        ];
    }
}
