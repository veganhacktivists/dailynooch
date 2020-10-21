<?php

use App\Models\FeedSource;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class FeedSourcesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $feedSourcesJson = File::get('database/data/feed-sources.json');
        $feedSources = collect(json_decode($feedSourcesJson, true));
        $newFeedSources = $feedSources->map(function ($feedSource) {
            $feedSource['created_at'] = $feedSource['updated_at'] = now();

            return $feedSource;
        });

        FeedSource::insert($newFeedSources->toArray());
    }
}
