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
                        @can('roles.edit')
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

                                        <a href="javascript:void(0);" onclick="resetPermissionCache()"
                                            class="menu-link flex-stack px-5">
                                            Refresh Cache
                                            <span class="ms-2" data-bs-toggle="tooltip" title="Reset permission cache">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </a>

                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Permissions</div>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="#" class="menu-link px-5" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_permission">Add Permission</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5 my-1">
                                        <a href="{{ route('admin.permissions-list') }}" class="menu-link px-5">List
                                            Permissions</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu-->
                                <!--end::Menu-->
                            </div>
                        @endcan
                        <!--begin::Row-->
                        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 g-5 g-xl-9">
                            <!--begin::Col-->

                            @foreach ($roles as $role)
                                <div class="col-md-4">
                                    <div class="card card-flush h-md-100 shadow-sm hover-elevate-up border">

                                        <!-- Header -->
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <div class="d-flex align-items-center">
                                                <span class="symbol symbol-40px me-3">
                                                    <span class="symbol-label bg-light-success">
                                                        <i class="ki-outline ki-shield-tick fs-2 text-success"></i>
                                                    </span>
                                                </span>

                                                <div>
                                                    <h5 class="mb-0 fw-bold">{{ $role->name }}</h5>
                                                    <span class="text-muted fs-7">Role</span>
                                                </div>
                                            </div>

                                            <span class="badge badge-light-success">
                                                {{ $role->users_count }} Users
                                            </span>
                                        </div>

                                        <!-- Subtle divider instead of border -->
                                        <div class="separator separator-dashed"></div>

                                        <!-- Body -->
                                        <div class="card-body pt-4">

                                            <div class="fw-bold mb-3 d-flex align-items-center">
                                                <i class="ki-outline ki-key fs-4 me-2 text-gray-500"></i>
                                                Permissions
                                            </div>

                                            <div class="d-flex flex-wrap gap-2">

                                                @php
                                                    $maxVisible = 5;
                                                    $totalPermissions = $role->permissions->count();
                                                @endphp

                                                @foreach ($role->permissions->take($maxVisible) as $permission)
                                                    <span class="badge badge-light-dark">
                                                        {{ ucfirst($permission->name) }}
                                                    </span>
                                                @endforeach

                                                @if ($totalPermissions > $maxVisible)
                                                    <span class="badge badge-light-dark">
                                                        +{{ $totalPermissions - $maxVisible }}
                                                    </span>
                                                @endif

                                                @if ($totalPermissions === 0)
                                                    <span class="text-muted">No permissions assigned</span>
                                                @endif

                                            </div>
                                        </div>

                                        <!-- Footer -->
                                        <div class="card-footer d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                @can('edit.roles')
                                                    <a href="{{ route('role.view', $role->id) }}"
                                                        class="btn btn-sm btn-light-dark">
                                                        <i class="ki-outline ki-eye fs-3 me-1"></i>
                                                        View
                                                    </a>

                                                    <button type="button" class="btn btn-sm btn-light-dark"
                                                        data-bs-toggle="modal" data-bs-target="#modal_edit_role"
                                                        data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}"
                                                        data-role-desc="{{ $role->description }}">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </button>
                                                @endcan
                                            </div>

                                        </div>

                                    </div>
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
    @include('roles-and-permissions.modals.edit-role')
    @include('roles-and-permissions.modals.add-permission')
@endsection

@push('scripts')
    <script>
        function resetPermissionCache() {

            Swal.fire({
                title: 'Are you sure?',
                text: "This will reset permission cache",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reset it!'
            }).then((result) => {

                if (result.isConfirmed) {

                    fetch('/admin/permissions/cache-reset', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire(
                                'Success',
                                data.message,
                                'success'
                            );
                        })
                        .catch(() => {
                            Swal.fire(
                                'Error',
                                'Something went wrong',
                                'error'
                            );
                        });

                }
            });
        }


        // Fill The Modal to Edit The Role

        document.addEventListener('DOMContentLoaded', function() {

            const modal = document.getElementById('modal_edit_role');

            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                const roleId = button.getAttribute('data-role-id');
                const roleName = button.getAttribute('data-role-name');
                const roleDescription = button.getAttribute('data-role-desc');

                document.getElementById('edit_role_id').value = roleId;
                document.getElementById('edit_role_name').value = roleName;
                document.getElementById('edit_role_description').value = roleDescription;
            });

        });

        // End of The code to edit the Role
    </script>
@endpush
