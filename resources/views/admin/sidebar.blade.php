<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
            <img src="{{ asset('vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
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
                
            </ul>
        </div>
    </div>
</div>