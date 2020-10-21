<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFeedSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_sources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('widget_type');
            $table->string('feed_type');
            $table->string('url');
            $table->unique(['widget_type', 'feed_type', 'url']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feed_sources');
    }
}
