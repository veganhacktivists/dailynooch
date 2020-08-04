<?php

namespace App\Widgets;

class RedditRVegan extends AbstractRedditWidget
{
    protected $name = 'Vegan Reddit';
    protected $type = 'reddit-rvegan';
    protected $description = 'Displays threads from the vegan subreddit.';

    // Abstract Reddit Widget params
    protected $subreddit = 'vegan';
    protected $sortMode = 'hot';
    protected $numberOfThreads = '6';

    /**
     * If this returns true then the thread will be removed.
     *
     * @param redditThread - Json formatted individual Reddit Thread as returned by Reddit.
     */
    private function filterThread($redditThread): boolean {
        // Filter out stickied threads.
        return $redditThread['stickied'];
    }
}
