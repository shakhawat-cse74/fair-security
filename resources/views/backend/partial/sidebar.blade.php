<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <div class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('dashboard') }}">
                <img src="{{ asset($systemSettings->system_logo ?? 'uploads/systems/logo/default-logo.png') }}"
                     class="header-brand-img" alt="logo" style="height: 50px; width: 600px">
            </a>
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/>
                </svg>
            </div>

            <ul class="side-menu">
                <li><h3>Menu</h3></li>

                <!-- Dashboard -->
                <li class="slide">
                    <a class="side-menu__item" href="{{ route('dashboard') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M8.354 1.146a.5.5 0 0 0-.708 0L1 7.793V14.5A1.5 1.5 0 0 0 2.5 16h3a.5.5 0 0 0 .5-.5V11a1 1 0 0 1 2 0v4.5a.5.5 0 0 0 .5.5h3A1.5 1.5 0 0 0 15 14.5V7.793l-6.646-6.647z"/>
                        </svg>
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>

                <li><h3>Components</h3></li>

                <!-- Banner -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H4zm0 1h8a1 1 0 0 1 1 1v10l-3-3-3 3-3-3-3 3V2a1 1 0 0 1 1-1z"/>
                        </svg>
                        <span class="side-menu__label">Banner</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('banners.index') }}" class="slide-item">Manage Banner</a></li>
                    </ul>
                </li>


                <!-- Our Journey -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zM4.285 12.433a.5.5 0 0 1 .683-.183l3.75 2.5a.5.5 0 0 1-.5.866l-3.75-2.5a.5.5 0 0 1-.183-.683zm7-8.866a.5.5 0 0 1 .183.683l-2.5 3.75a.5.5 0 1 1-.866-.5l2.5-3.75a.5.5 0 0 1 .683-.183z"/>
                        </svg>
                        <span class="side-menu__label">Our Journey</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('our-journeys.index') }}" class="slide-item">Manage Our Journey</a></li>
                    </ul>
                </li>

                <!-- Mission -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0-1A6 6 0 1 0 8 2a6 6 0 0 0 0 12zM8 4a4 4 0 1 1 0 8 4 4 0 0 1 0-8zM8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                        </svg>
                        <span class="side-menu__label">Mission</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('missions.index') }}" class="slide-item">Manage Mission</a></li>
                    </ul>
                </li>

                <!-- Vission -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zm-8 4a4 4 0 1 1 0-8 4 4 0 0 1 0 8z"/>
                            <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                        </svg>
                        <span class="side-menu__label">Vission</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('vissions.index') }}" class="slide-item">Manage Vission</a></li>
                    </ul>
                </li>

                <!-- Partner -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M4.5 6a.5.5 0 0 0-.5.5v5.793l1 1V6.5A.5.5 0 0 0 4.5 6zM11.5 6a.5.5 0 0 1 .5.5v6.293l1-1V6.5a.5.5 0 0 0-.5-.5h-1z"/>
                            <path d="M1 6a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v1l-3 3-2-2-2 2-3-3V6z"/>
                        </svg>
                        <span class="side-menu__label">Partner</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('partners.index') }}" class="slide-item">Manage Partner</a></li>
                    </ul>
                </li>

                <!-- Gallery -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M1 2a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2zm1 0v12h12V2H2z"/>
                            <path d="M10 5l3 4-2 3H5l3-5 2-2z"/>
                        </svg>
                        <span class="side-menu__label">Gallery</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('galleries.index') }}" class="slide-item">Manage Gallery</a></li>
                    </ul>
                </li>

                <!-- Branch -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M2 0h12a1 1 0 0 1 1 1v15H1V1a1 1 0 0 1 1-1zm1 1v14h2V1H3zm4 0v14h2V1H7zm4 0v14h2V1h-2z"/>
                        </svg>
                        <span class="side-menu__label">Branch</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('branches.index') }}" class="slide-item">Manage Branch</a></li>
                    </ul>
                </li>

                <!-- Employee -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                        </svg>
                        <span class="side-menu__label">Employee</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('employees.index') }}" class="slide-item">Manage Employee</a></li>
                    </ul>
                </li>

                <!-- Management -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M5 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM1 8s1-1 4-1 4 1 4 1-1 1-4 1-4-1-4-1zM12 3a2 2 0 1 0 0 4 2 2 0 0 0 0-4zM8 8s1-1 4-1 4 1 4 1-1 1-4 1-4-1-4-1z"/>
                        </svg>
                        <span class="side-menu__label">Management</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('management.index') }}" class="slide-item">Manage Management</a></li>
                    </ul>
                </li>

                <!-- Our Services -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm0 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zM4.285 12.433a.5.5 0 0 1 .683-.183l3.75 2.5a.5.5 0 0 1-.5.866l-3.75-2.5a.5.5 0 0 1-.183-.683zm7-8.866a.5.5 0 0 1 .183.683l-2.5 3.75a.5.5 0 1 1-.866-.5l2.5-3.75a.5.5 0 0 1 .683-.183z"/>
                        </svg>
                        <span class="side-menu__label">Our Services</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('our-services.index') }}" class="slide-item">Manage Our Services</a></li>
                    </ul>
                </li>

                <!-- System Setting -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M9.667 0a.667.667 0 0 1 .667.667v1.333a.667.667 0 0 1-.667.667H6.333a.667.667 0 0 1-.667-.667V.667A.667.667 0 0 1 6.333 0h3.334zM4 3.667V2.333h-.667A.667.667 0 0 0 2.667 3v1.667H4zm8 0V3h-.667v1.667H12zm-4 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                        </svg>
                        <span class="side-menu__label">System Setting</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('profile.index') }}" class="slide-item">Profile Setting</a></li>
                        <li><a href="{{ route('settings.mail') }}" class="slide-item">Mail Setting</a></li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="side-menu__icon me-2" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            <path d="M1 14s1-1 7-1 7 1 7 1-1 1-7 1-7-1-7-1z"/>
                        </svg>
                        <span class="side-menu__label">Users</span>
                        <i class="angle fa fa-angle-right"></i>
                    </a>
                    <ul class="slide-menu">
                        <li><a href="{{ route('users.create') }}" class="slide-item">Create User</a></li>
                        <li><a href="{{ route('users.index') }}" class="slide-item">Manage User</a></li>
                    </ul>
                </li>

            </ul>

            <div class="slide-right" id="slide-right">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/>
                </svg>
            </div>
        </div>
    </div>
</div>
<!--/APP-SIDEBAR-->
