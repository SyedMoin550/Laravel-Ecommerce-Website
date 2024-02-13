<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('admin.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-heading">Category</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#cate-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-gem"></i><span>Manage Category</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="cate-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('addCategory') }}">
                        <i class="bi bi-circle-fill"></i><span>Add Category</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('allCategory') }}">
                        <i class="bi bi-circle-fill"></i><span>All Category</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">Products</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#products-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box-fill"></i><span>Manage Products</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="products-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('showAddProductPage') }}">
                        <i class="bi bi-circle-fill"></i><span>Add Product</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('allProduct') }}">
                        <i class="bi bi-circle-fill"></i><span>All Products</span>
                    </a>
                </li>
            </ul>
        </li>
        <!-- End Icons Nav -->

        <li class="nav-heading">Orders</li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#orders-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-box-fill"></i><span>Manage Orders</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="orders-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('showAllOrder') }}">
                        <i class="bi bi-circle-fill"></i><span>All Orders</span>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-heading">Notifications</li>
            <li class="nav-item">
                <a class="nav-link" href="/admin/notification">
                    <i class="bi bi-box-fill"></i><span>Notification</span></i>
                </a>
            </li>
    </ul>

</aside>
