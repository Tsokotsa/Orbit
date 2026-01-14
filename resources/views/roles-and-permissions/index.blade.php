@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <div class="row g-7" data-select2-id="select2-data-111-xkf7">
                    <!--begin::Content-->
                    <!--begin::Content container-->
                    <div id="kt_app_content_container" class="app-container container-fluid text-end">
                        <div class="nav-item ms-auto m-4">
                            <!--begin::Action menu-->
                            <button class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions 
                            <i class="ki-outline ki-down fs-2 me-0"></i></button>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6" data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Role</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5"  data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">Add Role</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link flex-stack px-5">Refresh Roles
                                    <span class="ms-2" data-bs-toggle="tooltip" aria-label="Comming Soon" data-bs-original-title="Comming soon" data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span></a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Permissions</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5">Add Permission</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5 my-1">
                                    <a href="#" class="menu-link px-5">Comming Soon</a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                            <!--end::Menu-->
                        </div>
                        <!--begin::Row-->
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Administrator</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: 5</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>All Admin Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Financial
                                                Summaries
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>Enabled Bulk Reports
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Payouts
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Disputes
                                            </div>
                                            <div class='d-flex align-items-center py-2'>
                                                <span class='bullet bg-primary me-3'></span>
                                                <em>and 7 more...</em>
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="apps/user-management/roles/view.html"
                                            class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                        <button type="button" class="btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Developer</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: 14</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>Some Admin Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Financial Summaries only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit API Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Payouts only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Disputes
                                            </div>
                                            <div class='d-flex align-items-center py-2'>
                                                <span class='bullet bg-primary me-3'></span>
                                                <em>and 3 more...</em>
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="apps/user-management/roles/view.html"
                                            class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                        <button type="button" class="btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Analyst</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: 4</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>No Admin Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Financial
                                                Summaries
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>Enabled Bulk Reports
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Payouts only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Disputes only
                                            </div>
                                            <div class='d-flex align-items-center py-2'>
                                                <span class='bullet bg-primary me-3'></span>
                                                <em>and 2 more...</em>
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="apps/user-management/roles/view.html"
                                            class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                        <button type="button" class="btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit Role</button>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Support</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: 23</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>No Admin Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Financial Summaries only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Payouts only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View and Edit Disputes
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>Response to Customer Feedback
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="apps/user-management/roles/view.html"
                                            class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                        <button type="button" class="btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit
                                            Role</button>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-4">
                                <!--begin::Card-->
                                <div class="card card-flush h-md-100">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>Trial</h2>
                                        </div>
                                        <!--end::Card title-->
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-1">
                                        <!--begin::Users-->
                                        <div class="fw-bold text-gray-600 mb-5">Total users with this role: 546</div>
                                        <!--end::Users-->
                                        <!--begin::Permissions-->
                                        <div class="d-flex flex-column text-gray-600">
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>No Admin Controls
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Financial Summaries only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Bulk Reports only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Payouts only
                                            </div>
                                            <div class="d-flex align-items-center py-2">
                                                <span class="bullet bg-primary me-3"></span>View Disputes only
                                            </div>
                                        </div>
                                        <!--end::Permissions-->
                                    </div>
                                    <!--end::Card body-->
                                    <!--begin::Card footer-->
                                    <div class="card-footer flex-wrap pt-0">
                                        <a href="apps/user-management/roles/view.html"
                                            class="btn btn-light btn-active-primary my-1 me-2">View Role</a>
                                        <button type="button" class="btn btn-light btn-active-light-primary my-1"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_update_role">Edit
                                            Role</button>
                                    </div>
                                    <!--end::Card footer-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Add new card-->
                            <div class="ol-md-4">
                                <!--begin::Card-->
                                <div class="card h-md-100">
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-center">
                                        <!--begin::Button-->
                                        <button type="button" class="btn btn-clear d-flex flex-column flex-center"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_role">
                                            <!--begin::Illustration-->
                                            <img src="assets/media/illustrations/sketchy-1/4.png" alt=""
                                                class="mw-100 mh-150px mb-7" />
                                            <!--end::Illustration-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-3 text-gray-600 text-hover-primary">Add New Role</div>
                                            <!--end::Label-->
                                        </button>
                                        <!--begin::Button-->
                                    </div>
                                    <!--begin::Card body-->
                                </div>
                                <!--begin::Card-->
                            </div>
                            <!--begin::Add new card-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Content container-->
                    <!--end::Content-->
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    @include('roles-and-permissions.modals.add-role')
@endsection