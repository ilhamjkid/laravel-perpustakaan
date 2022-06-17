@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row">
        @auth
            <div class="col-auto mb-2">
                <form action="/report">
                    <form action="/history" method="get">
                        @if (request('dataPerPage'))
                            <input type="hidden" name="dataPerPage" value="{{ request('dataPerPage') }}">
                        @endif
                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif
                        @if (request('page'))
                            <input type="hidden" name="page" value="{{ request('page') }}">
                        @endif
                        <button type="submit" class="btn btn-success">
                            Laporan
                        </button>
                    </form>
                </form>
            </div>
        @endauth
        <div class="col-md-auto">
            <form action="/history" method="get">
                @if (request('dataPerPage'))
                    <input type="hidden" name="dataPerPage" value="{{ request('dataPerPage') }}">
                @endif
                <div class="input-group">
                    <input class="form-control" type="search" name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped fs-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($histories->count() > 0)
                    @foreach ($histories as $history)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration + (request('dataPerPage') ?? 5) * ((request('page') ?? 1) - 1) }}</td>
                            <td>{{ $history->name }}</td>
                            <td>{{ $history->book->title ?? 'Tidak ada' }}</td>
                            <td>
                                <a class="badge bg-primary text-white" href="/history/{{ $history->slug }}">
                                    <span data-feather="eye"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="align-middle">
                        <td colspan="4" class="text-center">
                            Data tidak ada
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="row mb-3">
        <div class="col-auto">
            <form action="/history" method="get">
                <div class="input-group mb-3">
                    <select class="form-select" name="dataPerPage">
                        <option value="5"
                            {{ request('dataPerPage') ? (request('dataPerPage') == 5 ? 'selected' : '') : '' }}>5
                        </option>
                        <option value="10"
                            {{ request('dataPerPage') ? (request('dataPerPage') == 10 ? 'selected' : '') : '' }}>10
                        </option>
                        <option value="15"
                            {{ request('dataPerPage') ? (request('dataPerPage') == 15 ? 'selected' : '') : '' }}>15
                        </option>
                        <option value="20"
                            {{ request('dataPerPage') ? (request('dataPerPage') == 20 ? 'selected' : '') : '' }}>20
                        </option>
                    </select>
                    <button class="btn btn-primary" type="submit">
                        Tampilkan
                    </button>
                </div>
            </form>
        </div>
        <div class="col-auto fs-6">
            {{ $histories->onEachSide(1)->links() }}
        </div>
    </div>

    <script>
        const pagination = document.querySelector('.pagination');
        if (pagination !== null) {
            pagination.classList.add('flex-wrap');
            const btnPagination = document.querySelectorAll('.pagination .page-item');
            const btnPrevious = btnPagination[0].querySelector('.page-link');
            const btnNext = btnPagination[btnPagination.length - 1].querySelector('.page-link');
            btnPrevious.innerHTML = '&laquo;';
            btnNext.innerHTML = '&raquo;';
        }
    </script>
@endsection
