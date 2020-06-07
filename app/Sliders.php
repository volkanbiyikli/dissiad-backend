<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sliders extends Model
{
    protected $fillable = ['name', 'old_name', 'description', 'image', 'old_image', 'status', 'url', 'blank_url', 'order'];
}
