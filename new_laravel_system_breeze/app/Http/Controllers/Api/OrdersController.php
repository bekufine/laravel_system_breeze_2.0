<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OrdersController extends Controller{
    public function index (){
        return response()->json(Order::all());
    }
    public function hotels(){
        $city= Auth::user()->city;
        return response()->json(Hotel::all()->where("city", "=", $city));
    }
}