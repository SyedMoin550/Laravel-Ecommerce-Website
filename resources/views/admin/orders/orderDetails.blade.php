@extends('admin.Layout.layout')


@section('title', 'Order-Details')

@section('content')
    @if (session()->has('msg'))
        <div class="container mt-2 mb-2">
            <div class="alert alert-success">{{session('msg')}}</div>
        </div>
    @endif
    <div class="container mt-5 mb-3 d-flex justify-content-end gap-3">
        <a href="{{route('showOrderInvoice',$order->order_id)}}" class="btn btn-primary btn-sm btn-sm">View Invoice</a>
        <a href="{{route('InvoiceDownload',$order->order_id)}}" class="btn btn-warning btn-sm">Download Invoice</a>
    </div>
    <div class="container shadow p-4 rounded">
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
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($order->order_items as $item)
                        <tr>
                            <th scope="row">
                                <img src="{{ asset($item->products->product_images[0]['image']) }}" alt="No Image"
                                    class="img-thumbnail img-rounded" width="50px">
                            </th>
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
    <div class="container mt-3 mb-5">
        {{-- <livewire:orders.mark-order :order="$order"/> --}}
        <h5>
            Mark Order <span class="badge bg-success float-end">{{$order->status}}</span>
        </h5>
        <form action="{{route('markOrder',$order->order_id)}}" method="post">
            @csrf
            <Select class="form-select mt-3" name="markStatus">
                <option value="In Progress" {{$order->status == "In Progress" ? 'selected': ''}}>In Progress</option>
                <option value="Shipped" {{$order->status == "Shipped" ? 'selected': ''}}>Shipped</option>
                <option value="Delivered" {{$order->status == "Delivered" ? 'selected': ''}}>Delivered</option>
                <option value="Cancelled" {{$order->status == "Cancelled" ? 'selected': ''}}>Cancelled</option>
            </Select>
            <button type="submit" class="btn btn-primary btn-sm mt-2">Update</button>
        </form>
    </div>
@endsection
