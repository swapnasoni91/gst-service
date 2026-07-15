<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'product_id',
        'quantity',
        'price',
        'gst_percent',

        'gst_amount',

        'cgst_percent',

        'sgst_percent',

        'igst_percent',

        'cgst_amount',

        'sgst_amount',

        'igst_amount',

        'total'

    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}