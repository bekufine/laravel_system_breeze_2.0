<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\OrdersExport;
use App\Models\Hotel;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Services\WeatherService;

class CoordinatorController extends Controller
{   
    protected $user;     
    protected $conditions;

    public function __construct()
        {
            $this->user = Auth::user();
            $this->conditions =[
                ['hotels.city', "=", $this->user->city],
                ["orders.is_done", "=", false]
            ];
        }

    public function dashboard(){
        $todaysOrders = DB::table("orders")
        ->join("hotels","orders.hotel_id", "=", "hotels.id")
        ->join("departments","orders.dep_id", "=", "departments.id")
        ->select("orders.id", "orders.event_date", "hotels.hotel_name", "departments.name", "orders.venue_name", "orders.event_style", "orders.workers_number")
        ->get();
        $weatherData = new WeatherService()->getForecast(Auth::user()->city);
        // dd($todaysOrders);
        $changedOrdersCount = Order::where("is_updated", "=", true)->count();
        
        return view("coordinator.dashboard",["weatherData"=>$weatherData, "todaysOrders" =>$todaysOrders, "changedOrdersCount" => $changedOrdersCount]);
    }
            
    public function index(Request $request){
        
        if($request->input('filter-form')){
            if ($request->filled('hotel')) {
                $this->conditions[] = ["orders.hotel_id", "=", $request->hotel];
            }
            if ($request->filled('department')) {
                $this->conditions[] = ["orders.dep_id", "=", $request->department];
            }
            if ($request->filled("date")){
                $this->conditions[] = ["orders.event_date", "=", $request->date];
            }
        }
        $orders = DB::table('orders')
            ->join('hotels', 'orders.hotel_id', '=', 'hotels.id')
            ->join("departments", "orders.dep_id", "=", "departments.id")
            ->where($this->conditions)
            ->select('orders.*','hotels.hotel_name', 'departments.name')
            ->orderByDesc('orders.created_at')
            ->paginate(14)
            ->withQueryString();
        $hotels = Hotel::all()
        ->where("city", "=", $this->user->city);
        return view('coordinator.orders', ["CoordinatorsOrders" =>$orders, "hotels" => $hotels]);
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

    public function history(Request $request){
        $this->conditions[1][2]=true;
        if($request->input('filter-form')){
            if ($request->filled('hotel')) {
                $this->conditions[] = ["orders.hotel_id", "=", $request->hotel];
            }
            if ($request->filled('department')) {
                $this->conditions[] = ["orders.dep_id", "=", $request->department];
            }
            if ($request->filled("date")){
                $this->conditions[] = ["orders.event_date", "=", $request->date];
            } 
        };
        $orders_list = DB::table("orders")
        ->join("hotels", "orders.hotel_id", "=" , "hotels.id")
        ->join("departments", "orders.dep_id", "=" , "departments.id")
        ->select(
            'orders.*',
            'hotels.hotel_name as hotel_name',
            'departments.name as name'     
        )
        ->where($this->conditions)
        ->orderByDesc('orders.updated_at')
        ->paginate(14)
        ->withQueryString();
        $hotels = Hotel::all()
        ->where("city", "=", $this->user->city);
        // dd($orders_list);

        return view('coordinator.history', ["history_orders"=>$orders_list, "hotels" => $hotels]);
    }

    public function downloadFile(Order $order, Request $request){
        if(Gate::allows('has_access_to_order', $order )){
            $path = $order->file_path;
            return Storage::disk('public')->download($path, $order->file_name);
        }

    }

    public function export() 
    {   
        $orders = request()->orders;
        if (empty($orders)) {
            return back()->with('error', '受注お選びください');
        }
        
        return Excel::download(new OrdersExport($orders), 'orders.xlsx');
    }
    public function show_old_order(Order $order){
        // dd($order);
        // dd($order->hotel_id);
        $order = DB::table("old_orders")
        ->join("hotels", "old_orders.hotel_id", "=" , "hotels.id")
        ->join("departments", "old_orders.dep_id", "=" , "departments.id")
        ->select(
            'old_orders.*',
            'hotels.hotel_name as hotel_name',
            'departments.name as name'     
        )
        ->where("old_orders.order_id","=", $order->id)
        ->get();
        // dd($order);
        return view("coordinator.show_order",["order"=>$order[0]]);
    }

    public function show_order(Order $order){
        $record = DB::table("orders")
        ->join("hotels", "orders.hotel_id", "=", "hotels.id")
        ->join("departments", "orders.dep_id", "=", "departments.id")
        ->select(
            'orders.*',
            'hotels.hotel_name as hotel_name',
            'departments.name as name'     
        )
        ->where("orders.id","=", $order->id)
        ->get();
        return view("coordinator.show_order",["order"=>$record[0]]);
    }
}