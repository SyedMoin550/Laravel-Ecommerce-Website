@extends('Layout.layout')

@section('title','Change Password')

@section('content')
    <div class="container-fluid mt-3">
        <div class="container">
            <div class="row mb-5 mt-2" >
                <div class="col-12 col-sm-12 col-md-6 h-100 " style="margin-top:8rem">
                    <form class="" action="{{route('changePassPage')}}" method="post">
                        @csrf
                        <h4 class="fw-bolder text-center ">Change Password</h4>
                        @if (session()->has('response'))
                            <div class="alert alert-warning">{{session('response')}}</div>
                        @endif
                        <div class="mt-2">
                            <label for="oldPass" class="form-label">Old Password</label>
                            <input type="password"  name="oldPass" class="form-control @error('oldPass') is-invalid @enderror " id="oldPass" placeholder="Enter Old Password">
                            @error('oldPass')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="pass" class="form-label">New Password</label>
                            <input type="password" name="pass"  class="form-control @error('pass') is-invalid @enderror " id="pass" placeholder="Enter New Password">
                            @error('pass')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="cpass" class="form-label">Confirm Password</label>
                            <input type="password" name="cpass" class="form-control @error('cpass') is-invalid @enderror " id="cpass" placeholder="Enter Confirm Password" >
                            @error('cpass')
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
