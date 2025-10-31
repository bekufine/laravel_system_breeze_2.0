<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CoordinatorController extends Controller
{
    public function index(){
        return view("coordinator.dashboard");
    }

    public function orders(){
        $user = Auth::user();
        // $hotel = DB::table("orders")
        //     ->join("hotels", "orders.hotel_id", "=", "hotels.id")
        //     ->join("departments", "orders.dep_id", "=", "departments.id")
        //     ->select('hotels.hotel_name', 'departments.name')
        //     ->get();
            
        $orders = DB::table('orders')
            ->join('hotels', 'orders.hotel_id', '=', 'hotels.id')
            ->join("departments", "orders.dep_id", "=", "departments.id")
            ->where('hotels.city', $user->city)
            ->where("orders.is_done", false )
            ->select('orders.*','hotels.hotel_name', 'departments.name')
            ->orderByDesc('orders.created_at')
            ->paginate(14);
            
        return view('coordinator.orders', ["CoordinatorsOrders" =>$orders]);
    }

    public function history(){
        return view('coordinator.history');
    }
}