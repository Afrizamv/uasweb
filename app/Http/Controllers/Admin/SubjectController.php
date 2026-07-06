<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of all subjects in the system.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Subject::with('user');

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('kode_mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('dosen', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $subjects = $query->latest()->paginate(15)->withQueryString();

        return view('admin.subjects', compact('subjects', 'search'));
    }
}
