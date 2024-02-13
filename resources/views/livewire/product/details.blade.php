<div class="container mt-2" wire:ignore>
    <div class="row mb-5">
        <div class="col-5 col-sm-5 col-md-5 mt-2 ">
            <div class="exzoom" id="exzoom">
                <!-- Images -->
                <div class="exzoom_img_box">
                    <ul class='exzoom_img_ul'>
                        @foreach ($images as $item)
                            <li><img src="{{ asset($item['image']) }}" alt="Not Found" /></li>
                        @endforeach
                    </ul>
                </div>
                <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                <div class="exzoom_nav"></div>
                <!-- Nav Buttons -->
                <p class="exzoom_btn">
                    <a href="javascript:void(0);" class="exzoom_prev_btn">
                        < </a>
                            <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                </p>
            </div>
        </div>

        {{-- Product Details  --}}
        <div class="col-7 col-sm-7 col-md-7 mt-2 p-2 pt-0">
            <div class="product_name fw-bolder fs-4">{{ $product->product_name }}</div>
            <hr>
            <div class="product_price mt-5 fw-bold">
                <span class="text-dark fs-4">{{ 'Rs ' . $product->salling_price }}</span>
                <del class="text-secondary fs-5 ms-3">{{ 'Rs ' . $product->original_price }}</del>
                <span class="text-danger fs-5 ms-3">{{ '-' . $product->discount }}</span>
            </div>
            @if ($product->quantity == 0)
                <button class="mt-3 btn btn-danger btn-sm">Out of Stock</button>
            @elseif ($product->quantity <= 5)
                <div class="mt-3 text-danger">{{ $product->quantity . ' Product Available Only' }}<span>
                    @else
                        <button class="mt-3 btn btn-success btn-sm">In Stock</button>
            @endif

            <div class="mt-4 d-flex gap-2">
                <button class="btn btn-light fw-bolder fs-5" wire:click="decrement"
                    style="background-color: rgb(227, 225, 225)">-</button>
                <input type="text" class="form-control" wire:model="quantityCount" value="1" style="width: 60px"
                    readonly>
                <button class="btn btn-light fw-bolder fs-5" wire:click="increment"
                    style="background-color: rgb(227, 225, 225)">+</button>
            </div>

            <div class="mt-4">
                <button class="btn btn-outline-dark" wire:click="addToCart({{ $product->id }})">
                    <span>Add To Cart</span>
                    <span wire:loading wire:target="addToCart" class="spinner-grow spinner-grow-sm"></span>
                </button>
                <button class="btn btn-outline-dark">Add To Whitelist</button>
            </div>
            <div class="mt-4">
                <h4 class="text-dark">Small Description</h4>
                <p class="text-dark">{{ $product->desc }}</p>
            </div>
        </div>
    </div>

    {{-- Details  --}}
    <div class="product-details mb-5">
        <h4 class="bg-light p-2">Product Details</h4>
        <p>{!! $product->details !!}</p>
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('alert', (event) => {
            alertify.set('notifier','position', 'top-right');
            alertify.set('notifier','delay', 2);
            alertify.success(event.text);
        });
    });
</script>
