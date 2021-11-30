<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{

    public function run()
    {

        $users =  [
            [
                'name' => 'Omar Abdul R.A',
                'email' => 'admin1@gmail.com',
                'username' => 'omar',
                'phone' => '6582123533955',
                'password' => Hash::make('admin'),
                'is_admin' => true
            ],
            [
                'name' => 'Widiareta Safitri',
                'email' => 'admin2@gmail.com',
                'username' => 'widi',
                'phone' => '65255464132135',
                'password' => Hash::make('admin'),
                'is_admin' => true
            ],
        ];

        User::insert($users);
    }
}
