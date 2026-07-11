<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Subject;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show the student dashboard with statistics, deadlines, and dynamic reminders.
     */
    public function index()
    {
        $user = auth()->user();

        $totalSubjects = $user->subjects()->count();
        $totalTasks = $user->tasks()->count();
        $completedTasks = $user->tasks()->where('status', 'Selesai')->count();

        $now = Carbon::now();
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        // 1. Terlambat (Overdue and not Selesai)
        $terlambatTasks = $user->tasks()
            ->where('status', '!=', 'Selesai')
            ->where('deadline', '<', $now)
            ->count();

        // 2. Belum Dikerjakan (Belum Dimulai and not overdue)
        $belumDikerjakanTasks = $user->tasks()
            ->where('status', 'Belum Dimulai')
            ->where(function ($q) use ($now) {
                $q->where('deadline', '>=', $now)->orWhereNull('deadline');
            })
            ->count();

        // 3. Sedang Dikerjakan (and not overdue)
        $sedangDikerjakanTasks = $user->tasks()
            ->where('status', 'Sedang Dikerjakan')
            ->where(function ($q) use ($now) {
                $q->where('deadline', '>=', $now)->orWhereNull('deadline');
            })
            ->count();

        // Calculate progress percentage
        $progress = $totalTasks > 0 ? round(($completedTasks / $totalTasks) * 100) : 0;

        // Count deadlines for today
        $deadlineTodayCount = $user->tasks()
            ->whereDate('deadline', $today)
            ->where('status', '!=', 'Selesai')
            ->count();

        // Count deadlines for tomorrow
        $deadlineTomorrowCount = $user->tasks()
            ->whereDate('deadline', $tomorrow)
            ->where('status', '!=', 'Selesai')
            ->count();

        // Count deadlines for the next 7 days (including today)
        $startOfWeek = Carbon::now()->startOfDay();
        $endOfWeek = Carbon::now()->addDays(7)->endOfDay();
        $deadlineThisWeekCount = $user->tasks()
            ->whereBetween('deadline', [$startOfWeek, $endOfWeek])
            ->where('status', '!=', 'Selesai')
            ->count();

        // Retrieve automatic reminders (tasks that are not Selesai)
        $remindersList = [];
        $tasks = $user->tasks()->where('status', '!=', 'Selesai')->with('subject')->get();

        foreach ($tasks as $task) {
            $deadline = Carbon::parse($task->deadline);
            $diffInDays = Carbon::now()->startOfDay()->diffInDays($deadline->copy()->startOfDay(), false);

            if ($diffInDays < 0) {
                $remindersList[] = [
                    'task' => $task,
                    'type' => 'Sudah lewat',
                    'message' => "Deadline tugas ini sudah terlewati " . abs($diffInDays) . " hari!",
                    'badge' => 'danger'
                ];
            } elseif ($diffInDays == 0) {
                $remindersList[] = [
                    'task' => $task,
                    'type' => 'Hari ini',
                    'message' => "Tugas ini deadline-nya hari ini!",
                    'badge' => 'warning'
                ];
            } elseif ($diffInDays == 1) {
                $remindersList[] = [
                    'task' => $task,
                    'type' => 'Besok',
                    'message' => "Tugas ini deadline-nya besok!",
                    'badge' => 'info'
                ];
            } elseif ($diffInDays <= 3 && $diffInDays > 1) {
                $remindersList[] = [
                    'task' => $task,
                    'type' => '3 Hari lagi',
                    'message' => "Tugas ini deadline-nya {$diffInDays} hari lagi!",
                    'badge' => 'primary'
                ];
            } elseif ($diffInDays <= 7 && $diffInDays > 3) {
                $remindersList[] = [
                    'task' => $task,
                    'type' => '7 Hari lagi',
                    'message' => "Tugas ini deadline-nya {$diffInDays} hari lagi!",
                    'badge' => 'secondary'
                ];
            }
        }

        return view('student.dashboard', compact(
            'totalSubjects',
            'totalTasks',
            'completedTasks',
            'belumDikerjakanTasks',
            'sedangDikerjakanTasks',
            'terlambatTasks',
            'progress',
            'deadlineTodayCount',
            'deadlineTomorrowCount',
            'deadlineThisWeekCount',
            'remindersList'
        ));
    }

    /**
     * Show the pricing page.
     */
    public function pricing()
    {
        $user = auth()->user();
        $subjectsCount = $user->subjects()->count();
        $tasksCount = $user->tasks()->count();

        return view('student.pricing', compact('user', 'subjectsCount', 'tasksCount'));
    }

    /**
     * Process simulated upgrade/downgrade of premium status.
     */
    public function upgrade(Request $request)
    {
        $user = auth()->user();
        $isPremium = $request->boolean('is_premium');

        $user->is_premium = $isPremium;
        $user->save();

        $message = $isPremium
            ? 'Akun Anda berhasil ditingkatkan ke Premium! Nikmati akses tanpa batas.'
            : 'Akun Anda berhasil diturunkan ke akun Free.';

        return redirect()->route('student.upgrade')->with('success', $message);
    }
}
