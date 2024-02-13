<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;
use App\Models\Addtocart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
class PaypalController extends Controller
{
    // public function paypal(Request $req){
    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $paypalToken = $provider->getAccessToken();

    //     $provider->createOrder([
    //         "intent" => "CAPTURE",
    //         "application_context" =>[
    //             "return_url" => route('success'),
    //             "cancel_url" => route('cancel')
    //         ],
    //         "purchase_units" => [
    //             [
    //                 "amount" => [
    //                 "currency_code" => "USD",
    //                 "value" => "100.00"
    //                 ]
    //             ]
    //         ]
    //     ]);


    // }
    public function success(Request $req){

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($req->token);
        // dd($response);
        if(isset($response['status']) && $response['status'] === "COMPLETED"){


            if($this->place_order()){
                $payment = new Payment();
                $payment->payment_id = $response['id'];
                $payment->order_id = session('order_id');
                $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
                $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
                $payment->payer_name = $response['payer']['name']['given_name'];
                $payment->payer_email = $response['payer']['email_address'];
                $payment->payement_status = $response['status'];
                $payment->payement_method = "Paypal";

                $payment->save();
                session()->forget('order_id');
                return redirect()->route('showThankYouPage');
            }

        }
        else{
            return redirect()->route('cancel');
        }


    }
    public function cancel(Request $req){
        return "Payment has been cancelled!";
    }



    public function place_order()
    {
        $order = new Order();
        $order->fullname = session('fullname');
        $order->user_id = Auth::user()->id;
        $order->email = session('email');
        $order->number = session('number');
        $order->address = session('address');
        $order->zipcode = session('zipcode');
        $order->tracking_num = "Or_".Str::random(7);
        $order->payment_mode = "Online Payment";
        $order->total_price = session('totalAmount');
        $order->status = "In Progress";
        $order->save();
        // forget all sessions
        session()->forget('fullname');
        session()->forget('email');
        session()->forget('number');
        session()->forget('address');
        session()->forget('zipcode');
        session()->forget('totalAmount');

        $order_id = $order->order_id;
        session()->put('order_id',$order_id);
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

        // empty the cart items
        Addtocart::where('user_id',Auth::user()->id)->delete();

        return true;
    }
}
