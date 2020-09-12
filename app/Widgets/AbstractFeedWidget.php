<?php

namespace App\Widgets;

use App\Models\FeedSource;
use App\Widgets\Feed\Feed;
use Illuminate\Support\Collection;

class AbstractFeedWidget extends AbstractWidget
{
    protected $name = 'Feed';
    protected $type = 'feed';
    protected $description = 'Get information from your favorite blog or website right in your dashboard!';

    protected $itemsToGetPerFeed = 5;

    public function getData(): array
    {
        $feeds = $this->getFeeds();

        $feedItems = $feeds->reduce(function ($carry, Feed $feed) {
            $feedItemsData = $feed->fetchFeedItems();

            return $carry->merge($feedItemsData->slice(0, $this->itemsToGetPerFeed));
        }, new Collection());

        return ['feedItems' => $this->formatFeedItemsData($feedItems)->values()];
    }

    /**
     * Perform any final formatting/transormations on the feed items
     * before they're kicked out the door.
     */
    protected function formatFeedItemsData(Collection $data): Collection
    {
        return $data;
    }

    /**
     * Get feeds for this widget.
     *
     * @return Collection|Feed[]
     */
    private function getFeeds(): Collection
    {
        $sources = FeedSource::where('widget_type', $this->type)->select('feed_type', 'url')->get();
        $feeds = $sources->reduce(function ($carry, $source) {
            $className = 'App\\Widgets\\Feed\\Sources\\'.kebabToPascal($source->feed_type);
            if (class_exists($className)) {
                $carry->push(new $className($source->url));
            }

            return $carry;
        }, new Collection());

        return $feeds;
    }
}
