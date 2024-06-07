<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Dishes as ModelsDishes;

class Dishes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     ModelsDishes::create([
        'name' => 'Cơm',
     ]);
     ModelsDishes::create([
        'name' => 'Cá rán',
     ]);
     ModelsDishes::create([
        'name' => 'Canh cua',
     ]);
     ModelsDishes::create([
        'name' => 'Mì tôm',
     ]);
     ModelsDishes::create([
        'name' => 'Mực nướng',
     ]);
     ModelsDishes::create([
        'name' => 'Tôm hùm',
     ]);
     ModelsDishes::create([
        'name' => 'Cua hoàng đế',
     ]);
     ModelsDishes::create([
        'name' => 'Rau muống luộc',
     ]);
     ModelsDishes::create([
        'name' => 'Thịt bò',
     ]);
    }
}
