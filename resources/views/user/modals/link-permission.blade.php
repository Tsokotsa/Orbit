<div class="modal fade" id="linkUserPermissionsModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            {{-- HEADER --}}
            <div class="modal-header">
                <h3 class="modal-title">
                    <i class="ki-outline ki-shield-tick fs-2 text-primary me-2"></i>
                    Assign Permissions
                </h3>

                <button type="button" class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </button>
            </div>

            {{-- BODY --}}
            <div class="modal-body">
                <div class="d-flex align-items-center position-relative mb-5">
                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5 text-gray-500"></i>
                    <input type="text" id="permission_search" class="form-control form-control-solid ps-13"
                        placeholder="Search permissions...">
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed gy-5 fs-6" id="permissions_modal_dt">

                        <thead class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                            <tr>
                                <th class="text-start">#</th>
                                <th>Permission</th>
                                <th>Model</th>
                                <th>Action</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>

                        <tbody></tbody>

                    </table>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer">
                <button class="btn btn-light" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button class="btn btn-primary" id="assignPermissionsBtn">
                    <i class="ki-outline ki-check-circle fs-2 me-2"></i>
                    Assign Selected
                </button>
            </div>

        </div>
    </div>
</div>

{{-- ========================= --}}
{{-- SCRIPTS --}}
{{-- ========================= --}}
@push('scripts')
    <script>
        let modalTable;
        let currentUserId = null;

        /*
        |--------------------------------------------------------------------------
        | OPEN MODAL
        |--------------------------------------------------------------------------
        */
        $('#linkUserPermissionsModal').on('show.bs.modal', function(event) {

            currentUserId = $(event.relatedTarget).data('user-id');

            /*
            |--------------------------------------------------------------------------
            | DESTROY PREVIOUS DATATABLE
            |--------------------------------------------------------------------------
            */
            if ($.fn.DataTable.isDataTable('#permissions_modal_dt')) {
                $('#permissions_modal_dt').DataTable().destroy();
            }

            /*
            |--------------------------------------------------------------------------
            | LOAD DATATABLE
            |--------------------------------------------------------------------------
            */
            modalTable = $('#permissions_modal_dt').DataTable({

                processing: true,
                pageLength: 10,
                order: [
                    [1, 'asc']
                ],

                ajax: {
                    url: `/admin/users/${currentUserId}/permissions`,
                    dataSrc: 'data'
                },

                columns: [

                    /*
                    |--------------------------------------------------------------------------
                    | ID
                    |--------------------------------------------------------------------------
                    */
                    {
                        data: 'id',
                        className: 'text-start'
                    },

                    /*
                    |--------------------------------------------------------------------------
                    | PERMISSION NAME
                    |--------------------------------------------------------------------------
                    */
                    {
                        data: 'name',

                        render: function(data) {

                            return `
                            <div class="d-flex align-items-center">

                                <i class="ki-outline ki-key fs-2 text-primary me-3"></i>

                                <span class="fw-semibold text-gray-800">
                                    ${data}
                                </span>

                            </div>
                        `;
                        }
                    },

                    /*
                    |--------------------------------------------------------------------------
                    | MODEL
                    |--------------------------------------------------------------------------
                    */
                    {
                        data: 'model',

                        render: function(data) {

                            return `
                            <span class="badge badge-light-primary">
                                ${data}
                            </span>
                        `;
                        }
                    },

                    /*
                    |--------------------------------------------------------------------------
                    | ACTION
                    |--------------------------------------------------------------------------
                    */
                    {
                        data: 'action',

                        render: function(data) {

                            let color = 'secondary';

                            if (data === 'create') color = 'success';
                            if (data === 'store') color = 'success';

                            if (data === 'edit') color = 'warning';
                            if (data === 'update') color = 'warning';

                            if (data === 'delete') color = 'danger';
                            if (data === 'destroy') color = 'danger';

                            if (data === 'view') color = 'info';
                            if (data === 'index') color = 'info';

                            return `
                            <span class="badge badge-light-${color}">
                                ${data}
                            </span>
                        `;
                        }
                    },

                    /*
                    |--------------------------------------------------------------------------
                    | STATUS BUTTON
                    |--------------------------------------------------------------------------
                    */
                    {
                        data: null,
                        className: 'text-end',
                        orderable: false,
                        searchable: false,

                        render: function(data) {

                            /*
                            |--------------------------------------------------------------------------
                            | ASSIGNED
                            |--------------------------------------------------------------------------
                            */
                            if (data.assigned) {

                                return `
                                <button
                                    class="btn btn-sm btn-light-danger unlink-permission"
                                    data-id="${data.id}">

                                    <i class="ki-outline ki-trash fs-5 me-1"></i>

                                    Unlink
                                </button>
                            `;
                            }

                            /*
                            |--------------------------------------------------------------------------
                            | NOT ASSIGNED
                            |--------------------------------------------------------------------------
                            */
                            return `
                            <button
                                class="btn btn-sm btn-light-success link-permission"
                                data-id="${data.id}">

                                <i class="ki-outline ki-plus fs-5 me-1"></i>

                                Link
                            </button>
                        `;
                        }
                    }
                ]
            });
        });

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */
        $('#permission_search').on('keyup', function() {

            modalTable.search(this.value).draw();

        });

        /*
        |--------------------------------------------------------------------------
        | LINK PERMISSION
        |--------------------------------------------------------------------------
        */
        $(document).on('click', '.link-permission', function() {

            let permissionId = $(this).data('id');

            $.ajax({

                url: `/admin/users/${currentUserId}/permissions/assign`,
                type: 'POST',

                data: {
                    permission_id: permissionId,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1200,
                        showConfirmButton: false
                    });

                    modalTable.ajax.reload(null, false);
                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to assign permission'
                    });
                }
            });
        });

        /*
        |--------------------------------------------------------------------------
        | UNLINK PERMISSION
        |--------------------------------------------------------------------------
        */
        $(document).on('click', '.unlink-permission', function() {

            let permissionId = $(this).data('id');

            $.ajax({

                url: `/admin/users/${currentUserId}/permissions/remove`,
                type: 'DELETE',

                data: {
                    permission_id: permissionId,
                    _token: "{{ csrf_token() }}"
                },

                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message,
                        timer: 1200,
                        showConfirmButton: false
                    });

                    modalTable.ajax.reload(null, false);
                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to remove permission'
                    });
                }
            });
        });
    </script>
@endpush
