<div class="container">
    <div class="row mb-5 mt-2" >
        <div class="col-12 col-sm-12 col-md-6 h-100 " style="margin-top:8rem">
            <form class="" wire:submit.prevent="submit">
                <h4 class="fw-bolder text-center ">Login</h4>
                @if (session()->has('response'))
                    <div class="alert alert-warning">{{session('response')}}</div>
                @endif
                <div class="mt-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="Enter Email" wire:model.blur="email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-2">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " id="password" placeholder="Enter Password" wire:model.blur="password">
                    @error('password')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" >
                        Login
                        <div class="spinner-border spinner-border-sm ms-1" role="status" wire:loading wire:target="submit"></div
                    </button>
                </div>
            </form>
        </div>
        <div class="col-6 col-sm-6 col-md-6 h-100 d-flex align-items-center">
            <img src="{{asset('images/login2.avif')}}" alt="">
        </div>
    </div>
</div>
