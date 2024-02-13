<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DepositController extends Controller
{

    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('admin.notification.getNotification');
    }
    
}
