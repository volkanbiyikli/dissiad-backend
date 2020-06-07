<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Pages extends Model
{
    use Sluggable;
    protected $fillable = ['name', 'old_name', 'description', 'image', 'old_image', 'category_id', 'status', 'menu_status', 'left_status', 'url', 'blank_url', 'order', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
