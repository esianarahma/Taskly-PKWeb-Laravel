<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'description',
        'ip_address',
    ];

    // Relasi: log ini dibuat oleh satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}