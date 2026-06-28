<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'subject',
        'message',
        'status',
        'order_reference',
        'admin_reply',
        'image_data',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
