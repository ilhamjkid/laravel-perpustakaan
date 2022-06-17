<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Grade;
use App\Models\User;
use App\Models\Book;
use App\Models\Borrower;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Perpus MTSN',
            'username' => 'perpusmtsn',
            'email' => 'perpusmtsn@gmail.com',
            'password' => Hash::make('qwerty'),
        ]);
    }
}
