<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class RssSource extends Model
{
    use CrudTrait;

    protected $table = 'rss_sources';
    protected $guarded = ['id'];
    protected $fillable = ['widget_type', 'url'];
}
