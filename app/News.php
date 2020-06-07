<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use Sluggable;
    protected $fillable = ['name', 'old_name', 'description', 'image', 'old_image', 'bigimage', 'status', 'date', 'author_id', 'category_id', 'tag', 'url', 'blank_url', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
