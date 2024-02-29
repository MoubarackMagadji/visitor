<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

        $users = \App\Models\User::all();
        return view('users.index', compact('users'));

    }

    public function create(){

        return view('users.add');

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
