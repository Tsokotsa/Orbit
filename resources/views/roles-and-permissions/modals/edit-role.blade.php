<div class="modal fade" id="modal_edit_role" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h2 class="fw-bold">Edit a role</h2>

                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <!-- Body -->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                <form id="modal_edit_role_form" class="form">
                    <input type="hidden" id="edit_role_id" name="edit_role_id">
                    @csrf

                    <!-- Role Name -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Role Name</span>
                        </label>

                        <input class="form-control form-control-solid" placeholder="Enter a role name"
                            name="edit_role_name" id="edit_role_name">
                    </div>

                    <!-- Description -->
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description</span>
                        </label>

                        <input class="form-control form-control-solid" placeholder="Enter role description"
                            name="edit_role_description" id="edit_role_description">
                    </div>

                    <!-- Status -->
                    <div class="fv-row mb-7">
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="edit_role_status" checked>
                            <label class="form-check-label">
                                Role status
                            </label>
                        </div>
                    </div>

                    <!-- Info -->
                    <div class="text-gray-600 mb-5">
                        Role set as a <strong>Super Admin role</strong> will be locked and not editable.
                    </div>

                    <!-- Actions -->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">
                            Discard
                        </button>

                        <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
    <script>
        "use strict";

        var KTUsersEditRole = function() {

            let validator = null;
            let modal = null;
            let form = null;
            let submitButton = null;

            const init = () => {

                const element = document.getElementById('modal_edit_role');
                form = document.getElementById('modal_edit_role_form');
                modal = new bootstrap.Modal(element);
                submitButton = element.querySelector('[data-kt-permissions-modal-action="submit"]');

                // Prevent duplicate initialization
                if (validator) {
                    validator.destroy();
                    validator = null;
                }

                // Validation
                validator = FormValidation.formValidation(form, {
                    fields: {
                        edit_role_name: {
                            validators: {
                                notEmpty: {
                                    message: 'Role name is required'
                                }
                            }
                        },
                        edit_role_description: {
                            validators: {
                                notEmpty: {
                                    message: 'Role description is required'
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row'
                        })
                    }
                });

                // Submit
                submitButton.onclick = function(e) {
                    e.preventDefault();

                    validator.validate().then(function(status) {

                        if (status === 'Valid') {

                            // ✅ CONFIRMATION BEFORE SUBMIT
                            Swal.fire({
                                text: "Are you sure you want to save this role?",
                                icon: "question",
                                showCancelButton: true,
                                confirmButtonText: "Yes, save it",
                                cancelButtonText: "Cancel",
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                    cancelButton: "btn btn-light"
                                }
                            }).then(function(result) {

                                if (!result.isConfirmed) {
                                    return;
                                }

                                // show loading
                                submitButton.setAttribute('data-kt-indicator', 'on');
                                submitButton.disabled = true;

                                $.ajax({
                                    type: "POST",
                                    url: "admin/roles/store",
                                    data: $('#modal_edit_role_form').serialize(),

                                    success: function(response) {

                                        Swal.fire({
                                            title: "Success",
                                            text: response.message,
                                            icon: "success",
                                            timer: 1500,
                                            showConfirmButton: false
                                        });

                                        submitButton.removeAttribute(
                                            'data-kt-indicator');
                                        submitButton.disabled = false;

                                        form.reset();
                                        modal.hide();
                                    },

                                    error: function(xhr) {

                                        const res = JSON.parse(xhr.responseText);

                                        Swal.fire({
                                            title: "Error",
                                            text: res.message,
                                            icon: "error"
                                        });

                                        submitButton.removeAttribute(
                                            'data-kt-indicator');
                                        submitButton.disabled = false;
                                    }
                                });
                            });

                        } else {

                            Swal.fire({
                                text: "Please fix validation errors",
                                icon: "error",
                                confirmButtonText: "OK"
                            });
                        }
                    });
                };
                // Close modal (reset validation)
                element.querySelector('[data-kt-permissions-modal-action="close"]')
                    .addEventListener('click', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            text: "Close this form?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Yes",
                            cancelButtonText: "No"
                        }).then(result => {
                            if (result.isConfirmed) {
                                form.reset();
                                validator.resetForm(true);
                                modal.hide();
                            }
                        });
                    });

                // Cancel button
                element.querySelector('[data-kt-permissions-modal-action="cancel"]')
                    .addEventListener('click', function(e) {
                        e.preventDefault();

                        Swal.fire({
                            text: "Cancel changes?",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonText: "Yes",
                            cancelButtonText: "No"
                        }).then(result => {
                            if (result.isConfirmed) {
                                form.reset();
                                validator.resetForm(true);
                                modal.hide();
                            }
                        });
                    });

            };

            return {
                init: init
            };
        }();

        KTUtil.onDOMContentLoaded(function() {
            KTUsersEditRole.init();
        });
    </script>
@endpush
