<?php

use App\Models\FeedSource;
use Illuminate\Database\Seeder;

class FeedSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sources = [
            [
                'widget_type' => 'nutrition-facts',
                'feed_type' => 'rss',
                'url' => 'https://nutritionfacts.org/feed',
            ],
            [
                'widget_type' => 'nutrition-facts-videos',
                'feed_type' => 'rss',
                'url' => 'https://nutritionfacts.org/feed?post_type=video',
            ],
            [
                'widget_type' => 'news',
                'feed_type' => 'rss',
                'url' => 'https://www.plantbasednews.org/.rss/full/',
            ],
            [
                'widget_type' => 'news',
                'feed_type' => 'wp-json',
                'url' => 'https://www.livekindly.co/wp-json/wp/v2/posts?_embed',
            ],
        ];
        FeedSource::create($sources);
    }
}
