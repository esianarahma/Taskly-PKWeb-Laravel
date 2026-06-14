<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi: satu user punya banyak project
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Relasi: satu user punya banyak task
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Relasi: satu user punya banyak kategori
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    // Relasi: satu user punya banyak log aktivitas
    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    // Helper untuk cek role admin
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}