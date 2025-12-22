<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OldOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\File;
use App\Services\WeatherService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Throwable;



class OrderController extends Controller
{
    public function dashboard(){
        // $currentDate = date('Y-m-d');
        $todaysOrders = Order::all()
        ->where("user_id", "=" , Auth::user()->id);
        $weatherData = new WeatherService()->getForecast(Auth::user()->city);
        return view('dashboard',["weatherData"=>$weatherData, "todaysOrders"=>$todaysOrders]);
    }

    public function page(){
        return view('orders.create');
    }
     
    public function history(){
        $user = Auth::user();
        $orders = Order::where('hotel_id', $user->hotel_id)->
        where('dep_id', $user->dep_id)->
        where('user_id', $user->id)->latest()->paginate(14);
        return view('orders.history', compact('orders'));
    }

    public function store(Request $request){
        try{
            $validated = $request ->validate([
                'orders.*.hotel_id'         => 'required|integer',
                'orders.*.dep_id'           => 'required|integer',
                'orders.*.user_id'          => 'required|integer', //changed from coor_id to user_id
                'orders.*.event_date'       => 'required|date',
                'orders.*.work_start_time'  => 'required|string',
                'orders.*.work_end_time'    => 'required|string',
                'orders.*.workers_number'   => 'required|integer|min:1',
                'orders.*.event_start_time' => 'required|string',
                'orders.*.event_end_time'   => 'required|string',
                'orders.*.guests_number'    => 'required|integer|min:1',
                'orders.*.duty_content'     => 'required|string',
                'orders.*.venue_name'       => 'required|string',
                'orders.*.position'         => 'required|string',
                'orders.*.comments'         => 'nullable|string',
                'orders.*.event_style'      => 'nullable|string',
                'orders.*.file'      => ['sometimes',File::types(['xlsx', 'xls', 'csv', 'doc', 'docx','pdf'])->max(15120)]
            ]);
        } catch(ValidationException $e){
            return back()
            ->withErrors($e->validator)
            ->withInput();
        }
        
        foreach($validated["orders"] as $orderRow){
            
            // if ($file = $orderRow["file"]){
            if (array_key_exists("file", $orderRow)){
                $file = $orderRow["file"];
                $path = $file->store('uploads', 'public');
                $orderRow["file_path"]=$path;
                $orderRow["file_type"]= $file->extension();
                $orderRow["file_size"]= $file->getSize();
                $orderRow["file_name"]= $file->getClientOriginalName();
            }
            // dd($orderRow);
            unset($orderRow["file"]); 
            Order::create($orderRow);
        }
        return redirect()->back()->with("success",  'ご注文送りました ✅!');
        
    }

    //link to download a file
    
    //update record
    public function update(Order $order){
        // $order = Order::find($id);
        $data = request()->all()["orders"]["0"];
        // dd($data);
        $validated = request()->validate([
            'orders.*.hotel_id'         => 'required|integer',
            'orders.*.dep_id'           => 'required|integer',
            'orders.*.user_id'          => 'required|integer',
            'orders.*.event_date'       => 'required|date',
            'orders.*.work_start_time'  => 'required|string',
            'orders.*.work_end_time'    => 'required|string',
            'orders.*.workers_number'   => 'required|integer|min:1',
            'orders.*.event_start_time' => 'required|string',
            'orders.*.event_end_time'   => 'required|string',
            'orders.*.guests_number'    => 'required|integer|min:1',
            'orders.*.duty_content'     => 'required|string',
            'orders.*.venue_name'       => 'required|string',
            'orders.*.position'         => 'required|string',
            'orders.*.comments'         => 'nullable|string',
            'orders.*.event_style'      => 'nullable|string'
        ]);
        
        $oldOrderExists = OldOrder::where("order_id", $order->id)->exists();
        if($oldOrderExists){
            $orderToUpdate = Oldorder::where("order_id", $order->id)->first();
            // dd($orderToUpdate);
            $changeddata = OldOrder::changeIdtoOrderId($order);
            // dd($changeddata);
            $orderToUpdate->update($changeddata);
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
                'event_style'=> $data["event_style"],
                "is_updated"=>true
            ]);
            return redirect(route("order.history"))
            ->with('success', '発注は更新されました ✅!');
            // dd("go and check");
        }
        // $order = Order::find($id);
        else{
            $order_copy = clone $order;
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
                'event_style'=> $data["event_style"],
                "is_updated"=>true
            ]);
            // dd($order_copy);
            OldOrder::storeFromOrder($order_copy);
            return redirect(route("order.history"))
            ->with('success', '発注は更新されました ✅!');
        }
    }

    //show record
    public function show(Order $order){
        return view('orders.show', ["order"=>$order]);
    }
}
