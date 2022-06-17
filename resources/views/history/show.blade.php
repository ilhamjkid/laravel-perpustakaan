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
                        <div class="fs-4 fw-bold">Kelas</div>
                        <div class="fs-5 fw-normal">{{ $history->grade->name ?? 'Tidak ada' }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Absen</div>
                        <div class="fs-5 fw-normal">{{ $history->number }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Judul Buku</div>
                        <div class="fs-5 fw-normal">{{ $history->book->title ?? 'Tidak ada' }}</div>
                    </div>
                </li>
            </ol>
        </div>
        <div class="col-md-6">
            <ol class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Tanggal Dibuat</div>
                        <div class="fs-5 fw-normal">{{ $history->created_at->diffForHumans() }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Tanggal Pinjam</div>
                        <div class="fs-5 fw-normal">{{ $history->borrow_date }}</div>
                    </div>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fs-4 fw-bold">Tanggal Kembali</div>
                        <div class="fs-5 fw-normal">{{ $history->back_date }}</div>
                    </div>
                </li>
            </ol>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <a href="/history" class="btn btn-secondary">
                Kembali
            </a>
        </div>
    </div>
@endsection
