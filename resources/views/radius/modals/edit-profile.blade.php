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

                    {{-- ================================================== --}}
                    {{-- PROFILE IDENTITY --}}
                    {{-- ================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-profile-user fs-2 text-primary"></i>
                                </span>
                            </div>

                            <div>
                                <h4 class="mb-0 text-gray-900">Profile Identity</h4>
                                <div class="fs-7 text-muted">Name and assignment group</div>
                            </div>

                        </div>

                        <div class="row g-5">

                            <div class="col-md-12">

                                <label class="form-label fw-semibold">Profile Name</label>

                                <input type="text" id="edit_profile_name" name="groupname"
                                    class="form-control form-control-solid" placeholder="e.g. GOLD, SILVER, BUSINESS">

                            </div>

                        </div>

                    </div>

                    {{-- ================================================== --}}
                    {{-- BANDWIDTH CONTROL --}}
                    {{-- ================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-outline ki-speedometer fs-2 text-success"></i>
                                </span>
                            </div>

                            <div>
                                <h4 class="mb-0 text-gray-900">Bandwidth Control</h4>
                                <div class="fs-7 text-muted">Upload / Download limits (MikroTik format)</div>
                            </div>

                        </div>

                        <div class="row g-5">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Download Rate</label>

                                <input type="text" id="edit_download" name="download"
                                    class="form-control form-control-solid" placeholder="e.g. 20M/20M">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Upload Rate</label>

                                <input type="text" id="edit_upload" name="upload"
                                    class="form-control form-control-solid" placeholder="e.g. 10M/10M">

                            </div>

                        </div>

                    </div>

                    {{-- ================================================== --}}
                    {{-- SESSION & LIMITS --}}
                    {{-- ================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-outline ki-time fs-2 text-warning"></i>
                                </span>
                            </div>

                            <div>
                                <h4 class="mb-0 text-gray-900">Session Control</h4>
                                <div class="fs-7 text-muted">Login and usage restrictions</div>
                            </div>

                        </div>

                        <div class="row g-5">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Max Sessions</label>

                                <input type="number" id="edit_max_sessions" name="max_sessions"
                                    class="form-control form-control-solid" placeholder="1">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">Idle Timeout (seconds)</label>

                                <input type="number" id="edit_idle_timeout" name="idle_timeout"
                                    class="form-control form-control-solid" placeholder="300">

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
