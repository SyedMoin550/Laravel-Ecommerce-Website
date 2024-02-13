<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showRegistration(){
        return view('sign-up');
    }


    // public function registration(Request $req){

    // }


    public function showLogin(){
        return view('login');
    }
}
