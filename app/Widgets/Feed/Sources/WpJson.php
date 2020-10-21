<?php

namespace App\Widgets\Feed\Sources;

use App\Widgets\Feed\AbstractFeed;
use App\Widgets\Feed\FeedItem;
use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class WpJson extends AbstractFeed
{
    protected string $feedType = 'wp-json';
    private Client $client;

    public function __construct(string $url, Client $client)
    {
        parent::__construct($url);

        $this->client = $client;
    }

    public function fetchFeedItems(int $fetchCount = null): Collection
    {
        $feed = $this->fetchData($this->feedUrl, $fetchCount);

        return $feed->map(function ($item) {
            $feedItem = new FeedItem();
            $feedItem->link = $item->link;
            $feedItem->date = $item->date;
            $feedItem->title = htmlspecialchars_decode($item->title->rendered);
            $feedItem->featured_image = $item->_embedded->{'wp:featuredmedia'}[0]->link ?? '';

            return $feedItem;
        });
    }

    private function fetchData(string $url, int $fetchCount = null): Collection
    {
        $params = [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'query' => ['_embed' => true],
        ];
        if (isset($fetchCount)) {
            $params['query']['per_page'] = $fetchCount;
        }
        $response = $this->client->get($url, $params);

        return collect(json_decode($response->getBody()->getContents()));
    }
}
