<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'project_id',
        'no_invoice',
        'date',
        'date_due'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class)
            ->with(['client']);
    }

    public function details()
    {
        return $this->hasMany(InvoiceDetail::class, 'invoice_id', 'id');
    }

    public function scopeExpired($query)
    {
        return $query->where('date_due', '<', date('Y-m-d'));
    }
}
