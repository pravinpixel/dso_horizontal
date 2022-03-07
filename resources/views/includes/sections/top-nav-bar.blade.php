<div class="topnav shadow bg-primary">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu ">

            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav custom">                    
                    <li class="nav-item dropdown">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard') ? "active" : "" }}"><i class="bi bi-speedometer2 me-1"></i><span>Dashboard</span></a>
                    </li>  
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['withdrawal-material-products','list-material-products']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-briefcase me-1"></i> Material / In-House product <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="{{ route('withdrawal-material-products') }}" class="dropdown-item {{ Route::is(['withdrawal-material-products']) ? "active" : "" }}"><i class="bi bi-aspect-ratio me-1"></i><span>Withdrawal</span></a>
                            <a href="{{ route('list-material-products') }}" class="dropdown-item {{ Route::is(['list-material-products']) ? "active" : "" }}"><i class="bi bi-plus-circle-dotted me-1"></i><span>Search or Add</span></a>
                        </div>
                    </li> 
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none {{ Route::is(['threshold-qty','near-expiry-expired']) ? "active" : "" }}" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-bell me-1"></i> Notification <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="{{ route('threshold-qty') }}" class="dropdown-item {{ Route::is(['threshold-qty']) ? "active" : "" }}"><i class="bi bi-subtract me-1"></i><span>Threshold Qty</span></a>
                            <a href="{{ route('near-expiry-expired') }}" class="dropdown-item {{ Route::is(['near-expiry-expired']) ? "active" : "" }}"><i class="bi bi-list-ul me-1"></i><span>Near Expiry/Expired </span></a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('disposal') }}" class="nav-link {{ Route::is('disposal') ? "active" : "" }}"><i class="bi bi-trash2 me-1"></i><span>Early Disposal</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('extend-expiry') }}" class="nav-link {{ Route::is('extend-expiry') ? 'active' : '' }}"><i class="bi bi-arrow-up-right-square me-1"></i>Extend Expiry</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('reports') }}" class="nav-link {{ Route::is('reports') ? 'active' : '' }}"><i class="bi bi-file-earmark-bar-graph me-1"></i>Report  </a>
                    </li> 
                    <li class="nav-item dropdown">
                        <a href="{{ route('print-barcode') }}" class="nav-link {{ Route::is('print-barcode') ? 'active' : '' }}"><i class="bi bi-upc-scan me-1"></i>Print Barcode </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="{{ route('reconsolidation') }}" class="nav-link {{ Route::is('reconsolidation') ? "active" : "" }}"><i class="bi bi-arrow-repeat me-1"></i>Reconciliation</a>
                    </li> 
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-dashboards" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-dashboard me-1"></i>Dashboards <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-dashboards">
                            <a href="dashboard-analytics.html" class="dropdown-item">Analytics</a>
                            <a href="dashboard-crm.html" class="dropdown-item">CRM</a>
                            <a href="index.html" class="dropdown-item">Ecommerce</a>
                            <a href="dashboard-projects.html" class="dropdown-item">Projects</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-apps me-1"></i>Apps <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-apps">
                            <a href="apps-calendar.html" class="dropdown-item">Calendar</a>
                            <a href="apps-chat.html" class="dropdown-item">Chat</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Ecommerce <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                    <a href="apps-ecommerce-products.html" class="dropdown-item">Products</a>
                                    <a href="apps-ecommerce-products-details.html" class="dropdown-item">Products Details</a>
                                    <a href="apps-ecommerce-orders.html" class="dropdown-item">Orders</a>
                                    <a href="apps-ecommerce-orders-details.html" class="dropdown-item">Order Details</a>
                                    <a href="apps-ecommerce-customers.html" class="dropdown-item">Customers</a>
                                    <a href="apps-ecommerce-shopping-cart.html" class="dropdown-item">Shopping Cart</a>
                                    <a href="apps-ecommerce-checkout.html" class="dropdown-item">Checkout</a>
                                    <a href="apps-ecommerce-sellers.html" class="dropdown-item">Sellers</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Email <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-email">
                                    <a href="apps-email-inbox.html" class="dropdown-item">Inbox</a>
                                    <a href="apps-email-read.html" class="dropdown-item">Read Email</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-project" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Projects <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-project">
                                    <a href="apps-projects-list.html" class="dropdown-item">List</a>
                                    <a href="apps-projects-details.html" class="dropdown-item">Details</a>
                                    <a href="apps-projects-gantt.html" class="dropdown-item">Gantt</a>
                                    <a href="apps-projects-add.html" class="dropdown-item">Create Project</a>
                                </div>
                            </div>
                            <a href="apps-social-feed.html" class="dropdown-item">Social Feed</a>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-tasks" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Tasks <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-tasks">
                                    <a href="apps-tasks.html" class="dropdown-item">List</a>
                                    <a href="apps-tasks-details.html" class="dropdown-item">Details</a>
                                    <a href="apps-kanban.html" class="dropdown-item">Kanban Board</a>
                                </div>
                            </div>
                            <a href="apps-file-manager.html" class="dropdown-item">File Manager</a>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-pages" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil-copy-alt me-1"></i>Pages <div class="arrow-down"></div>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="topnav-pages">
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Authenitication <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                    <a href="pages-login.html" class="dropdown-item">Login</a>
                                    <a href="pages-login-2.html" class="dropdown-item">Login 2</a>
                                    <a href="pages-register.html" class="dropdown-item">Register</a>
                                    <a href="pages-register-2.html" class="dropdown-item">Register 2</a>
                                    <a href="pages-logout.html" class="dropdown-item">Logout</a>
                                    <a href="pages-logout-2.html" class="dropdown-item">Logout 2</a>
                                    <a href="pages-recoverpw.html" class="dropdown-item">Recover Password</a>
                                    <a href="pages-recoverpw-2.html" class="dropdown-item">Recover Password 2</a>
                                    <a href="pages-lock-screen.html" class="dropdown-item">Lock Screen</a>
                                    <a href="pages-lock-screen-2.html" class="dropdown-item">Lock Screen 2</a>
                                    <a href="pages-confirm-mail.html" class="dropdown-item">Confirm Mail</a>
                                    <a href="pages-confirm-mail-2.html" class="dropdown-item">Confirm Mail 2</a>
                                </div>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-error" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Error <div class="arrow-down"></div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="topnav-error">
                                    <a href="pages-404.html" class="dropdown-item">Error 404</a>
                                    <a href="pages-404-alt.html" class="dropdown-item">Error 404-alt</a>
                                    <a href="pages-500.html" class="dropdown-item">Error 500</a>
                                </div>
                            </div>
                            <a href="pages-starter.html" class="dropdown-item">Starter Page</a>
                            <a href="pages-preloader.html" class="dropdown-item">With Preloader</a>
                            <a href="pages-profile.html" class="dropdown-item">Profile</a>
                            <a href="pages-profile-2.html" class="dropdown-item">Profile 2</a>
                            <a href="pages-invoice.html" class="dropdown-item">Invoice</a>
                            <a href="pages-faq.html" class="dropdown-item">FAQ</a>
                            <a href="pages-pricing.html" class="dropdown-item">Pricing</a>
                            <a href="pages-maintenance.html" class="dropdown-item">Maintenance</a>
                            <a href="pages-timeline.html" class="dropdown-item">Timeline</a>
                            <a href="landing.html" class="dropdown-item">Landing</a>
                        </div>
                    </li> --}}
                     
                </ul>
            </div>
        </nav>
    </div>
</div> 