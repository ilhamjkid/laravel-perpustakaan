<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Grade;
use App\Models\History;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('borrower.index', [
            'title' => 'Peminjam',
            'titlePage' => 'Halaman Peminjam',
            'borrowers' => Borrower::with(['grade', 'book'])->latest()
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
        return view('borrower.create', [
            'title' => 'Peminjam',
            'titlePage' => 'Tambah Peminjam',
            'grades' => Grade::all(),
            'books' => Book::all(),
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
            'name' => ['required', 'min:2', 'max:255'],
            'slug' => ['required', 'min:2', 'unique:borrowers'],
            'number' => ['required', 'integer', 'min:1'],
            'borrow_date' => ['required', 'date'],
            'back_date' => ['required', 'date'],
        ]);
        $validatedData['grade_id'] = intval($request->grade_id);
        $validatedData['book_id'] = intval($request->book_id);
        Borrower::create($validatedData);
        return redirect('/borrower')
            ->with('success', 'Peminjam berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function show(Borrower $borrower)
    {
        return view('borrower.show', [
            'title' => 'Peminjam',
            'titlePage' => $borrower->name,
            'borrower' => $borrower->load(['grade', 'book']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function edit(Borrower $borrower)
    {
        return view('borrower.edit', [
            'title' => 'Peminjam',
            'titlePage' => 'Ubah Peminjam',
            'grades' => Grade::all(),
            'books' => Book::all(),
            'borrower' => $borrower,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Borrower $borrower)
    {
        $rules = [
            'name' => ['required', 'min:2', 'max:255'],
            'number' => ['required', 'integer', 'min:1'],
            'borrow_date' => ['required', 'date'],
            'back_date' => ['required', 'date'],
        ];
        if ($request->slug !== $borrower->slug) {
            $rules['slug'] = ['required', 'min:2', 'unique:borrowers'];
        }
        $validatedData = $request->validate($rules);
        $validatedData['grade_id'] = intval($request->grade_id);
        $validatedData['book_id'] = intval($request->book_id);
        Borrower::where('slug', $borrower->slug)
            ->update($validatedData);
        return redirect('/borrower')
            ->with('success', 'Peminjam berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Borrower  $borrower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Borrower $borrower)
    {
        $message = 'berhasil dihapus!';
        if (request('confirm')) {
            $validatedData = [
                'name' => $borrower->name,
                'slug' => $borrower->slug,
                'number' => $borrower->number,
                'borrow_date' => $borrower->borrow_date,
                'back_date' => $borrower->back_date,
                'grade_id' => intval($borrower->grade_id),
                'book_id' => intval($borrower->book_id),
            ];
            History::create($validatedData);
            $message = 'sudah mengembalikan buku!';
        }
        Borrower::where('slug', $borrower->slug)->delete();
        return redirect('/borrower')->with('success', "Peminjam $message");
    }

    public function checkslug(Request $request)
    {
        $slug = SlugService::createSlug(Borrower::class, 'slug', $request->name);
        return response()->json($slug);
    }
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
}
