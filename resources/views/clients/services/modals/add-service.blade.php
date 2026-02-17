<div class="modal fade" tabindex="-1" id="add-service-modal">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h2>Create Service</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body py-lg-10 px-lg-10">

                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                    id="add_service_stepper" data-kt-stepper="true">

                    <!-- Stepper Aside -->
                    <div class="d-flex justify-content-center justify-content-xl-start flex-row-auto w-100 w-xl-300px">
                        <div class="stepper-nav ps-lg-10">

                            <!-- Step 1 -->
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="ki-outline ki-check stepper-check fs-2"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Warning</h3>
                                        <div class="stepper-desc">Information to Note</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>

                            <!-- Step 2 -->
                            <div class="stepper-item pending" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="ki-outline ki-check stepper-check fs-2"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Service</h3>
                                        <div class="stepper-desc">Service that you want to link</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>

                            <!-- Step 3 -->
                            <div class="stepper-item pending" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon w-40px h-40px">
                                        <i class="ki-outline ki-check stepper-check fs-2"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Completed</h3>
                                        <div class="stepper-desc">Review and Submit</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Stepper Content -->
                    <form class="form d-flex flex-column flex-row-fluid" style="min-height: 500px;"
                        id="add_service_form" novalidate="novalidate">

                        <!-- STEP 1 -->
                        <div data-kt-stepper-element="content" class="current">
                            @csrf
                            <input type="hidden" id="client_id" value="{{ $client_id }}">
                            <div class="alert bg-white text-center p-10 mb-10 shadow-sm rounded">

                                <div class="mb-5">
                                    <i class="ki-outline ki-information fs-5x text-warning"></i>
                                </div>

                                <h3 class="fw-bold text-warning mb-3">
                                    Attention Required
                                </h3>

                                <div class="fs-5 text-gray-700">
                                    Proceed only if you fully understand what you are doing.<br>
                                    Incorrect configuration may impact billing and client services.
                                </div>

                            </div>

                        </div>

                        <!-- STEP 2 -->
                        <div data-kt-stepper-element="content" class="pending">

                            <div class="d-flex justify-content-center w-100">
                                <div class="col-12 col-lg-8 col-xl-10">

                                    <div class="fv-row">
                                        <label class="required fs-6 fw-semibold mb-2">Package</label>
                                        <select class="form-select" name="service_id" id="package_select"
                                            data-placeholder="Select Package to link ...">
                                        </select>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- STEP 3 -->
                        <!-- STEP 3 -->
                        <div data-kt-stepper-element="content" class="pending">

                            <div class="d-flex justify-content-center w-100">
                                <div class="col-12 col-lg-8 col-xl-7">

                                    <div class="card border-0 shadow-sm">

                                        <div class="card-body p-10">

                                            <!-- Header -->
                                            <div class="text-center mb-8">
                                                <i class="ki-outline ki-shield-tick fs-4x text-success mb-4"></i>
                                                <h3 class="fw-bold mb-2 mt-8">
                                                    Confirm Selected Package
                                                </h3>
                                                <div class="text-muted">
                                                    Please verify the details before submitting
                                                </div>
                                            </div>

                                            <!-- Details -->
                                            <div class="d-flex flex-column gap-6 fs-5">

                                                <!-- Name -->
                                                <div
                                                    class="d-flex justify-content-between align-items-center border-bottom pb-4">
                                                    <div class="fw-semibold text-muted">
                                                        <i class="ki-outline ki-package fs-4 me-2"></i>
                                                        Package Name
                                                    </div>
                                                    <span id="confirm_package_name"
                                                        class="badge badge-light-primary fs-6 px-4 py-2">
                                                        -
                                                    </span>
                                                </div>

                                                <!-- Speed -->
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div class="fw-semibold text-muted">
                                                        <i class="ki-outline ki-speedometer fs-4 me-2"></i>
                                                        Speed
                                                    </div>
                                                    <span id="confirm_package_speed"
                                                        class="badge badge-light-success fs-6 px-4 py-2">
                                                        -
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>



                        <!-- ACTIONS -->
                        <div class="d-flex flex-stack pt-10 mt-auto">

                            <div class="me-2">
                                <button type="button" class="btn btn-lg btn-light-primary me-3"
                                    data-kt-stepper-action="previous">
                                    <i class="ki-outline ki-arrow-left fs-3 me-1"></i>Back
                                </button>
                            </div>

                            <div>
                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit"
                                    id="add_service_submit">
                                    <span class="indicator-label">
                                        Submit
                                        <i class="ki-outline ki-arrow-right fs-3 ms-2"></i>
                                    </span>
                                </button>

                                <button type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="next">
                                    Continue
                                    <i class="ki-outline ki-arrow-right fs-3 ms-1"></i>
                                </button>
                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>



@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ==============================
            // STEPPER INIT
            // ==============================
            var element = document.querySelector("#add_service_stepper");
            var stepperObj = new KTStepper(element);

            // ==============================
            // FORM VALIDATION INIT
            // ==============================
            const form = document.getElementById('add_service_form');

            const validator = FormValidation.formValidation(form, {
                fields: {
                    service_id: {
                        validators: {
                            notEmpty: {
                                message: 'Please select a package'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            });

            // ==============================
            // STEP VALIDATION
            // ==============================
            stepperObj.on("kt.stepper.next", function(stepper) {

                if (stepper.getCurrentStepIndex() === 2) {

                    validator.validate().then(function(status) {

                        if (status === 'Valid') {
                            stepper.goNext();
                        } else {
                            Swal.fire({
                                text: "Please select a package before continuing.",
                                icon: "error",
                                confirmButtonText: "Ok",
                                buttonsStyling: false,
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }

                    });

                } else {
                    stepper.goNext();
                }
            });

            stepperObj.on("kt.stepper.previous", function(stepper) {
                stepper.goPrevious();
            });

            // ==============================
            // SELECT2 INIT
            // ==============================
            $('#package_select').select2({
                dropdownParent: $('#add-service-modal'),
                placeholder: "Select Service to link ...",
                allowClear: true,
                width: '100%',
                ajax: {
                    url: '/services/list',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            search: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(item) {
                                return {
                                    id: item.id,
                                    text: item.name + " - " + item.d_speed,
                                    speed: item.d_speed,
                                    name: item.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Revalidate on change
            $('#package_select').on('change', function() {
                validator.revalidateField('service_id');
            });

            // Fill confirmation step
            $('#package_select').on('select2:select', function(e) {
                var data = e.params.data;
                $('#confirm_package_name').text(data.name);
                $('#confirm_package_speed').text(data.speed + " / " + data.speed);
            });

            // ==============================
            // SUBMIT HANDLER
            // ==============================
            const button = document.getElementById('add_service_submit');
            let isSubmitting = false; // Prevent double submission

            button.addEventListener('click', function(e) {
                e.preventDefault();

                if (isSubmitting) return; // Block if already submitting

                validator.validate().then(function(status) {

                    if (status !== 'Valid') {
                        Swal.fire({
                            text: "Please select a package before submitting.",
                            icon: "error",
                            confirmButtonText: "Ok",
                            buttonsStyling: false,
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                        return;
                    }

                    Swal.fire({
                        text: "Are you sure you want to proceed?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, Proceed!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: "btn fw-bold btn-success",
                            cancelButton: "btn fw-bold btn-active-light"
                        }
                    }).then(result => {

                        if (!result.isConfirmed) return;

                        // 🔥 Disable button + show loading indicator
                        isSubmitting = true;
                        button.setAttribute('data-kt-indicator', 'on');
                        button.disabled = true;

                        var package_id = $("#package_select").val();
                        var client_id = $("#client_id").val();

                        $.ajax({
                            url: '/client/add-service',
                            type: 'POST',
                            data: {
                                service_id: package_id,
                                client_id: client_id,
                                _token: $('input[name="_token"]').val()
                            },
                            dataType: 'json',
                            success: function(data) {

                                if (data.success) {
                                    toastr.success("Service Added successfully",
                                        "Success");
                                    location.reload();
                                } else {
                                    toastr.error("Failed to add service: " +
                                        data.error, "Error");
                                }

                                resetModal();
                            },
                            error: function(err) {
                                console.error(err);
                                toastr.error("Error adding service", "Error");
                                resetModal();
                            }
                        });

                    });

                });

            });

            // ==============================
            // RESET FUNCTION
            // ==============================
            function resetModal() {

                isSubmitting = false;

                // Remove loading indicator
                button.removeAttribute('data-kt-indicator');
                button.disabled = false;

                // Reset form validation
                validator.resetForm(true);

                // Reset Select2
                $('#package_select').val(null).trigger('change');

                // Reset confirmation fields
                $('#confirm_package_name').text('-');
                $('#confirm_package_speed').text('-');

                // Go back to Step 1
                stepperObj.goTo(1);

                // Hide modal
                const modalInstance = bootstrap.Modal
                    .getOrCreateInstance($('#add-service-modal')[0]);
                modalInstance.hide();
            }

            // ==============================
            // AUTO RESET WHEN MODAL CLOSES
            // ==============================
            $('#add-service-modal').on('hidden.bs.modal', function() {
                resetModal();
            });

        });
    </script>
@endpush
