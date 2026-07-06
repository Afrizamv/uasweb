<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Reminder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReminderController extends Controller
{
    /**
     * Display a listing of reminders.
     */
    public function index(Request $request)
    {
        // Query reminders belonging to the authenticated student
        $query = Reminder::whereHas('task.subject', function ($q) {
            $q->where('user_id', auth()->id());
        })->with(['task.subject']);

        $reminders = $query->latest('reminder_date')->paginate(15);

        return view('student.reminders.index', compact('reminders'));
    }

    /**
     * Complete a reminder (change status to Completed).
     */
    public function complete(Reminder $reminder)
    {
        // Authorize that the student owns the task associated with the reminder
        if ($reminder->task->subject->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reminder->update(['status' => 'Completed']);

        return redirect()->back()->with('success', 'Reminder berhasil diselesaikan.');
    }
}
