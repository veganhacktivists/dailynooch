<?php

namespace App\Widgets;

class RedditThreads extends AbstractWidget
{
    protected $name = 'Reddit Threads';
    protected $type = 'reddit-threads';
    protected $description = 'Description of this widget.';

    public function getData(): array
    {
        return [
            'testData' => 'Hello World.',
        ];
    }
}
