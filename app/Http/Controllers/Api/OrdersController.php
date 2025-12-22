<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Order;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller{
    public function index (){
        return response()->json(Order::all());
    }
    public function departments(Hotel $hotel){
        return response()->json(Department::all()->where("hotel_id","=", $hotel->id));
    }
    public function orders_for_coordiantor_dashboard(){
        $todaysOrders = Order::whereHas("hotel", function($q){
            $q->where("city", Auth::user()->city);
        })->get();
        return response()->json($todaysOrders);
    }
    
}