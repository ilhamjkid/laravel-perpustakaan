<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('history.index', [
            'title' => 'Sejarah',
            'titlePage' => 'Halaman Sejarah',
            'histories' => History::with(['grade', 'book'])->latest()
                ->filter(request(['search']))
                ->paginate(request('dataPerPage') ?? 5)
                ->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        return view('history.show', [
            'title' => 'Sejarah',
            'titlePage' => $history->name,
            'history' => $history->load(['grade', 'book']),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(History $history)
    {
        //
    }

    public function report(Request $request)
    {
        return view('history.report', [
            'title' => 'Sejarah',
            'titlePage' => 'Laporan Peminjam',
            'histories' => History::with(['grade', 'book'])->latest()
                ->filter(request(['search']))
                ->paginate(request('dataPerPage') ?? 5)
                ->withQueryString(),
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'report']]);
    }
}
