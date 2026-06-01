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
            <!-- OPERATIONS ITEMS -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <span class="menu-link menu-center">
                    <span class="menu-icon me-0">
                        <i class="las la-tools fs-1"></i>
                    </span>
                </span>

                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    <div class="menu-item">
                        <div class="menu-content">
                            <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                Operations
                            </span>
                        </div>
                    </div>

                    <!-- Roles -->
                    <div class="menu-item">
                        <a class="menu-link" href="{{ route('ops.callout-calculation') }}">
                            <span class="menu-icon">
                                <i class="las la-calculator fs-2"></i>
                            </span>

                            <span class="menu-title">
                                Callout Simulation
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

            <!-- ===================================================== -->
            <!-- DYNAMIC LINKS -->
            <!-- ===================================================== -->
            <div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start"
                class="menu-item py-2">

                <!-- Sidebar Icon -->
                <span class="menu-link menu-center">

                    <span class="menu-icon me-0">
                        <i class="ki-outline ki-disconnect fs-1"></i>
                    </span>

                </span>

                <!-- Dropdown -->
                <div class="menu-sub menu-sub-dropdown menu-sub-indention px-2 py-4 w-250px mh-75 overflow-auto">

                    @foreach ($systemLinks as $section => $links)
                        <!-- Section -->
                        <div class="menu-item">
                            <div class="menu-content">
                                <span class="menu-section fs-5 fw-bolder ps-1 py-1">
                                    {{ $section }}
                                </span>
                            </div>
                        </div>

                        <!-- Links -->
                        @foreach ($links as $link)
                            @if (!$link->permission || auth()->user()->can($link->permission))
                                <div class="menu-item">

                                    <a class="menu-link" href="{{ $link->url }}"
                                        target="{{ $link->open_in_new_tab ? '_blank' : '_self' }}">

                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>

                                        <span class="menu-title">
                                            {{ $link->name }}
                                        </span>

                                    </a>

                                </div>
                            @endif
                        @endforeach
                    @endforeach

                    <!-- Divider -->
                    <div class="separator my-3"></div>

                    <!-- Add Link -->
                    @can('system-links.create')
                        <div class="menu-item">

                            <a href="#" class="menu-link" data-bs-toggle="modal"
                                data-bs-target="#addSystemLinkModal">

                                <span class="menu-icon">
                                    <i class="ki-outline ki-plus fs-3"></i>
                                </span>

                                <span class="menu-title">
                                    Add Link
                                </span>

                            </a>

                        </div>
                    @endcan

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


<div class="modal fade" id="addSystemLinkModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered mw-750px">

        <div class="modal-content rounded-4 shadow-sm">

            <!--begin::Form-->
            <form method="POST" action="/link/store" id="systemLinkForm">

                @csrf

                <!--begin::Header-->
                <div class="modal-header border-0 pb-0">

                    <div>

                        <h1 class="fw-bold mb-1">
                            Add System Link
                        </h1>

                        <div class="text-muted fs-6">
                            Register a new internal or external system shortcut
                        </div>

                    </div>

                    <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">

                        <i class="ki-outline ki-cross fs-1"></i>

                    </div>

                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="modal-body py-10 px-lg-15">

                    <!--begin::Basic Information-->
                    <div class="mb-10">

                        <div class="d-flex align-items-center mb-5">

                            <i class="ki-outline ki-information-5 fs-2 text-primary me-2"></i>

                            <h3 class="fw-bold m-0">
                                Basic Information
                            </h3>

                        </div>

                        <div class="row g-5">

                            <!-- Section -->
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Section
                                </label>

                                <input type="text" name="section" class="form-control form-control-solid"
                                    placeholder="Monitoring" />

                                <div class="form-text">
                                    Group where the link will appear
                                </div>

                            </div>

                            <!-- Title -->
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Title
                                </label>

                                <input type="text" name="title" class="form-control form-control-solid"
                                    placeholder="Zabbix" />

                                <div class="form-text">
                                    Display name shown in menu
                                </div>

                            </div>

                        </div>

                    </div>
                    <!--end::Basic Information-->

                    <!--begin::Link Details-->
                    <div class="mb-10">

                        <div class="d-flex align-items-center mb-5">

                            <i class="ki-outline ki-link fs-2 text-primary me-2"></i>

                            <h3 class="fw-bold m-0">
                                Link Details
                            </h3>

                        </div>

                        <div class="row g-5">

                            <!-- URL -->
                            <div class="col-12">

                                <label class="required form-label fw-semibold">
                                    URL
                                </label>

                                <input type="text" name="url" class="form-control form-control-solid"
                                    placeholder="https://zabbix.company.com" />

                            </div>

                            <!-- Icon -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Icon
                                </label>

                                <input type="text" name="icon" class="form-control form-control-solid"
                                    placeholder="ki-monitor" />

                                <div class="form-text">
                                    KeenIcons / FontAwesome icon class
                                </div>

                            </div>

                            <!-- Sort Order -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Sort Order
                                </label>

                                <input type="number" name="sort_order" class="form-control form-control-solid"
                                    value="0" />

                            </div>

                        </div>

                    </div>
                    <!--end::Link Details-->

                    <!--begin::Access Control-->
                    <div class="mb-5">

                        <div class="d-flex align-items-center mb-5">

                            <i class="ki-outline ki-shield-tick fs-2 text-primary me-2"></i>

                            <h3 class="fw-bold m-0">
                                Access Control
                            </h3>

                        </div>

                        <div class="row g-5">

                            <!-- Permission -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Permission
                                </label>

                                <input type="text" name="permission" class="form-control form-control-solid"
                                    placeholder="monitoring.view" />

                                <div class="form-text">
                                    Leave empty for public visibility
                                </div>

                            </div>

                            <!-- Environment -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Environment
                                </label>

                                <select name="environment" class="form-select form-select-solid">

                                    <option value="production">
                                        Production
                                    </option>

                                    <option value="staging">
                                        Staging
                                    </option>

                                    <option value="development">
                                        Development
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>
                    <!--end::Access Control-->

                    <!--begin::Options-->
                    <div class="separator separator-dashed my-10"></div>

                    <div class="row g-5">

                        <!-- Open in New Tab -->
                        <div class="col-md-4">

                            <div class="form-check form-switch form-check-custom form-check-solid">

                                <input class="form-check-input" type="checkbox" name="new_tab" checked />

                                <label class="form-check-label fw-semibold ms-3">
                                    Open in New Tab
                                </label>

                            </div>

                        </div>

                        <!-- Active -->
                        <div class="col-md-4">

                            <div class="form-check form-switch form-check-custom form-check-solid">

                                <input class="form-check-input" type="checkbox" name="is_active" checked />

                                <label class="form-check-label fw-semibold ms-3">
                                    Active
                                </label>

                            </div>

                        </div>

                        <!-- Visible -->
                        <div class="col-md-4">

                            <div class="form-check form-switch form-check-custom form-check-solid">

                                <input class="form-check-input" type="checkbox" name="visible_in_sidebar" checked />

                                <label class="form-check-label fw-semibold ms-3">
                                    Visible in Sidebar
                                </label>

                            </div>

                        </div>

                    </div>
                    <!--end::Options-->

                </div>
                <!--end::Body-->

                <!--begin::Footer-->
                <div class="modal-footer border-0 pt-0">

                    <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" class="btn btn-primary">

                        <span class="indicator-label">
                            Save Link
                        </span>

                    </button>

                </div>
                <!--end::Footer-->

            </form>
            <!--end::Form-->

        </div>

    </div>

</div>
