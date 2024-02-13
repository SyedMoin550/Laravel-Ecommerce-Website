<div class="container-fluid mt-5" style="overflow-x: auto">

    @if ($addtocarts->isEmpty())
        <div class="vh-100" style="margin-top: 120px">
            <div class="alert alert-warning">Your cart is currently empty</div>
        </div>
    @else
        <table class="table table-responsive">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($addtocarts as $cartItem)
                    <tr>
                        <th scope="row">
                            <div class="" style="width:50px">
                                <img src="{{ asset($cartItem->products->product_images[0]['image']) }}"
                                    class="rounded img-thumbnail w-100" />
                            </div>
                        </th>
                        <th scope="row">{{ $cartItem->products->product_name }}</th>
                        {{-- <td>{{ $cartItem->quantity }}</td> --}}
                        <td>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm fw-bolder fs-5" wire:click="decrement({{$cartItem->id}})"
                                    style="background-color: rgb(227, 225, 225)">-</button>
                                <input type="text" class="form-control" value="{{ $cartItem->quantity }}" style="width: 60px"
                                    readonly>
                                <button class="btn btn-sm fw-bolder fs-5" wire:click="increment({{$cartItem->id}})"
                                    style="background-color: rgb(227, 225, 225)">+</button>
                            </div>
                        </td>
                        <td>{{ $cartItem->products->salling_price * $cartItem->quantity }}</td>
                        @php
                            $totalprice += $cartItem->products->salling_price * $cartItem->quantity
                        @endphp
                        <td><button type="submit" class="btn btn-danger" wire:click="removeItem({{$cartItem->id}})">
                            <span wire:loading.remove wire:target="removeItem({{$cartItem->id}})">Remove</span>
                            {{-- <span class="spinner-grow spinner-grow-sm" wire:loading wire:target="removeItem({{$cartItem->id}})"></span> --}}
                            <span class="" wire:loading wire:target="removeItem({{$cartItem->id}})">Removing..</span>
                        </button></td>
                    </tr>
                @endforeach
            </tbody>
    @endif

    </table>
    <div class="row mb-5">
        <div class="col-8 col-sm-8 col-md-8 col-lg-8 my-md-auto mt-3">
            <h5>Get the best deal & Offer <span><a href="/">Shop Now</a></span></h5>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4 mt-3">
            <div class="shadow p-3">
                <h4> Total:
                    <span class="float-end">PKR {{$totalprice}}</span>
                </h4>
                <hr>
                <a href="{{route('showCheckoutPage')}}" class="btn btn-primary w-100">Checkout</a>
            </div>
        </div>
    </div>

</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('alert', (event) => {
            alertify.set('notifier', 'position', 'top-right');
            alertify.set('notifier','delay', 2);
            alertify.success(event.text);
        });
    });
</script>
