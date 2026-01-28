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
                {{-- manage-properties --}}
                <li class="nav-item">
                    <a href="{{ route('manage-properties.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('manage-properties.*') ? 'active' : '' }}">
                        <i class="ri-home-4-line"></i>
                        <span data-key="t-properties">Manage Properties</span>
                    </a>
                </li>

                {{-- manage-agents --}}
                <li class="nav-item">
                    <a href="{{ route('manage-agents.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('manage-agents.*') ? 'active' : '' }}">
                        <i class="ri-user-3-line"></i>
                        <span data-key="t-agents-management">Agents Management</span>
                    </a>
                </li>
                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Student Enquiries --}}
                <li class="nav-item">
                    <a href="{{ route('student-enquiry.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('student-enquiry.*') ? 'active' : '' }}">
                        <i class="ri-question-answer-line"></i>
                        <span data-key="t-student-enquiries">Student Enquiries</span>
                    </a>
                </li>
                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">

                {{-- Cities --}}
                <li class="nav-item">
                    <a href="{{ route('cities.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('cities.*') ? 'active' : '' }}">
                        <i class="ri-community-line"></i>
                        <span data-key="t-cities">Cities</span>
                    </a>
                </li>

                {{-- Amenities --}}
                <li class="nav-item">
                    <a href="{{ route('amenities.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('amenities.*') ? 'active' : '' }}">
                        <i class="ri-service-line"></i>
                        <span data-key="t-amenities">Amenities</span>
                    </a>
                </li>

                {{-- Bill Includeds --}}
                <li class="nav-item">
                    <a href="{{ route('bill-includeds.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('bill-includeds.*') ? 'active' : '' }}">
                        <i class="ri-bank-card-line"></i>
                        <span data-key="t-bill-includeds">Bill Includeds</span>
                    </a>
                </li>

                {{-- Property Types --}}
                <li class="nav-item">
                    <a href="{{ route('property-types.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('property-types.*') ? 'active' : '' }}">
                        <i class="ri-building-4-line"></i>
                        <span data-key="t-property-types">Property Types</span>
                    </a>
                </li>
                {{-- Room Types --}}
                <li class="nav-item">
                    <a href="{{ route('room-types.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('room-types.*') ? 'active' : '' }}">
                        <i class="ri-hotel-bed-line"></i>
                        <span data-key="t-room-types">Types of Rooms</span>
                    </a>
                </li>

                {{-- Place of Studies --}}
                <li class="nav-item">
                    <a href="{{ route('place-of-studies.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('place-of-studies.*') ? 'active' : '' }}">
                        <i class="ri-bank-line"></i>
                        <span data-key="t-place-of-studies">Place of Studies</span>
                    </a>
                </li>

                {{-- Referral Sources --}}
                <li class="nav-item">
                    <a href="{{ route('referral-sources.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('referral-sources.*') ? 'active' : '' }}">
                        <i class="ri-share-line"></i>
                        <span data-key="t-referral-sources">Referral Sources</span>
                    </a>
                </li>

                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">

                {{-- Blog Categories --}}
                <li class="nav-item">
                    <a href="{{ route('blog-categories.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('blog-categories.*') ? 'active' : '' }}">
                        <i class="ri-price-tag-3-line"></i>
                        <span data-key="t-blog-categories">Blog Categories</span>
                    </a>
                </li>

                {{-- Blogs --}}
                <li class="nav-item">
                    <a href="{{ route('blogs.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                        <i class="ri-article-line"></i>
                        <span data-key="t-blogs">Blogs</span>
                    </a>
                </li>
                <hr style="border: none; height: 1px; background-color: hsl(0, 0%, 85%); margin: 20px 0;">

                {{-- Digital Resources Menu --}}
                <li class="nav-item">
                    <a href="{{ route('digital-resources.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('digital-resources.*') ? 'active' : '' }}">
                        <i class="ri-file-cloud-line"></i>
                        <span data-key="t-digital-resources">Digital Resources</span>
                    </a>
                </li>

                {{-- Digital Resource Access Menu --}}
                <li class="nav-item">
                    <a href="{{ route('digitals.resources.access') }}"
                        class="nav-link menu-link {{ request()->routeIs('digitals.resources.access*') ? 'active' : '' }}">
                        <i class="ri-shield-user-line"></i>
                        <span data-key="t-digital-resource-access">Digital Resource Access</span>
                    </a>
                </li>

                <hr style="border: none; height: 4px; background-color: hsl(0, 0%, 85%); margin-top: 5px;">
                {{-- ================================== HomePage ================================== --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('homepage-*') ? 'active' : '' }}"
                        href="#sidebarhomepage" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('homepage-*') ? 'true' : 'false' }}"
                        aria-controls="sidebarhomepage">
                        <i class="bi bi-house-door"></i>
                        <span>Home Page</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('homepage-*') ? 'show' : '' }}"
                        id="sidebarhomepage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('homepage-hero.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('homepage-hero.index') ? 'active' : '' }}">
                                    Hero Section
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ================================== Student Blog ================================== --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('student-blog-*') ? 'active' : '' }}"
                        href="#sidebarstudentblog" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('student-blog-*') ? 'true' : 'false' }}"
                        aria-controls="sidebarstudentblog">
                        <i class="bi bi-journal-text"></i>
                        <span>Student Blog</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('student-blog-*') ? 'show' : '' }}"
                        id="sidebarstudentblog">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('student-blog-hero.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('student-blog-hero.index') ? 'active' : '' }}">
                                    Hero Section
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ================================== Partner Page ================================== --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('partner-page-*') ? 'active' : '' }}"
                        href="#sidebarpartnerpage" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('partner-page-*') ? 'true' : 'false' }}"
                        aria-controls="sidebarpartnerpage">
                        <i class="bi bi-people"></i>
                        <span>Partner Page</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('partner-page-*') ? 'show' : '' }}"
                        id="sidebarpartnerpage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('partner-page-hero.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('partner-page-hero.index') ? 'active' : '' }}">
                                    Hero Section
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                {{-- ================================== Letting Agent Page ================================== --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->routeIs('letting-agent-page-*') ? 'active' : '' }}"
                        href="#sidebarlettingagentpage" data-bs-toggle="collapse" role="button"
                        aria-expanded="{{ request()->routeIs('letting-agent-page-*') ? 'true' : 'false' }}"
                        aria-controls="sidebarlettingagentpage">
                        <i class="bi bi-building"></i>
                        <span>Letting Agent Page</span>
                    </a>
                    <div class="collapse menu-dropdown {{ request()->routeIs('letting-agent-page-*') ? 'show' : '' }}"
                        id="sidebarlettingagentpage">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('letting-agent-hero.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('letting-agent-hero.index') ? 'active' : '' }}">
                                    Hero Section
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('letting-agent-who-we-are.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('letting-agent-who-we-are.index') ? 'active' : '' }}">
                                    Who We Are
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('letting-agent-generate-demand.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('letting-agent-generate-demand.index') ? 'active' : '' }}">
                                    Generate Student Demand
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('letting-agent-why-choose-us.index') }}"
                                    class="nav-link ps-5 {{ request()->routeIs('letting-agent-why-choose-us.index') ? 'active' : '' }}">
                                    Why Providers Choose Us
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Testimonials --}}
                <li class="nav-item">
                    <a href="{{ route('testimonials.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('testimonials.*') ? 'active' : '' }}">
                        <i class="ri-chat-quote-line"></i>
                        <span data-key="t-testimonials">Testimonials</span>
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
                <hr style="border: none; height: 3px; background-color: hsl(0, 8%, 64%); margin-bottom: 5px;">
                {{-- Frequently Asked Questions --}}
                <li class="nav-item">
                    <a href="{{ route('faq.index') }}"
                        class="nav-link menu-link {{ request()->routeIs('faq.*') ? 'active' : '' }}">
                        <i class="ri-question-line"></i>
                        <span data-key="t-faq">FAQ</span>
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
