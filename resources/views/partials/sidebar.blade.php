<style>
    .sidebar-link:hover {
        background-color: #11849B !important;
        color: #ffffff !important;
    }
    .sidebar-link:hover .ti {
        color: #ffffff !important;
    }
    .sidebar-link.active {
        background-color: #11849B !important;
        color: #ffffff !important;
    }
    .sidebar-link.active .ti {
        color: #ffffff !important;
    }
</style>

<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset('build/admin/images/logos/logo.png') }}" width="230" alt="Logo" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="background-color: #ffffff;">
            <ul id="sidebarnav">
                @if(auth()->user()->hasRole('patient'))
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('patient.appointments') ? 'active' : '' }}" 
                           href="{{ route('patient.appointments') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-calendar-event" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">My Appointments</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('patient.profile') ? 'active' : '' }}" 
                           href="{{ route('patient.profile') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-user" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">My Profile</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('contact') ? 'active' : '' }}" 
                           href="{{ route('contact') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-mail" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Contact</span>
                        </a>
                    </li>
                @else

                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('dashboard') ? 'active' : '' }}" 
                           href="/dashboard" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-layout-dashboard" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Dashboard</span>
                        </a>
                    </li>
                     <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.appointments') ? 'active' : '' }}" 
                           href="{{ route('admin.appointments') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-calendar-event" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Manage Appointments</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.categories.index') ? 'active' : '' }}" 
                           href="{{ route('admin.categories.index') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-folder" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Categories</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.specializations') ? 'active' : '' }}" 
                           href="/admin/specializations" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-ribbon-health" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Specializations</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.doctors') ? 'active' : '' }}" 
                           href="/admin/doctors" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-stethoscope" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Doctors</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.patients') ? 'active' : '' }}" 
                           href="/admin/patients" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-users" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Patients</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.consultations') ? 'active' : '' }}" 
                           href="/admin/consultations" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-calendar-event" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Consultations</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.services') ? 'active' : '' }}" 
                           href="/admin/services" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-briefcase" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Services</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a class="sidebar-link {{ Route::is('admin.blogs.index') ? 'active' : '' }}" 
                           href="{{ route('admin.blogs.index') }}" 
                           aria-expanded="false" 
                           style="background-color: #ffffff; color: #11849B;">
                            <span>
                                <i class="ti ti-file" style="color: #11849B;"></i>
                            </span>
                            <span class="hide-menu">Blogs</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>