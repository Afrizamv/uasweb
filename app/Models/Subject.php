<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_mata_kuliah',
        'kode_mata_kuliah',
        'dosen',
        'semester',
        'warna',
    ];

    /**
     * Get the user that owns the subject.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the tasks for the subject.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
}
