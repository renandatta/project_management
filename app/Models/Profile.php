<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'website',
        'file'
    ];
}
