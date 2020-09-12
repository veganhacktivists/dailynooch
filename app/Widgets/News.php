<?php

namespace App\Widgets;

use Illuminate\Support\Collection;

class News extends AbstractFeedWidget
{
    protected $name = 'Latest news';
    protected $type = 'news';
    protected $description = 'Vegan news';

    protected $itemsToGetPerFeed = 3;

    protected function formatFeedItemsData(Collection $data): Collection
    {
        return $data->sortBy('date');
    }
}
