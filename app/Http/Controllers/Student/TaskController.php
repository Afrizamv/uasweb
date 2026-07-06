<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks with filters, search, and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $priority = $request->input('prioritas');

        // Access tasks belonging to the authenticated student
        $query = Task::whereHas('subject', function ($q) {
            $q->where('user_id', auth()->id());
        })->with('subject');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('subject', function ($sq) use ($search) {
                      $sq->where('nama_mata_kuliah', 'like', "%{$search}%");
                  });
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($priority)) {
            $query->where('prioritas', $priority);
        }

        $tasks = $query->latest('deadline')->paginate(10)->withQueryString();

        return view('student.tasks.index', compact('tasks', 'search', 'status', 'priority'));
    }

    /**
     * Show the form for creating a new task.
     */
    public function create()
    {
        $subjects = auth()->user()->subjects;
        return view('student.tasks.create', compact('subjects'));
    }

    /**
     * Store a newly created task in storage.
     */
    public function store(TaskRequest $request)
    {
        // Double check that the chosen subject belongs to the current user
        $subject = auth()->user()->subjects()->findOrFail($request->input('subject_id'));

        $data = $request->validated();

        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('attachments', 'public');
            $data['lampiran'] = $path;
        }

        Task::create($data);

        return redirect()->route('student.tasks.index')
            ->with('success', 'Tugas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the task.
     */
    public function edit(Task $task)
    {
        Gate::authorize('view', $task);

        $subjects = auth()->user()->subjects;
        return view('student.tasks.edit', compact('task', 'subjects'));
    }

    /**
     * Update the task in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        Gate::authorize('update', $task);

        // Double check that the chosen subject belongs to the current user
        $subject = auth()->user()->subjects()->findOrFail($request->input('subject_id'));

        $data = $request->validated();

        if ($request->hasFile('lampiran')) {
            // Delete old attachment if exists
            if ($task->lampiran) {
                Storage::disk('public')->delete($task->lampiran);
            }
            $path = $request->file('lampiran')->store('attachments', 'public');
            $data['lampiran'] = $path;
        }

        $task->update($data);

        return redirect()->route('student.tasks.index')
            ->with('success', 'Tugas berhasil diperbarui!');
    }

    /**
     * Remove the task from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        // Delete attachment from storage
        if ($task->lampiran) {
            Storage::disk('public')->delete($task->lampiran);
        }

        $task->delete();

        return redirect()->route('student.tasks.index')
            ->with('success', 'Tugas berhasil dihapus!');
    }
}
