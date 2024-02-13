<?php

namespace App\Livewire;

use Livewire\Component;
use illuminate\Support\Facades\Auth;
class Login extends Component
{
    public $email;
    public $password;

    public function updated($fields)
    {
        $this->validateOnly($fields,[
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ],[
            'email.exists' => 'Email does not exist'
        ]);
    }

    public function submit(){
        $this->validate(
            [
                'email' => 'required|email|exists:users,email',
                'password' => 'required'
            ],[
                'email.exists' => 'Email does not exist'
            ]
        );

        // if(Auth::attempt(['email' => $email, 'password' => $password])){}
        if(Auth::attempt(['email' => $this->email,'password' => $this->password])){
            if(session()->has('url.intented')){
                return redirect(session()->get('url.intented'));
            }

            if(Auth::user()->role_as == 1){
                return redirect('/admin');
            }
            else{
                return redirect('/');
            }

        }
        else{
            return redirect()->back()->with(['response' => 'Invalid Crediential!']);
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
