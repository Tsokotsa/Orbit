<div class="modal fade" id="kt_modal_edit_user" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content shadow-sm border-0 rounded-4">

            <!-- HEADER -->
            <div class="modal-header border-0 pb-0 px-10 pt-8">

                <div>

                    <h2 class="fw-bold text-gray-900 mb-1">
                        Manage Subscriber
                    </h2>

                    <div class="text-muted fs-7">
                        Edit Radius user attributes and subscriber operational controls
                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body px-10 pt-6 pb-8">

                <!-- NOTICE -->
                <div class="notice d-flex bg-light-secondary rounded-3 border border-dashed border-gray-300 p-5 mb-8">

                    <!-- ICON -->
                    <i class="ki-outline ki-information-5 fs-2tx text-gray-700 me-4"></i>

                    <!-- CONTENT -->
                    <div class="d-flex flex-stack flex-grow-1">

                        <div class="fw-semibold">

                            <h4 class="text-gray-900 fw-bold mb-1">
                                Subscriber Management Notice
                            </h4>

                            <div class="fs-7 text-muted">
                                Changes performed here immediately affect subscriber authentication,
                                active PPPoE sessions and bandwidth policies.
                            </div>

                        </div>

                    </div>

                </div>

                <form id="kt_edit_user_form">

                    @csrf

                    <input type="hidden" id="edit_username" name="username">

                    <input type="hidden" id="is_suspended" value="0">

                    <!-- ====================================================== -->
                    <!-- SUBSCRIBER -->
                    <!-- ====================================================== -->
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">

                                <span class="symbol-label bg-light-primary">

                                    <i class="ki-outline ki-profile-circle fs-2 text-primary"></i>

                                </span>

                            </div>

                            <div>

                                <h4 class="mb-0 text-gray-900">
                                    Subscriber Information
                                </h4>

                                <div class="fs-7 text-muted">
                                    Radius account identity and assigned profile
                                </div>

                            </div>

                        </div>

                        <div class="row g-5">

                            <!-- USERNAME -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Username
                                </label>

                                <input type="text" id="edit_username_display" class="form-control form-control-solid"
                                    readonly>

                            </div>

                            <!-- PROFILE -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Radius Profile
                                </label>

                                <select id="edit_profile" name="profile" class="form-select form-select-solid"
                                    data-control="select2" data-dropdown-parent="#kt_modal_edit_user">

                                    @foreach ($profiles as $profile)
                                        <option value="{{ $profile->groupname }}">

                                            {{ $profile->groupname }}

                                        </option>
                                    @endforeach

                                </select>

                            </div>

                        </div>

                    </div>

                    <!-- ====================================================== -->
                    <!-- NETWORK -->
                    <!-- ====================================================== -->
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">

                                <span class="symbol-label bg-light-success">

                                    <i class="ki-outline ki-wifi-square fs-2 text-success"></i>

                                </span>

                            </div>

                            <div>

                                <h4 class="mb-0 text-gray-900">
                                    Network Configuration
                                </h4>

                                <div class="fs-7 text-muted">
                                    IP assignment and bandwidth configuration
                                </div>

                            </div>

                        </div>

                        <div class="row g-5 mb-5">

                            <!-- FRAMED IP -->
                            <div class="col-md-12">

                                <label class="form-label fw-semibold">
                                    Framed IP Address
                                </label>

                                <input type="text" id="edit_framed_ip" name="framed_ip"
                                    class="form-control form-control-solid" placeholder="Optional">

                            </div>

                        </div>

                        <div class="row g-5">

                            <!-- DOWNLOAD -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Download Speed
                                </label>

                                <input type="text" id="user_edit_download" name="user_download_speed"
                                    class="form-control form-control-solid" placeholder="e.g 20M">

                            </div>

                            <!-- UPLOAD -->
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Upload Speed
                                </label>

                                <input type="text" id="user_edit_upload" name="user_upload_speed"
                                    class="form-control form-control-solid" placeholder="e.g 10M">

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-10 pb-8 pt-5">

                <!-- ACTIONS -->
                <div class="d-flex flex-wrap gap-3">

                    <!-- FORCE DISCONNECT -->
                    <button type="button" class="btn btn-sm btn-light device-action" id="disconnect_user_btn">

                        <i class="ki-outline ki-disconnect fs-5 me-1"></i>

                        Disconnect

                    </button>

                    <!-- SUSPEND -->
                    <button type="button" class="btn btn-sm btn-light device-action" id="suspend_user_btn">

                        <i class="ki-outline ki-shield-cross fs-5 me-1"></i>

                        <span id="suspend_btn_text">
                            Suspend
                        </span>

                    </button>

                    <!-- RESET PASSWORD -->
                    <button type="button" class="btn btn-sm btn-light device-action" id="reset_password_btn">

                        <i class="ki-outline ki-key fs-5 me-1"></i>

                        Reset Password

                    </button>

                </div>

                <!-- SAVE -->
                <button type="button" class="btn btn-sm btn-primary" id="save_user_changes">

                    <i class="ki-outline ki-check fs-5 me-1"></i>

                    Save Changes

                </button>

            </div>

        </div>

    </div>

</div>
