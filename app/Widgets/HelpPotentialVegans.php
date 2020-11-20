<?php

namespace App\Widgets;

class HelpPotentialVegans extends AbstractWidget
{
    protected $name = 'Help Potential Vegans';
    protected $type = 'help-potential-vegans';
    protected $description = 'Description of this widget.';

    public function getData(): array
    {
        return [
            'testData' => 'Hello World.',
        ];
    }
}
