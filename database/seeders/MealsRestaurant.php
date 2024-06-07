<?php

namespace Database\Seeders;

use App\Models\MealsRestaurant as ModelsMealsRestaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealsRestaurant extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsMealsRestaurant::create([
            'meal_id' => '1',
            'restaurant_id' => '1',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '1',
            'restaurant_id' => '2',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '1',
            'restaurant_id' => '3',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '2',
            'restaurant_id' => '1',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '2',
            'restaurant_id' => '4',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '3',
            'restaurant_id' => '1',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '3',
            'restaurant_id' => '3',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '3',
            'restaurant_id' => '4',
        ]);
        ModelsMealsRestaurant::create([
            'meal_id' => '3',
            'restaurant_id' => '5',
        ]);


    }
}
