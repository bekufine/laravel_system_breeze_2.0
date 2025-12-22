<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class OrdersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private array $orderIds;

    public function __construct(array $orders)
    {
        $this->orderIds = $orders;
        // dd($this->orderIds);
    }

    public function collection()
    {
        return DB::table('orders')
        ->join("hotels", "orders.hotel_id", "=", "hotels.id")
        ->join("departments", "orders.dep_id", "=", "departments.id")
        ->select("orders.*", "hotels.hotel_name", "departments.name")
        ->whereIn("orders.id", $this->orderIds)
        ->select( "orders.id", "orders.event_date as 日付", "hotels.hotel_name as ホテル名", "departments.name as デパート名", 
                 "orders.venue_name as 会場名","orders.event_style as イベントスタイル","orders.event_start_time as イベント開始時刻",
                 "orders.event_end_time as イベント終了時刻","orders.position as 役職","orders.work_start_time as 作業開始時刻",
                "orders.work_end_time as 作業終了時刻","orders.workers_number as 労働者数","orders.guests_number as ゲスト数",
                "orders.duty_content as 義務内容","orders.comments as コメント"
                )
        ->get();
        // dd($result);
        //  return Order::whereIn("id", $this->orderIds)->get();
        // // dd($orders);
        
    }

    public function headings(): array
    {
        return [
            '#',
            '日付',
            'ホテル名',
            'デパート名',
            '会場名',
            "イベントスタイル",
            'イベント開始時刻',
            'イベント終了時刻',
            '役職',
            '作業開始時刻',
            '作業終了時刻',
            '労働者数',
            "ゲスト数",
            '義務内容',
            'コメント'
        ];
    }

    // public function export() 
    // {   
    //     return Order::all();
    // }

}
