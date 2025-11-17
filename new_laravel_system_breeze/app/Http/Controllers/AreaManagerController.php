<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class AreaManagerController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = Auth::user();        
    }

    public function index(Request $request){
        $hotels  = Hotel::all()->where("city", "=", $this->user->city);
        $coordinators = User::all()->where("city", "=", $this->user->city)
        ->where("role" ,"=", "coordinator");
        $users = User::all()->where("city", "=", $this->user->city)
        ->where("role" ,"=", "user");
        return view("manager.manage", [
            'user' => $request->user(),
            "hotels"=>$hotels,
            "coordinators"=>$coordinators,
            "users"=>$users
        ]);
    }
    public function store_hotel(Request $request){
        $validated = $request->validateWithBag("create_hotel",[
            "hotel_name"=>"required|string|min:3|unique:hotels,hotel_name",
            "city"=>"required|string"
        ],[
            "hotel_name.unique"=>"このホテル名は既に使用されています。"
        ]);
        Hotel::create($validated);
        return back()->with("success","ホテル追加されました ✅");
    }

    public function store_department(Request $request){
        $validated = $request->validateWithBag("create_department",[
            "hotel_id"=>"required|integer",
            "name"=>"required|string|min:3|unique:departments,name"
        ],[
            'name.unique' => 'このデパート名は既に使用されています。'
        ]);
        Department::create($validated);
        return back()->with("success", "デパート追加されました ✅");
    }   

    public function store_user(Request $request){
        $validated = $request->validateWithBag("create_user",[
            "city"=>"required|string",
            "hotel_id"=>"required|integer",
            "dep_id"=>"required|integer",
            "name"=>"required|string|min:3",
            "email"=>"email|unique:users,email",
            "user_logid"=>"required|string|min:3|unique:users,user_logid",
            "password"=>["required", Password::min(6), 'confirmed']

        ],[
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'user_logid.unique' => 'このユーザー名は既に使用されています。',
            'confirmed'=>"パスワードが一致しません"
        ]);
        User::create($validated);
        return back()->with("success", "ユーザー追加されました ✅");
    }

    public function store_coordinator(){
        $validated = request()->validateWithBag("create_coordinator",[
            "city"=>"required|string",
            "role"=>"required|string",
            "name"=>"required|string|min:3",
            "email"=>"email|unique:users,email",
            "user_logid"=>"required|string|unique:users,user_logid",
            "password"=>["required",Password::min(6), 'confirmed']
        ], [
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'user_logid.unique' => 'このユーザー名は既に使用されています。',
            'confirmed'=>"パスワードが一致しません"
        ]);
        
        User::create($validated);
        return back()->with("success", "コーディネーター追加されました ✅");
    }

}
