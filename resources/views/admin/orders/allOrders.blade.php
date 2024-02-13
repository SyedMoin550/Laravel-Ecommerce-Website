@extends('admin.Layout.layout')


@section('title', 'All-Orders')


@section('content')

    <div class="container-fluid mt-4">
        <h4 class="fw-bolder">All Orders</h4>
        <div class="container-fluid" style="overflow-x: auto;">
            <table class="table table-hover table-responsive table-bordered mt-3 shadow" id="table">
                <thead >
                    <tr class="table-dark">
                        <th scope="col">Order ID</th>
                        <th scope="col">Tracking Number</th>
                        <th scope="col">Username</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{$order->order_id}}</th>
                            <td>{{$order->tracking_num}}</td>
                            <td>{{$order->fullname}}</td>
                            <td>{{$order->updated_at}}</td>
                            <td>{{$order->payment_mode}}</td>
                            <td>{{$order->status}}</td>
                            <td>
                                <a href="{{route('showOrderDetails',$order->order_id)}}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

@endsection
