<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantDishe extends Model
{
    use HasFactory;
    protected $table = 'restaurant_dishe';

    public $timestamps = true;

    protected $guarded = [];
}
