<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\User;
use App\Notifications\AlertSuccessfull;
class AlertController extends Controller
{
    public function __contruct(){
        $this->middleware('auth');
    }

    public function index(){
        $notifications = Alert::get();
        return view('admin.notification.getNotification', compact('notifications'));
    }

    public function store(Request $req){
        // $validator = Validator::make($req->all(),[
        //     'title' => 'required',
        //     'notification' => 'required'
        // ]);

        // if($validator->fails()){
        //     return $validator->messages();
        // }

        // $req->validate([
        //     'title' => 'required',
        //     'notification' => 'required'
        // ]);

        $notification = Alert::create([
            'user_id' => auth()->user()->id,
            'title' => $req->title,
            'notification' => $req->notification
        ]);

        // $users = auth()->user()->id;
        $users = User::all();

        foreach($users as $user){
            $user->notify(new AlertSuccessfull($notification->title,$notification->notification));
        }
        session()->flash('message',[
            'type' => 'success',
            'msg' => 'Your Notification was sent successfully!'
        ]);
        return redirect()->back()->with('status', 'Your Notification was sent successfully!');

    }

    public function markAsRead(){
        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
}
