<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderController extends Controller
{
    public function page(){
        return view('orders.create');
    }
        // 'hotel_id',
        // 'dep_id',
        // 'coor_id',
    public function history(){
        $user = Auth::user();
        $orders = Order::where('hotel_id', $user->hotel_id)->
        where('dep_id', $user->dep_id)->
        where('user_id', $user->id)->latest()->paginate(14);
        return view('orders.history', compact('orders'));
    }

    public function store(Request $request){
        $data = $request->all(); 
        $user = Auth::user();
        // dd($data);
        $validated = $request ->validate([
            'orders.*.hotel_id'         => 'required|integer',
            'orders.*.dep_id'           => 'required|integer',
            'orders.*.user_id'          => 'required|integer', //changed from coor_id to user_id
            'orders.*.event_date'       => 'required|date',
            'orders.*.work_start_time'  => 'required|date_format:H:i',
            'orders.*.work_end_time'    => 'required|date_format:H:i',
            'orders.*.workers_number'   => 'required|integer|min:1',
            'orders.*.event_start_time' => 'required|date_format:H:i',
            'orders.*.event_end_time'   => 'required|date_format:H:i',
            'orders.*.guests_number'    => 'required|integer|min:1',
            'orders.*.duty_content'     => 'required|string',
            'orders.*.venue_name'       => 'required|string',
            'orders.*.position'         => 'required|string',
            'orders.*.comments'         => 'nullable|string',
            'orders.*.event_style'      => 'nullable|string'

        ]); 
        foreach($validated["orders"] as $orderRow){
            Order::create($orderRow); 
        }
        return redirect()->back()->with("success",  'Order is updated ✅!');
        
    }
    //update record
    public function update($id){
        
        $data = request()->all()["orders"]["0"];
        // dd($data);
        $validated = request()->validate([
            'orders.*.hotel_id'         => 'required|integer',
            'orders.*.dep_id'           => 'required|integer',
            'orders.*.user_id'          => 'required|integer',
            'orders.*.event_date'       => 'required|date',
            'orders.*.work_start_time'  => 'required|date_format:H:i',
            'orders.*.work_end_time'    => 'required|date_format:H:i',
            'orders.*.workers_number'   => 'required|integer|min:1',
            'orders.*.event_start_time' => 'required|date_format:H:i',
            'orders.*.event_end_time'   => 'required|date_format:H:i',
            'orders.*.guests_number'    => 'required|integer|min:1',
            'orders.*.duty_content'     => 'required|string',
            'orders.*.venue_name'       => 'required|string',
            'orders.*.position'         => 'required|string',
            'orders.*.comments'         => 'nullable|string',
            'orders.*.event_style'      => 'nullable|string'
        ]);
        
        $order = Order::find($id);
        // dd($order);
        $order->update([
            'hotel_id'=> $data["hotel_id"],
            'dep_id'=> $data["dep_id"], 
            'user_id'=> $data["user_id"],
            'event_date'=> $data["event_date"],
            'work_start_time'=> $data["work_start_time"],
            'work_end_time'=> $data["work_end_time"],
            'workers_number'=> $data["workers_number"],
            'event_start_time'=> $data["event_start_time"],
            'event_end_time'=> $data["event_end_time"],
            'guests_number'=> $data["guests_number"],
            'duty_content'=> $data["duty_content"],
            'venue_name'=> $data["venue_name"],
            'position'=> $data["position"],
            'comments'=> $data["comments"],
            'event_style'=> $data["event_style"]
        ]);
        return redirect(route("order.show", ["id"=>$id]))
        ->with('success', 'Order is updated ✅!');
    }

    //show record
    public function show($id){
        $order = Order::where('id', $id)->first();
        return view('orders.change', compact('order'));
    }

}
