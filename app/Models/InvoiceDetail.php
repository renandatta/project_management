<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed qty
 * @property mixed price
 */
class InvoiceDetail extends Model
{
    protected $fillable = [
        'invoice_id',
        'item',
        'qty',
        'unit',
        'price'
    ];

    public function getTotalAttribute()
    {
        return $this->qty * $this->price;
    }
}
