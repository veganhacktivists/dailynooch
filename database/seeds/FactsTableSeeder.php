<?php

use App\Models\Fact;
use Illuminate\Database\Seeder;

class FactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Fact::class, 50)->create();
    }
}
