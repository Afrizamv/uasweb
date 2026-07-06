<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of all tasks in the system.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $priority = $request->input('prioritas');

        $query = Task::with(['subject.user']);

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%")
                  ->orWhereHas('subject', function ($sq) use ($search) {
                      $sq->where('nama_mata_kuliah', 'like', "%{$search}%")
                        ->orWhereHas('user', function ($uq) use ($search) {
                            $uq->where('name', 'like', "%{$search}%");
                        });
                  });
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }

        if (!empty($priority)) {
            $query->where('prioritas', $priority);
        }

        $tasks = $query->latest('deadline')->paginate(15)->withQueryString();

        return view('admin.tasks', compact('tasks', 'search', 'status', 'priority'));
    }
}
