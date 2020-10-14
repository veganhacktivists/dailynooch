<?php

namespace App\Widgets\Feed;

use Illuminate\Support\Collection;

abstract class AbstractFeed
{
    protected string $feedType;
    protected string $feedUrl;

    public function __construct(string $url)
    {
        $this->feedUrl = $url;
    }

    /**
     * Fetch data from a remote feed source and return as a collection of FeedItems.
     *
     * @return Collection|FeedItem[]
     */
    abstract public function fetchFeedItems(int $fetchCount = null): Collection;
}
