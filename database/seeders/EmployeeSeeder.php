<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employes = [
            [
                'name' => 'Adam Philips',
                'skill' => 'Master Barber',
                'description' => 'Experienced in barber for 7 years',
            ],
            [
                'name' => 'Dylan Adams',
                'skill' => 'Hair Expert',
                'description' => 'Have good knowledge in hair world',
            ],
            [
                'name' => 'Gloria Edwards',
                'skill' => 'Beard Expert',
                'description' => 'Experienced in bread expert for 5 years',
            ],
            [
                'name' => 'Josh Dunn',
                'skill' => 'Color Expert',
                'description' => 'Experienced in coloring for 9 years',
            ],
                
            ];

            Employee::insert($employes);
    }
}
