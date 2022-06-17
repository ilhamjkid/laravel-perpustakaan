<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrower;
use App\Models\Category;
use App\Models\Grade;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index', [
            'title' => 'Dasbor',
            'titlePage' => 'Halaman Dasbor',
            'allData' => [
                [
                    'name' => 'Kelas',
                    'tabel' => Grade::all(),
                    'image' => 'hexagon.svg',
                    'link' => 'grade',
                ],
                [
                    'name' => 'Kategori',
                    'tabel' => Category::all(),
                    'image' => 'grid.svg',
                    'link' => 'category',
                ],
                [
                    'name' => 'Buku',
                    'tabel' => Book::all(),
                    'image' => 'book.svg',
                    'link' => 'book',
                ],
                [
                    'name' => 'Peminjam',
                    'tabel' => Borrower::all(),
                    'image' => 'book-open.svg',
                    'link' => 'borrower',
                ],
            ],
        ]);
    }
}
