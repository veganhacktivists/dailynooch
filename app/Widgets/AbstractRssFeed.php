<?php

namespace App\Widgets;

use Vedmant\FeedReader\Facades\FeedReader;

class AbstractRssFeed extends AbstractWidget
{
    protected $name = 'Rss Feed';
    protected $type = 'rss-feed';
    protected $description = 'Get information from your favorite blog or website right in your dashboard!';

    protected $elementNames = [
        'link', 'authors', 'title', 'description', 'content', 'date', 'enclosures',
    ];

    /**
     * @var string
     */
    protected $url;

    public function getData(): array
    {
        $feed = FeedReader::read($this->url);

        return ['feedItems' => $this->getFeedItems($feed)];
    }

    private function getFeedItems($feed)
    {
        $feedItems = [];
        foreach ($feed->get_items() as $item) {
            $feedItems[] = $this->getItemWithElements($item);
        }

        return $feedItems;
    }

    private function getItemWithElements($item)
    {
        $feedItem = [];
        foreach ($this->elementNames as $elementName) {
            $methodName = 'get_'.$elementName;

            if (is_callable([$item, $methodName])) {
                $feedItem[$elementName] = $item->$methodName();
            }
        }

        return $feedItem;
    }
}
