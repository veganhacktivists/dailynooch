<?php

namespace App\Widgets;

class NutritionalFacts extends AbstractRssFeed
{
    protected $name = 'Nutritional facts';
    protected $type = 'nutritional-facts';
    protected $description = 'Nutritional facts';

    protected $elementNames = ['link', 'title'];

    protected $url = 'https://nutritionfacts.org/feed';
}
