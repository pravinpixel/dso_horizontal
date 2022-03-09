<div class="navbar-custom topnav-navbar  bg-primary-2">
    <div class="container-fluid d-flex justify-content-betweens align-items-center">
        <!-- LOGO -->
        <a href="{{ route('dashboard') }}" class="topnav-logo border-end">
            <span class="topnav-logo-lg">
                <img src="{{ asset('public/asset/images/logo/logo-small.png') }}" alt="" width="80px"> 
            </span>
            <span class="topnav-logo-sm">
                <b class="text-white h4"><span class="text-primary">DSO</span> EG1</b>
            </span>
        </a> 
        <div class="h3 text-white m-0 ps-4">EG1 Inventory Management System</div>

        <ul class="list-unstyled topbar-menu  float-end ms-auto mb-0">  
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" data-bs-toggle="modal" data-bs-target="#notification-modal">
                    <i class="bi bi-bell noti-icon"></i>
                    <span class="badge rounded-pill bg-danger">5</span>
                    
                </a> 
            </li>
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none"   href="{{ route('ui-demo') }}"  >
                    <i class="bi bi-gear noti-icon"></i>
                </a> 
            </li> 
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ asset('public/asset/images/user.jpg') }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name">Dominic Keller</span>
                        <span class="account-position">Founder</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="bi bi-person-circle me-1"></i>
                        <span>My Account</span>
                    </a> 

                    <!-- item-->
                    <a href="{{ route('login') }}" class="dropdown-item notify-item">
                        <i class="bi bi-box-arrow-right me-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li> 
        </ul>  
        <a class="navbar-toggle"  data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
            <div class="lines">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </a> 
    </div>
</div>
 