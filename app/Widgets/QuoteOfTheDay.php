<?php

namespace App\Widgets;

use App\Models\Quote;

class QuoteOfTheDay extends AbstractWidget
{
    protected $name = 'Quote of the day';
    protected $type = 'quote-of-the-day';
    protected $description = 'Vegan quotes of the day.';

    public function getData() : array
    {
        $quoteOfTheDay = Quote::inRandomOrder()->first();
        return [
            'author' => $quoteOfTheDay->author,
            'text' => $quoteOfTheDay->text,
        ];
    }
}
