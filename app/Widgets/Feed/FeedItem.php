<?php

namespace App\Widgets\Feed;

class FeedItem
{
    public string $link = '';
    public string $data = '';
    public string $title = '';
    public string $description = '';
    public string $content = '';
    public string $featured_image = '';
    public array $video = ['link' => '', 'type' => ''];
}
