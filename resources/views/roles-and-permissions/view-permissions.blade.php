@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">

            <!--begin::Notice-->
            <div
                class="notice d-flex bg-light-primary rounded border-primary border border-dashed min-w-lg-600px flex-shrink-0 p-6">

                <!--begin::Icon-->
                <i class="ki-outline ki-shield-tick fs-2tx text-primary me-4"></i>
                <!--end::Icon-->

                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1 flex-wrap flex-md-nowrap">

                    <!--begin::Content-->
                    <div class="mb-3 mb-md-0 fw-semibold">

                        <h4 class="text-gray-900 fw-bold">
                            Permissions Management
                        </h4>

                        <div class="fs-6 text-gray-700 pe-7">
                            Permissions control access to sensitive areas of the system.
                            Ensure proper access is assigned to maintain security and integrity.
                        </div>

                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Wrapper-->

            </div>
            <!--end::Notice-->

            <!--begin::Card-->
            <div class="card mt-10">

                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">

                    <!--begin::Card title-->
                    <div class="card-title">

                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">

                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>

                            <input type="text" data-kt-permission-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Search permissions..." />

                        </div>
                        <!--end::Search-->

                    </div>
                    <!--end::Card title-->

                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body py-4">

                    <!--begin::Table-->
                    <div class="table-responsive">

                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="all_permissions_dt">

                            <!--begin::Table head-->
                            <thead>

                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                    <th class="text-start">ID</th>

                                    <th>Permission</th>

                                    <th>Module</th>

                                    <th>Action</th>

                                    <th>Guard</th>

                                    <th>Created</th>

                                    <th class="text-end min-w-100px">
                                        Actions
                                    </th>

                                </tr>

                            </thead>
                            <!--end::Table head-->

                            <!--begin::Table body-->
                            <tbody class="text-gray-600 fw-semibold">

                                @foreach ($permissions as $perm)
                                    <tr id="row-{{ $perm['id'] }}">

                                        <!--begin::ID-->
                                        <td class="text-start">
                                            {{ $perm['id'] }}
                                        </td>
                                        <!--end::ID-->

                                        <!--begin::Permission-->
                                        <td>
                                            <div class="d-flex flex-column">

                                                <span class="text-gray-800 fw-bold mb-1">
                                                    {{ $perm['name'] }}
                                                </span>

                                                @if (!empty($perm['description']))
                                                    <span class="text-muted fs-7">
                                                        {{ $perm['description'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        <!--end::Permission-->

                                        <!--begin::Module-->
                                        <td>

                                            <span class="badge badge-light-primary fw-bold">
                                                {{ ucfirst($perm['model']) }}
                                            </span>

                                        </td>
                                        <!--end::Module-->

                                        <!--begin::Action-->
                                        <td>

                                            <div class="d-flex align-items-center">

                                                <div class="bullet bullet-dot bg-success me-3"></div>

                                                <span class="fw-semibold text-gray-700">
                                                    {{ ucfirst($perm['action']) }}
                                                </span>

                                            </div>

                                        </td>
                                        <!--end::Action-->

                                        <!--begin::Guard-->
                                        <td>

                                            <span class="badge badge-light-dark">
                                                {{ $perm['guard_name'] }}
                                            </span>

                                        </td>
                                        <!--end::Guard-->

                                        <!--begin::Created-->
                                        <td>

                                            <div class="d-flex align-items-center">

                                                <i class="ki-outline ki-calendar fs-5 me-2 text-gray-500"></i>

                                                {{ \Carbon\Carbon::parse($perm['created_at'])->format('d M Y') }}

                                            </div>

                                        </td>
                                        <!--end::Created-->

                                        <!--begin::Actions-->
                                        <td class="text-end">

                                            <button type="button"
                                                class="btn btn-icon btn-light-primary btn-sm edit-permission"
                                                data-id="{{ $perm['id'] }}" data-name="{{ $perm['name'] }}"
                                                data-description="{{ $perm['description'] }}" title="Edit Permission">

                                                <i class="ki-outline ki-pencil fs-4"></i>

                                            </button>

                                        </td>
                                        <!--end::Actions-->

                                    </tr>
                                @endforeach

                            </tbody>
                            <!--end::Table body-->

                        </table>

                    </div>
                    <!--end::Table-->

                </div>
                <!--end::Card body-->

            </div>
            <!--end::Card-->

        </div>

    </div>
    <!-- Begin Includes -->
    @include('roles-and-permissions.modals.edit-permission')
    <!-- End Includes -->
@endsection

@push('scripts')
    <script>
        let table = $('#all_permissions_dt').DataTable({
            pageLength: 10,
            order: [
                [0, 'desc']
            ],
            responsive: {
                details: false
            }
        });
        // External search
        $('[data-kt-permission-table-filter="search"]').on('keyup', function() {
            table.search(this.value).draw();
        });
    </script>

    <script>
        // Open modal
        $(document).on('click', '.edit-permission', function() {

            $('#edit_permission_id').val($(this).data('id'));

            $('#edit_permission_name').val($(this).data('name'));

            $('#edit_permission_description').val($(this).data('description'));

            $('#kt_modal_edit_permission').modal('show');

        });



        // Submit update
        $('#edit_permission_form').submit(function(e) {

            e.preventDefault();

            let permissionId = $('#edit_permission_id').val();
            let form = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "This permission will be updated.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: `/permission/${permissionId}/update`,
                        type: "POST",
                        data: form.serialize(),

                        beforeSend: function() {
                            Swal.fire({
                                title: 'Updating...',
                                text: 'Please wait',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },

                        success: function(response) {

                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: response.message,
                                timer: 1500,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                location.reload();
                            }, 1500);

                        },

                        error: function(xhr) {

                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: xhr.responseJSON?.message ||
                                    'Something went wrong.'
                            });

                        }

                    });

                }

            });

        });
    </script>
@endpush
