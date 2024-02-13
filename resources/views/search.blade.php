@extends('Layout.layout')

@section('title', 'Search')


@section('content')

<div class="container">
    <h4 class="fw-bold text-secondary mt-5">Search Result For "{{Request::get('search')}}"</h4>

    @if($products->isEmpty())
        <div class="container mt-5 " style="height: 50vh">
            <div class="alert alert-warning">Product Not Found!</div>
        </div>
    @endif
    <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 mt-1">
        @foreach ($products as $product)

            <div class="col">
                <a href="{{ url("product/".$product->slug . "/$product->id") }}" class="text-decoration-none" style="color:inherit;">
                    <div class="card h-100">
                        <img src="{{ asset($product->product_images[0]['image']) }}" alt="No Image"
                            class="card-img-top">
                        <div class="card-body">
                            <h6 class="card-title">{{ $product['product_name'] }}</h6>
                            {{-- <p class="card-text text-justify">{{$desc}}</p> --}}
                            <h5 class="text-danger">Rs. {{ $product['salling_price'] }}</h5>
                            <del class="text-secondary ">Rs {{ $product['original_price'] }}</del><span
                                class="text-secondary ms-2">-{{ $product['discount'] }}</span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    <div class="mt-2">
        {{$products->appends(request()->input())->links()}}
    </div>
</div>


@endsection
