<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use CrudTrait;

    protected $table = 'quotes';
    protected $guarded = ['id'];
    protected $fillable = ['author', 'text'];
}
