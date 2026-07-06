<?php

namespace App\Policies;

use App\Models\Subject;
use App\Models\User;

class SubjectPolicy
{
    /**
     * Determine whether the user can view the subject.
     */
    public function view(User $user, Subject $subject): bool
    {
        return $user->isAdmin() || $user->id === $subject->user_id;
    }

    /**
     * Determine whether the user can update the subject.
     */
    public function update(User $user, Subject $subject): bool
    {
        // Only the owner can update the subject
        return $user->id === $subject->user_id;
    }

    /**
     * Determine whether the user can delete the subject.
     */
    public function delete(User $user, Subject $subject): bool
    {
        // Only the owner can delete the subject
        return $user->id === $subject->user_id;
    }
}
