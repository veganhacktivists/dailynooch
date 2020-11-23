<?php

namespace App\Widgets;

use App\Models\Fact;

class FactOfTheDay extends AbstractWidget
{
    protected $name = 'Fact of the Day';
    protected $type = 'fact-of-the-day';
    protected $description = 'Vegan fact of the day.';

    public function getTtl(): int
    {
        return 24 * 60;
    }

    public function getData(): array
    {
        $factOfTheDay = Fact::inRandomOrder()->first();

        return [
            'text' => $factOfTheDay->text,
        ];
    }
}
