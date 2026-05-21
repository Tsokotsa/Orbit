<!--begin::Modal - Add User-->
<div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content">

            <!--begin::Header-->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h2 class="fw-bold text-gray-900">
                        Add Radius User
                    </h2>

                    <div class="text-muted fs-7">
                        Create PPPoE subscriber and link profile
                    </div>

                </div>

                <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-1"></i>

                </div>

            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="modal-body py-10 px-10">

                <!--begin::Stepper-->
                <div class="stepper stepper-pills stepper-column d-flex flex-column flex-xl-row flex-row-fluid"
                    id="kt_add_user_stepper">

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
                                            Service
                                        </h3>

                                        <div class="stepper-desc">
                                            Account type
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
                                            Authentication
                                        </h3>

                                        <div class="stepper-desc">
                                            Username & password
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
                                            Profile
                                        </h3>

                                        <div class="stepper-desc">
                                            Radius package
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
                                            Review data
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                    <!--end::Aside-->

                    <!--begin::Content-->
                    <div class="flex-row-fluid">

                        <form id="kt_add_user_form">


                            <!-- STEP 1 -->
                            <div class="current" data-kt-stepper-element="content">
                                @csrf
                                <div class="w-100">

                                    <div class="fv-row mb-10">

                                        <label class="required fw-semibold fs-6 mb-2">
                                            Service Type
                                        </label>

                                        <select name="service_type" class="form-select form-select-solid"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-parent="#kt_modal_add_user">

                                            <option value="">
                                                Select Service
                                            </option>

                                            <option value="parati">
                                                ParaTi
                                            </option>

                                            <option value="nettop">
                                                NetTop
                                            </option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 2 -->
                            <div data-kt-stepper-element="content">

                                <div class="w-100">

                                    <!-- USERNAME -->
                                    <div class="fv-row mb-10">

                                        <label class="fw-semibold fs-6 mb-2">
                                            Username
                                        </label>

                                        <div class="input-group">

                                            <input type="text" name="username" id="generated_username"
                                                class="form-control form-control-solid" readonly>

                                            <button type="button" class="btn btn-light-primary" id="generate_username">

                                                Regenerate

                                            </button>

                                        </div>

                                    </div>

                                    <!-- PASSWORD -->
                                    <div class="fv-row mb-10">

                                        <div class="d-flex flex-stack mb-2">

                                            <label class="fw-semibold fs-6">
                                                Password
                                            </label>

                                            <label class="form-check form-switch form-check-custom form-check-solid">

                                                <input class="form-check-input" type="checkbox" checked
                                                    id="auto_generate_password">

                                                <span class="form-check-label fs-7">
                                                    Auto Generate
                                                </span>

                                            </label>

                                        </div>

                                        <input type="text" name="password" id="password_input"
                                            class="form-control form-control-solid d-none">

                                    </div>

                                    <!-- FRAMED IP -->
                                    <div class="fv-row">

                                        <label class="fw-semibold fs-6 mb-2">
                                            Framed IP Address
                                        </label>

                                        <input type="text" name="framed_ip" class="form-control form-control-solid"
                                            placeholder="Optional">

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 3 -->
                            <div data-kt-stepper-element="content">

                                <div class="w-100">

                                    <div class="fv-row mb-10">

                                        <label class="required fw-semibold fs-6 mb-2">
                                            Radius Profile
                                        </label>

                                        <select name="profile" class="form-select form-select-solid"
                                            data-control="select2" data-dropdown-parent="#kt_modal_add_user">

                                            <option value="">
                                                Select Profile
                                            </option>

                                            @foreach ($profiles as $profile)
                                                <option value="{{ $profile->groupname }}">
                                                    {{ $profile->groupname }}
                                                </option>
                                            @endforeach

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <!-- STEP 4 -->
                            <div data-kt-stepper-element="content">

                                <div class="border border-dashed border-gray-300 rounded p-8">

                                    <div class="mb-5">

                                        <span class="fw-bold text-gray-800">
                                            Review user information before creating subscriber.
                                        </span>

                                    </div>

                                    <div class="text-muted fs-7">
                                        Click submit to provision Radius authentication and link the selected profile.
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
                                            Create User
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
            <!--end::Body-->

        </div>

    </div>

</div>
<!--end::Modal-->

@push('scripts')
    <script>
        let stepper = null;

        function initUserStepper() {

            const element = document.querySelector("#kt_add_user_stepper");

            if (!element) return;

            // prevent double init
            if (element.dataset.initialized === "1") return;

            stepper = new KTStepper(element);

            element.dataset.initialized = "1";

            /*
            |--------------------------------------------------------------------------
            | NEXT STEP
            |--------------------------------------------------------------------------
            */
            stepper.on("kt.stepper.next", function(s) {

                s.goNext();

            });

            /*
            |--------------------------------------------------------------------------
            | PREVIOUS STEP
            |--------------------------------------------------------------------------
            */
            stepper.on("kt.stepper.previous", function(s) {

                s.goPrevious();

            });

        }

        /*
        |--------------------------------------------------------------------------
        | MODAL OPEN (IMPORTANT)
        |--------------------------------------------------------------------------
        */
        $('#kt_modal_add_user').on('shown.bs.modal', function() {

            setTimeout(function() {

                initUserStepper();

                // force layout recalculation (IMPORTANT FOR METRONIC)
                window.dispatchEvent(new Event('resize'));

            }, 150);

        });

        /*
        |--------------------------------------------------------------------------
        | RESET ON CLOSE (IMPORTANT)
        |--------------------------------------------------------------------------
        */
        $('#kt_modal_add_user').on('hidden.bs.modal', function() {

            const el = document.querySelector("#kt_add_user_stepper");

            if (el) el.dataset.initialized = "0";

            stepper = null;

        });


        // Generate Username

        function generateUsername() {

            let type = $('select[name="service_type"]').val();

            if (!type) return;

            let domain = type === 'parati' ? 'parati.paratus.co.mz' : 'nettop.paratus.co.mz';

            /*let random = Math.floor(Math.random() * 9000) + 1000;

            let username = `user${random}@${domain}`; */
            let username = `user_example@${domain}`;

            $('#generated_username').val(username);
        }

        /*
        |--------------------------------------------------------------------------
        | ON SERVICE CHANGE
        |--------------------------------------------------------------------------
        */
        $('select[name="service_type"]').on('change', function() {

            generateUsername();

        });


        // Password Toggle Switch

        $('#auto_generate_password').on('change', function() {

            if ($(this).is(':checked')) {

                $('#password_input').addClass('d-none').val('');

            } else {

                $('#password_input').removeClass('d-none').focus();

            }

        });

        // Submit form

        $('[data-kt-stepper-action="submit"]').on('click', function() {

            Swal.fire({
                title: 'Create User?',
                text: "This will provision FreeRADIUS account",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Create'
            }).then((result) => {

                if (!result.isConfirmed) return;

                let btn = $(this);

                btn.attr('data-kt-indicator', 'on');

                $.ajax({

                    url: "{{ route('radius.users.store') }}",
                    type: "POST",
                    data: $('#kt_add_user_form').serialize(),

                    success: function(res) {

                        btn.removeAttr('data-kt-indicator');

                        Swal.fire({
                            icon: 'success',
                            title: 'User Created',
                            html: `
                        <b>Username:</b> ${res.username}<br>
                        <b>Password:</b> ${res.password}
                    `
                        });

                        $('#kt_modal_add_user').modal('hide');
                        $('#kt_add_user_form')[0].reset();

                    },

                    error: function(xhr) {

                        btn.removeAttr('data-kt-indicator');

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message ?? 'Error creating user'
                        });

                    }

                });

            });

        });
    </script>
@endpush
