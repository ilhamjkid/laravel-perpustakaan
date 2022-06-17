@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row mt-2">
        <div class="col-md-10">
            <form action="/book/{{ $book->slug }}" method="post" class="row">
                @csrf
                @method('put')
                <div class="mb-3 col-12">
                    <label for="title" class="form-label fs-5">Judul Buku :</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title"
                        value="{{ old('title', $book->title) }}">
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="slug" id="slug" value="{{ old('slug', $book->slug) }}">
                <div class="mb-3 col-md-6">
                    <label for="source" class="form-label fs-5">Sumber Buku :</label>
                    <input type="text" name="source" class="form-control @error('source') is-invalid @enderror" id="source"
                        value="{{ old('source', $book->source) }}">
                    @error('source')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="category_id" class="form-label fs-5">Kategori Buku :</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            @if ($category->id === $book->category_id)
                                <option value="{{ $category->id }}" selected>
                                    {{ $category->name }}
                                </option>
                            @else
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="author" class="form-label fs-5">Pengarang Buku :</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror" id="author"
                        value="{{ old('author', $book->author) }}">
                    @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="publisher" class="form-label fs-5">Penerbit Buku :</label>
                    <input type="text" name="publisher" class="form-control @error('publisher') is-invalid @enderror"
                        id="publisher" value="{{ old('publisher', $book->publisher) }}">
                    @error('publisher')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="published_year" class="form-label fs-5">Tahun Terbit Buku :</label>
                    <input type="number" name="published_year"
                        class="form-control @error('published_year') is-invalid @enderror" id="published_year"
                        value="{{ old('published_year', $book->published_year) }}" min="1901" max="2150">
                    @error('published_year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="stock" class="form-label fs-5">Stok Buku :</label>
                    <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" id="stock"
                        value="{{ old('stock', $book->stock) }}" min="1">
                    @error('stock')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <a class="btn btn-secondary me-1" href="/book">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const title = document.querySelector('input#title');
        const slug = document.querySelector('input#slug');
        title.addEventListener('input', () => {
            fetch('http://127.0.0.1:8000/slugbook?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data);
        });
    </script>
@endsection
