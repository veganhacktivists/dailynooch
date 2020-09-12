<?php

namespace App\Widgets\Feed\Sources;

use App\Widgets\Feed\Feed;
use App\Widgets\Feed\FeedItem;
use Illuminate\Support\Collection;
use Vedmant\FeedReader\Facades\FeedReader;

class Rss extends Feed
{
    protected string $feedType = 'rss';

    public function fetchFeedItems(): Collection
    {
        $feed = $this->fetchData($this->feedUrl);

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

    private function fetchData(string $url): Collection
    {
        $feedData = FeedReader::read($url);

        return collect($feedData->get_items());
    }
}
