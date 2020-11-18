<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    use CrudTrait;

    protected $table = 'facts';
    protected $guarded = ['id'];
    protected $fillable = ['text'];
}
