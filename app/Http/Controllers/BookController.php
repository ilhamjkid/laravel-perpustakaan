<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('book.index', [
            'title' => 'Buku',
            'titlePage' => 'Halaman Buku',
            'books' => Book::with('category')->latest()
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
        return view('book.create', [
            'title' => 'Buku',
            'titlePage' => 'Tambah Buku',
            'categories' => Category::all(),
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
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:books'],
            'source' => ['required', 'max:255'],
            'author' => ['required'],
            'publisher' => ['required'],
            'published_year' => ['required', 'integer', 'between:1901,2150'],
            'stock' => ['required', 'integer', 'min:1'],
        ]);
        $validatedData['category_id'] = intval($request->category_id);
        Book::create($validatedData);
        return redirect('/book')
            ->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', [
            'title' => 'Buku',
            'titlePage' => 'Buku ' . $book->title,
            'book' => $book->load('category'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('book.edit', [
            'title' => 'Buku',
            'titlePage' => 'Ubah Buku',
            'book' => $book,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'source' => ['required', 'max:255'],
            'author' => ['required'],
            'publisher' => ['required'],
            'published_year' => ['required', 'integer', 'between:1901,2150'],
            'stock' => ['required', 'integer', 'min:1'],
        ];
        if ($request->slug !== $book->slug) {
            $rules['slug'] = ['required', 'unique:books'];
        }
        $validatedData = $request->validate($rules);
        $validatedData['category_id'] = intval($request->category_id);
        Book::where('slug', $book->slug)->update($validatedData);
        return redirect('/book')->with('success', 'Buku berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::where('slug', $book->slug)->delete();
        return redirect('/book')->with('success', 'Buku berhasil dihapus!');
    }

    public function checkslug(Request $request)
    {
        $slug = SlugService::createSlug(Book::class, 'slug', $request->title);
        return response()->json($slug);
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
}
