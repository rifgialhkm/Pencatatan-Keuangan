<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('categories')->insert([
            'name' => 'Tagihan',
            'type' => 'Pengeluaran',
            'created_at' => now()
        ]);

        DB::table('categories')->insert([
            'name' => 'Penjualan',
            'type' => 'Pemasukan',
            'created_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password123321'),
            'created_at' => now()
        ]);
    }
}
