@extends('Layout.layout')


@section('content')
    <div class="container-fluid">
        <div class="bg-light">
            <div class="container p-2 pb-1">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @if (isset($parentCategory))
                            <li class="breadcrumb-item "><a href="/" class="nav-link text-decoration-underline">Home</a>
                            </li>
                            <li class="breadcrumb-item ">{{ $parentCategory->category_name }}</li>
                            <li class="breadcrumb-item ">{{ $subCate->category_name }}</li>
                        @else
                            <li class="breadcrumb-item "><a href="/"
                                    class="nav-link text-decoration-underline">Home</a></li>
                            @if ($parentCategoryWithSubParent)
                                <li class="breadcrumb-item ">
                                    {{ $parentCategoryWithSubParent->parentCategory->parentCategory->category_name }}</li>
                                <li class="breadcrumb-item ">
                                    {{ $parentCategoryWithSubParent->parentCategory->category_name }}</li>
                                <li class="breadcrumb-item ">{{ $parentCategoryWithSubParent->category_name }}</li>
                            @endif
                        @endif
                    </ol>
                </nav>
            </div>
        </div>

        <div class="section container mt-3">
            @if (isset($subCate))
                <h3 class="fw-bolder mt-3">{{ $subCate->category_name }}</h3>
            @else
                <h3 class="fw-bolder mt-3">{{ $productBySubCategory->category_name }}</h3>
            @endif
            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-6 g-4 mt-3 mb-5">
                @if (isset($subCate))
                    @foreach ($subCate->subCategories as $subcategory)
                        @foreach ($subcategory->products as $product)
                            @if (!isset($subcategory->products))
                                <div class="alert alert-danger">No Found</div>
                            @endif
                            <div class="col">
                                <a href="{{ url('product/' . $product->slug . "/$product->id") }}"
                                    class="text-decoration-none" style="color:inherit;">
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
                    @endforeach
                @else
                    @foreach ($productBySubCategory->products as $product)
                        <div class="col">
                            <a href="{{ url('product/' . $product->slug . "/$product->id") }}" class="text-decoration-none"
                                style="color:inherit;">
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
                @endif
            </div>
        </div>
        {{-- @php
            dd($subCate->subCategories);
        @endphp --}}
    </div>
@endsection
