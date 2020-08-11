<?php

namespace App\Widgets;

class NutritionFactsVideos extends AbstractRssFeed
{
    protected $name = 'NutritionFacts.org videos';
    protected $type = 'nutrition-facts-videos';
    protected $description = 'Nutrition facts videos';

    protected $elementNames = ['link', 'title', 'enclosures'];

    protected $url = 'https://nutritionfacts.org/feed?post_type=video';
}
