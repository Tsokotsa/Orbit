<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">

    <!--begin::Primary menu-->
    <div id="kt_aside_menu_wrapper" class="app-sidebar-menu flex-grow-1 hover-scroll-y scroll-lg-ps my-5 pt-8"
        data-kt-scroll="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">

        <!--begin::Menu-->
        <div id="kt_aside_menu"
            class="menu menu-rounded menu-column menu-title-gray-600 menu-state-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500 fw-semibold fs-6"
            data-kt-menu="true">

            <!-- ===================================================== -->
            <!-- HOME -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-home-2 fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Home
                            </span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="/land">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                Dashboard
                            </span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- ===================================================== -->
            <!-- CLIENTS -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-people fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Clients
                            </span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="/client">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                List
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="/client/sales-orders">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                Sales Orders
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="/contacts/list">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                Contacts
                            </span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- ===================================================== -->
            <!-- MODULES -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-switch fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Modules
                            </span>
                        </div>
                    </div>

                    @can('assets.view')
                        <div class="menu-item">
                            <a class="menu-link" href="/asset">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>

                                <span class="menu-title">
                                    Assets
                                </span>
                            </a>
                        </div>
                    @endcan

                    @can('calix.view')
                        <div class="menu-item">
                            <a class="menu-link" href="/calix">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>

                                <span class="menu-title">
                                    Calix
                                </span>
                            </a>
                        </div>
                    @endcan

                    @can('starlink.view')
                        <div class="menu-item">
                            <a class="menu-link" href="/starlink">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>

                                <span class="menu-title">
                                    Starlink
                                </span>
                            </a>
                        </div>
                    @endcan

                    <div class="menu-item">
                        <a class="menu-link" href="/billing">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                Billing
                            </span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- ===================================================== -->
            <!-- PRODUCTS -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-handcart fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Products & Services
                            </span>
                        </div>
                    </div>

                    <div class="menu-item">
                        <a class="menu-link" href="/product/list">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>

                            <span class="menu-title">
                                List
                            </span>
                        </a>
                    </div>

                </div>
            </div>

            <!-- ===================================================== -->
            <!-- SETTINGS STANDALONE ITEMS -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-setting-4 fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Settings
                            </span>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('admin.view-role-perm') }}">
                            <span class="menu-icon">
                                <i class="las la-key fs-2"></i>
                            </span>

                            <span class="menu-title">
                                Roles & Permissions
                            </span>
                        </a>
                    </div>

                    <!-- Users -->
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('user.view') }}">
                            <span class="menu-icon">
                                <i class="las la-user fs-2"></i>
                            </span>

                            <span class="menu-title">
                                System Users
                            </span>
                        </a>
                    </div>

                    <!-- Radius -->
                    @can('radius.view')
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route('radius.view') }}">
                                <span class="menu-icon">
                                    <i class="las la-fingerprint fs-2"></i>
                                </span>

                                <span class="menu-title">
                                    Radius Management
                                </span>
                            </a>
                        </div>
                    @endcan

                    <!-- Documentation -->
                    <div class="menu-item">
                        <a class="menu-link" href="#" target="_blank" title="Coming Soon"
                            data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                            data-bs-placement="right">

                            <span class="menu-icon">
                                <i class="las la-book fs-2"></i>
                            </span>

                            <span class="menu-title">
                                Documentation
                            </span>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        <!--end::Menu-->
    </div>
    <!--end::Primary menu-->
    <!--begin::Footer-->
    <div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">

        <!--begin::Theme toggle-->
        <a href="#" class="btn btn-icon btn-active-color-primary"
            data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end">

            <i class="ki-outline ki-night-day theme-light-show fs-2x"></i>
            <i class="ki-outline ki-moon theme-dark-show fs-2x"></i>
        </a>
        <!--end::Theme toggle-->

        <!--begin::Theme menu-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
            data-kt-menu="true" data-kt-element="theme-mode-menu">

            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="light">

                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-night-day fs-2"></i>
                    </span>

                    <span class="menu-title">
                        Light
                    </span>
                </a>
            </div>

            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="dark">

                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-moon fs-2"></i>
                    </span>

                    <span class="menu-title">
                        Dark
                    </span>
                </a>
            </div>

            <div class="menu-item px-3 my-0">
                <a href="#" class="menu-link px-3 py-2" data-kt-element="mode" data-kt-value="system">

                    <span class="menu-icon" data-kt-element="icon">
                        <i class="ki-outline ki-screen fs-2"></i>
                    </span>

                    <span class="menu-title">
                        System
                    </span>
                </a>
            </div>

        </div>
        <!--end::Theme menu-->

    </div>
    <!--end::Footer-->
</div>
<!--end::Sidebar-->
