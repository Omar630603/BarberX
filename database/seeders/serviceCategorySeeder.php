<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryService;

class serviceCategorySeeder extends Seeder
{
    
    public function run()
    {
        $serviceCategories = [
            ['name' => 'Hair Cut'],
            ['name' => 'Color & Wash'],
            ['name' => 'Beard Style'],
        ];

        CategoryService::insert($serviceCategories);
    }
}
