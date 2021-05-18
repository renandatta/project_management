<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'invoice_id',
        'no_receipt',
        'date',
        'total'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
