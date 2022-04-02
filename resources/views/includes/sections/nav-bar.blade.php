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
        <div class="h3 text-white m-0 ps-4">EG1 Inventory Management System  <span id="loader"></span> </div>

        <ul class="list-unstyled topbar-menu  float-end ms-auto mb-0">  
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" href="{{ route('help.index') }}" >
                    <i title="Help menu" class="bi bi-question-circle-fill noti-icon"></i>
                </a> 
            </li> 
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle arrow-none" href="#" data-bs-toggle="modal" data-bs-target="#notification-modal">
                    <i  class="bi bi-bell noti-icon"></i>
                    <span class="badge rounded-pill bg-danger" style="transform: translate(-10px, -12px);">5</span> 
                </a> 
            </li> 
            
            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" id="topbar-userdrop" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <span class="account-user-avatar"> 
                        <img src="{{ asset('public/asset/images/user.jpg') }}" alt="user-image" class="rounded-circle">
                    </span>
                    <span>
                        <span class="account-user-name">{{ Sentinel::getUser()->first_name }}</span>
                        <span class="account-position">{{ Sentinel::getUser()->roles[0]->name }}</span>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown" aria-labelledby="topbar-userdrop">
                    <!-- item-->
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="{{ route('master-settings') }}" class="dropdown-item notify-item">
                        <i class="bi bi-gear me-1"></i>
                        <span>Settings </span>
                    </a> 

                    <!-- item-->
                    <a href="{{ route('help.index') }}" class="dropdown-item notify-item">
                        <i class="bi bi-question-circle-fill me-1"></i>
                        <span>Help </span>
                    </a>

                    <!-- item-->
                    <a onclick="return document.getElementById('logout_form').submit()" class="dropdown-item notify-item">
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

 
<form action="{{ route('logout') }}" method="POST" id="logout_form">@csrf</form>