<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Http;

abstract class AbstractRedditWidget extends AbstractWidget
{
    protected $name = 'Reddit Threads';
    protected $type = 'reddit-threads';
    protected $description = 'Load threads from your favourite subreddit whilst filtering out threads you\'re not interested in.';

    protected const SORTMODE_HOT           = 'hot';
    protected const SORTMODE_TOP           = 'top';
    protected const SORTMODE_CONTROVERSIAL = 'controversial';
    protected const SORTMODE_RISING        = 'rising';
    protected const REDDIT_URL_FORMAT      = 'https://www.reddit.com/r/%s/%s/.json?limit=%s';
    protected const REDDIT_URL_BASE        = 'https://www.reddit.com';

    protected $subreddit;
    protected $sortMode;
    protected $numberOfThreads;
    protected $extraLimitToAccountForFilter = 10;


    protected function filterThread(array $redditThread): bool
    {
        return false;
    }

    public function getData(): array
    {
        $redditResponse = Http::withHeaders([
            'User-agent' => ''
        ])->get(
            sprintf(
                self::REDDIT_URL_FORMAT,
                $this->subreddit,
                $this->sortMode,
                $this->numberOfThreads + $this->extraLimitToAccountForFilter
            )
        );

        $this->validateReponseOrFail($redditResponse);

        $processedThreads = $this->getProcessedThreads($redditResponse['data']['children']);

        if (empty($processedThreads)) {
            throw new Exception('Reddit returned no posts for the subreddit: '.$this->subreddit);
        }
        return $processedThreads;
    }

    private function validateReponseOrFail($redditResponse)
    {
        if (!$redditResponse->successful()) {
            throw new Exception('Reddit returned a '.$redditResponse->status().' error code.');
        }
        else if (!isset($redditResponse['data']) || !isset($redditResponse['data']['children'])) {
            throw new Exception('Reddit\'s response format has changed and cannot be processed.');
        }
    }

    private function getProcessedThreads(array $rawSubredditThreads): array
    {
        $processedThreads = array();
        foreach ($rawSubredditThreads as $rawRedditThread) {
            $redditThread = $rawRedditThread['data'];

            if (count($processedThreads) < $this->numberOfThreads && !$this->filterThread($redditThread)) {
                $processedThreads[] = $this->formatPermalink($redditThread);
            }
        }
        return $processedThreads;
    }

    private function formatPermalink(array $redditThread): array
    {
        $redditThread['permalink'] = self::REDDIT_URL_BASE.$redditThread['permalink'];
        return $redditThread;
    }
}
