<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Hotel;

class Order extends Model
{
    use HasFactory,HasApiTokens;
    protected $table = 'orders';
  

    protected $fillable = [
        'hotel_id', 'dep_id', 'user_id',//here changed from coor id to user id 
        'event_date', 'work_start_time', 'work_end_time',
        'workers_number', 'event_start_time', 'event_end_time',
        'guests_number', 'duty_content', 'venue_name',
        'position', 'comments', 'event_style', 'is_done','file_path','file_type', 'file_size', "file_name","is_updated"
    ];
    public function hotel(){
        return $this->belongsTo(Hotel::class);
    }
}