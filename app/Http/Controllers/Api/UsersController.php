<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


// class UsersController extends  Controller {
//     public function index (){
//         return response()->json(User::all());
//     }
// }

class UsersController extends Controller {
    public function index (){
        return response()->json(User::all());
    }
}




// class UsersController extends Controller {

//     public function index(){
//         return request()->json(User::all());
//     }
// }