<?php

namespace App\Widgets;

use Illuminate\Support\Str;

class RedditRveganart extends AbstractRedditWidget
{
    protected $name = 'r/veganart on Reddit';
    protected $type = 'reddit-rveganart';
    protected $description = 'Displays art from the veganart subreddit.';

    protected $subreddit = 'veganart';
    protected $sortMode = self::SORTMODE_TOP;
    protected $numberOfThreads = 20;

    protected function filterThread(array $redditThread): bool
    {
        return !$this->isImage($redditThread);
    }

    private function isImage(array $redditThread): bool
    {
        return Str::endsWith($redditThread['url'], ['.jpg', '.jpeg', '.png', '.bmp']);
    }
}
