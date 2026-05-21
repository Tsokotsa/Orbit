<!--begin::Modal - Add NAS-->
<div class="modal fade" id="kt_modal_add_nas" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h2 class="fw-bold text-gray-900">
                        Add NAS Device
                    </h2>

                    <div class="text-muted fs-7">
                        Register a Network Access Server into FreeRADIUS
                    </div>

                </div>

                <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-1"></i>

                </div>

            </div>

            <!-- BODY -->
            <div class="modal-body py-10 px-10">

                <!--begin::Stepper-->
                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                    id="kt_add_nas_stepper">

                    <!--begin::Aside-->
                    <div class="d-flex flex-row-auto w-100 w-xl-300px mb-10">

                        <div class="stepper-nav">

                            <!-- STEP 1 -->
                            <div class="stepper-item current" data-kt-stepper-element="nav">

                                <div class="stepper-wrapper">

                                    <div class="stepper-icon w-40px h-40px">
                                        <span class="stepper-number">1</span>
                                    </div>

                                    <div class="stepper-label">

                                        <h3 class="stepper-title">
                                            Device
                                        </h3>

                                        <div class="stepper-desc">
                                            NAS information
                                        </div>

                                    </div>

                                </div>

                                <div class="stepper-line h-40px"></div>

                            </div>

                            <!-- STEP 2 -->
                            <div class="stepper-item" data-kt-stepper-element="nav">

                                <div class="stepper-wrapper">

                                    <div class="stepper-icon w-40px h-40px">
                                        <span class="stepper-number">2</span>
                                    </div>

                                    <div class="stepper-label">

                                        <h3 class="stepper-title">
                                            Connectivity
                                        </h3>

                                        <div class="stepper-desc">
                                            IP & type
                                        </div>

                                    </div>

                                </div>

                                <div class="stepper-line h-40px"></div>

                            </div>

                            <!-- STEP 3 -->
                            <div class="stepper-item" data-kt-stepper-element="nav">

                                <div class="stepper-wrapper">

                                    <div class="stepper-icon w-40px h-40px">
                                        <span class="stepper-number">3</span>
                                    </div>

                                    <div class="stepper-label">

                                        <h3 class="stepper-title">
                                            Security
                                        </h3>

                                        <div class="stepper-desc">
                                            Shared secret
                                        </div>

                                    </div>

                                </div>

                                <div class="stepper-line h-40px"></div>

                            </div>

                            <!-- STEP 4 -->
                            <div class="stepper-item" data-kt-stepper-element="nav">

                                <div class="stepper-wrapper">

                                    <div class="stepper-icon w-40px h-40px">
                                        <span class="stepper-number">4</span>
                                    </div>

                                    <div class="stepper-label">

                                        <h3 class="stepper-title">
                                            Confirm
                                        </h3>

                                        <div class="stepper-desc">
                                            Review configuration
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!--end::Aside-->

                    <!--begin::Content-->
                    <div class="flex-row-fluid">

                        <form id="kt_add_nas_form">



                            <!-- STEP 1 -->
                            <div class="current" data-kt-stepper-element="content">
                                @csrf
                                <div class="w-100">

                                    <div class="row g-5">

                                        <div class="col-md-6">

                                            <label class="required form-label fw-semibold">
                                                NAS Description
                                            </label>

                                            <input type="text" name="description"
                                                class="form-control form-control-solid" placeholder="Main POP Router">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="required form-label fw-semibold">
                                                Short Name
                                            </label>

                                            <input type="text" name="shortname"
                                                class="form-control form-control-solid" placeholder="POP-MPT-01">

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 2 -->
                            <div data-kt-stepper-element="content">

                                <div class="w-100">

                                    <div class="row g-5">

                                        <div class="col-md-6">

                                            <label class="required form-label fw-semibold">
                                                NAS IP Address
                                            </label>

                                            <input type="text" name="nasname" class="form-control form-control-solid"
                                                placeholder="192.168.1.1">

                                        </div>

                                        <div class="col-md-6">

                                            <label class="required form-label fw-semibold">
                                                NAS Type
                                            </label>

                                            <select name="type" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-dropdown-parent="#kt_modal_add_nas">

                                                <option value="mikrotik">
                                                    MikroTik
                                                </option>

                                                <option value="cisco">
                                                    Cisco
                                                </option>

                                                <option value="other">
                                                    Other
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 3 -->
                            <div data-kt-stepper-element="content">

                                <div class="w-100">

                                    <div class="fv-row">

                                        <label class="required form-label fw-semibold">
                                            Shared Secret
                                        </label>

                                        <div class="input-group">

                                            <input type="password" name="secret" id="nas_secret"
                                                class="form-control form-control-solid">

                                            <button type="button" class="btn btn-light-primary"
                                                id="generate_secret_btn">

                                                Generate

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 4 -->
                            <div data-kt-stepper-element="content">

                                <div
                                    class="notice d-flex bg-light-secondary rounded border-secondary border border-dashed p-6 mb-8">

                                    <!-- ICON -->
                                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>

                                    <!-- WRAPPER -->
                                    <div class="d-flex flex-stack flex-grow-1">

                                        <!-- CONTENT -->
                                        <div class="fw-semibold">

                                            <h4 class="text-gray-900 fw-bold">
                                                Confirm NAS Configuration
                                            </h4>

                                            <div class="fs-8 text-gray-700">

                                                This NAS device will be added into the
                                                <b class="text-warning">RADIUS</b> infrastructure and allowed
                                                to authenticate subscribers.

                                                Ensure the shared secret configured on
                                                the NAS device matches the secret defined here.

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- ACTIONS -->
                            <div class="d-flex flex-stack pt-10">

                                <div class="me-2">

                                    <button type="button" class="btn btn-light-primary"
                                        data-kt-stepper-action="previous">

                                        Back

                                    </button>

                                </div>

                                <div>

                                    <button type="button" class="btn btn-primary" data-kt-stepper-action="submit">

                                        <span class="indicator-label">
                                            Add NAS
                                        </span>

                                        <span class="indicator-progress">

                                            Please wait...

                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>

                                        </span>

                                    </button>

                                    <button type="button" class="btn btn-primary" data-kt-stepper-action="next">

                                        Continue

                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>
                    <!--end::Content-->

                </div>
                <!--end::Stepper-->

            </div>

        </div>

    </div>

</div>
<!--end::Modal-->

@push('scripts')
    <script>
        let nasStepper = null;

        /*
        |--------------------------------------------------------------------------
        | INIT STEPPER
        |--------------------------------------------------------------------------
        */
        function initNasStepper() {

            const element = document.querySelector("#kt_add_nas_stepper");

            if (!element) return;

            if (element.dataset.initialized === "1") return;

            nasStepper = new KTStepper(element);

            element.dataset.initialized = "1";

            nasStepper.on("kt.stepper.next", function(stepper) {

                stepper.goNext();

            });

            nasStepper.on("kt.stepper.previous", function(stepper) {

                stepper.goPrevious();

            });

        }

        /*
        |--------------------------------------------------------------------------
        | MODAL OPEN
        |--------------------------------------------------------------------------
        */
        $('#kt_modal_add_nas').on('shown.bs.modal', function() {

            setTimeout(function() {

                initNasStepper();

                window.dispatchEvent(new Event('resize'));

            }, 150);

        });

        /*
        |--------------------------------------------------------------------------
        | RESET MODAL
        |--------------------------------------------------------------------------
        */
        $('#kt_modal_add_nas').on('hidden.bs.modal', function() {

            const el = document.querySelector("#kt_add_nas_stepper");

            if (el) {
                el.dataset.initialized = "0";
            }

            nasStepper = null;

        });

        /*
        |--------------------------------------------------------------------------
        | GENERATE SECRET
        |--------------------------------------------------------------------------
        */
        $('#generate_secret_btn').on('click', function() {

            let secret = Math.random().toString(36).slice(-12);

            $('#nas_secret').val(secret);

        });

        /*
        |--------------------------------------------------------------------------
        | SUBMIT
        |--------------------------------------------------------------------------
        */
        $('[data-kt-stepper-action="submit"]').on('click', function() {

            let btn = $(this);

            Swal.fire({

                title: 'Add NAS?',
                text: 'This device will authenticate against FreeRADIUS',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Add'

            }).then((result) => {

                if (!result.isConfirmed) return;

                btn.attr('data-kt-indicator', 'on');

                $.ajax({

                    url: "{{ route('nas.store') }}",
                    type: "POST",
                    data: $('#kt_add_nas_form').serialize(),

                    success: function(response) {

                        btn.removeAttr('data-kt-indicator');

                        Swal.fire({

                            icon: 'success',
                            title: 'NAS Added',
                            text: response.message

                        });

                        $('#kt_modal_add_nas').modal('hide');

                        $('#kt_add_nas_form')[0].reset();

                    },

                    error: function(xhr) {

                        btn.removeAttr('data-kt-indicator');

                        Swal.fire({

                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message ?? 'Unable to add NAS'

                        });

                    }

                });

            });

        });
    </script>
@endpush
