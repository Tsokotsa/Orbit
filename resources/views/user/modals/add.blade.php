<div class="modal fade" tabindex="-1" id="kt_modal_add_user">
    <div class="modal-dialog mw-900px">
        <form class="modal-content stepper stepper-pills" id="kt_modal_add_user_form" enctype="multipart/form-data">
            @csrf
            <div class="modal-header px-10">
                <h3 class="modal-title">Add User</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body px-10">
                <!--begin::Stepper-->
                <div>
                    <!--begin::Nav-->
                    <div class="stepper-nav flex-center flex-wrap mb-10">
                        <!--begin::Step 2-->
                        <div class="stepper-item mx-4 my-4 current" data-kt-stepper-element="nav">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">1</span>
                                </div>
                                <!--end::Icon-->

                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Basic
                                    </h3>

                                    <div class="stepper-desc">
                                        User details
                                    </div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 1-->

                        <!--begin::Step 2-->
                        <div class="stepper-item mx-4 my-4" data-kt-stepper-element="nav">
                            <!--begin::Wrapper-->
                            <div class="stepper-wrapper d-flex align-items-center">
                                <!--begin::Icon-->
                                <div class="stepper-icon w-40px h-40px">
                                    <i class="stepper-check fas fa-check"></i>
                                    <span class="stepper-number">2</span>
                                </div>
                                <!--begin::Icon-->

                                <!--begin::Label-->
                                <div class="stepper-label">
                                    <h3 class="stepper-title">
                                        Advanced
                                    </h3>

                                    <div class="stepper-desc">
                                        User contacts
                                    </div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Line-->
                            <div class="stepper-line h-40px"></div>
                            <!--end::Line-->
                        </div>
                        <!--end::Step 2-->
                    </div>
                    <!--end::Nav-->
                    <!--begin::Group-->
                    <div class="px-20 mb-5 scroll-y mh-300px">
                        <!--begin::Step 1 -->
                        <div class="flex-column current" data-kt-stepper-element="content">
                            <!--begin::Input group-->
                            <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll"
                                data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
                                data-kt-scroll-dependencies="#kt_modal_add_user_header"
                                data-kt-scroll-wrappers="#kt_modal_add_user_scroll" data-kt-scroll-offset="300px"
                                style="max-height: 339px;">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                    <!--end::Label-->
                                    <!--begin::Image placeholder-->
                                    <style>
                                        .image-input-placeholder {
                                            background-image: url('assets/media/svg/files/blank-image.svg');
                                        }

                                        [data-bs-theme="dark"] .image-input-placeholder {
                                            background-image: url('assets/media/svg/files/blank-image-dark.svg');
                                        }
                                    </style>
                                    <!--end::Image placeholder-->
                                    <!--begin::Image input-->
                                    <div class="image-input image-input-outline image-input-placeholder" data-kt-image-input="true">
                                    <!--begin::Preview existing avatar-->
                                        <div class="image-input-wrapper w-125px h-125px"
                                            style="background-image: url(assets/media/avatars/300-6.jpg);"></div>
                                        <!--end::Preview existing avatar-->
                                        <!--begin::Label-->
                                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" aria-label="Change avatar" data-bs-original-title="Change avatar" data-kt-initialized="1">
                                            <i class="ki-outline ki-pencil fs-7"></i>
                                            <!--begin::Inputs-->
                                            <input type="file" name="user-avatar" accept=".png, .jpg, .jpeg">
                                            {{-- <input type="hidden" name="avatar_remove"> --}}
                                            <!--end::Inputs-->
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Cancel-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                            aria-label="Cancel avatar" data-bs-original-title="Cancel avatar"
                                            data-kt-initialized="1">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <!--end::Cancel-->
                                        <!--begin::Remove-->
                                        <span
                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                            data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                            aria-label="Remove avatar" data-bs-original-title="Remove avatar"
                                            data-kt-initialized="1">
                                            <i class="ki-outline ki-cross fs-2"></i>
                                        </span>
                                        <!--end::Remove-->
                                    </div>
                                    <!--end::Image input-->
                                    <!--begin::Hint-->
                                    <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                    <!--end::Hint-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span class="required">Name</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    aria-label="Please enter name."
                                                    data-bs-original-title="Please enter name." data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="name">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mt-3">
                                                <span>Surname</span>
                                                <span class="ms-1" data-bs-toggle="tooltip"
                                                    aria-label="Please enter name."
                                                    data-bs-original-title="Please enter surname"
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="surname">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-2">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="email" name="email"
                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                        placeholder="example@domain.com">
                                    <!--end::Input-->
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <!--begin::Label-->
                                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                                    <!--end::Label-->
                                    <!--begin::Roles-->
                                    @foreach ($roles as $role)
                                        <!--begin::Input row-->
                                        <div class="d-flex fv-row">
                                            <!--begin::Radio-->
                                            <div class="form-check form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" name="user_role" type="radio"
                                                    value="{{ $role->id }}" id="kt_modal_update_role_option_1"
                                                    <?php if ($role->name === 'Default') {
                                                        echo 'checked';
                                                    } ?>>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <label class="form-check-label" for="kt_modal_update_role_option_1">
                                                    <div class="fw-bold text-gray-800">{{ $role->name }}</div>
                                                    <div class="text-gray-600">{{ $role->description }}</div>
                                                </label>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Radio-->
                                        </div>
                                        <!--end::Roles-->
                                        <div class="separator separator-dashed my-5"></div>
                                </div>
                                @endforeach
                                <!--end::Input group-->
                            </div>
                            <!--end::Input group-->
                         </div>
                        <!--End::Step 1-->

                        <!--begin::Step 2-->
                        <div class="flex-column" data-kt-stepper-element="content">
                            <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span class="required">Phone</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="Enter primary cell number"
                                                data-bs-original-title="Enter primary cell number."
                                                data-kt-initialized="1">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="ki-duotone ki-phone fs-1"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span></i>
                                            </span>
                                            <input type="text" class="form-control moz_mask" placeholder="Cell number"
                                                aria-label="phone" name="phone" aria-describedby="basic-addon1" />
                                        </div>
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col">
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-7 fv-plugins-icon-container">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Telegram</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="Enter telegram ID"
                                                data-bs-original-title="Enter telegram ID" data-kt-initialized="1">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="ki-duotone ki-send fs-1"><span class="path1"></span><span
                                                        class="path2"></span><span class="path3"></span></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Telegram ID"
                                                aria-label="telegram" name="telegram"
                                                aria-describedby="basic-addon1" />
                                        </div>
                                        <!--end::Input-->
                                        <div
                                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        </div>
                                    </div>
                                    <!--end::Input group-->
                                </div>
                                <!--end::Col-->
                        
                            </div>
                            <!--begin::Alert-->
                            <div
                                class="alert alert-light d-flex align-items-center p-5 mt-6 border border-primary border-dashed">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-shield-tick fs-2hx text-primary me-4"><span
                                        class="path1"></span><span class="path2"></span></i>
                                <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column">
                                    <!--begin::Title-->
                                    <h4 class="mb-1 text-dark">Consent</h4>
                                    <!--end::Title-->

                                    <!--begin::Content-->
                                    <span class="text-gray-500">This contacts will be used to receive comms from the
                                        system.</span>
                                    <!--end::Content-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <!--End::Step 2-->
                    </div>
                    <!--end::Group-->
                </div>
                <!--end::Stepper-->
            </div>
            <div class="modal-footer px-10 d-flex flex-stack">
                <!--begin::Wrapper-->
                <div class="me-2">
                    <button type="button" class="btn btn-light btn-active-light-primary"
                        data-kt-stepper-action="previous">
                        Back
                    </button>
                </div>
                <!--end::Wrapper-->

                <!--begin::Wrapper-->
                <div>
                    <button type="button" class="btn btn-primary add-user" data-kt-stepper-action="submit">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-kt-stepper-action="next">
                        Continue
                    </button>
                </div>
                <!--end::Wrapper-->
            </div>
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
        var KTUsersAddUser = function () {
    // Shared variables
    const element = document.getElementById('kt_modal_add_user');
    const form = element.querySelector('#kt_modal_add_user_form');
    const modal = new bootstrap.Modal(element);

    // Init add schedule modal
    var initAddUser = () => {

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        var validator = FormValidation.formValidation(
            form,
            {
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
                validator.validate().then(function (status) {

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
            }).then(function (result) {
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
            }).then(function (result) {
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
        init: function () {
            initAddUser();
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTUsersAddUser.init();
});
    </script>
@endpush
