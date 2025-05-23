<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="build/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="build/images/logo-dark.png" alt="" height="22">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="build/images/logo-sm.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="build/images/logo-light.png" alt="" height="22">
                        </span>
                    </a>
                </div>

                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger shadow-none" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

            
            </div>

            <div class="d-flex align-items-center">

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class='ti ti-category-2 fs-3xl'></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg p-0 dropdown-menu-end">
                        <div class="p-3 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fw-semibold fs-base"> Browse by Apps </h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#!" class="btn btn-sm btn-subtle-info"> View All Apps
                                        <i class="ri-arrow-right-s-line align-middle"></i></a>
                                </div>
                            </div>
                        </div>

                        <div class="p-2">
                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/github.png" alt="Github">
                                        <span>GitHub</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/bitbucket.png" alt="bitbucket">
                                        <span>Bitbucket</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/dribbble.png" alt="dribbble">
                                        <span>Dribbble</span>
                                    </a>
                                </div>
                            </div>

                            <div class="row g-0">
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/dropbox.png" alt="dropbox">
                                        <span>Dropbox</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/mail_chimp.png" alt="mail_chimp">
                                        <span>Mail Chimp</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <a class="dropdown-icon-item" href="#!">
                                        <img src="build/images/brands/slack.png" alt="slack">
                                        <span>Slack</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text" data-toggle="fullscreen">
                        <i class='ti ti-arrows-maximize fs-3xl'></i>
                    </button>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text mode-layout" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="ti ti-sun align-middle fs-3xl"></i>
                    </button>
                    <div class="dropdown-menu p-2 dropdown-menu-end" id="light-dark-mode">
                        <a href="#!" class="dropdown-item" data-mode="light"><i class="bi bi-sun align-middle me-2"></i> Default (light mode)</a>
                        <a href="#!" class="dropdown-item" data-mode="dark"><i class="bi bi-moon align-middle me-2"></i> Dark</a>
                        <a href="#!" class="dropdown-item" data-mode="auto"><i class="bi bi-moon-stars align-middle me-2"></i> Auto (system default)</a>
                    </div>
                </div>

                <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-light rounded-circle user-name-text" id="page-header-notifications-dropdown" data-bs-toggle="dropdown"  data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class='ti ti-bell-ringing fs-3xl'></i>
                        <span class="position-absolute topbar-badge fs-3xs translate-middle badge rounded-pill bg-danger"><span class="notification-badge">4</span><span class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head rounded-top">
                            <div class="p-3 border-bottom border-bottom-dashed">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="mb-0 fs-lg fw-semibold"> Notifications <span class="badge bg-danger-subtle text-danger fs-sm notification-badge"> 4</span></h6>
                                        <p class="fs-md text-muted mt-1 mb-0">You have <span class="fw-semibold notification-unread">3</span> unread messages</p>
                                    </div>
                                    <div class="col-auto dropdown">
                                        <a href="javascript:void(0);" data-bs-toggle="dropdown" class="link-secondary fs-md"><i class="bi bi-three-dots-vertical"></i></a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">All Clear</a></li>
                                            <li><a class="dropdown-item" href="#">Mark all as read</a></li>
                                            <li><a class="dropdown-item" href="#">Archive All</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="py-2 ps-2" id="notificationItemsTabContent">
                            <div data-simplebar style="max-height: 300px;" class="pe-2">
                                <h6 class="text-overflow text-muted fs-sm my-2 text-uppercase notification-title">New</h6>
                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                            <span class="avatar-title bg-success-subtle text-success rounded-circle fs-lg">
                                                <i class='ti ti-gift'></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 fs-md mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                    Optimization <span class="text-secondary">reward</span> is ready!
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-xs fw-medium text-uppercase text-muted">
                                                <span><i class="ti ti-clock-hour-4"></i> Just 30 sec ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check01">
                                                <label class="form-check-label" for="all-notification-check01"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="position-relative me-3 flex-shrink-0">
                                            <img src="build/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            <span class="active-badge position-absolute start-100 translate-middle p-1 bg-success rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-1 fs-md fw-semibold">Angela Bernier</h6>
                                            </a>
                                            <div class="fs-sm text-muted">
                                                <p class="mb-1">Answered to your comment on the cash flow forecast's graph 🔔.</p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium text-uppercase text-muted">
                                                <span><i class="ti ti-clock-hour-4"></i> 48 min ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check02">
                                                <label class="form-check-label" for="all-notification-check02"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-reset notification-item d-block dropdown-item position-relative unread-message">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                            <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-lg">
                                                <i class='ti ti-message-2'></i>
                                            </span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-2 fs-md lh-base">You have received <b class="text-success">20</b> new messages in the conversation
                                                </h6>
                                            </a>
                                            <p class="mb-0 fs-xs fw-medium text-uppercase text-muted">
                                                <span><i class="ti ti-clock-hour-4"></i> 2 hrs ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check03">
                                                <label class="form-check-label" for="all-notification-check03"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="text-overflow text-muted fs-sm my-2 text-uppercase notification-title">Read Before</h6>

                                <div class="text-reset notification-item d-block dropdown-item position-relative">
                                    <div class="d-flex">

                                        <div class="position-relative me-3 flex-shrink-0">
                                            <img src="build/images/users/avatar-8.jpg" class="rounded-circle avatar-xs" alt="user-pic">
                                            <span class="active-badge position-absolute start-100 translate-middle p-1 bg-warning rounded-circle">
                                                <span class="visually-hidden">New alerts</span>
                                            </span>
                                        </div>

                                        <div class="flex-grow-1">
                                            <a href="#!" class="stretched-link">
                                                <h6 class="mt-0 mb-1 fs-md fw-semibold">Maureen Gibson</h6>
                                            </a>
                                            <div class="fs-sm text-muted">
                                                <p class="mb-1">We talked about a project on linkedin.</p>
                                            </div>
                                            <p class="mb-0 fs-xs fw-medium text-uppercase text-muted">
                                                <span><i class="ti ti-clock-hour-4"></i> 4 hrs ago</span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-base">
                                            <div class="form-check notification-check">
                                                <input class="form-check-input" type="checkbox" value="" id="all-notification-check04">
                                                <label class="form-check-label" for="all-notification-check04"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-actions" id="notification-actions">
                                <div class="d-flex text-muted justify-content-center align-items-center">
                                    Select <div id="select-content" class="text-body fw-semibold px-1">0</div> Result <button type="button" class="btn btn-link link-danger p-0 ms-2" data-bs-toggle="modal" data-bs-target="#removeNotificationModal">Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dropdown ms-sm-3 topbar-head-dropdown dropdown-hover-end header-item topbar-user">
                    <button type="button" class="btn shadow-none btn-icon" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="Header Avatar">
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <!-- item-->
                        <h6 class="dropdown-header">Welcome {{ Auth::user()->name ?? '' }} </h6>
                        <a class="dropdown-item fs-sm" href="#!"><i class="bi bi-person-circle text-muted align-middle me-1"></i> <span class="align-middle">@lang('translation.profile') </span></a>
                        <a class="dropdown-item fs-sm" href="#!"><i class="bi bi-cart4 text-muted align-middle me-1"></i> <span class="align-middle">@lang('translation.order-track')</span></a>
                        <a class="dropdown-item fs-sm" href="#!"><i class="bi bi-box-seam text-muted align-middle me-1"></i> <span class="align-middle">@lang('translation.chat')</span></a>
                        <a class="dropdown-item fs-sm" href="#!"><span class="badge bg-success-subtle text-success float-end ms-2">New</span><i class="bi bi-cassette text-muted align-middle me-1"></i> <span class="align-middle">@lang('translation.todo')</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item fs-sm" href="#!"><i class="bi bi-gear text-muted align-middle me-1"></i> <span class="align-middle">@lang('translation.setting')</span></a>
                        <a class="dropdown-item fs-sm" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="bi bi-box-arrow-right text-muted align-middle me-1"></i> <span class="align-middle" data-key="t-logout"> @lang('translation.logout')</span></a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="wrapper"></div>

