<?php

namespace App\Widgets;

use Illuminate\Support\Facades\Http;

abstract class AbstractRedditWidget extends AbstractWidget
{
    protected $name = 'Reddit Threads';
    protected $type = 'reddit-threads';
    protected $description = 'Load threads from your favourite subreddit whilst filtering out threads you\'re not interested in.';

    protected const SORTMODE_HOT =           'hot';
    protected const SORTMODE_TOP =           'top';
    protected const SORTMODE_CONTROVERSIAL = 'controversial';
    protected const SORTMODE_RISING =        'rising';
    protected const REDDIT_URL_FORMAT = 'https://www.reddit.com/r/%s/%s/.json?limit=%s';
    protected const REDDIT_URL_BASE = 'https://www.reddit.com';

    protected $subreddit;
    protected $sortMode;
    protected $numberOfThreads;


    protected function filterThread(array $redditThread): bool {
        return false;
    }

    public function getData(): array
    {
        $threadLimit = $this->numberOfThreads+10;
        $redditUrl = sprintf(self::REDDIT_URL_FORMAT, $this->subreddit, $this->sortMode, $threadLimit);

        $redditResponse = Http::withHeaders([
            'User-agent' => ''
        ])->get($redditUrl);

        if ($redditResponse->successful()) {

            if (isset($redditResponse['data']) && isset($redditResponse['data']['children'])) {
                $subredditThreads = $redditResponse['data']['children'];

                $processedThreads = array();
                foreach ($subredditThreads as $rawRedditThread) {
                    $redditThread = $rawRedditThread['data'];

                    if (!$this->filterThread($redditThread)) {
                        $redditThread['permalink'] = self::REDDIT_URL_BASE.$redditThread['permalink'];
                        $processedThreads[] = $redditThread;
                    }

                    if (count($processedThreads) === $this->numberOfThreads) {
                        break;
                    }
                }

                if (empty($processedThreads)) {
                    return $this->buildError('Reddit returned no posts for the subreddit: '.$this->subreddit);
                }
                else {
                    return $processedThreads;
                }
            }
            else {
                return $this->buildError('Reddit\'s response format has changed and cannot be processed.');
            }
        }
        else {
            return $this->buildError('Reddit returned a '.$redditResponse->status().' error code.');
        }
    }
}
