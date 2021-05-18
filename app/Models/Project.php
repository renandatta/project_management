<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'description',
        'date_start'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
