<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Hotel extends Model  
{
    use HasFactory , HasApiTokens;
    protected $table = 'hotels';

    protected $fillable =[
        "hotel_name","coor_id","city"
    ];
}
