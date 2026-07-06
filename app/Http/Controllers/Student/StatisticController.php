<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StatisticController extends Controller
{
    /**
     * Display the statistics view page.
     */
    public function index()
    {
        return view('student.statistics');
    }

    /**
     * Get JSON data for Chart.js.
     */
    public function getData()
    {
        $user = auth()->user();

        // 1. Completion status data
        $completedCount = $user->tasks()->where('status', 'Selesai')->count();
        $incompleteCount = $user->tasks()->where('status', '!=', 'Selesai')->count();

        // 2. Tasks count by subject
        $subjects = $user->subjects()->withCount('tasks')->get();
        $subjectLabels = $subjects->pluck('nama_mata_kuliah');
        $subjectCounts = $subjects->pluck('tasks_count');

        // 3. Tasks count by month (current year)
        $currentYear = Carbon::now()->year;
        $tasksThisYear = $user->tasks()
            ->whereYear('deadline', $currentYear)
            ->get();

        // Group tasks by month in PHP to maintain MySQL & SQLite database compatibility
        $monthlyCounts = array_fill(1, 12, 0);
        foreach ($tasksThisYear as $task) {
            $monthNum = $task->deadline->month;
            $monthlyCounts[$monthNum]++;
        }

        $monthLabels = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthlyData = array_values($monthlyCounts);

        return response()->json([
            'status' => [
                'labels' => ['Selesai', 'Belum Selesai'],
                'data' => [$completedCount, $incompleteCount]
            ],
            'subject' => [
                'labels' => $subjectLabels,
                'data' => $subjectCounts
            ],
            'monthly' => [
                'labels' => $monthLabels,
                'data' => $monthlyData
            ]
        ]);
    }
}
