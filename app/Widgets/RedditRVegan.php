<?php

namespace App\Widgets;

class RedditRVegan extends AbstractRedditWidget
{
    protected $name = 'r/Vegan on Reddit';
    protected $type = 'reddit-rvegan';
    protected $description = 'Displays threads from the vegan subreddit.';

    // Abstract Reddit Widget params
    protected $subreddit = 'vegan';
    protected $sortMode = self::SORTMODE_HOT;
    protected $numberOfThreads = 6;

    protected function filterThread(array $redditThread): bool {
        return $redditThread['stickied'];
    }
}
