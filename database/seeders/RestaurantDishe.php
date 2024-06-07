<?php

namespace Database\Seeders;

use App\Models\RestaurantDishe as ModelsRestaurantDishe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantDishe extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsRestaurantDishe::create([
            'dishe_id' => '1',
            'restaurant_id' => '1',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '2',
            'restaurant_id' => '1',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '1',
            'restaurant_id' => '2',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '8',
            'restaurant_id' => '2',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '2',
            'restaurant_id' => '3',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '4',
            'restaurant_id' => '3',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '6',
            'restaurant_id' => '4',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '7',
            'restaurant_id' => '4',
        ]);
        ModelsRestaurantDishe::create([
            'dishe_id' => '1',
            'restaurant_id' => '5',
        ]);

    }
}
