<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Meals extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meal::create([
            'name' => 'Bữa sáng',
        ]);
        Meal::create([
            'name' => 'Bữa trưa',
        ]);
        Meal::create([
            'name' => 'Bữa tối',
        ]);

    }
}
