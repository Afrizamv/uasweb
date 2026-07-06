<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'judul',
        'deskripsi',
        'deadline',
        'prioritas',
        'status',
        'lampiran',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * Get the subject that owns the task.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the reminders for the task.
     */
    public function reminders(): HasMany
    {
        return $this->hasMany(Reminder::class);
    }

    /**
     * Booted method to handle model events.
     */
    protected static function booted()
    {
        static::saved(function ($task) {
            // Delete existing reminders for this task to avoid duplicates or stale dates
            $task->reminders()->delete();

            $deadline = Carbon::parse($task->deadline);

            // Automatic reminder dates: 7 days, 3 days, 1 day (tomorrow), and day of (today)
            $reminderOffsets = [7, 3, 1, 0];

            foreach ($reminderOffsets as $offset) {
                $reminderDate = $deadline->copy()->subDays($offset);
                
                // Only create reminders that are relevant. 
                // In a real application, you might only create future reminders, 
                // but let's record them for all phases.
                $task->reminders()->create([
                    'reminder_date' => $reminderDate,
                    'status' => 'Pending',
                ]);
            }
        });
    }
}
