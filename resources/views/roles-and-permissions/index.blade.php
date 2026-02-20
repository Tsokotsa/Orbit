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
                            <button class="btn btn-primary ps-7" data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                data-kt-menu-placement="bottom-end">Actions
                                <i class="ki-outline ki-down fs-2 me-0"></i></button>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Role</div>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link px-5" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_add_role">Add Role</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-5">
                                    <a href="#" class="menu-link flex-stack px-5">Refresh Roles
                                        <span class="ms-2" data-bs-toggle="tooltip" aria-label="Comming Soon"
                                            data-bs-original-title="Comming soon" data-kt-initialized="1">
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

                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    <!--begin::Card-->
                                    <div class="card card-flush h-md-100">

                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{ $role->name }}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->

                                        <!--begin::Card body-->
                                        <div class="card-body pt-1">

                                            <!--begin::Users-->
                                            <div class="fw-bold text-gray-600 mb-5">
                                                Total users with this role: {{ $role->users_count }}
                                            </div>
                                            <!--end::Users-->

                                            <!--begin::Permissions-->
                                            <div class="d-flex flex-column text-gray-600">

                                                @php
                                                    $maxVisible = 5;
                                                    $totalPermissions = $role->permissions->count();
                                                @endphp

                                                @foreach ($role->permissions->take($maxVisible) as $permission)
                                                    <div class="d-flex align-items-center py-2">
                                                        <span class="bullet bg-primary me-3"></span>
                                                        {{ ucfirst($permission->name) }}
                                                    </div>
                                                @endforeach

                                                @if ($totalPermissions > $maxVisible)
                                                    <div class="d-flex align-items-center py-2">
                                                        <span class="bullet bg-primary me-3"></span>
                                                        <em>and {{ $totalPermissions - $maxVisible }} more...</em>
                                                    </div>
                                                @endif

                                                @if ($totalPermissions === 0)
                                                    <div class="d-flex align-items-center py-2 text-muted">
                                                        No permissions assigned
                                                    </div>
                                                @endif

                                            </div>
                                            <!--end::Permissions-->

                                        </div>
                                        <!--end::Card body-->

                                        <!--begin::Card footer-->
                                        <div class="card-footer flex-wrap pt-0">

                                            <a href="#" class="btn btn-light btn-active-primary my-1 me-2">
                                                View Role
                                            </a>

                                            @can('edit roles')
                                                <a href="#" class="btn btn-light btn-active-light-primary my-1">
                                                    Edit Role
                                                </a>
                                            @endcan

                                        </div>
                                        <!--end::Card footer-->

                                    </div>
                                    <!--end::Card-->
                                </div>
                            @endforeach


                            <!--end::Col-->
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
