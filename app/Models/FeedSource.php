<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class FeedSource extends Model
{
    use CrudTrait;

    protected $table = 'feed_sources';
    protected $guarded = ['id'];
    protected $fillable = ['widget_type', 'feed_type', 'url'];
}
