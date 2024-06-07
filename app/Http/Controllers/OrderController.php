<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealsRestaurant;
use App\Models\Order;
use App\Models\OrderDish;
use App\Models\RestaurantDishe;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function StepOrder(){
        $meals = Meal::all();
        return view('StepOrder',compact('meals'));
    }

    public function getRestaurants($id)
    {
        $restaurants = MealsRestaurant::join('restaurants','restaurants.id','=','meals_restaurant.restaurant_id')
        ->where('meal_id', $id)->get();
        return response()->json($restaurants);
    }

    public function getdishes($id)
    {
        $dishe = RestaurantDishe::join('dishes','dishes.id','=','restaurant_dishe.dishe_id')
        ->where('restaurant_id', $id)->get();
        return response()->json($dishe);
    }

    public function submitFormOrder(Request $request)
    {
        $data = $request->all();

        // Tạo đơn hàng mới
        $order = new Order();
        $order->meal_id = $data['meal_category']['id'];
        $order->restaurant_id = $data['restaurant']['id'];
        $order->num_people = $data['num_people'];


        $order->save();

        // Lưu các món ăn trong đơn hàng
        foreach ($data['dishes'] as $dish) {
            $orderDish = new OrderDish();
            $orderDish->order_id = $order->id;
            $orderDish->dish_id = $dish['id'];
            $orderDish->servings = $dish['servings'];
            $orderDish->save();
        }
        return response()->json(['message' => 'Form submitted successfully!']);
    }
}
