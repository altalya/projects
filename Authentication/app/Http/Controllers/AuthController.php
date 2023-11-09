<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        if(Auth::user()->user_type == 'admin'){
            return view('dashboard');
        }
        else if(Auth::user()->user_type == 'user'){
            return view('dashboard1');
        }
        else{
            return redirect->back();
        }
    }
}
