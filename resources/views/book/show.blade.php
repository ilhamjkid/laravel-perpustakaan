@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <ol class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Sumber Buku</div>
                        <div class="fs-5 fw-normal">{{ $book->source }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Kategori Buku</div>
                        <div class="fs-5 fw-normal">{{ $book->category->name ?? 'Tidak ada' }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Pengarang Buku</div>
                        <div class="fs-5 fw-normal">{{ $book->author }}</div>
                    </div>
                </li>
            </ol>
        </div>
        <div class="col-md-6">
            <ol class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Penerbit Buku</div>
                        <div class="fs-5 fw-normal">{{ $book->publisher }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Tahun Terbit</div>
                        <div class="fs-5 fw-normal">{{ $book->published_year }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Stok Buku</div>
                        <div class="fs-5 fw-normal">{{ $book->stock }}</div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="/book" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection
