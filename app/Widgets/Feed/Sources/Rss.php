<?php

namespace App\Widgets\Feed\Sources;

use App\Widgets\Feed\AbstractFeed;
use App\Widgets\Feed\FeedItem;
use Illuminate\Support\Collection;
use Vedmant\FeedReader\Facades\FeedReader;

class Rss extends AbstractFeed
{
    protected string $feedType = 'rss';

    public function fetchFeedItems(int $fetchCount = null): Collection
    {
        $feed = $this->fetchData($this->feedUrl, $fetchCount);

        return $feed->map(function ($item) {
            $feedItem = new FeedItem();
            $feedItem->link = $item->get_link();
            $feedItem->date = $item->get_date();
            $feedItem->title = $item->get_title();
            $feedItem->description = $item->get_description();
            $feedItem->content = $item->get_content();
            $feedItem->featured_image = $item->get_enclosures()[0]->link ?? '';
            $feedItem->video['link'] = $item->get_enclosures()[1]->link ?? '';
            $feedItem->video['type'] = $item->get_enclosures()[1]->type ?? '';

            return $feedItem;
        });
    }

    private function fetchData(string $url, int $fetchCount = null): Collection
    {
        $feedData = FeedReader::read($url);
        $feedItems = collect($feedData->get_items());

        return isset($fetchCount) ? $feedItems->splice(0, $fetchCount) : $feedItems;
    }
}
