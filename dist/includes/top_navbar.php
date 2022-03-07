<div id="wrapper">

<!-- top navbar -->
<nav class="navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-bars"></i></button>
        </div>

        <div class="navbar-brand ps-2">
            <a href="home.php">
                <img src="assets/images/mdflogo2.png" alt="" width="60px" height="40px">
            </a>
        </div>

        <div class="d-flex flex-grow-1 align-items-center">
            <div class="d-flex">
                <ul class="nav nav-pills me-4 ms-2 d-none d-lg-block">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Info mdf</a>
                        <ul class="dropdown-menu shadow-sm">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Separated link</a></li>
                        </ul>
                    </li>
                </ul>
                <form id="navbar-search" class="navbar-form search-form position-relative d-none d-md-block">
                    <input value="" class="form-control" placeholder="Search here..." type="text">
                    <button type="button" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <div class="flex-grow-1">
                <ul class="nav navbar-nav flex-row justify-content-end align-items-center">
                    <li class="d-none d-sm-block"><a href="app-events.html" class="icon-menu"><i class="fa fa-calendar"></i></a></li>
                    <li class="d-none d-sm-block"><a href="app-chat.html" class="icon-menu"><i class="fa fa-comments"></i></a></li>
                    <li><a href="app-inbox.html" class="icon-menu"><i class="fa fa-envelope"></i><span class="notification-dot"></span></a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle icon-menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="notification-dot"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-0 shadow notification">
                            <ul class="list-unstyled feeds_widget">
                                <li class="d-flex">
                                    <div class="feeds-left"><i class="fa fa-thumbs-o-up"></i></div>
                                    <div class="feeds-body flex-grow-1">
                                        <h6 class="mb-1">7 New Feedback <small class="float-end text-muted small">Today</small></h6>
                                        <span class="text-muted">It will give a smart finishing to your site</span>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="feeds-left"><i class="fa fa-user"></i></div>
                                    <div class="feeds-body flex-grow-1">
                                        <h6 class="mb-1">New User <small class="float-end text-muted small">10:45</small></h6>
                                        <span class="text-muted">I feel great! Thanks team</span>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="feeds-left"><i class="fa fa-question-circle"></i></div>
                                    <div class="feeds-body flex-grow-1">
                                        <h6 class="mb-1 text-warning">Server Warning <small class="float-end text-muted small">10:50</small></h6>
                                        <span class="text-muted">Your connection is not private</span>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="feeds-left"><i class="fa fa-check"></i></div>
                                    <div class="feeds-body flex-grow-1">
                                        <h6 class="mb-1 text-danger">Issue Fixed <small class="float-end text-muted small">11:05</small></h6>
                                        <span class="text-muted">WE have fix all Design bug with Responsive</span>
                                    </div>
                                </li>
                                <li class="d-flex">
                                    <div class="feeds-left"><i class="fa fa-shopping-basket"></i></div>
                                    <div class="feeds-body flex-grow-1">
                                        <h6 class="mb-1">7 New Orders <small class="float-end text-muted small">11:35</small></h6>
                                        <span class="text-muted">You received a new oder from Tina.</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle icon-menu" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa fa-sliders"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 shadow">
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-pencil-square-o"></i> <span>Basic</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-sliders fa-rotate-90"></i> <span>Preferences</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-lock"></i> <span>Privacy</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-bell"></i> <span>Notifications</span></a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-credit-card"></i> <span>Payments</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-print"></i> <span>Invoices</span></a></li>
                            <li><a class="dropdown-item" href="javascript:void(0);"><i class="fa fa-refresh"></i> <span>Renewals</span></a></li>
                        </ul>
                    </li>
                    <li><a href="logout.php" class="icon-menu"><i class="fa fa-sign-out"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>