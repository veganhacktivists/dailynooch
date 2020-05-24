<?php

namespace App\Widgets;

use Illuminate\View\View;
use Rinvex\Widgets\Models\AbstractWidget;

class RssFeed extends AbstractWidget
{
    protected $container = 'widgets.container';

    /**
     * Treat this method as a normal PHP method, or a controller action.
     * You may return view() or other content to render and display.
     */
    public function make(): View
    {
        $url = '';
        if (array_key_exists('url', $this->params) && $this->params['url'] !== null) {
            $url = $this->params['url'];
        }

        $feed = \Feed::loadRss($url);

        return view('widgets.rss_feed', ['feed' => $feed]);
    }

    public function placeholder(): string
    {
        return 'Loading...';
    }
}
