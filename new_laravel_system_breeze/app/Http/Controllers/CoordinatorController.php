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
        $orders = DB::table('orders')
            ->join('hotels', 'orders.hotel_id', '=', 'hotels.id')
            ->where('hotels.city', $user->city)
            ->select('orders.*')
            ->get();
        return view('coordinator.orders', ["orders" =>$orders]);
    }

    public function history(){
        return view('coordinator.history');
    }
}