@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $titlePage }}</h1>
    </div>
    <div class="row justify-content-evenly">
        @foreach ($allData as $data)
            <div class="col-md-6">
                <a href="/{{ $data['link'] }}"
                    class="d-block mb-4 shadow overflow-hidden text-decoration-none element-dashboard"
                    style="border-radius:10px">
                    <div class="row">
                        <div class="col-4 bg-success p-4 py-lg-5 d-flex justify-content-center">
                            <img src="/images/{{ $data['image'] }}" alt="Book" class="img-fluid" style="height: 100%">
                        </div>
                        <div class="col-8 bg-light">
                            <div style="height: 100%" class="row align-content-center align-items-center">
                                <div class="col-12">
                                    <h2 class="fs-2 text-center text-success">
                                        {{ $data['name'] }}
                                    </h2>
                                </div>
                                <div class="col-12">
                                    <h1 class="display-1 fw-normal text-secondary text-center">
                                        {{ $data['tabel']->count() }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection
