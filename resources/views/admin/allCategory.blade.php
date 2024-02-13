@extends('admin.Layout.layout')

@section('title', 'All Category')

@section('content')
    <div class="container-fluid" style="overflow-x: auto">
        <h4 class="fw-bolder">All Category</h4>
        <table class="table table-hover table-responsive mt-5" id="table">
            <thead>
                <tr class="table-dark">
                    <th scope="col">ID</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Parent Category</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($parentCategory as $item)
                    <tr>
                        <th scope="row" class="category_id">{{ $item['id'] }}</th>
                        <td>{{ $item['category_name'] }}</td>
                        <td>
                            @if (!empty($item['parentCategory']))
                                {{ $item['parentCategory']->category_name }}
                            @else
                                {{ 'Main Category' }}
                            @endif
                        </td>
                        <td>
                            <form method="get">
                                @csrf
                                {{-- <a href="{{route('deleteCategory' , $item['id']) }}" class="btn btn-danger btn-sm" onclick="deleteCate({{$item['id']}})"><i class="bi bi-trash"></i></a> --}}
                                <button class="btn btn-danger btn-sm deleteCategoryBtn"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $parentCategory->links() }}
    </div>

    <script>

        $('.deleteCategoryBtn').on('click', function(e) {
            e.preventDefault();
            category_id = $(this).closest('tr').find('.category_id').text();

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
                        url: "/admin/category/delete/" + category_id,
                        success: function(response) {
                            if (response.success == true) {
                                Swal.fire(
                                        'Congratulation',
                                        "Category Delete Successfully",
                                        'success'
                                    )
                                    .then(function() {
                                        window.location.reload();
                                    });
                            } else {
                                Swal.fire(
                                    'Oops',
                                    "Category Not Delete ",
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
