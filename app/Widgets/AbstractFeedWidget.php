<?php

namespace App\Widgets;

use App\Models\FeedSource;
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

        $feedItems = new Collection();
        foreach ($feeds as $feed) {
            $feedItems = $feedItems->merge($feed->fetchFeedItems($this->itemsToGetPerFeed));
        }

        return ['feedItems' => $this->formatFeedItemsData($feedItems)->values()];
    }

    /**
     * Perform any final formatting/transformations on the feed items
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

        $feeds = new Collection();
        foreach ($sources as $source) {
            $className = 'App\\Widgets\\Feed\\Sources\\'.kebabToPascal($source->feed_type);
            if (class_exists($className)) {
                $feeds->push(app()->makeWith($className, ['url' => $source->url]));
            }
        }

        return $feeds;
    }
}
