<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealsRestaurant extends Model
{
    use HasFactory;
    protected $table = 'meals_restaurant';

    public $timestamps = true;

    protected $guarded = [];

    public function Meal()
    {
        return $this->belongsTo(Meal::class, 'meal_id');
    }

    public function Restaurant()
    {
        return $this->belongsTo(Restaurant::class,'restaurant_id');
    }
}
