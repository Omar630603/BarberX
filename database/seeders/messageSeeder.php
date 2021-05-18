<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class messageSeeder extends Seeder
{

    public function run()
    {
      
        DB::table('message')->insert([
            'name' => 'Widiareta',
            'email' => 'widiareta@jamil.com',
            'title' => 'It Was Very Nice Service',
            'messagetext' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
            'show' => 0
        ],
    );
           
          
    }
}
