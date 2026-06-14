<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'color',
    ];

    // Relasi: kategori ini milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: satu kategori dipakai di banyak task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}