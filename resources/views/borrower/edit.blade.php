@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row mt-2">
        <div class="col-md-10">
            <form action="/borrower/{{ $borrower->slug }}" method="post" class="row">
                @csrf
                @method('put')
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label fs-5">Nama Lengkap :</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name', $borrower->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="slug" id="slug">
                <div class="mb-3 col-md-6">
                    <label for="grade_id" class="form-label fs-5">Kelas :</label>
                    <select class="form-control" name="grade_id" id="grade_id">
                        @foreach ($grades as $grade)
                            @if ($borrower->grade_id === $grade->id)
                                <option value="{{ $grade->id }}" selected>
                                    {{ $grade->name }}
                                </option>
                            @else
                                <option value="{{ $grade->id }}">
                                    {{ $grade->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="number" class="form-label fs-5">Absen :</label>
                    <input type="number" name="number" class="form-control @error('number') is-invalid @enderror"
                        id="number" value="{{ old('number', $borrower->number) }}" min="1">
                    @error('number')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="book_id" class="form-label fs-5">Judul Buku :</label>
                    <select class="form-control" name="book_id" id="book_id">
                        @foreach ($books as $book)
                            @if ($borrower->book_id === $book->id)
                                <option value="{{ $book->id }}" selected>
                                    {{ $book->title }}
                                </option>
                            @else
                                <option value="{{ $book->id }}">
                                    {{ $book->title }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="borrow_date" class="form-label fs-5">Tanggal Pinjam :</label>
                    <input type="date" name="borrow_date" class="form-control @error('borrow_date') is-invalid @enderror"
                        id="borrow_date" value="{{ old('borrow_date', $borrower->borrow_date) }}">
                    @error('borrow_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="back_date" class="form-label fs-5">Tanggal Kembali :</label>
                    <input type="date" name="back_date" class="form-control @error('back_date') is-invalid @enderror"
                        id="back_date" value="{{ old('back_date', $borrower->back_date) }}">
                    @error('back_date')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <a class="btn btn-secondary me-1" href="/borrower">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const name = document.querySelector('input#name');
        const slug = document.querySelector('input#slug');
        name.addEventListener('input', () => {
            fetch('http://127.0.0.1:8000/slugborrower?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data);
        });
    </script>
@endsection
