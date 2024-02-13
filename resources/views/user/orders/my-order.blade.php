@extends('Layout.layout')


@section('title', 'My-Orders')


@section('content')

    <div class="container mt-5" style="margin-bottom: 400px">
        <h4 class="text-center">My Orders</h4>
        <div class="container-fluid" style="overflow-x: auto;">
            <table class="table table-hover table-responsive table-bordered mt-5 shadow">
                <thead >
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Order Date</th>
                        <th scope="col">Tracking Number</th>
                        <th scope="col">Username</th>
                        <th scope="col">Payment Mode</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">

                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row">{{$order->order_id}}</th>
                            <td>{{$order->updated_at}}</td>
                            <td>{{$order->tracking_num}}</td>
                            <td>{{$order->fullname}}</td>
                            <td>{{$order->payment_mode}}</td>
                            <td>{{$order->status}}</td>
                            <td>
                                <a href="{{route('showMyOrdersDetails',$order->order_id)}}" class="btn btn-primary btn-sm">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$orders->links()}}
        </div>
    </div>

@endsection
