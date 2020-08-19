<?php

namespace App\Widgets;

use App\Models\RssSource;
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
        if ($this->url) {
            $urls = $this->url;
        } else {
            $rssSources = RssSource::where('widget_type', $this->type)->select('url')->get();
            $urls = $rssSources->map(fn ($source) => $source->url)->toArray();
        }

        $feeds = FeedReader::read($urls);

        return ['feedItems' => $this->getFeedItems($feeds)];
    }

    protected function formatItemData($items)
    {
        return $items;
    }

    private function getFeedItems($feed)
    {
        $feedItems = [];
        foreach ($feed->get_items() as $item) {
            $feedItems[] = $this->getItemWithElements($item);
        }

        return $this->formatItemData($feedItems);
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
