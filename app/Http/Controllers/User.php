<?php

namespace App\Http\Controllers;


use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class User extends Controller
{
    
    public function login(){
        return view('login');
    }

    public function authenticate(Request $request){
        // dd($request->all());

        $user = $request->validate([
            "username" => "required",
            "password" => 'required'
        ]);

        if(Auth::attempt($user)){
            request()->session()->regenerateToken();
            return redirect( route('dashboard'));
        }else{
            return redirect()->back()->onlyInput('username')->with('error','Error');
        }

    }

    public function index(){
        
        $paginator = request()->nb ?? Cookie::get("visitors_users_nb") ?? 10;
        if(request()->has("nb")) {
            Cookie::queue("visitors_users_nb", request()->nb,365);
        }

        $users = \App\Models\User::sortable(["id"=>"desc"])->paginate($paginator);
        
        return view('users.index', compact('users'));

    }

    public function create(){

        return view('users.add');

    }

    public function store(Request $request){

       

        $validator = \Validator::make($request->all(),[
            'username' => ['required', Rule::unique("users", "username")],
            'password' => 'required|confirmed|min:6',

        ]);

        
        
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 202);
        }

        
        $user = [
            'username' => $request->username,
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'admin' => (isset($request->is_admin) ? true:false)
        ];

        
        \App\Models\User::create($user);

        echo 'ok';
    }

    public function show(\App\Models\User $user){
        
        return view('users.show')->with('user',$user);
    }

    public function update(\App\Models\User $user, Request $request){
        // dd($user);

        $validator = \Validator::make($request->all(),[
            'username' => ['required', Rule::unique("users", "username")->ignore($user->id)],
        ]);

        
        
        if ($validator->fails())
        {
            return response()->json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 202);
        }

        $userNew = [
            'username' => $request->username,
            'name' => $request->name,
            'admin' => (isset($request->is_admin) ? true:false)
        ];

        $user->update($userNew);

        echo 'okok';
    }


    public function dashboard (){
        return view("dashboard");
    }

    public function logout(Request $request){
        auth()->logout();
        session()->regenerateToken();
        session()->invalidate();
        return redirect(route('login'));
    }

}
