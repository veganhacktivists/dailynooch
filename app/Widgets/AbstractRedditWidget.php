<?php

namespace App\Widgets;

class AbstractRedditWidget extends AbstractWidget
{
    protected $name = 'Reddit Threads';
    protected $type = 'reddit-threads';
    protected $description = 'Load threads from your favourite subreddit whilst filtering out threads you\'re not interested in.';

    /**
     * @var string
     * Subreddit to retrieve
     */
    protected $subreddit;
    /**
     * @var string
     * The sorting mode to use on each subreddit. Supported modes are: top, hot, controversial, rising
     */
    protected $sortMode;
    /**
     * @var integer
     * The number of threads to retrieve (note we initially retrieve 5 more to filter out pinned posts/threads)
     */
    protected $numberOfThreads;

    /**
     * If this returns true then the thread will be removed.
     * If you wish to apply filters then override this when you extend the class.
     *
     * @param redditThread - Json formatted individual Reddit Thread as returned by Reddit.
     */
    private function filterThread($redditThread): bool {
        return false;
    }

    public function getData(): array
    {
        // Set the thread limit to way higher than the number of threads because threads may be removed via filterThread().
        $threadLimit = $this->numberOfThreads+10;

        // The json url to retrieve from Reddit.
        $jsonUrl = 'https://www.reddit.com/r/'.$this->subreddit.'/'.$this->sortMode.'/.json?limit='.$threadLimit;

        // Retrieve the Reddit threads.
        $decodedJson = json_decode(file_get_contents($jsonUrl), true);
        $jsonChildren = $decodedJson['data']['children'];

        // Remove any filtered threads and make sure the number doesn't exceed $this->numberOfThreads
        $processedThreads = array();
        foreach ($jsonChildren as $rawRedditThread) {
            $redditThread = $rawRedditThread['data'];

            // If the thread shouldn't be filtered then add it to our array of processed threads.
            if (!$this->filterThread($redditThread)) {
                array_push($processedThreads, $redditThread);
            }

            // If we've reached the thread limit then stop looping.
            if (count($processedThreads) === $this->numberOfThreads) {
                break;
            }
        }

        return $processedThreads;
    }
}
