<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grade.index', [
            'title' => 'Kelas',
            'titlePage' => 'Halaman Kelas',
            'grades' => Grade::latest()
                ->filter(request(['search']))
                ->paginate(request('dataPerPage') ?? 5)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grade.create', [
            'title' => 'Kelas',
            'titlePage' => 'Tambah Kelas',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255', 'unique:grades'],
            'slug' => ['required', 'min:3', 'max:255', 'unique:grades'],
        ]);
        Grade::create($validatedData);
        return redirect('/grade')->with(
            'success',
            'Kelas berhasil ditambahkan!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit(Grade $grade)
    {
        return view('grade.edit', [
            'title' => 'Kelas',
            'titlePage' => 'Ubah Kelas',
            'grade' => $grade,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grade $grade)
    {
        if (
            $request->name === $grade->name &&
            $request->slug === $grade->slug
        ) {
            return redirect('/grade');
        }
        $rules = [];
        if ($request->name !== $grade->name) {
            $rules['name'] = [
                'required', 'min:3', 'max:255', 'unique:grades'
            ];
        }
        if ($request->slug !== $grade->slug) {
            $rules['slug'] = [
                'required', 'min:3', 'max:255', 'unique:grades'
            ];
        }
        $validatedData = $request->validate($rules);
        Grade::where('slug', $grade->slug)
            ->update($validatedData);
        return redirect('/grade')->with('success', 'Kelas berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grade $grade)
    {
        Grade::where('slug', $grade->slug)->delete();
        return redirect('/grade')->with(
            'success',
            'Kelas berhasil dihapus!'
        );
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Grade::class, 'slug', $request->name);
        return response()->json($slug);
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
}
