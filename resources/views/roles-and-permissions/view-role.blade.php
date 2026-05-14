<style>
    .unlink-btn:hover {
        opacity: 0.7;
        transform: scale(1.1);
        transition: 0.2s ease;
    }
</style>
@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div id="kt_app_content_container" class="app-container container-fluid">

                <div
                    class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-devices-2 fs-2tx text-primary me-4"></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                        <!--begin::Content-->
                        <div class="mb-3 mb-md-0 fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Roles and Permissions are sensitive!</h4>
                            <div class="fs-6 text-gray-700 pe-7">Make sure you dont assign <b>wrong</b> permissions to users
                                that
                                might compromise your data integrity!</div>
                        </div>
                        <!--end::Content-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!-- Begin Table -->
                <div class="card mt-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                <input type="text" data-kt-client-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Search permissions...">
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--begin::Card title-->
                        <div class="card-toolbar">
                            <button class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#linkPermissionsModal" data-role-id="{{ $role->id }}">
                                <i class="ki-outline ki-plus fs-2"></i>
                                Link Permissions | {{ $role->name }}
                            </button>
                        </div>

                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body py-4">
                        <!--begin::Table-->
                        <div class="table-responsive">
                            <table class="table align-middle table-row-dashed gy-4 fs-6" id="permissions_dt">
                                <thead>
                                    <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                        <th class="text-start">ID #</th>
                                        <th>Permission</th>
                                        <th>Model</th>
                                        <th>Action</th>
                                        <th>Guard</th>
                                        <th>Created</th>
                                        <th class="text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $perm)
                                        <tr id="row-{{ $perm['id'] }}">

                                            <td class="text-start">{{ $perm['id'] }}</td>

                                            <!-- Permission -->
                                            <td>
                                                <span class="fw-semibold text-gray-800">
                                                    {{ ucfirst($perm['name']) }}
                                                </span>
                                            </td>

                                            <!-- Model -->
                                            <td>
                                                <span class="badge badge-light-primary">
                                                    {{ ucfirst($perm['model']) }}
                                                </span>
                                            </td>

                                            <!-- Action -->
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div style="width:4px; height:20px; background-color:#50cd89; border-radius:2px;"
                                                        class="me-3"></div>
                                                    <span class="text-gray-700 fw-semibold">
                                                        {{ ucfirst($perm['action']) }}
                                                    </span>
                                                </div>
                                            </td>

                                            <!-- Guard -->
                                            <td>
                                                <span class="badge badge-light-dark">
                                                    {{ $perm['guard_name'] }}
                                                </span>
                                            </td>

                                            <!-- Created -->
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <i class="ki-outline ki-calendar fs-4 me-2 text-gray-500"></i>
                                                    {{ \Carbon\Carbon::parse($perm['created_at'])->format('d M Y') }}
                                                </div>
                                            </td>

                                            <!-- Actions -->
                                            <td class="text-end">
                                                <i class="ki-outline ki-fasten fs-2 text-danger cursor-pointer unlink-btn"
                                                    data-id="{{ $perm['id'] }}" title="Unlink permission"></i>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!-- End Table -->

            </div>
        </div>

    </div>

    <!-- Included Modals -->
    @include('roles-and-permissions.modals.link-permission')
    <!-- End Of Included Modals -->
@endsection

@push('scripts')
    <script>
        let table = $('#permissions_dt').DataTable({
            pageLength: 10,
            order: [
                [0, 'desc']
            ],
            responsive: {
                details: false
            }
        });

        // Search input
        $('[data-kt-client-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });
    </script>

    <script>
        $(document).on('click', '.unlink-btn', function() {
            let permissionId = $(this).data('id');
            let row = $('#row-' + permissionId);

            Swal.fire({
                title: 'Are you sure?',
                text: "This permission will be removed from the role.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Yes, unlink it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ route('admin.permission-unlink') }}",
                        type: "POST",
                        data: {
                            permission_id: permissionId,
                            role_id: "{{ $role->id }}",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Unlinked!',
                                text: 'Permission removed successfully.',
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Remove row smoothly
                            table.row(row).remove().draw();

                        },
                        error: function() {
                            Swal.fire('Error', 'Something went wrong.', 'error');
                        }
                    });

                }
            });
        });
    </script>
@endpush
