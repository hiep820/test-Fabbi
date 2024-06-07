<?php

namespace Database\Seeders;

use App\Models\Restaurant as ModelsRestaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Restaurant extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 1',
        ]);
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 2',
        ]);
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 3',
        ]);
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 4',
        ]);
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 5',
        ]);
        ModelsRestaurant::create([
            'name' => 'Nhà hàng 6',
        ]);
    }
}
