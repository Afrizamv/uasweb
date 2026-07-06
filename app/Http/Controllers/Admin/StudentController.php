<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Remove the student account and all their data (cascaded).
     */
    public function destroy(User $student)
    {
        // Prevent deleting admin
        if ($student->role === 'admin') {
            return redirect()->back()->with('error', 'Akun admin tidak dapat dihapus.');
        }

        // Delete profile photo if exists
        if ($student->photo) {
            Storage::disk('public')->delete($student->photo);
        }

        // Delete all student files (attachments in tasks)
        // Since we want to clean up storage, let's get all tasks of this student and delete their attachments
        $tasks = $student->tasks;
        foreach ($tasks as $task) {
            if ($task->lampiran) {
                Storage::disk('public')->delete($task->lampiran);
            }
        }

        $student->delete(); // This triggers cascade delete in database for subjects, tasks, reminders

        return redirect()->route('admin.dashboard')
            ->with('success', 'Akun mahasiswa beserta seluruh datanya berhasil dihapus!');
    }
}
