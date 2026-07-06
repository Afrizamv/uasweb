<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::create([
            'name' => 'StudySync Admin',
            'email' => 'admin@studysync.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // 2. Student User 1
        $student1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'student@studysync.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // 3. Student User 2
        $student2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'mahasiswa@studysync.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        // Seed subjects and tasks for Student 1
        $sub1_1 = Subject::create([
            'user_id' => $student1->id,
            'nama_mata_kuliah' => 'Pemrograman Web',
            'kode_mata_kuliah' => 'IF-301',
            'dosen' => 'Dr. Eko Prasetyo',
            'semester' => 4,
            'warna' => '#4e73df', // Blue
        ]);

        $sub1_2 = Subject::create([
            'user_id' => $student1->id,
            'nama_mata_kuliah' => 'Kecerdasan Buatan',
            'kode_mata_kuliah' => 'IF-305',
            'dosen' => 'Prof. Herianto',
            'semester' => 4,
            'warna' => '#1cc88a', // Green
        ]);

        $sub1_3 = Subject::create([
            'user_id' => $student1->id,
            'nama_mata_kuliah' => 'Struktur Data',
            'kode_mata_kuliah' => 'IF-202',
            'dosen' => 'Retno Wulandari, M.T.',
            'semester' => 2,
            'warna' => '#e74a3b', // Red
        ]);

        // Tasks for Student 1
        // Web Programming Tasks
        Task::create([
            'subject_id' => $sub1_1->id,
            'judul' => 'Tugas Mandiri 1: Setup Laravel 12',
            'deskripsi' => 'Instalasi dan konfigurasi dasar framework Laravel 12 menggunakan Composer.',
            'deadline' => Carbon::now()->subDays(2), // Overdue
            'prioritas' => 'High',
            'status' => 'Belum Dimulai',
        ]);

        Task::create([
            'subject_id' => $sub1_1->id,
            'judul' => 'Tugas Kelompok: CRUD Bootstrap 5',
            'deskripsi' => 'Membuat dashboard sederhana dengan Bootstrap 5 dan routing resource Controller.',
            'deadline' => Carbon::now()->addDays(2), 
            'prioritas' => 'Medium',
            'status' => 'Sedang Dikerjakan',
        ]);

        // AI Tasks
        Task::create([
            'subject_id' => $sub1_2->id,
            'judul' => 'Kuis AI: Algoritma BFS & DFS',
            'deskripsi' => 'Mempelajari konsep pencarian BFS dan DFS serta implementasi pseudo-code.',
            'deadline' => Carbon::now()->addHours(3), // Today
            'prioritas' => 'High',
            'status' => 'Belum Dimulai',
        ]);

        Task::create([
            'subject_id' => $sub1_2->id,
            'judul' => 'Tugas Akhir: Chatbot Kecil',
            'deskripsi' => 'Membuat chatbot sederhana berbasis NLP dengan regex.',
            'deadline' => Carbon::now()->addDays(6), // 7 days (approx)
            'prioritas' => 'Low',
            'status' => 'Selesai',
        ]);

        // Data Structures Tasks
        Task::create([
            'subject_id' => $sub1_3->id,
            'judul' => 'Laporan Praktikum: Binary Tree',
            'deskripsi' => 'Menulis laporan analisa binary tree dan transversal pre-order, in-order, post-order.',
            'deadline' => Carbon::now()->addDays(1), // Tomorrow
            'prioritas' => 'High',
            'status' => 'Sedang Dikerjakan',
        ]);

        // Seed subjects and tasks for Student 2
        $sub2_1 = Subject::create([
            'user_id' => $student2->id,
            'nama_mata_kuliah' => 'Pemrograman Mobile',
            'kode_mata_kuliah' => 'IF-304',
            'dosen' => 'Antonius Wijaya, M.Kom',
            'semester' => 4,
            'warna' => '#f6c23e', // Yellow
        ]);

        Task::create([
            'subject_id' => $sub2_1->id,
            'judul' => 'Project Flutter: UI Clone',
            'deskripsi' => 'Membuat clone UI aplikasi ternama menggunakan Flutter.',
            'deadline' => Carbon::now()->addDays(5),
            'prioritas' => 'Medium',
            'status' => 'Belum Dimulai',
        ]);
    }
}
