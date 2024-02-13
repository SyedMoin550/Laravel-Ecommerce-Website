@extends('admin.Layout.layout')

@section('title', 'All Product')

@section('content')
    <div class="container-fluid" style="overflow-x: auto">
        <h4 class="fw-bolder">All Products</h4>
        <table class="table table-hover table-responsive mt-5" id="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Color</th>
                    <th scope="col">Category</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col">Price</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                    <tr>
                        <th scope="row" class="product_id">{{ $item['id'] }}</th>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['product_color'] }}</td>
                        <td>
                            @if (!empty($item['category']))
                                {{ $item['category']->category_name }}
                            @endif
                        </td>
                        <td>
                            @if (!empty($item['category']->parentCategory))
                                {{ $item['category']->parentCategory->category_name }}
                            @endif
                        </td>
                        <td>{{ $item['salling_price'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <form method="get">
                                @csrf
                                <a href="{{route('showEditProduct',$item['id'])}}" class="btn btn-light btn-sm editProductBtn"><i class="bi bi-pencil-square"></i></a>
                                <button class="btn btn-danger btn-sm deleteProductBtn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>

    <script>

        $('.deleteProductBtn').on('click', function(e) {
            e.preventDefault();
            product_id = $(this).closest('tr').find('.product_id').text();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // if Yes Send Ajax Request
                    $.ajax({
                        type: "get",
                        url: "/admin/product/delete/" + product_id,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                        'Congratulation',
                                        "Product Delete Successfully",
                                        'success'
                                    )
                                    .then(function() {
                                        window.location.reload();
                                    });
                            } else {
                                Swal.fire(
                                    'Oops',
                                    "Product Not Delete ",
                                    'warning'
                                )
                            }
                        }
                    });
                }
            })


        })
    </script>

@endsection
