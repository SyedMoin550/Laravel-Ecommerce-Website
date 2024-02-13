<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Registration extends Component
{
    public $name;
    public $email;
    public $number;
    public $password;
    public $confirm_password;


    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);
    }

    public function registerFormSubmit()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'number' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password'
        ]);

        $user = new User;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->user_number = $this->number;
        $user->password = Hash::make($this->password);

        $user->save();

        $this->reset();

        session()->flash('response','Registeration Successfully!');
    }
    public function render()
    {
        return view('livewire.registration');
    }
}
