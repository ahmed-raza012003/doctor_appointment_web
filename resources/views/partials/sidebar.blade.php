<style>
    .sidebar-link:hover {
        background-color: #11849B !important;
        color: #ffffff !important;
    }
    .sidebar-link:hover .ti {
        color: #ffffff !important;
    }
</style>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/dashboard" class="text-nowrap logo-img">
                <img src="{{ asset('build/admin/images/logos/logo.png') }}" width="230" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="" style="background-color: #ffffff;">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/dashboard" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
                        <span>
                            <i class="ti ti-layout-dashboard" style="color: #11849B;"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('admin.categories.index') }}" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
        <span>
            <i class="ti ti-folder" style="color: #11849B;"></i>
        </span>
        <span class="hide-menu">Categories</span>
    </a>
</li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/specializations" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
                        <span>
                            <i class="ti ti-ribbon-health" style="color: #11849B;"></i>
                        </span>
                        <span class="hide-menu">Specializations</span>
                    </a>
                </li>
                <li class="sidebar-item">
    <a class="sidebar-link" href="/admin/doctors" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
        <span>
            <i class="ti ti-stethoscope" style="color: #11849B;"></i>
        </span>
        <span class="hide-menu">Doctors</span>
    </a>
</li>

<li class="sidebar-item">
                    <a class="sidebar-link" href="/admin/patients" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
                        <span>
                            <i class="ti ti-users" style="color: #11849B;"></i>
                        </span>
                        <span class="hide-menu">Patients</span>
                    </a>
                </li>

           <li class="sidebar-item">
    <a class="sidebar-link" href="/admin/consultations" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
        <span>
            <i class="ti ti-calendar-event" style="color: #11849B;"></i>
        </span>
        <span class="hide-menu">Consultations</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="/admin/services" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
        <span>
            <i class="ti ti-briefcase" style="color: #11849B;"></i>
        </span>
        <span class="hide-menu">Services</span>
    </a>
</li>
<li class="sidebar-item">
    <a class="sidebar-link" href="{{ route('admin.blogs.index') }}" aria-expanded="false" style="background-color: #ffffff; color: #11849B;">
        <span>
            <i class="ti ti-file" style="color: #11849B;"></i>
        </span>
        <span class="hide-menu">Blogs</span>
    </a>
</li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>