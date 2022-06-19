<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('logo/'.get_option('dark_logo')) }}" alt="" class="dark-logo">
            <img src="{{ asset('logo/'.get_option('light_logo')) }}" alt="" class="light-logo">
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-add"></span><span class="mtext">Add Item   </span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('dashboard') }}">Men's Item</a></li>
                        <li><a href="{{ route('dashboard') }}">Women's Item</a></li>
                        <li><a href="{{ route('dashboard') }}">Kids Item</a></li>
                        <li><a href="{{ route('dashboard') }}">Accessories Item</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon dw dw-settings"></span><span class="mtext">Settings</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{route('admin.settings')}}">General</a></li>
                    </ul>

                </li>
            </ul>
        </div>
    </div>
</div>