<?php

namespace App\Widgets;

class RedditRveganrecipes extends AbstractRedditWidget
{
    protected $name = 'Recipes of the week';
    protected $type = 'reddit-rveganrecipes';
    protected $description = 'Displays threads from the vegan recipes subreddit.';

    protected $subreddit = 'veganrecipes';
    protected $sortMode = self::SORTMODE_HOT;
    protected $numberOfThreads = 6;

    protected function filterThread(array $redditThread): bool
    {
        return $redditThread['stickied'];
    }
}
