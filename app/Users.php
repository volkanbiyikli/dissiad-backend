<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $fillable = ['id', 'name', 'email', 'password', 'image', 'old_image', 'status', 'role'];
}
