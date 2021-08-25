<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'PT Transisi Teknologi Mandiri',
                    'email' => 'admin@transisi.id',
                    'password' => Hash::make('transisi')
                ],
                [
                    'name' => 'Akmal',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make('admin')
                ]
            ]
        );
    }
}
