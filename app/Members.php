<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Members extends Model
{
    use Sluggable;
    protected $fillable = ['name', 'old_name', 'license', 'address', 'city', 'authorized', 'authorized_email', 'telephone', 'fax', 'email', 'url', 'product', 'export', 'import', 'profile', 'map', 'image', 'old_image', 'status', 'slug'];

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
