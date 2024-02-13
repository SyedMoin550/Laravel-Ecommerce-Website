@extends('Layout.layout')

@section('title','Profile')

@section('content')
    <div class="container-fluid mt-3">
        <div class="container">
            <div class="row mb-5 mt-2" >
                <div class="col-12 col-sm-12 col-md-6 h-100 " style="margin-top:8rem">
                    <form class="" action="{{route('profileUpdate')}}" method="post">
                        @csrf
                        <h4 class="fw-bolder text-center ">Profile</h4>
                        @if (session()->has('response'))
                            <div class="alert alert-success">{{session('response')}}</div>
                        @endif
                        <div class="mt-2">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" value="{{auth()->user()->name}}" name="name" class="form-control @error('name') is-invalid @enderror " id="name" placeholder="Enter Username">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" value="{{auth()->user()->email}}" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="Enter Email" readonly>
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" name="number" value="{{auth()->user()->user_number}}" class="form-control @error('number') is-invalid @enderror " id="number" placeholder="Enter Number">
                            @error('number')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary" >
                                save
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-6 col-sm-6 col-md-6 h-100 d-flex align-items-center">
                    <img src="{{asset('images/login2.avif')}}" alt="">
                </div>
            </div>
        </div>

    </div>
@endsection
