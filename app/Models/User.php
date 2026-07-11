<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
        'is_premium',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_premium' => 'boolean',
        ];
    }

    /**
     * Check if user is Admin.
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is Student.
     */
    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Check if user can create another subject (Free max 5).
     */
    public function canCreateSubject(): bool
    {
        if ($this->is_premium) {
            return true;
        }
        return $this->subjects()->count() < 5;
    }

    /**
     * Check if user can create another task (Free max 5).
     */
    public function canCreateTask(): bool
    {
        if ($this->is_premium) {
            return true;
        }
        return $this->tasks()->count() < 5;
    }

    /**
     * Get the subjects for the user.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    /**
     * Get the tasks for the user through subjects.
     */
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Subject::class);
    }
}
