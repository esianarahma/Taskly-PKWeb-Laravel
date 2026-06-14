<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'project_id',
        'category_id',
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'attachment',
    ];

    protected function casts(): array
    {
        return [
            'due_date' => 'date',
        ];
    }

    // Relasi: task ini milik satu user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: task ini bagian dari satu project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    // Relasi: task ini punya satu kategori (boleh kosong)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}