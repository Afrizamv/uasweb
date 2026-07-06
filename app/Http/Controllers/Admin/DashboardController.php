<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the Admin Dashboard with overall SaaS statistics and students lists.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $totalStudents = User::where('role', 'student')->count();
        $totalSubjects = Subject::count();
        $totalTasks = Task::count();

        // Get students with their subjects and tasks count
        $studentsQuery = User::where('role', 'student')
            ->withCount(['subjects', 'tasks']);

        if (!empty($search)) {
            $studentsQuery->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $students = $studentsQuery->latest()->paginate(10)->withQueryString();

        return view('admin.dashboard', compact(
            'totalStudents',
            'totalSubjects',
            'totalTasks',
            'students',
            'search'
        ));
    }
}
