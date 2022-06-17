@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <form action="/category/{{ $category->slug }}" method="post">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="name" class="form-label fs-5">Nama Kategori :</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name', $category->name) }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="slug" class="form-label fs-5">Slug Kategori :</label>
                    <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug"
                        value="{{ old('slug', $category->slug) }}">
                    @error('slug')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <a class="btn btn-secondary me-1" href="/category">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const name = document.querySelector('input#name');
        const slug = document.querySelector('input#slug');
        name.addEventListener('input', () => {
            fetch('http://127.0.0.1:8000/slugcategory?name=' + name.value)
                .then(response => response.json())
                .then(data => slug.value = data);
        });
    </script>
@endsection
