<?php

namespace App\Widgets;

class AbstractRssFeed extends AbstractWidget
{
    protected $name = 'Rss Feed';
    protected $type = 'rss-feed';
    protected $description = 'Get information from your favorite blog or website right in your dashboard!';

    /**
     * @var string
     */
    protected $url;

    public function getData(): array
    {
        return \Feed::loadRss($this->url)->toArray();
    }
}
