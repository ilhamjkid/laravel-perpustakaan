<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index', [
            'title' => 'Pengguna',
            'titlePage' => 'Halaman Pengguna',
            'users' => User::latest()->filter(request(['search']))
                ->paginate(request('dataPerPage') ?? 5)->withQueryString(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create', [
            'title' => 'Pengguna',
            'titlePage' => 'Tambah Pengguna',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'username' => ['required', 'min:5', 'unique:users', 'alpha_dash'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'min:8'],
        ]);
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);
        return redirect('/user')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', [
            'title' => 'Pengguna',
            'titlePage' => 'Ubah Pengguna',
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'name' => ['required', 'min:3', 'max:255'],
        ];
        if ($request->username !== $user->username) {
            $rules['username'] = ['required', 'min:5', 'unique:users', 'alpha_dash'];
        }
        if ($request->email !== $user->email) {
            $rules['email'] = ['required', 'email', 'unique:users'];
        }
        if ($request->password !== $user->password) {
            $rules['password'] = ['required', 'min:8'];
        }
        $validatedData = $request->validate($rules);
        if (isset($validatedData['password'])) {
            $validatedData['password'] =
                Hash::make($validatedData['password']);
        }
        User::where('username', $user->username)
            ->update($validatedData);
        return redirect('/user')
            ->with('success', 'Pengguna berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        User::where('username', $user->username)->delete();
        return redirect('/user')->with('success', 'Pengguna berhasil dihapus!');
    }
}
