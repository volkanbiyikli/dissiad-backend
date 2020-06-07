<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['id', 'url', 'title', 'status', 'description', 'logo_header', 'old_logo_header', 'logo_footer', 'old_logo_footer', 'icon', 'old_icon', 'analytics', 'noindex', 'seo_description', 'twitter', 'facebook'];
}
