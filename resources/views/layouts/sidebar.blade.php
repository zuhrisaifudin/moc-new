<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="22">
            </span>
        </a>
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-light.png') }}" alt="" height="22">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover shadow-none" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">

                <li class="nav-item">
                    <a href="{{ route('root') }}" class="nav-link menu-link"> <i class="ti ti-brand-google-home"></i> <span data-key="t-dashboards">Dashboards</span> </a>
                </li>
                
                <li class="menu-title"><i class="ti ti-dots"></i> <span data-key="t-permohonan">Permohonan</span></li>
               <li class="nav-item">
                    <a href="#sidebarPermohonan" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarPermohonan">
                        <i class="ti ti-file-invoice"></i> <span data-key="t-moc">Permohonan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPermohonan">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('central-moc-request-index') }}" class="nav-link" data-key="t-list-view">Semua MOC </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link" data-key="t-overview">Tambah MOC </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="menu-title"><i class="ti ti-dots"></i> <span data-key="t-pages">Master</span></li>

                @canany(['manage-stage', ' manage-criteria'])
                <li class="nav-item">
                    <a href="#sidebarTahapan" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTahapan">
                        <i class="ri-route-fill"></i> <span data-key="t-invoices">Form Perubahan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTahapan">
                        <ul class="nav nav-sm flex-column">
                            @can('manage-stage')
                            <li class="nav-item">
                                <a href="{{ route('central-stages-page') }}" class="nav-link" data-key="t-list-stages">Semua Tahapan </a>
                            </li>
                            @endcan
                            @can('manage-criteria')
                            <li class="nav-item">
                                <a href="{{ route('central-criteria-page') }}" class="nav-link" data-key="t-list-criteria">Semua Kriteria </a>
                            </li>
                            @endcan
                            @can('manage-description-change')
                            <li class="nav-item">
                                <a href="{{ route('central-description-change-page') }}" class="nav-link" data-key="t-list-description-change">Semua Deskripsi </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany
                @canany(['manage-region'])
                <li class="nav-item">
                    <a href="#sidebarRegion" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarRegion">
                        <i class="ri-open-source-line"></i> <span data-key="t-invoices">Wilayah</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarRegion">
                        <ul class="nav nav-sm flex-column">
                            @can('manage-regions')
                            <li class="nav-item">
                                <a href="{{ route('central-region-page') }}" class="nav-link" data-key="t-list-regions">Semua Wilayah </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany
                @canany(['manage-district'])
                <li class="nav-item">
                    <a href="#sidebarDistrict" class="nav-link menu-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDistrict">
                        <i class=" ri-opera-line"></i> <span data-key="t-invoices">Area</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarDistrict">
                        <ul class="nav nav-sm flex-column">
                            @can('manage-district')
                            <li class="nav-item">
                                <a href="{{ route('central-district-page') }}" class="nav-link" data-key="t-list-district">Semua Area </a>
                            </li>
                            @endcan
                        </ul>
                    </div>
                </li>
                @endcanany

                <li class="menu-title"><i class="ti ti-dots"></i> <span data-key="t-setting">Setting</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarSetting" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSetting">
                        <i class="ri-shield-user-line"></i> <span data-key="t-pages">Pengaturan</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarSetting">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('telescope') }}" class="nav-link" data-key="t-telescop">Telescop Development </a>
                            </li>
                          
                        </ul>
                    </div>
                </li>
                @canany(['manage-user', ' manage-module', ' manage-permission', ' manage-role'])
                <li class="nav-item">
                    <a class="nav-link menu-link collapsed" href="#sidebarAuthentication" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuthentication">
                        <i class="ri-sound-module-line"></i> <span data-key="t-pages">Authentication</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuthentication">
                        <ul class="nav nav-sm flex-column">
                            @can('manage-user')
                            <li class="nav-item">
                                <a href="{{ route('central-user-page') }}" class="nav-link {{ Route::is('central-user-page') ? 'active' : '' }}" data-key="t-starter"><i class="ri-shield-user-line"></i>  User</a>
                            </li>
                            @endcan
                            @can('manage-module')
                            <li class="nav-item">
                                <a href="{{ route('central-module-page') }}" class="nav-link {{ Route::is('central-module-page') ? 'active' : '' }}" data-key="t-modul"><i class="ri-sound-module-line"></i>  Modul</a>
                            </li>
                            @endcan
                            @can('manage-permission')
                            <li class="nav-item">
                                <a href="{{ route('central-permission-page') }}" class="nav-link {{ Route::is('central-permission-page') ? 'active' : '' }}" data-key="t-permission"><i class="ri-shield-keyhole-fill"></i>  Permission</a>
                            </li>
                            @endcan
                            @can('manage-role')
                            <li class="nav-item">
                                <a href="{{ route('central-role-page') }}" class="nav-link {{ Route::is('central-role-page') ? 'active' : '' }}" data-key="t-permission"><i class="ri-key-2-line"></i>  Role</a>
                            </li>
                             @endcan
                        </ul>
                    </div>
                </li>
                @endcanany
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>