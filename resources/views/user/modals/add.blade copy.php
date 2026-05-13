<div class="modal fade" tabindex="-1" id="kt_modal_add_user">
    <div class="modal-dialog modal-dialog-centered mw-900px">

        <form class="modal-content stepper stepper-pills" id="kt_modal_add_user_form" enctype="multipart/form-data">

            @csrf

            <!--begin::Header-->
            <div class="modal-header px-10">
                <h3 class="modal-title">Add User</h3>

                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">

                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="modal-body px-10 py-7">

                <!--begin::Stepper-->
                <div id="kt_add_user_stepper">

                    <!--begin::Nav-->
                    <div class="stepper-nav flex-center flex-wrap mb-10">

                        <!--begin::Step 1-->
                        <div class="stepper-item current mx-4 my-4" data-kt-stepper-element="nav">

                            <div class="stepper-wrapper d-flex align-items-center">

                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>

                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Basic
                                    </h3>

                                    <div class="stepper-desc">
                                        User details
                                    </div>
                                </div>

                            </div>

                            <div class="stepper-line h-40px"></div>
                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div class="stepper-item mx-4 my-4" data-kt-stepper-element="nav">

                            <div class="stepper-wrapper d-flex align-items-center">

                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>

                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Advanced
                                    </h3>

                                    <div class="stepper-desc">
                                        User contacts
                                    </div>
                                </div>

                            </div>

                            <div class="stepper-line h-40px"></div>
                        </div>
                        <!--end::Step 2-->

                    </div>
                    <!--end::Nav-->

                    <!--begin::Content-->
                    <div class="px-5">

                        <!--begin::Step 1-->
                        <div class="current" data-kt-stepper-element="content">

                            <div class="scroll-y pe-5" style="max-height: 500px;">

                                <!--begin::Avatar-->
                                <div class="fv-row mb-7">

                                    <label class="d-block fw-semibold fs-6 mb-5">
                                        Avatar
                                    </label>

                                    <div class="image-input image-input-outline" data-kt-image-input="true">

                                        <div class="image-input-wrapper w-125px h-125px"></div>

                                        <label
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="change">

                                            <i class="ki-outline ki-pencil fs-7"></i>

                                            <input type="file" name="user_avatar" accept=".png, .jpg, .jpeg">
                                        </label>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel">

                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>

                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove">

                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>

                                    </div>

                                    <div class="form-text">
                                        Allowed file types: png, jpg, jpeg.
                                    </div>

                                </div>
                                <!--end::Avatar-->

                                <!--begin::Row-->
                                <div class="row">

                                    <!--begin::Name-->
                                    <div class="col-md-6">

                                        <div class="fv-row mb-7">

                                            <label class="required fs-6 fw-semibold form-label">
                                                Name
                                            </label>

                                            <input type="text" class="form-control form-control-solid"
                                                name="name">

                                        </div>

                                    </div>
                                    <!--end::Name-->

                                    <!--begin::Surname-->
                                    <div class="col-md-6">

                                        <div class="fv-row mb-7">

                                            <label class="fs-6 fw-semibold form-label">
                                                Surname
                                            </label>

                                            <input type="text" class="form-control form-control-solid"
                                                name="surname">

                                        </div>

                                    </div>
                                    <!--end::Surname-->

                                </div>
                                <!--end::Row-->

                                <!--begin::Email-->
                                <div class="fv-row mb-7">

                                    <label class="required fw-semibold fs-6 mb-2">
                                        Email
                                    </label>

                                    <input type="email" name="email" class="form-control form-control-solid"
                                        placeholder="example@domain.com">

                                </div>
                                <!--end::Email-->

                                <!--begin::Roles-->
                                <div class="mb-7">

                                    <label class="required fw-semibold fs-6 mb-5">
                                        Role
                                    </label>

                                    @foreach ($roles as $role)
                                        <div class="d-flex fv-row mb-5">

                                            <div class="form-check form-check-custom form-check-solid">

                                                <input class="form-check-input me-3" name="user_role" type="radio"
                                                    value="{{ $role->id }}" id="role_{{ $role->id }}"
                                                    {{ $role->name == 'Default' ? 'checked' : '' }}>

                                                <label class="form-check-label" for="role_{{ $role->id }}">

                                                    <div class="fw-bold text-gray-800">
                                                        {{ $role->name }}
                                                    </div>

                                                    <div class="text-gray-600">
                                                        {{ $role->description }}
                                                    </div>

                                                </label>

                                            </div>

                                        </div>

                                        <div class="separator separator-dashed mb-5"></div>
                                    @endforeach

                                </div>
                                <!--end::Roles-->

                            </div>

                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div data-kt-stepper-element="content">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="fv-row mb-7">

                                        <label class="required fs-6 fw-semibold form-label">
                                            Phone
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-phone fs-1"></i>
                                            </span>

                                            <input type="text" class="form-control moz_mask" name="phone"
                                                placeholder="Cell number">

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="fv-row mb-7">

                                        <label class="fs-6 fw-semibold form-label">
                                            Telegram
                                        </label>

                                        <div class="input-group">

                                            <span class="input-group-text">
                                                <i class="ki-duotone ki-send fs-1"></i>
                                            </span>

                                            <input type="text" class="form-control" name="telegram"
                                                placeholder="Telegram ID">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div
                                class="alert alert-light border border-primary border-dashed d-flex align-items-center p-5 mt-5">

                                <i class="ki-duotone ki-shield-tick fs-2hx text-primary me-4"></i>

                                <div class="d-flex flex-column">

                                    <h4 class="mb-1 text-dark">
                                        Consent
                                    </h4>

                                    <span class="text-gray-500">
                                        These contacts will be used to receive communications from the system.
                                    </span>

                                </div>

                            </div>

                        </div>
                        <!--end::Step 2-->

                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Stepper-->

            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="modal-footer px-10 d-flex justify-content-between">

                <button type="button" class="btn btn-light" data-kt-stepper-action="previous">

                    Back
                </button>

                <div>

                    <button type="button" class="btn btn-primary me-3" data-kt-stepper-action="next">

                        Continue
                    </button>

                    <button type="submit" class="btn btn-primary add-user" data-kt-stepper-action="submit">

                        <span class="indicator-label">
                            Submit
                        </span>

                        <span class="indicator-progress">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>

                    </button>

                </div>

            </div>
            <!--end::Footer-->

        </form>

    </div>
</div>


@push('scripts')
    <script>
        // Stepper lement
        var element = document.querySelector("#kt_modal_add_user_form");

        // Initialize Stepper
        var stepper = new KTStepper(element);

        // Handle next step
        stepper.on("kt.stepper.next", function() {
            stepper.goNext(); // go next step
        });

        // Handle previous step
        stepper.on("kt.stepper.previous", function() {
            stepper.goPrevious(); // go previous step
        });
    </script>

    <script>
        var KTUsersAddUser = function() {
            // Shared variables
            const element = document.getElementById('kt_modal_add_user');
            const form = element.querySelector('#kt_modal_add_user_form');
            const modal = new bootstrap.Modal(element);

            // Init add schedule modal
            var initAddUser = () => {

                // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
                var validator = FormValidation.formValidation(
                    form, {
                        fields: {
                            'name': {
                                validators: {
                                    notEmpty: {
                                        message: 'Full name is required'
                                    }
                                }
                            },
                            'email': {
                                validators: {
                                    notEmpty: {
                                        message: 'Valid email address is required'
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

                // Submit button handler
                const submitButton = element.querySelector('[data-kt-stepper-action="submit"]');
                submitButton.addEventListener('click', e => {
                    var form = $('#kt_modal_add_user_form')[0];
                    var form_data = new FormData(form);

                    e.preventDefault();


                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function(status) {

                            if (status == 'Valid') {
                                // Show loading indication
                                submitButton.setAttribute('data-kt-indicator', 'on');

                                // Disable button to avoid multiple click 
                                submitButton.disabled = true;
                                //console.log(formData);
                                //   var form_data = $('#kt_modal_add_user_form').serialize();
                                //   var avatar = $("#user-avatar").val();
                                $.ajax({
                                    type: "POST",
                                    processData: false, // Important!
                                    url: "/user/add",
                                    //data: form_data + '&user-avatar=' + avatar, // serializes the form's elements.
                                    data: form_data, // serializes the form's elements.
                                    contentType: false, // Important!                                                                                                                                                                   
                                    cache: false,
                                    success: function(response) {
                                        Swal.fire({
                                            title: "Wooohooo!",
                                            text: response.message,
                                            icon: "success",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        submitButton.removeAttribute(
                                            'data-kt-indicator');
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

                // Cancel button handler
                const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
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
                            modal.hide();
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

                // Close button handler
                const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
                closeButton.addEventListener('click', e => {
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
                            modal.hide();
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
            }

            return {
                // Public functions
                init: function() {
                    initAddUser();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTUsersAddUser.init();
        });
    </script>
@endpush
