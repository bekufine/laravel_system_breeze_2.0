<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OldOrder extends Model
{
    protected $table = 'old_orders';
  

    protected $fillable = ["id",	"order_id",	"hotel_id",	"dep_id",	"user_id",	"event_date",	"work_start_time",	"work_end_time",	"workers_number",	"venue_name",	"event_start_time",	"event_end_time",	"position",	"duty_content",	"guests_number",	"comments",	"created_at",	"updated_at",	"event_style",	"is_done",	"file_path",	"file_type",	"file_size",	"file_name",	"coor_id"];

    //since the keys are different this function is for  renaming the key from order.id->order.order_id cause in table its order_id
    public static function storeFromOrder(Order $order): self 
    {
        $data = $order->toArray();
        $data["order_id"] = $data["id"];
        unset($data["id"]);
        return self::create($data);
    }

    public static function changeIdtoOrderId(Order $order)
    {
        $data = $order->toArray();
        $data["order_id"] = $data["id"];
        unset($data["id"]);
        return $data;
    }
}

