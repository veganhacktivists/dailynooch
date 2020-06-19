<?php

namespace App\Widgets;

use Illuminate\Http\JsonResponse;

class RssFeed extends AbstractWidget
{
    protected $name = 'Rss Feed';
    protected $description = 'Get information from your favorite blog or website right in your dashboard!';

    public function action(): JsonResponse
    {
        $url = '';
        if (array_key_exists('url', $this->params) && $this->params['url'] !== null) {
            $url = $this->params['url'];
        }

        return new JsonResponse(\Feed::loadRss($url)->toArray());
    }
}
