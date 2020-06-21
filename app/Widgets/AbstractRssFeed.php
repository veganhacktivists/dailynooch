<?php

namespace App\Widgets;

use Illuminate\Http\JsonResponse;

class AbstractRssFeed extends AbstractWidget
{
    protected $name = 'Rss Feed';
    protected $type = 'rss-feed';
    protected $description = 'Get information from your favorite blog or website right in your dashboard!';

    /**
     * @var string
     */
    protected $url;

    public function action(): JsonResponse
    {
        return new JsonResponse(\Feed::loadRss($this->url)->toArray());
    }
}
