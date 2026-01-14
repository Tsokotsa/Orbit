<div class="modal fade" id="kt_modal_add_role" tabindex="-1" style="display: none" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add a role</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_modal_add_role_form" class="form fv-plugins-bootstrap5 fv-plugins-framework">
                    @csrf
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Role Name</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="role names is required to be unique." data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter a role name" name="role_name">
                        <!--end::Input-->
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Description</span>
                            <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"
                                data-bs-content="role names is required to be unique." data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input class="form-control form-control-solid" placeholder="Enter role descriptio"
                            name="role_description">
                        <!--end::Input-->
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7">
                        <!--begin::Checkbox-->
                        <div class="form-check form-switch form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" name="role_status" checked="checked" />
                            <label class="form-check-label" for="flexSwitchChecked">
                                Role status
                            </label>
                        </div>
                        <!--end::Checkbox-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Disclaimer-->
                    <div class="text-gray-600">role set as a
                        <strong class="me-1">Core role</strong>will be locked and
                        <strong class="me-1">not editable</strong>in future
                    </div>
                    <!--end::Disclaimer-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-permissions-modal-action="cancel">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

@push('scripts')
    <script>
        "use strict";

        // Class definition
        var KTUsersAddRole = function() {
            // Shared variables
            const element = document.getElementById('kt_modal_add_role');
            const form = element.querySelector('#kt_modal_add_role_form');
            const modal = new bootstrap.Modal(element);

            // Init add schedule modal
            var initAddRole = () => {

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                var validator = FormValidation.formValidation(
                    form, {
                        fields: {
                            'role_name': {
                                validators: {
                                    notEmpty: {
                                        message: 'role name is required'
                                    }
                                }
                            },
                            'role_description': {
                                validators: {
                                    notEmpty: {
                                        message: 'role description is required'
                                    }
                                }
                            },
                        },

                        plugins: {
                            trigger: new FormValidation.plugins.Trigger(),
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: '.fv-row',
                                eleInvalidClass: '',
                                eleValidClass: ''
                            })
                        }
                    }
                );

                // Close button handler
                const closeButton = element.querySelector('[data-kt-permissions-modal-action="close"]');
                closeButton.addEventListener('click', e => {
                    e.preventDefault();

                    Swal.fire({
                        text: "Are you sure you would like to close?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, close it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            modal.hide(); // Hide modal				
                        }
                    });
                });

                // Cancel button handler
                const cancelButton = element.querySelector('[data-kt-permissions-modal-action="cancel"]');
                cancelButton.addEventListener('click', e => {
                    e.preventDefault();

                    Swal.fire({
                        text: "Are you sure you would like to cancel?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, cancel it!",
                        cancelButtonText: "No, return",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function(result) {
                        if (result.value) {
                            form.reset(); // Reset form	
                            modal.hide(); // Hide modal				
                        } else if (result.dismiss === 'cancel') {
                            Swal.fire({
                                text: "Your form has not been cancelled!.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary",
                                }
                            });
                        }
                    });
                });

                // Submit button handler
                const submitButton = element.querySelector('[data-kt-permissions-modal-action="submit"]');
                submitButton.addEventListener('click', function(e) {
                    // Prevent default button action
                    e.preventDefault();

                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function(status) {
                            console.log('validated!');

                            if (status == 'Valid') {
                                // Show loading indication
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable button to avoid multiple click 
                                submitButton.disabled = true;

                                // Simulate form submission. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                var form_data = $('#kt_modal_add_role_form').serialize();
                                $.ajax({
                                    type: "POST",
                                    url: "/role/add",
                                    data: form_data, // serializes the form's elements.
                                    success: function(response) {
                                        Swal.fire({
                                            title: "Wooohooo!",
                                            text: response.message,
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        submitButton.removeAttribute('data-kt-indicator');
                                        submitButton.disabled = false;
                                        modal.hide();
                                        form.reset();
                                    },
                                    
                                    error: function(xhr, status, error) {
                                        var responseJson = JSON.parse(xhr.responseText);
                                        // Access the message property from the response
                                        var errorMessage = responseJson.message;
                                        // Display error message
                                        // alert('Error: ' + errorMessage);
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter = Swal
                                                    .stopTimer;
                                                toast.onmouseleave = Swal
                                                    .resumeTimer;
                                            }
                                        });
                                        Toast.fire({
                                            icon: "error",
                                            title: "Erro: " + errorMessage
                                        });
                                    },

                                });
                            } else {
                                // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                                Swal.fire({
                                    text: "Sorry, looks like there are some errors detected, please try again.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        });
                    }
                });
            }

            return {
                // Public functions
                init: function() {
                    initAddRole();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTUsersAddRole.init();
        });
    </script>
@endpush
