<?php

namespace App\Livewire\Checkout;

use App\Models\Addtocart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ShowCheckout extends Component
{

    public $name,$email,$number,$address,$zipCode,$totalAmount = 0, $loading = false;

    public function updated($fields){

        $this->validateOnly($fields,[
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ]);
    }

    public function rules(){
        return [
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required',
            'address' => 'required',
            'zipCode' => 'required',
        ];
    }

    public function place_order()
    {
        $order = new Order();
        $order->fullname = $this->name;
        $order->user_id = Auth::user()->id;
        $order->email = $this->email;
        $order->number = $this->number;
        $order->address = $this->address;
        $order->zipcode = $this->zipCode;
        $order->tracking_num = "Or_".Str::random(7);
        $order->payment_mode = "Cash On Delivery";
        $order->total_price = $this->totalAmount;
        $order->status = "In Progress";
        $order->save();


        $order_id = $order->order_id;
        $userCarts = Addtocart::where('user_id',Auth::user()->id)->get();
        foreach ($userCarts as $cartItems) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order_id;
            $orderItem->user_id = Auth::user()->id;
            $orderItem->product_id = $cartItems->product_id;
            $orderItem->quantity = $cartItems->quantity;
            $orderItem->price = $cartItems->price;
            $orderItem->save();

            // decrement product  quantity
            $cartItems->products()->where('id',$cartItems->product_id)->decrement('quantity',$cartItems->quantity);
        }

        return true;
    }

    public function codOrder(){
        $this->validate();  //yeh function rules function ki base pr chalta hy

        if($this->place_order()){
            // Removing Cart Items
            $cart = Addtocart::where('user_id',Auth::user()->id)->delete();
            $this->dispatch('updateCartCounter');
            $this->dispatch('alert', text:"Order Place Successfully!");
            return redirect()->route('showThankYouPage');
        }
    }

    public function totalProductPrice(){
        $this->totalAmount = 0;
        $userCarts = Addtocart::where('user_id',Auth::user()->id)->get();
        foreach ($userCarts as $cartItems) {
            $this->totalAmount += $cartItems->price;
        }
        return $this->totalAmount;
    }


    public function paypal(){
        
        $this->validate();

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        session()->put('fullname',$this->name);
        session()->put('email',$this->email);
        session()->put('number',$this->number);
        session()->put('address',$this->address);
        session()->put('zipcode',$this->zipCode);
        session()->put('totalAmount',$this->totalAmount);
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" =>[
                "return_url" => route('success'),
                "cancel_url" => route('cancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                    "currency_code" => "USD",
                    "value" => $this->totalAmount
                    ]
                ]
            ]
        ]);

        // dd($response);

        if(isset($response['id'])  && $response['id'] != null){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve')
                    return redirect()->away($link['href']);
            }
        }

    }

    public function render()
    {

        $this->totalAmount = $this->totalProductPrice();

        return view('livewire.checkout.show-checkout');

    }
}
