<div class="modal fade" id="linkPermissionsModal" tabindex="-1">
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
        let selectedPermissions = new Set();
        let currentRoleId = null;

        /* =========================
           OPEN MODAL + LOAD TABLE
        ========================= */
        $('#linkPermissionsModal').on('show.bs.modal', function(event) {

            selectedPermissions = new Set();

            currentRoleId = $(event.relatedTarget).data('role-id');

            if ($.fn.DataTable.isDataTable('#permissions_modal_dt')) {
                $('#permissions_modal_dt').DataTable().destroy();
            }

            modalTable = $('#permissions_modal_dt').DataTable({
                // dom: 't',
                ajax: {
                    url: `admin/roles/${currentRoleId}/available-permissions`,
                    dataSrc: 'data'
                },
                processing: true,
                pageLength: 5, // ✅ start with 5 rows

                lengthMenu: [5, 10, 25, 50], // optional but recommended
                order: [
                    [1, 'asc']
                ],
                columns: [

                    /* CHECKBOX */
                    {
                        data: 'id',
                        className: "text-start",
                        render: function(data) {
                            return `
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input perm-check" type="checkbox" value="${data}">
                        </div>
                    `;
                        }
                    },

                    /* PERMISSION */
                    {
                        data: 'name',
                        render: function(data) {
                            return `
                        <div class="d-flex align-items-center">
                            <i class="ki-outline ki-key fs-2 text-primary me-3"></i>
                            <span class="fw-semibold text-gray-800">${data}</span>
                        </div>
                    `;
                        }
                    },

                    /* MODEL */
                    {
                        data: 'model',
                        render: function(data) {
                            return `<span class="badge badge-light-primary">${data}</span>`;
                        }
                    },

                    /* ACTION */
                    {
                        data: 'action',
                        render: function(data) {

                            let color = 'secondary';

                            if (data === 'create') color = 'success';
                            if (data === 'update') color = 'warning';
                            if (data === 'delete') color = 'danger';
                            if (data === 'view') color = 'info';

                            return `
                        <span class="badge badge-light-${color}">
                            <i class="ki-outline ki-bolt fs-7 me-1"></i>
                            ${data}
                        </span>
                    `;
                        }
                    }
                ]
            });
        });

        // BEGIN Search
        $('#permission_search').on('keyup', function() {
            modalTable.search(this.value).draw();
        });

        // END Search


        /* =========================
           CHECKBOX SELECTION
        ========================= */
        $(document).on('change', '.perm-check', function() {

            let id = $(this).val();

            if ($(this).is(':checked')) {
                selectedPermissions.add(id);
            } else {
                selectedPermissions.delete(id);
            }
        });


        /* =========================
           ASSIGN PERMISSIONS
        ========================= */
        $('#assignPermissionsBtn').click(function() {

            if (selectedPermissions.size === 0) {

                Swal.fire({
                    icon: 'warning',
                    title: 'No permissions selected',
                    text: 'Please select at least one permission.'
                });

                return;
            }

            Swal.fire({
                title: 'Confirm Action',
                text: `Assign ${selectedPermissions.size} permission(s) to this role?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Assign',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#50cd89',
                cancelButtonColor: '#d33'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({
                    url: "{{ route('admin.permissions-assign') }}",
                    type: "POST",
                    data: {
                        role_id: currentRoleId,
                        permissions: Array.from(selectedPermissions),
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Permissions assigned successfully',
                            timer: 1500,
                            showConfirmButton: false
                        });

                        $('#linkPermissionsModal').modal('hide');

                        location.reload();
                    },
                    error: function() {

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Something went wrong'
                        });

                    }
                });

            });

        });
    </script>
@endpush
