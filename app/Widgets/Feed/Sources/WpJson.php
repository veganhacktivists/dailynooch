<?php

namespace App\Widgets\Feed\Sources;

use App\Widgets\Feed\Feed;
use App\Widgets\Feed\FeedItem;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class WpJson extends Feed
{
    protected string $feedType = 'wp-json';

    public function fetchFeedItems(): Collection
    {
        $feed = $this->fetchData($this->feedUrl);

        return $feed->map(function ($item) {
            $feedItem = new FeedItem();
            $feedItem->link = $item->link;
            $feedItem->date = $item->date;
            $feedItem->title = $item->title->rendered;
            $feedItem->featured_image = $item->_embedded->{'wp:featuredmedia'}[0]->link ?? '';

            return $feedItem;
        });
    }

    private function fetchData(string $url): Collection
    {
        $params = [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];
        $response = (new Client())->request('GET', $url, $params);

        return collect(json_decode($response->getBody()->getContents()));
    }
}
