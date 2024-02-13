<?php

namespace App\Livewire\Product;

use App\Models\Addtocart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddToCartPage extends Component
{
    public $quantityCount = 0;
    public $totalprice;
    public function removeItem($id)
    {

        $removeCartItem = Addtocart::find($id)->delete();

        $this->dispatch('alert', text: "Remove item successfully");
        $this->dispatch('updateCartCounter');
    }

    public function decrement($id)
    {
        $updateQuantity = Addtocart::with('products')->find($id);
        if ($updateQuantity->quantity >= 2) {
            $updateQuantity->quantity = ($updateQuantity->quantity - 1);
            $updateQuantity->price = ($updateQuantity->products->salling_price * $updateQuantity->quantity);
            $updateQuantity->save();

            $this->dispatch('alert', text: 'Product quantity updated');
        }
        else{
            $this->dispatch('alert', text: 'Product quantity not updated');
        }
    }


    public function increment($id)
{
    $updateQuantity = Addtocart::with('products')->find($id);

    if ($updateQuantity->quantity >= 1) {
        $productStock = $updateQuantity->products->quantity;

        if ($productStock >= ($updateQuantity->quantity + 1)) {
            $updateQuantity->quantity += 1;
            $updateQuantity->price = $updateQuantity->products->salling_price * $updateQuantity->quantity;
            $updateQuantity->save();

            $this->dispatch('alert', text: 'Product quantity updated');
        } else {
            $this->dispatch('alert', text:'Insufficient product stock.');
        }
    }
}


    public function render()
    {
        $addtocarts = Addtocart::with('products')->where('user_id', Auth::user()->id)->get();

        return view('livewire.product.add-to-cart-page', compact('addtocarts'));
    }
}
