<?php

use App\Models\Quote;
use Illuminate\Database\Seeder;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(Quote::class, 50)->create();
    }
}
