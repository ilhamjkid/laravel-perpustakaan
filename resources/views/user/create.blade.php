@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <form action="/user" method="post">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label fs-5">Nama Lengkap :</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label fs-5">Nama Pengguna :</label>
                    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                        id="username" value="{{ old('username') }}">
                    @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fs-5">Email :</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        value="{{ old('email') }}">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fs-5">Password :</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        id="password">
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <a class="btn btn-secondary me-1" href="/user">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
