@php
    $systemSetting = App\Models\SystemSetting::first();
@endphp

<div class="app-menu navbar-menu">
    {{-- Logo & Toggle Button --}}
    <div class="navbar-brand-box">
        <a href="{{ route('dashboard') }}" class="logo logo-dark">
            <span class="logo-sm position-relative fs-1">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/studentStay.png') }}" alt="Logo"
                    height="53px">
            </span>
            <span class="logo-lg position-relative fs-1">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/studentStay.png') }}" alt="Logo"
                    width="200px" height="53px">
            </span>
        </a>

        <a href="{{ route('dashboard') }}" class="logo logo-light">
            <span class="logo-sm position-relative fs-1">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/studentStay.png') }}" alt="Logo"
                    height="53px">
            </span>
            <span class="logo-lg position-relative fs-1">
                <img src="{{ asset($systemSetting->logo ?? 'backend/images/studentStay.png') }}" alt="Logo"
                    width="200px" height="53px">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-3xl header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>

        <div class="vertical-menu-btn-wrapper header-item vertical-icon">
            <button type="button"
                class="btn btn-sm px-0 fs-xl vertical-menu-btn topnav-hamburger shadow hamburger-icon"
                id="topnav-hamburger-icon">
                <i class='bx bx-chevrons-right'></i>
                <i class='bx bx-chevrons-left'></i>
            </button>
        </div>
    </div>
    {{-- Logo & Toggle Button --}}
    <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">


    <div id="scrollbar">
        {{-- Sidebar Start --}}
        <div class="container-fluid">
            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="ri-dashboard-line"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>


                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Frequently Asked Questions --}}
                <li class="nav-item">
                    <a href="{{ route('faq.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                        <i class="ri-question-line"></i>
                        <span data-key="t-faq">FAQ</span>
                    </a>
                </li>

                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Privacy Policy --}}
                <li class="nav-item">
                    <a href="{{ route('privacy-policy.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('privacy-policy.index') ? 'active' : '' }}">
                        <i class="bi bi-shield-lock"></i>
                        <span data-key="t-privacy-policy">Privacy Policy</span>
                    </a>
                </li>


                {{-- Terms-and-condition --}}
                <li class="nav-item">
                    <a href="{{ route('terms-and-conditions.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('terms-and-conditions.index') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text"></i>
                        <span data-key="t-terms-and-conditions"> Terms & Conditions</span>
                    </a>
                </li>
                </li>

                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Settings --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/settings*') && !request()->routeIs('privacy-policy.index') && !request()->routeIs('terms-and-conditions.index') ? 'active' : '' }}"
                        href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->is('admin/settings*') && !request()->routeIs('privacy-policy.index') && !request()->routeIs('terms-and-conditions.index') ? 'true' : 'false' }}"
                        aria-controls="sidebarPages">
                        <i class="ri-settings-3-line"></i>
                        <span data-key="t-pages">Settings</span>
                    </a>


                    <div class="collapse menu-dropdown {{ request()->is('admin/settings*') && !request()->routeIs('privacy-policy.index') && !request()->routeIs('terms-and-conditions.index') ? 'show' : '' }}"
                        id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('profile.setting') }}"
                                    class="nav-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}"
                                    data-key="t-profile-setting">
                                    Profile Settings
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('system.index') }}"
                                    class="nav-link {{ request()->routeIs('system.index') ? 'active' : '' }}"
                                    data-key="t-system-settings">
                                    System Settings
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('mail.setting') }}"
                                    class="nav-link {{ request()->routeIs('mail.setting') ? 'active' : '' }}"
                                    data-key="t-system-settings">
                                    SMTP Server
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('integration.setting') }}"
                                    class="nav-link {{ request()->routeIs('integration.setting') ? 'active' : '' }}"
                                    data-key="t-integration-settings">
                                    Integration Settings
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="{{ route('social.index') }}"
                                    class="nav-link {{ request()->routeIs('social.index') ? 'active' : '' }}"
                                    data-key="t-social-media-settings">
                                    Social Media Settings
                                </a>
                            </li> --}}

                            {{-- <li class="nav-item">
                                <a href="{{ route('settings.dynamic_page.index') }}"
                                    class="nav-link {{ request()->routeIs('settings.dynamic_page.*') ? 'active' : '' }}"
                                    data-key="t-dynamic-page-settings">
                                    Dynamic Page Settings
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        {{-- Sidebar End --}}
    </div>

    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
