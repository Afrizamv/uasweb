<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\DashboardController as StudentDashboard;
use App\Http\Controllers\Student\SubjectController as StudentSubject;
use App\Http\Controllers\Student\TaskController as StudentTask;
use App\Http\Controllers\Student\CalendarController as StudentCalendar;
use App\Http\Controllers\Student\StatisticController as StudentStatistic;
use App\Http\Controllers\Student\ReminderController as StudentReminder;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\StudentController as AdminStudent;
use App\Http\Controllers\Admin\SubjectController as AdminSubject;
use App\Http\Controllers\Admin\TaskController as AdminTask;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirection dashboard based on role
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('student.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentDashboard::class, 'index'])->name('dashboard');
    Route::resource('subjects', StudentSubject::class);
    Route::resource('tasks', StudentTask::class);
    
    // Calendar
    Route::get('/calendar', [StudentCalendar::class, 'index'])->name('calendar.index');
    Route::get('/calendar/events', [StudentCalendar::class, 'getEvents'])->name('calendar.events');
    
    // Statistics
    Route::get('/statistics', [StudentStatistic::class, 'index'])->name('statistics.index');
    Route::get('/statistics/data', [StudentStatistic::class, 'getData'])->name('statistics.data');
    
    // Reminders
    Route::get('/reminders', [StudentReminder::class, 'index'])->name('reminders.index');
    Route::post('/reminders/{reminder}/complete', [StudentReminder::class, 'complete'])->name('reminders.complete');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
    Route::delete('/students/{student}', [AdminStudent::class, 'destroy'])->name('students.destroy');
    Route::get('/subjects', [AdminSubject::class, 'index'])->name('subjects');
    Route::get('/tasks', [AdminTask::class, 'index'])->name('tasks');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
