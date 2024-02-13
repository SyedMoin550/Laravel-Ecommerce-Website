@extends('Layout.layout')

@section('title', 'product')

@section('content')
    <div class="container-fluid">
        <div class="bg-light">
            <div class="container p-2 pb-1">
                <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                    aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item "><a href="/" class="nav-link text-decoration-underline">Home</a></li>
                        @foreach ($parentCategory as $item)
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $item['getParentParentCategory']->parentCategory->parentCategory->category_name }}</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $item['getParentParentCategory']->parentCategory->category_name }}</li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $item['getParentParentCategory']->category_name }}</li>

                            {{-- product name  --}}
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
                        @endforeach
                    </ol>
                </nav>
            </div>
        </div>

       <livewire:product.details :images="$images" :product="$product"/>

    </div>
@endsection

@section('scripts')
    <script>
        $(function() {

            $("#exzoom").exzoom({

                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": false,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 2000

            });

        });
    </script>
@endsection
