<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <style>
        @media print {
            .btn-back {
                display: none;
            }
        }

    </style>
    <title>{{ $title }}</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="display-5 fw-normal my-3">
                    {{ $titlePage }}
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Judul Buku</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Kembali</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                                <tr>
                                    <td>{{ $loop->iteration + (request('dataPerPage') ?? 5) * ((request('page') ?? 1) - 1) }}
                                    </td>
                                    <td>{{ $history->name ?? "" }}</td>
                                    <td>{{ $history->grade->name ?? "" . ' / ' . $history->number ?? "" }}</td>
                                    <td>{{ $history->book->title ?? "" }}</td>
                                    <td>{{ $history->borrow_date ?? "" }}</td>
                                    <td>{{ $history->back_date ?? "" }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <a class="btn-back btn btn-secondary" href="/history">
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="/js/bootstrap.js"></script>
</body>

</html>
