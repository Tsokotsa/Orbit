<!--begin::Modal-->
<div class="modal fade" id="kt_modal_update_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded-4 shadow-sm">

            <!-- Header -->
            <div class="modal-header border-0 pt-7">

                <div>
                    <h2 class="fw-bold mb-1 d-flex align-items-center">
                        <i class="ki-outline ki-shield-tick fs-1 text-primary me-3"></i>
                        Update User Role
                    </h2>

                    <div class="text-muted fs-6">
                        Manage user access permissions
                    </div>
                </div>

                <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>

            </div>

            <!-- Body -->
            <div class="modal-body px-10 pb-10 pt-2">

                <!-- Loading State -->
                <div id="role_modal_loader" class="text-center py-20">

                    <div class="spinner-border text-primary mb-5" style="width: 3rem; height: 3rem;">
                    </div>

                    <div class="fw-semibold fs-4 text-gray-700">
                        Loading user information...
                    </div>

                </div>

                <!-- Actual Content -->
                <div id="role_modal_content" class="d-none">

                    <form id="kt_modal_update_role_form" method="POST" action="{{ route('users.update.role') }}">

                        @csrf

                        <input type="hidden" name="user_id" id="modal_user_id">

                        <!-- Warning -->
                        <div
                            class="notice d-flex bg-light-warning rounded-3 border-warning border border-dashed p-5 mb-8">

                            <i class="ki-outline ki-information-4 fs-2tx text-warning me-4"></i>

                            <div class="fw-semibold">

                                <h5 class="mb-1 text-gray-900">
                                    Role Permission Notice
                                </h5>

                                <div class="fs-7 text-gray-700">
                                    Changing user roles will automatically update
                                    permissions and system access.
                                </div>

                            </div>

                        </div>

                        <!-- User Info -->
                        <div class="card border border-gray-200 mb-8">

                            <div class="card-body d-flex align-items-center p-5">

                                <div class="symbol symbol-65px me-5">

                                    <div id="modal_user_initial"
                                        class="symbol-label fs-2 fw-bold bg-light-primary text-primary">
                                    </div>

                                </div>

                                <div class="flex-grow-1">

                                    <div id="modal_user_name" class="fw-bold fs-3 text-gray-900 mb-1">
                                    </div>

                                    <div id="modal_user_email" class="text-muted fs-6">
                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Roles -->
                        <div class="mb-10">

                            <label class="required fw-semibold fs-6 mb-3 d-block">
                                Assign Roles
                            </label>

                            <select name="roles[]" id="roles_select" class="form-select form-select-solid" multiple>
                            </select>

                            <div class="text-muted fs-7 mt-2">
                                Users can have multiple roles assigned.
                            </div>

                        </div>

                        <!-- Footer -->
                        <div class="d-flex justify-content-end">

                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                                Cancel
                            </button>

                            <button type="submit" class="btn btn-primary">

                                <span class="indicator-label">
                                    <i class="ki-outline ki-check fs-2"></i>
                                    Update Role
                                </span>

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>
<!--end::Modal-->

@push('scripts')
    <script>
        $(document).ready(function() {

            // Init Select2
            $('#roles_select').select2({
                dropdownParent: $('#kt_modal_update_role'),
                width: '100%',
                placeholder: 'Select roles'
            });




            // Open modal
            $('.btn-edit-role').on('click', function() {

                let userId = $(this).data('user-id');

                // Reset state
                $('#role_modal_loader').removeClass('d-none');
                $('#role_modal_content').addClass('d-none');

                // Open modal immediately
                $('#kt_modal_update_role').modal('show');

                // Fetch data
                $.ajax({
                    url: '/users/' + userId + '/roles',
                    type: 'GET',

                    success: function(response) {

                        let user = response.user;
                        let roles = response.roles;

                        // Fill user info
                        $('#modal_user_id').val(user.id);

                        $('#modal_user_name').text(user.name);

                        $('#modal_user_email').text(user.email);

                        $('#modal_user_initial')
                            .text(user.name.charAt(0).toUpperCase());

                        // Reset select
                        $('#roles_select').empty();

                        // Add roles
                        $.each(roles, function(index, role) {

                            let selected = user.roles.includes(role.name);

                            $('#roles_select').append(
                                new Option(
                                    role.name,
                                    role.name,
                                    selected,
                                    selected
                                )
                            );

                        });

                        // Refresh Select2
                        $('#roles_select').trigger('change');

                        // Hide loader
                        $('#role_modal_loader').addClass('d-none');

                        // Show content
                        $('#role_modal_content').removeClass('d-none');

                    },

                    error: function() {

                        $('#kt_modal_update_role').modal('hide');

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Unable to load user roles.'
                        });

                    }

                });

            });




            // Submit Confirmation
            $('#kt_modal_update_role_form').on('submit', function(e) {

                e.preventDefault();

                let form = this;

                Swal.fire({
                    title: 'Update User Role?',
                    text: 'User permissions will be updated.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#009ef7',
                    confirmButtonText: 'Yes, update',
                    cancelButtonText: 'Cancel'
                }).then((result) => {

                    if (result.isConfirmed) {

                        form.submit();

                    }

                });

            });

        });
    </script>
@endpush
