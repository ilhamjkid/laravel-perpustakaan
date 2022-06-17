@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row">
        @auth
            <div class="col-auto mb-2">
                <a class="btn btn-primary" href="/borrower/create">Tambah Peminjam</a>
            </div>
        @endauth
        <div class="col-md-auto">
            <form action="/borrower" method="get">
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
                    <th>Nama Peminjam</th>
                    <th>Judul Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($borrowers->count() > 0)
                    @foreach ($borrowers as $borrower)
                        <tr class="align-middle">
                            <td>{{ $loop->iteration + (request('dataPerPage') ?? 5) * ((request('page') ?? 1) - 1) }}</td>
                            <td>{{ $borrower->name }}</td>
                            <td>{{ $borrower->book->title ?? 'Tidak ada' }}</td>
                            <td>
                                <a class="badge bg-primary text-white" href="/borrower/{{ $borrower->slug }}">
                                    <span data-feather="eye"></span>
                                </a>
                                @auth
                                    <a class="badge bg-warning text-white" href="/borrower/{{ $borrower->slug }}/edit">
                                        <span data-feather="edit"></span>
                                    </a>
                                    <button type="button" id="{{ $borrower->slug }}" data-borrower="{{ $borrower->name }}"
                                        class="btn-delete badge bg-danger border-0" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete">
                                        <span data-feather="delete"></span>
                                    </button>
                                    <button type="button" id="{{ $borrower->slug }}" data-borrower="{{ $borrower->name }}"
                                        class="btn-confirm badge bg-success border-0" data-bs-toggle="modal"
                                        data-bs-target="#modalConfirm">
                                        <span data-feather="check-square"></span>
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
            <form action="/borrower" method="get">
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
            {{ $borrowers->onEachSide(1)->links() }}
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteData" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/borrower" method="post" class="modal-content">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteData">Hapus peminjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="delete" value="true">
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

    <!-- Modal -->
    <div class="modal fade" id="modalConfirm" tabindex="-1" aria-labelledby="modalConfirmData" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/book" method="post" class="modal-content">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmData">Konfirmasi peminjam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="confirm" value="true">
                    <h5 class="fs-5"></h5>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Konfirmasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const btnModalDelete = document.querySelectorAll('.btn-delete');
        const btnModalConfirm = document.querySelectorAll('.btn-confirm');
        btnModalDelete.forEach((button) => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#modalDelete form');
                const h5 = modal.querySelector('.fs-5');
                h5.innerHTML = 'Anda yakin ingin menghapus peminjam ' +
                    this.dataset.borrower + '?';
                modal.action = '/borrower/' + this.id;
            });
        });
        btnModalConfirm.forEach((button) => {
            button.addEventListener('click', function() {
                const modal = document.querySelector('#modalConfirm form');
                const h5 = modal.querySelector('.fs-5');
                h5.innerHTML = this.dataset.borrower +
                    ' sudah mengembalikan buku?';
                modal.action = '/borrower/' + this.id;
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
