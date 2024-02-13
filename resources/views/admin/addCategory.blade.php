@extends('admin.Layout.layout')

@section('title','Add-Category')

@section('content')
    <h4 class="fw-bolder">Manage Category</h4>
    <div class="container-fluid mt-5">
        @if (session('message'))
            <div class="alert alert-{{session('message')['type']}}">
                {{session('message')['msg']}}
            </div>
        @endif
        <form method="post" class="">
            @csrf
            <div class="mt-3 mb-3">
                <select name="allCate" id="allCate" class="form-select">
                    <option value="">Select Category</option>
                    <option value="0">Main Category</option>
                    @foreach ($category as $item)
                        <option value="{{$item['id']}}" class="fs-5 ">{{$item['category_name']}}</option>

                        @if (!empty($item['subCategories']))
                            @foreach ($item['subCategories'] as $item)
                                <option value="{{$item['id']}}" >&nbsp;&nbsp; &raquo; {{$item['category_name']}} </option>

                                @if (!empty($item['subCategories']))
                                    @foreach ($item['subCategories'] as $item)
                                        <option value="{{$item['id']}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &raquo; {{$item['category_name']}}</option>
                                    @endforeach
                                @endif

                            @endforeach
                        @endif
                    @endforeach
                </select>

                @error('allCate')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                {{-- <span class="text-danger">* Choose only when you want to add sub category *</span> --}}
            </div>
            <div class="">
                <label for="categoryName" class="form-label">Category Name</label>
                <input type="text" name="categoryName" id="categoryName" class="form-control w-100" placeholder="Enter Category Name">
                @error('categoryName')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mt-2">
                <label for="categorySlug" class="form-label">Category Slug</label>
                <input type="text" name="categorySlug" id="categorySlug" class="form-control w-100" placeholder="Enter Category Slug">
                @error('categorySlug')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="mt-2">
                <input type="submit" value="Add" class="btn btn-sm btn-dark">
            </div>
        </form>
    </div>

@endsection
