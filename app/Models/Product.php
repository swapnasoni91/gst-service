<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'price',
        'stock',
        'gst_percent'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
