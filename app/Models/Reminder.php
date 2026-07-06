<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'reminder_date',
        'status',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
    ];

    /**
     * Get the task that owns the reminder.
     */
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
