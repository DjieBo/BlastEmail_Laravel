<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;

class ActionController extends Controller
{
    function index(){
        return view('welcome');
    }
    function login(Request $request){   
        $this->validate($request, [
            'username'      => 'required',
            'password'      => 'required'
        ]);
        $user_data = array(
            'username'      => $request['username'],
            'password'      => $request['password']
        );
        if(Auth::attempt($user_data)) {return redirect('/main');}
        else{return back()->with('error', 'Data Anda Bermasalah');}
    }
    function logout(){
        Auth::logout();
        return redirect('/');
    }
}
