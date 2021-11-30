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
                'password' =>Hash::make('admin')
            ],
            [
                'name' => 'Widiareta Safitri',
                'email' => 'admin2@gmail.com',
                'username' => 'widi',
                'password' =>Hash::make('admin')
                
            ],   
          ];

          User::insert($users);

    }
}
