@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row">
        @auth
            <div class="col-auto mb-2">
                <a class="btn btn-primary" href="/book/create">Tambah Buku</a>
            </div>
        @endauth
        <div class="col-md-auto">
            <form action="/book" method="get">
                @if (request('dataPerPage'))
                    <input type="hidden" name="dataPerPage" value="{{ request('dataPerPage') }}">
                @endif
                <div class="input-group">
                    <input class="form-control" type="search" name="search" value="{{ request('search') }}">
                </div>
            </form>
        </div>
    </div>
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-striped fs-5">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($books->count() > 0)
                    @foreach ($books as $book)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration + (request('dataPerPage') ?? 5) * ((request('page') ?? 1) - 1) }}</td>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category->name ?? 'Tidak ada' }}</td>
                            <td>
                                <a class="badge bg-primary text-white" href="/book/{{ $book->slug }}">
                                    <span data-feather="eye"></span>
                                </a>
                                @auth
                                    <a class="badge bg-warning text-white" href="/book/{{ $book->slug }}/edit">
                                        <span data-feather="edit"></span>
                                    </a>
                                    <button type="button" id="{{ $book->slug }}" data-book="{{ $book->title }}"
                                        class="btn-delete badge bg-danger border-0" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete">
                                        <span data-feather="delete"></span>
                                    </button>
                                @endauth
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
            <form action="/book" method="get">
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
            {{ $books->onEachSide(1)->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteData" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/book" method="post" class="modal-content">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteData">Hapus buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="fs-5"></h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">
                        Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const btnModal = document.querySelectorAll('.btn-delete');
        btnModal.forEach((button) => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#modalDelete form');
                const h5 = modal.querySelector('.fs-5');
                h5.innerHTML = 'Anda yakin ingin menghapus buku ' +
                    this.dataset.book;
                modal.action = '/book/' + this.id;
            });
        });
        const pagination = document.querySelector('.pagination')
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
