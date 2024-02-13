<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Carbon as SupportCarbon;

class OrderController extends Controller
{
    public function showMyOrdersPage()
    {

        // $orders = Order::with('user')->where('user_id', Auth::user()->id)->get();
        $orders = Order::with('user')->where('user_id', Auth::user()->id)->orderBy('created_at','desc')->paginate(20);

        return view('user.orders.my-order')->with('orders', $orders);
    }


    public function showMyOrdersDetails($id)
    {

        // $order = Ord
        $order = Order::with('order_items')->where('order_id', $id)->get()->first();

        return view('user.orders.order-details')->with('order', $order);
    }


    public function showAllOrder()
    {

        $orders = Order::orderBy('created_at', 'desc')->paginate(25);

        return view('admin.orders.allOrders')->with('orders', $orders);
    }


    public function showOrderDetails($id)
    {

        $order = Order::with('order_items')->where('order_id', $id)->get()->first();

        return view('admin.orders.orderDetails')->with('order', $order);
    }


    public function markOrder(Request $req ,$id){
        $order = Order::where('order_id',$id)->first();

        // dd($order);
        if (!$order) {
            return redirect()->back()->with('error', 'Order not found.');
        }

        $order->status = $req->markStatus;
        $order->save();
        return redirect()->back()->with('msg','Status Marked As '.$req->markStatus);
    }


    public function showOrderInvoice($id)
    {

        $order = Order::with('order_items')->where('order_id', $id)->get()->first();
        return view('admin.orders.invoice.showInvoice')->with('order', $order);
    }

    public function InvoiceDownload($id)
    {
        $order = Order::with('order_items')->where('order_id', $id)->get()->first();


        $pdf = Pdf::loadView('admin.orders.invoice.invoice-html', ['order' => $order]);
        $currentDate = Carbon::now()->format('d-m-Y H:i:s');
        return $pdf->download('invoice #'.$order->order_id.''.$currentDate.'.pdf');
    }
}
