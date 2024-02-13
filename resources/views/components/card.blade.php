<div class="col">
    <div class="card h-100">
        <img src="{{asset('images/Peace Lily.jpg')}}" alt="No Image" class="card-img-top">
        <div class="card-body">
            <h6 class="card-title">{{$title}}</h6>
            {{-- <p class="card-text text-justify">{{$desc}}</p> --}}
            <h5 class="text-danger">Rs. {{$price}}</h5>
            <del class="text-secondary ">Rs {{$originalPrice}}</del><span class="text-secondary ms-2">-{{$discount}}</span>
        </div>
    </div>
</div>
