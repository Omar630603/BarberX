<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{

  public function run()
  {
    $services = [
      [
        'category_service_id' => 1,
        'name' => 'hair cut',
        'price' => 20000
      ],

      [
        'category_service_id' => 1,
        'name' => 'hair steam',
        'price' => 20000
      ],
      [
        'category_service_id' => 1,
        'name' => 'wedding cuts',
        'price' => 50000
      ],
      [
        'category_service_id ' => 2,
        'name' => 'hair color',
        'price' => 20000
      ],
      [
        'category_service_id' => 2,
        'name' => 'shampoo',
        'price' => 20000
      ],
      [
        'category_service_id' => 2,
        'name' => 'hair wash',
        'price' => 20000
      ],
      [
        'category_service_id' => 3,
        'name' => 'bread trim',
        'price' => 20000
      ],
      [
        'category_service_id' => 3,
        'name' => 'bread shave',
        'price' => 20000
      ],

      [
        'category_service_id' => 3,
        'name' => 'wedding breads',
        'price' => 20000
      ],

      [
        'category_service_id' => 3,
        'name' => 'wedding breadsss',
        'price' => 20000
      ],
    ];

    Service::insert($services);
  }
}
