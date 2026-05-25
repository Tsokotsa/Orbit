<div class="modal fade" id="kt_modal_edit_profile" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content shadow-sm border-0 rounded-4">

            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 px-10 pt-8">

                <div>

                    <h2 class="fw-bold text-gray-900 mb-1">
                        Edit Radius Profile
                    </h2>

                    <div class="text-muted fs-7">
                        Manage bandwidth, limits and authentication behavior
                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-2"></i>
                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body px-10 pt-6 pb-8">

                {{-- NOTICE --}}
                <div class="notice d-flex bg-light-secondary rounded-3 border border-dashed border-gray-300 p-5 mb-8">

                    <i class="ki-outline ki-information-5 fs-2tx text-gray-700 me-4"></i>

                    <div class="fw-semibold">

                        <h4 class="text-gray-900 fw-bold mb-1">
                            Profile Impact Warning
                        </h4>

                        <div class="fs-7 text-muted">
                            Changes will affect all users assigned to this profile immediately.
                        </div>

                    </div>

                </div>

                <form id="edit_profile_form">

                    @csrf

                    <input type="hidden" id="edit_profile_old">

                    {{-- TABS --}}
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-8 fs-6">

                        <li class="nav-item">
                            <a class="nav-link active fw-semibold" data-bs-toggle="tab" href="#profile_general_tab">

                                <i class="ki-outline ki-profile-user fs-5 me-2"></i>
                                General

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#profile_bandwidth_tab">

                                <i class="las la-tachometer-alt fs-5 me-2"></i>
                                Bandwidth

                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#profile_session_tab">

                                <i class="ki-outline ki-time fs-5 me-2"></i>
                                Session Control

                            </a>
                        </li>

                    </ul>

                    <div class="tab-content">

                        {{-- ========================================== --}}
                        {{-- GENERAL --}}
                        {{-- ========================================== --}}
                        <div class="tab-pane fade show active" id="profile_general_tab">

                            <div class="border border-gray-200 border-dashed rounded-3 p-6">

                                <div class="d-flex align-items-center mb-5">

                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-outline ki-profile-user fs-2 text-primary"></i>
                                        </span>
                                    </div>

                                    <div>
                                        <h4 class="mb-0 text-gray-900">Profile Identity</h4>
                                        <div class="fs-7 text-muted">
                                            Name and assignment group
                                        </div>
                                    </div>

                                </div>

                                <div class="row g-5">

                                    <div class="col-md-12">

                                        <label class="form-label fw-semibold">
                                            Profile Name
                                        </label>

                                        <input type="text" id="edit_profile_name" name="groupname"
                                            class="form-control form-control-solid"
                                            placeholder="e.g. GOLD, SILVER, BUSINESS">

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- ========================================== --}}
                        {{-- BANDWIDTH --}}
                        {{-- ========================================== --}}
                        <div class="tab-pane fade" id="profile_bandwidth_tab">

                            <div class="border border-gray-200 border-dashed rounded-3 p-6">

                                <div class="d-flex align-items-center mb-5">

                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-success">
                                            <i class="las la-tachometer-alt fs-2 text-success"></i>
                                        </span>
                                    </div>

                                    <div>
                                        <h4 class="mb-0 text-gray-900">Bandwidth Control</h4>
                                        <div class="fs-7 text-muted">
                                            Upload / Download limits
                                        </div>
                                    </div>

                                </div>

                                <div class="row g-5">

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Download Rate
                                        </label>

                                        <input type="text" id="edit_download" name="download"
                                            class="form-control form-control-solid" placeholder="e.g. 20M">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Upload Rate
                                        </label>

                                        <input type="text" id="edit_upload" name="upload"
                                            class="form-control form-control-solid" placeholder="e.g. 10M">

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- ========================================== --}}
                        {{-- SESSION --}}
                        {{-- ========================================== --}}
                        <div class="tab-pane fade" id="profile_session_tab">

                            <div class="border border-gray-200 border-dashed rounded-3 p-6">

                                <div class="d-flex align-items-center mb-5">

                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-warning">
                                            <i class="ki-outline ki-time fs-2 text-warning"></i>
                                        </span>
                                    </div>

                                    <div>
                                        <h4 class="mb-0 text-gray-900">Session Control</h4>
                                        <div class="fs-7 text-muted">
                                            Login and usage restrictions
                                        </div>
                                    </div>

                                </div>

                                <div class="row g-5">

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Max Sessions
                                        </label>

                                        <input type="number" id="edit_max_sessions" name="max_sessions"
                                            class="form-control form-control-solid" placeholder="1">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Idle Timeout
                                        </label>

                                        <input type="number" id="edit_idle_timeout" name="idle_timeout"
                                            class="form-control form-control-solid" placeholder="300">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Auth Type
                                        </label>

                                        <input type="text" id="profile_edit_auth_type"
                                            name="profile_edit_auth_type" class="form-control form-control-solid"
                                            placeholder="Accept / Reject">

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label fw-semibold">
                                            Session Timeout
                                        </label>

                                        <input type="number" id="edit_session_timeout" name="edit_session_timeout"
                                            class="form-control form-control-solid" placeholder="86400">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-10 pb-8 pt-5">

                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="button" class="btn btn-primary" id="update_profile_btn">

                    <i class="ki-outline ki-check fs-5 me-1"></i>
                    Save Changes

                </button>

            </div>

        </div>

    </div>

</div>
