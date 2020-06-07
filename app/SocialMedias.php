<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMedias extends Model
{

    protected $fillable = ['name', 'icon', 'color', 'url', 'order', 'status'];

}
