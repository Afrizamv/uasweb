<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Display the calendar view page.
     */
    public function index()
    {
        return view('student.calendar');
    }

    /**
     * Get a JSON feed of tasks for FullCalendar.
     */
    public function getEvents()
    {
        $tasks = auth()->user()->tasks()->with('subject')->get();

        $events = [];
        foreach ($tasks as $task) {
            $events[] = [
                'id' => $task->id,
                'title' => "[" . $task->subject->nama_mata_kuliah . "] " . $task->judul,
                'start' => $task->deadline->toIso8601String(),
                'color' => $task->subject->warna ?? '#3788d8', // Fallback color
                'extendedProps' => [
                    'judul' => $task->judul,
                    'deskripsi' => $task->deskripsi ?? 'Tidak ada deskripsi.',
                    'deadline' => $task->deadline->format('d M Y H:i'),
                    'prioritas' => $task->prioritas,
                    'status' => $task->status,
                    'subject' => $task->subject->nama_mata_kuliah,
                    'dosen' => $task->subject->dosen,
                    'lampiran' => $task->lampiran ? asset('storage/' . $task->lampiran) : null,
                    'lampiran_name' => $task->lampiran ? basename($task->lampiran) : null,
                ]
            ];
        }

        return response()->json($events);
    }
}
