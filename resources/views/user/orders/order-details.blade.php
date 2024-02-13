@extends('Layout.layout')


@section('title', 'Order-Details')

@section('content')
    <div class="container mt-5 shadow p-4 rounded">
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <h5>Order Details</h5>
                <hr>
                <div><span class="fw-bold">Order ID: </span>{{$order->order_id}}</div>
                <div><span class="fw-bold">Tracking No: </span>{{$order->tracking_num}}</div>
                <div><span class="fw-bold">Order Date: </span>{{$order->updated_at}}</div>
                <div><span class="fw-bold">Payment Mode: </span>{{$order->payment_mode}}</div>
                <div><span class="fw-bold">Total Price: </span>PKR {{$order->total_price}}</div>
                <div><span class="fw-bold">Order Status: </span><span class="badge bg-success">{{$order->status}}</span></div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <h5>User Details</h5>
                <hr>
                <div><span class="fw-bold">Username: </span>{{$order->fullname}}</div>
                <div><span class="fw-bold">Email: </span>{{$order->email}}</div>
                <div><span class="fw-bold">Phone Number: </span>{{$order->number}}</div>
                <div><span class="fw-bold">Address: </span>{{$order->address}}</div>
                <div><span class="fw-bold">Zip Code: </span>{{$order->zipcode}}</div>
            </div>
        </div>

        <div class="order-items row mt-5 p-3">
            <h5>Ordered Items</h5>
            <hr>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($order->order_items as $item)

                        <tr>
                            <th scope="row">
                                <img src="{{asset($item->products->product_images[0]['image'])}}" alt="No Image" class="img-thumbnail img-rounded" width="50px">
                            </th>
                            <td>{{$item->products->product_name}}</td>
                            <td>{{$item->quantity}}</td>
                            <th>{{$item->price}}</th>
                        </tr>

                    @endforeach

                    <tr class="table-light">
                        <th colspan="3">Total Amount: </th>
                        <th colspan="1">PKR {{$order->total_price}}</th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mt-3">
        <h5 class="text-center">Get New Offer & Deals <a href="/" class="btn btn-primary"> Shop Now</a></h5>
    </div>
@endsection
