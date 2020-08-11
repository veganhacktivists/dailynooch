<?php

namespace App\Widgets;

class NutritionFacts extends AbstractRssFeed
{
    protected $name = 'Nutrition facts';
    protected $type = 'nutrition-facts';
    protected $description = 'Nutrition facts';

    protected $elementNames = ['link', 'title'];

    protected $url = 'https://nutritionfacts.org/feed';
}
