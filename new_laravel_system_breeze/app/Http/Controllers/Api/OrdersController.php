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
    
}