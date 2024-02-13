<?php

namespace App\Livewire\Product;

use App\Models\Addtocart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Details extends Component
{
    public $images;
    public $product;
    public $quantityCount = 1;

    public function increment()
    {
        $this->quantityCount++;
    }

    public function decrement()
    {
        if ($this->quantityCount == 1) {
            $this->quantityCount = 1;
        } else {
            $this->quantityCount--;
        }
    }

    public function addToCart($id)
    {
        // Checking user login or not
        $product = Product::find($id);

        if (Auth::check()) {
            if ($product->quantity >= $this->quantityCount) {
                // product already exist or not
                $addtocart = Addtocart::where('user_id', Auth::user()->id)->where('product_id', $product->id)->get();
                if ($addtocart->count() == 0 ) {
                    $addtocart = new Addtocart;
                    $addtocart->user_id = Auth::user()->id;
                    $addtocart->product_id = $product->id;
                    $addtocart->quantity = $this->quantityCount;
                    $addtocart->price = ($product->salling_price * $this->quantityCount);
                    $addtocart->save();

                    $this->dispatch
                    (
                        'alert', text: "Product added in the cart"
                    );

                    $this->dispatch('updateCartCounter');

                }
                else
                {
                    $this->dispatch
                    (
                        'alert', text: "Product already in your cart"
                    );
                }
            }
            else
            {
                $this->dispatch
                    (
                        'alert', text: "Only $product->quantity product left"
                    );
            }

        }
        else
        {

            session()->put('url.intented', '/product/' . $product->slug . '/' . $product->id, 5);
            $this->redirect('/Login');
        }
    }

    public function render()
    {
        return view('livewire.product.details');
    }
}
