<?php

namespace App\Livewire\Product;

use App\Models\Addtocart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class Addtocartcounter extends Component
{

    public $totalItems = 0;
    #[On('updateCartCounter')]
    public function cartCounter(){
        if(Auth::check()){
            return $this->totalItems = Addtocart::where('user_id',Auth::user()->id)->count();
        }
        else{
            $this->totalItems = 0;
        }
    }

    public function render()
    {
        $this->cartCounter();
        return view('livewire.product.addtocartcounter');
    }
}
