<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Videos extends Model
{
    protected $fillable = ['name', 'old_name', 'status', 'date', 'url', 'order'];
}
