<?php

namespace App\Widgets;

class News extends AbstractRssFeed
{
    protected $name = 'Latest news';
    protected $type = 'news';
    protected $description = 'Vegan news';

    protected function formatItemData($items)
    {
        $numCardsToFormat = 2;
        for ($i = 0; $i < $numCardsToFormat; ++$i) {
            $item = $items[$i];
            if (isset($item['enclosures']) && $item['enclosures'][0]->link == null) {
                $ogTags = $this->getOpengraphTags($item['link']);

                $item['authors'][0]->name = $ogTags['og:site_name'];
                $item['enclosures'][0]->link = $ogTags['og:image'];
            }
        }

        return $items;
    }

    private function getOpengraphTags($url)
    {
        $pageHtml = file_get_contents($url);
        $matches = null;
        preg_match_all('~<\s*meta\s+property="(og:[^"]+)"\s+content="([^"]*)~i', $pageHtml, $matches);

        $ogTags = [];
        for ($j = 0; $j < count($matches[1]); ++$j) {
            $ogTags[$matches[1][$j]] = $matches[2][$j];
        }
    }
}
