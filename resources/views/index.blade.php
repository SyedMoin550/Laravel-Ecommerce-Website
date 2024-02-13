@extends('Layout.layout')

@section('title', 'MyStore')

@section('content')
    <div class="container-fluid">
        <div class="container">
            {{-- Section 1 --}}
            <div class="row">
                <div class="col-4 col-sm-4 col-md-2 col-lg-2 border border-dark bg-light rounded">
                    <ul id="menu" class="d-flex flex-column">
                        {{-- <li class="parent"><a href="#">Recent Toys</a>
                            <ul class="child">
                                <li><a href="#">Yoyo</a></li>
                                <li><a href="#">Doctor Kit</a></li>
                                <li class="parent"><a href="#">Fun Puzzle<span class="expand">»</span></a>
                                    <ul class="child">
                                        <li><a href="#" nowrap>Cards</a></li>
                                        <li><a href="#" nowrap>Numbers</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Uno Cards</a></li>
                            </ul>
                        </li> --}}

                        @foreach ($category as $item)
                            <li class="parent">
                                <span class="text-dark " style="cursor: pointer">{{ $item['category_name'] }}</span>
                                @if (!empty($item['subCategories']))
                                    <ul class="child">
                                        @foreach ($item['subCategories'] as $subCategory)
                                            <li class="parent"><a href="category/{{ $subCategory['category_slug'] }}">{{ $subCategory['category_name'] }}</a>
                                                @if (!empty($subCategory['subCategories']))
                                                    <ul class="child">
                                                        @foreach ($subCategory['subCategories'] as $subsubCategory)
                                                            <li><a class="w-auto" href="category/{{ $subCategory['category_slug'] }}/{{ $subsubCategory['category_slug'] }}">{{ $subsubCategory['category_name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-8 col-sm-8 col-md-10 col-lg-10">
                    <div id="carouselExampleIndicators" class="carousel slide ">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0"
                                class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ asset('images/car1.png') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/car2.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ asset('images/car3.jpg') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Section 2 --}}
            <div class="Flash-Sales mt-5 mb-5">
                <h3 class="fw-bolder">Flash Sale</h3>
                <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 mt-1">
                    @foreach ($flashSaleProducts as $product)
                        {{-- <x-card title={{$product['product_name']}} price={{$product['salling_price']}} img ="r" originalPrice = {{$product['original_price']}} discount = {{$product['discount']}}/> --}}
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
            </div>
            <div class="Flash-Sales mb-5">
                <h3 class="fw-bolder">Categories</h3>
                <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 mt-1">
                    @foreach ($products as $product)
                        {{-- <x-card title={{$product['product_name']}} price={{$product['salling_price']}} img ="r" originalPrice = {{$product['original_price']}} discount = {{$product['discount']}}/> --}}
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
            </div>
        </div>
    </div>
@endsection
