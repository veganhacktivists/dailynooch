<?php

namespace App\Widgets;

abstract class AbstractRedditWidget extends AbstractWidget
{
    protected $name = 'Reddit Threads';
    protected $type = 'reddit-threads';
    protected $description = 'Load threads from your favourite subreddit whilst filtering out threads you\'re not interested in.';

    protected $baseUrl = 'https://www.reddit.com';

    /**
     * @var string
     */
    protected $subreddit;

    /**
     * @var string
     * The sorting mode to use on each subreddit. Supported modes are: top, hot, controversial, rising
     */
    protected $sortMode;

    protected const SORTMODE_TOP = 'top';
    protected const SORTMODE_HOT = 'hot';
    protected const SORTMODE_CONTROVERSIAL = 'controversial';
    protected const SORTMODE_RISING = 'rising';

    /**
     * @var integer
     */
    protected $numberOfThreads;

    /**
     * If this returns true then the thread will be removed.
     * If you wish to apply filters then override this when you extend the class.
     *
     * @param redditThread - Json formatted individual Reddit Thread as returned by Reddit.
     */
    protected function filterThread(array $redditThread): bool {
        return false;
    }

    public function getData(): array
    {
        // Set the thread limit to way higher than the number of threads because threads may be removed via filterThread().
        $threadLimit = $this->numberOfThreads+10;

        // The json url to retrieve from Reddit.
        $redditUrl = 'https://www.reddit.com/r/'.$this->subreddit.'/'.$this->sortMode.'/.json?limit='.$threadLimit;

        // Retrieve the Reddit threads.
        $redditResponse = file_get_contents($redditUrl);
        $decodedRedditResponse = json_decode($redditResponse, true);
        $subredditThreads = $decodedRedditResponse['data']['children'];

        // Remove any filtered threads and make sure the number doesn't exceed $this->numberOfThreads
        $processedThreads = array();
        foreach ($subredditThreads as $rawRedditThread) {
            $redditThread = $rawRedditThread['data'];

            // Turn the permalink url into an absolute path by adding the Reddit.com prefix.
            $redditThread['permalink'] = $this->baseUrl.$redditThread['permalink'];

            // If the thread shouldn't be filtered then add it to our array of processed threads.
            if (!$this->filterThread($redditThread)) {
                array_push($processedThreads, $redditThread);
            }

            // If we've reached the thread limit then stop looping.
            if (count($processedThreads) >= $this->numberOfThreads) {
                break;
            }
        }

        return $processedThreads;
    }
}
