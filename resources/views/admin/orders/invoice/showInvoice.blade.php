@extends('admin.Layout.layout')


@section('title', 'Order-Details')

@section('content')

    <div class="container shadow p-4 rounded">
        <div class="row mb-4">
            <div class="col-9 col-sm-9 col-md-9">
                <h4>Website Name</h4>
            </div>
            <div class="col-3 col-sm-3 col-md-3">
                <h6><span class="me-2">Invoice </span>#{{ $order->order_id }}</h6>
                <h6><span>Issue Date: </span> {{ $order->updated_at }}</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <h5>Order Details</h5>
                <hr>
                <div><span class="fw-bold">Order ID: </span>{{ $order->order_id }}</div>
                <div><span class="fw-bold">Tracking No: </span>{{ $order->tracking_num }}</div>
                <div><span class="fw-bold">Order Date: </span>{{ $order->updated_at }}</div>
                <div><span class="fw-bold">Payment Mode: </span>{{ $order->payment_mode }}</div>
                <div><span class="fw-bold">Total Price: </span>PKR {{ $order->total_price }}</div>
                <div><span class="fw-bold">Order Status: </span><span class="badge bg-success">{{ $order->status }}</span>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                <h5>User Details</h5>
                <hr>
                <div><span class="fw-bold">Username: </span>{{ $order->fullname }}</div>
                <div><span class="fw-bold">Email: </span>{{ $order->email }}</div>
                <div><span class="fw-bold">Phone Number: </span>{{ $order->number }}</div>
                <div><span class="fw-bold">Address: </span>{{ $order->address }}</div>
                <div><span class="fw-bold">Zip Code: </span>{{ $order->zipcode }}</div>
            </div>
        </div>

        <div class="order-items row mt-5 p-3">
            <h5>Ordered Items</h5>
            <hr>

            <table class="table">
                <thead>
                    <tr class="table-dark">
                        <th scope="col">No.</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->order_items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->products->product_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <th>{{ $item->price }}</th>
                        </tr>
                    @endforeach

                    <tr>
                        <th colspan="3">Total Amount</th>
                        <th colspan="1">PKR {{ $order->total_price }}</th>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
@endsection
