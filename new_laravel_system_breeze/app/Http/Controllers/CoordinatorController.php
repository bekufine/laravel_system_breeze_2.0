<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdersExport;
use Maatwebsite\Excel\Facades\Excel;

class CoordinatorController extends Controller
{

    public function index(){
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

    public function store(){
        $orders_id = request()->orders;
        if (empty($orders_id)) {
            return back()->with('error', '受注お選びください');
        }
        foreach($orders_id as $key => $value){
            $order = Order::findOrFail($value);
            $order->is_done = true;
            $order->save();
        }
        return redirect("/coordinator/orders")->with('success', 'ご注文は履歴リストに移動されました ✅');;
    }

    public function history(){
        $user = Auth::user();
        $orders_list = DB::table("orders")
        ->join("hotels", "orders.hotel_id", "=" , "hotels.id")
        ->join("departments", "orders.dep_id", "=" , "departments.id")
        ->where("hotels.city", $user->city)
        ->where("orders.is_done", true)
        ->orderByDesc('orders.updated_at')
        ->paginate(14);
        // $orders_list = Order::where("user_id", $user->id)
        // ->where("is_done", false)->get();
        return view('coordinator.history', ["orders"=>$orders_list]);
    }

    public function export() 
    {   
        $orders = request()->orders;
        if (empty($orders)) {
            return back()->with('error', '受注お選びください');
        }
        
        return Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }
}