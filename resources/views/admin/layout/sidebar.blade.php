<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : ''}}">
            <a class="nav-link" href="{{ url('admin/dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
            </a>
        </li>
        
        <!-- <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-settings" aria-expanded="false" aria-controls="ui-settings">
            <i class="icon-contract menu-icon"></i>
            <span class="menu-title">Settings</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-settings">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/update-admin-password') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/update-admin-password') }}">Update Password</a></li>
                    <li class="nav-item {{ request()->is('admin/update-admin-details') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/update-admin-details') }}">Update Details</a></li>
                </ul>
            </div>
        </li> -->

        


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-content-management" aria-expanded="false" aria-controls="ui-content-management">            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Content Management</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-content-management">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/homepage-banner') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/homepage-banner') }}">Homepage Banner</a></li>

                    <li class="nav-item {{ request()->is('admin/homepage-advertisement') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/homepage-advertisement') }}">Homepage Advertisement</a></li>

                    <li class="nav-item {{ request()->is('admin/add-edit-manage-footer/1') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/add-edit-manage-footer/1') }}">Footer Management</a></li>

                    <li class="nav-item {{ request()->is('admin/footer-banner') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/footer-banner') }}">Footer Banner</a></li>

                    <li class="nav-item {{ request()->is('admin/footer-advertisement') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/footer-advertisement') }}">Footer Advertisement</a></li>

                    <!-- <li class="nav-item {{ request()->is('admin/footer-cpoyright') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/footer-cpoyright') }}">Footer Cpoyright</a></li> -->

                    <li class="nav-item {{ request()->is('admin/social-media') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/social-media') }}">Social Media</a></li>

                </ul>
            </div>
        </li>


        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-admin" aria-expanded="false" aria-controls="ui-admin">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Manage Admins</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-admin">
                <ul class="nav flex-column sub-menu">
                    @if(Auth::guard('admin')->user()->type == "superadmin")
                    <li class="nav-item {{ request()->is('admin/admins/admin') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/admins/admin') }}">Admins</a></li>
                    @endif
                    @if(Auth::guard('admin')->user()->type == "superadmin" || Auth::guard('admin')->user()->type == "admin")
                    <li class="nav-item {{ request()->is('admin/admins/staff') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/admins/staff') }}">Staffs</a></li>
                    @endif
                    @if(Auth::guard('admin')->user()->type == "superadmin")
                    <li class="nav-item {{ request()->is('admin/admins/all') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/admins/all') }}">All Data</a></li>
                     @endif
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-user" aria-expanded="false" aria-controls="ui-user">
            <i class="icon-layout menu-icon"></i>
            <span class="menu-title">Manage Customers</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-user">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/customers') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/customers') }}">Customers</a></li>
                    <li class="nav-item {{ request()->is('admin/subscribers') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/subscribers') }}">Subscribers</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-section" aria-expanded="false" aria-controls="ui-section">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Manage Sections</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-section">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/sections') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/sections') }}">Sections</a></li>
                    <li class="nav-item {{ request()->is('admin/categories') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/categories') }}">Categories</a></li>
                    <li class="nav-item {{ request()->is('admin/brands') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/brands') }}">Brands</a></li>
                </ul>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-product" aria-expanded="false" aria-controls="ui-product">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Manage Products</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-product">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/products') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/products') }}">Products</a></li>
                    {{-- <li class="nav-item {{ request()->is('admin/attributes') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/attributes') }}">Product Attributes</a></li> --}}
                    <li class="nav-item {{ request()->is('admin/set-attributes') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/set-attributes') }}">Set Attributes</a></li>
                    {{-- <li class="nav-item {{ request()->is('admin/filters') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/filters') }}">Product Filters</a></li>
                    <li class="nav-item {{ request()->is('admin/filter-values') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/filter-values') }}">Filter Values</a></li> --}}
                    <li class="nav-item {{ request()->is('admin/add-bulk-products') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/add-bulk-products') }}">Add Bulk Products</a></li>

                    <li class="nav-item {{ request()->is('admin/product-collection') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/product-collection') }}">Product Collection</a></li>

                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-order" aria-expanded="false" aria-controls="ui-order">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Manage Orders</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-order">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/orders/pending') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/pending') }}">Pending Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/processing') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/processing') }}">Processing Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/on delivery') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/on delivery') }}">On Delivery Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/completed') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/completed') }}">Completed Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/declined') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/declined') }}">Declined Orders</a></li>                 
                    <li class="nav-item {{ request()->is('admin/orders/all') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/all') }}">All Data</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-pos" aria-expanded="false" aria-controls="ui-pos">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Manage POS</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-pos">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/pos') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/pos') }}">POS</a></li>
                    <!-- <li class="nav-item {{ request()->is('admin/orders/pending') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/pending') }}">Pending Orders</a></li>

                    <li class="nav-item {{ request()->is('admin/orders/processing') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/processing') }}">Processing Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/on delivery') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/on delivery') }}">On Delivery Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/completed') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/completed') }}">Completed Orders</a></li>
                    <li class="nav-item {{ request()->is('admin/orders/declined') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/declined') }}">Declined Orders</a></li>                 
                    <li class="nav-item {{ request()->is('admin/orders/all') ? 'active' : ''}}"> <a class="nav-link" href="{{ url('admin/orders/all') }}">All Data</a></li> -->
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-faq" aria-expanded="false" aria-controls="ui-faq">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">FAQ</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-faq">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/faqs') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/faqs') }}">Faqs</a></li>
                    <li class="nav-item {{ request()->is('admin/faq-categories') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/faq-categories') }}">Categories</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-tax" aria-expanded="false" aria-controls="ui-tax">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Tax Settings</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-tax">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/taxes') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/taxes') }}">Taxes</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-shippiung_charge" aria-expanded="false" aria-controls="ui-shippiung_charge">
            <i class="icon-grid-2 menu-icon"></i>
            <span class="menu-title">Shipping Charges</span>
            <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-shippiung_charge">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item {{ request()->is('admin/shipping-rules') ? 'active' : ''}}"><a class="nav-link" href="{{ url('admin/shipping-rules') }}">Shipping Rules</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>