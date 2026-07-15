<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanySetting extends Model
{
    protected $fillable = [
        'user_id',
        'company_name',
        'company_logo',
        'gst_number',
        'state',
        'phone',
        'address'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
