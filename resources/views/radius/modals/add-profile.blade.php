<!--begin::Modal - Add Profile-->
<div class="modal fade" id="kt_modal_add_profile" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content">

            <!--begin::Header-->
            <div class="modal-header border-0 pb-0">

                <div>

                    <h2 class="fw-bold text-gray-900">
                        Add Radius Profile
                    </h2>

                    <div class="text-muted fs-7">
                        Create PPPoE service profile
                    </div>

                </div>

                <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-1"></i>

                </div>

            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="modal-body px-10 py-7">

                <form id="kt_add_profile_form">
                    @csrf

                    <div class="row g-7">

                        <!-- PROFILE NAME -->
                        <div class="col-md-12">

                            <label class="required fw-semibold fs-6 mb-2">
                                Profile Name
                            </label>

                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="Home 10Mbps">

                        </div>

                        <!-- DOWNLOAD -->
                        <div class="col-md-6">

                            <label class="required fw-semibold fs-6 mb-2">
                                Download Speed
                            </label>

                            <select name="download_speed" class="form-select form-select-solid speed-select"
                                data-control="select2" data-hide-search="true">

                                <option value="">Select Speed</option>
                                <option value="1M">1 Mbps</option>
                                <option value="5M">5 Mbps</option>
                                <option value="10M">10 Mbps</option>
                                <option value="20M">20 Mbps</option>
                                <option value="50M">50 Mbps</option>
                                <option value="100M">100 Mbps</option>
                                <option value="200M">200 Mbps</option>
                                <option value="1000M">1 Gbps</option>

                            </select>

                        </div>

                        <!-- UPLOAD -->
                        <div class="col-md-6">

                            <label class="required fw-semibold fs-6 mb-2">
                                Upload Speed
                            </label>

                            <select name="upload_speed" class="form-select form-select-solid speed-select"
                                data-control="select2" data-hide-search="true">

                                <option value="">Select Speed</option>
                                <option value="1M">1 Mbps</option>
                                <option value="5M">5 Mbps</option>
                                <option value="10M">10 Mbps</option>
                                <option value="20M">20 Mbps</option>
                                <option value="50M">50 Mbps</option>
                                <option value="100M">100 Mbps</option>
                                <option value="200M">200 Mbps</option>
                                <option value="1000M">1 Gbps</option>
                            </select>

                        </div>

                        <!-- SIMULTANEOUS USE -->
                        <div class="col-md-6">

                            <label class="fw-semibold fs-6 mb-2">
                                Simultaneous Use
                            </label>

                            <input type="number" name="simultaneous_use" class="form-control form-control-solid"
                                value="1">

                        </div>

                        <!-- FRAMED IP -->
                        <div class="col-md-6">

                            <label class="fw-semibold fs-6 mb-2">
                                Framed IP Address
                            </label>

                            <input type="text" name="framed_ip" class="form-control form-control-solid"
                                placeholder="Optional">

                        </div>

                        <!-- SESSION TIMEOUT -->
                        <div class="col-md-6">

                            <label class="fw-semibold fs-6 mb-2">
                                Session Timeout
                            </label>

                            <input type="number" name="session_timeout" class="form-control form-control-solid"
                                placeholder="86400">

                        </div>

                        <!-- IDLE TIMEOUT -->
                        <div class="col-md-6">

                            <label class="fw-semibold fs-6 mb-2">
                                Idle Timeout
                            </label>

                            <input type="number" name="idle_timeout" class="form-control form-control-solid"
                                placeholder="600">

                        </div>

                        <!-- STATUS -->
                        <div class="col-md-12">

                            <div class="d-flex flex-stack p-5 border border-dashed border-gray-300 rounded">

                                <div class="me-5">

                                    <label class="fw-bold fs-6">
                                        Profile Active
                                    </label>

                                    <div class="text-muted fs-7">
                                        Enable or disable profile authentication
                                    </div>

                                </div>

                                <label class="form-check form-switch form-check-custom form-check-solid">

                                    <input class="form-check-input" type="checkbox" name="status" value="1"
                                        checked>

                                </label>

                            </div>

                        </div>

                    </div>

                </form>

            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="modal-footer border-0 pt-0">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" class="btn btn-primary" id="kt_submit_add_profile">

                    <span class="indicator-label">
                        Save Profile
                    </span>

                    <span class="indicator-progress">

                        Please wait...

                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>

                    </span>

                </button>

            </div>
            <!--end::Footer-->

        </div>

    </div>

</div>
<!--end::Modal-->

@push('scripts')
    <script>
        $(document).ready(function() {

            $('.speed-select').select2({
                dropdownParent: $('#kt_modal_add_profile')
            });

        });

        $('#kt_submit_add_profile').on('click', function() {

            let button = $(this);

            button.attr('data-kt-indicator', 'on');
            button.prop('disabled', true);

            $.ajax({

                url: "{{ route('radius.profiles.store') }}",
                type: "POST",
                data: $('#kt_add_profile_form').serialize(),

                success: function(response) {

                    button.removeAttr('data-kt-indicator');
                    button.prop('disabled', false);

                    $('#kt_modal_add_profile').modal('hide');

                    toastr.success('Profile created successfully');

                    $('#kt_add_profile_form')[0].reset();

                    $('.speed-select').val(null).trigger('change');

                },

                error: function(xhr) {

                    button.removeAttr('data-kt-indicator');
                    button.prop('disabled', false);

                    if (xhr.responseJSON && xhr.responseJSON.message) {

                        toastr.error(xhr.responseJSON.message);

                    } else {

                        toastr.error('Failed to create profile');

                    }

                }

            });

        });
    </script>
@endpush
