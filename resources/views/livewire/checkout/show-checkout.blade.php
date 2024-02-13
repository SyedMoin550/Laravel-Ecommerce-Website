<div class="container-fluid mt-5">
    <div class="container">
        <div class="p-3 shadow bg-light">
            <div class="d-flex justify-content-between">
                <div class="fs-5 fw-bold">Item Total Amount</div>
                <div class="fs-5 fw-bolder">Pkr {{ $this->totalAmount }}</div>
            </div>
            <hr>
            <div>
                <div>* Item will be delivered in 3 - 5 days</div>
                <div>* Tax and other charges are included</div>
            </div>
        </div>

        <div class="mt-5 shadow p-4 bg-light">
            <h5>Basic Information</h5>
            <hr>
            <form wire:submit.prevent="placeOrderSubmit">
                <div class="row">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="mt-1">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Enter Name"
                                wire:model.blur="name">
                        </div>
                        <div class="mt-1">
                            <label for="number" class="form-label">Phone Number</label>
                            <input type="text" id="number"
                                class="form-control @error('number') is-invalid @enderror"
                                placeholder="Enter Phone Number" wire:model.blur="number">
                        </div>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="mt-1">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Enter Email"
                                name="email" wire:model.blur="email">

                        </div>
                        <div class="mt-1">
                            <label for="zipCode" class="form-label">Pin Code (Zip Code)</label>
                            <input type="text" id="zipCode"
                                class="form-control @error('zipCode') is-invalid @enderror" placeholder="Enter Pin Code"
                                wire:model.blur="zipCode">
                        </div>
                    </div>
                </div>
                <div class="form-floating mt-3">
                    <textarea class="form-control @error('address') is-invalid @enderror" name="address" placeholder="Leave a comment here"
                        id="address" style="height: 100px" wire:model.blur="address"></textarea>
                    <label for="address">Full Address</label>
                </div>

                <div class="col-md-12 mb-3 mt-2">
                    <label class="form-label mt-2 mb-2">Select Payment Mode: </label>
                    <div class="d-md-flex align-items-start">
                        <div class="nav col-md-3 flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <button class="nav-link fw-bold active" id="cashOnDeliveryTab-tab" data-bs-toggle="pill"
                                data-bs-target="#cashOnDeliveryTab" type="button" role="tab"
                                aria-controls="cashOnDeliveryTab" aria-selected="true">Cash on Delivery</button>
                            <button class="nav-link fw-bold" id="onlinePayment-tab" data-bs-toggle="pill"
                                data-bs-target="#onlinePayment" type="button" role="tab"
                                aria-controls="onlinePayment" aria-selected="false">Online Payment</button>
                        </div>
                        <div class="tab-content col-md-9" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="cashOnDeliveryTab" role="tabpanel"
                                aria-labelledby="cashOnDeliveryTab-tab" tabindex="0">
                                <h6>Cash on Delivery Mode</h6>
                                <hr />
                                <button type="button" wire:click="codOrder" class="btn btn-primary">Place Order (Cash
                                    on Delivery)</button>
                            </div>
                            <div class="tab-pane fade" id="onlinePayment" role="tabpanel"
                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                <h6>Online Payment Mode</h6>
                                <hr />
                                <button type="button" class="btn btn-warning" id="paypalBtn" wire:click="paypal"
                                    wire:loading.attr="disabled" wire:target="paypal">
                                    {{-- <span wire:loading.remove></span>
                                    <span wire:loading>Loading...</span> --}}
                                    Pay With PayPal
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

</div>
<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('alert', (event) => {
            alertify.set('notifier', 'position', 'top-right');
            alertify.set('notifier', 'delay', 2);
            alertify.success(event.text);
        });
    });
</script>
