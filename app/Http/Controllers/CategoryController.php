<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('category.index', [
            'title' => 'Kategori',
            'titlePage' => 'Halaman Kategori',
            'categories' => Category::latest()
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
        return view('category.create', [
            'title' => 'Kategori',
            'titlePage' => 'Tambah Kategori',
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
            'name' => ['required', 'min:3', 'max:255', 'unique:categories'],
            'slug' => ['required', 'min:3', 'max:255', 'unique:categories'],
        ]);
        Category::create($validatedData);
        return redirect('/category')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('category.edit', [
            'title' => 'Category',
            'titlePage' => 'Ubah Kategori',
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        if (
            $request->name === $category->name &&
            $request->slug === $category->slug
        ) {
            return redirect('/category');
        }
        $rules = [];
        if ($request->name !== $category->name) {
            $rules['name'] = ['required', 'min:3', 'max:255', 'unique:categories'];
        }
        if ($request->slug !== $category->slug) {
            $rules['slug'] = ['required', 'min:3', 'max:255', 'unique:categories'];
        }
        $validatedData = $request->validate($rules);
        Category::where('slug', $category->slug)->update($validatedData);
        return redirect('/category')->with('success', 'Kategori berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        Category::where('slug', $category->slug)->delete();
        return redirect('/category')->with('success', 'Kategori berhasil dihapus!');
    }

    public function checkslug(Request $request)
    {
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json($slug);
    }
    
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
}
