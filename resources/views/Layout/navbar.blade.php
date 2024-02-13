<nav class="p-3">
    <div class="container-fluid ps-4 pe-4 pt-2 d-flex justify-content-between">
        <a class="navbar-brand fw-bolder fs-4" href="/">My Store</a>

        {{-- Category Dropdowns  --}}

        <div class="dropdown {{request()->routeIs('home') ? 'd-none' : ''}}">
            <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Categories
            </button>
            <ul class="dropdown-menu">
                @foreach ($category as $item)
                            <li class="parent dropdown-item">
                                <span class="text-dark " style="cursor: pointer">{{ $item['category_name'] }}</span>
                                @if (!empty($item['subCategories']))
                                    <ul class="child">
                                        @foreach ($item['subCategories'] as $subCategory)
                                            <li class="parent"><a href="/category/{{ $subCategory['category_slug'] }}">{{ $subCategory['category_name'] }}</a>
                                                @if (!empty($subCategory['subCategories']))
                                                    <ul class="child">
                                                        @foreach ($subCategory['subCategories'] as $subsubCategory)
                                                            <li><a class="w-auto" href="/category/{{ $subCategory['category_slug'] }}/{{ $subsubCategory['category_slug'] }}">{{ $subsubCategory['category_name'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
            </ul>
        </div>

        {{-- Search bar  --}}
        <div class="w-50">
            <form action="{{route('search')}}" class="d-flex" method="get">
                <input type="text" class="form-control" name="search" value="{{Request::get('search')}}" id="search" placeholder="Search Products"
                    style="border-top-right-radius:0px;border-bottom-right-radius: 0px;">
                <button type="submit" class="btn btn-dark" style="border-top-left-radius: 0px;border-bottom-left-radius:0px"><i
                        class="bi bi-search"></i></button>
            </form>
        </div>
        <div class="">
            <ul class="mb-2 d-flex nav-list">

                @if (auth()->user() && auth()->user()->role_as == 0)
                    <li class=" me-4  ">
                        <a class="nav-link" aria-current="page" href="{{ route('AddToCartPage') }}">
                            <span class="text-dark">
                                <i class="bi bi-cart-check fs-3 position-relative">
                                    <span
                                        class=" position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                                        style="font-size: 12px;">
                                        <livewire:Product.addtocartcounter />
                                    </span>
                                </i>
                            </span>

                        </a>
                    </li>

                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            My Orders
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('showMyOrdersPage') }}">My Orders</a></li>
                            <li><a class="dropdown-item" href="{{ route('showProfilePage') }}">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('showChangePassPage') }}">Change Password</a>
                            </li>
                            <li><a class="dropdown-item" href="/Logout">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <li class="nav-item me-2">
                        <a class="btn btn-dark " aria-current="page" href="/Login">Login</a>
                    </li>
                    <li class="nav-item me-2">
                        <a class="btn btn-warning " aria-current="page" href="/Sign-Up">Sign Up</a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
