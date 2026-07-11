<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource with search and pagination.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $query = auth()->user()->subjects();

        if (!empty($search)) {
            $query->where(function($q) use ($search) {
                $q->where('nama_mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('kode_mata_kuliah', 'like', "%{$search}%")
                  ->orWhere('dosen', 'like', "%{$search}%");
            });
        }

        $subjects = $query->latest()->paginate(10)->withQueryString();

        return view('student.subjects.index', compact('subjects', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->canCreateSubject()) {
            return redirect()->route('student.subjects.index')
                ->with('error', 'Batas maksimal mata kuliah untuk akun Free telah tercapai. Silakan upgrade ke Premium!');
        }

        return view('student.subjects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubjectRequest $request)
    {
        if (!auth()->user()->canCreateSubject()) {
            return redirect()->route('student.subjects.index')
                ->with('error', 'Batas maksimal mata kuliah untuk akun Free telah tercapai. Silakan upgrade ke Premium!');
        }

        auth()->user()->subjects()->create($request->validated());

        return redirect()->route('student.subjects.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        Gate::authorize('view', $subject);

        return view('student.subjects.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubjectRequest $request, Subject $subject)
    {
        Gate::authorize('update', $subject);

        $subject->update($request->validated());

        return redirect()->route('student.subjects.index')
            ->with('success', 'Mata kuliah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subject $subject)
    {
        Gate::authorize('delete', $subject);

        $subject->delete();

        return redirect()->route('student.subjects.index')
            ->with('success', 'Mata kuliah berhasil dihapus!');
    }
}
