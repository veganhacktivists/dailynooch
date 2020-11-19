<?php

namespace App\Widgets;

class Art extends AbstractWidget
{
    protected $name = 'Art';
    protected $type = 'art';
    protected $description = 'Description of this widget.';

    public function getData(): array
    {
        return [
            'caption' => 'By anonymous',
            'imageAlt' => 'Life is too short to make other lives shorter',
            'imageUrl' => 'https://i.imgur.com/Qvh34OM.png'
        ];
    }
}
