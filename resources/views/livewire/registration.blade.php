<div>
    <h4 class="fw-bolder text-center">Registration</h4>
        <div class="container">
            <div class="row mb-5 mt-2">
                <div class="col-12 col-sm-12 col-md-6">
                    @if (session()->has('response'))
                        <div class="alert alert-success">{{session('response')}}</div>
                    @endif
                    <form wire:submit.prevent="registerFormSubmit">
                        <div class="mt-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter Name" wire:model.blur="name">
                            @error('name')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror " id="email" placeholder="Enter Email" wire:model.blur="email" >
                            @error('email')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="number" class="form-label">Number</label>
                            <input type="text" name="number" class="form-control @error('number') is-invalid @enderror" id="number" placeholder="Enter Number" wire:model.blur="number">
                            @error('number')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Enter Password" wire:model.blur="password">
                            @error('password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="confirm_password" class="form-label">Repeat Password</label>
                            <input type="password" name="confirm_password" class="form-control @error('confirm_password') is-invalid @enderror" id="confirm_password" placeholder="Re-peat Password" wire:model.live.debounce.1000ms="confirm_password">
                            @error('confirm_password')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary btn-md">
                                Register
                                <div class=" ms-1 spinner-border spinner-border-sm" role="status" wire:loading>
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-6 col-sm-6 col-md-6 h-100 d-flex align-items-center">
                    <img src="{{asset('images/reg2.png')}}" alt="">
                </div>
            </div>
        </div>

</div>
