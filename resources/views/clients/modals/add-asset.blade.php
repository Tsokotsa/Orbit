<div class="modal fade" tabindex="-1" id="add_asset_modal">
    <div class="modal-dialog mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add Asset</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body">
                <form method="POST" id="asset-form">
                    @csrf

                    <input type="hidden" id="cid" name="client_id" value="{{ $cid }}">
                    <input type="hidden" id="asset_id" name="asset_id">
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Asset S/N</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Start type and should autocomplete"
                                data-bs-original-title="Start type and should autocomplete" data-kt-initialized="1">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        {{-- <input type="text" class="form-control form-control-solid" placeholder="Start typing..." name="target_title"> --}}

                        <div class="position-relative">
                            <input type="text" id="asset-search" class="form-control" name="asset_serial"
                                placeholder="Start typing asset name…" autocomplete="off">

                            <div id="asset-suggestions" class="list-group position-absolute w-100 shadow"
                                style="z-index: 1056; display:none;">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 text-start">
                            <label class="required fs-5 fw-semibold mb-2 text-left">Asset Name</label>
                            <input type="text" class="form-control form-control-solid" placeholder=""
                                name="asset_name" id="asset_name" readonly>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="col-md-6 text-start">
                            <label class="required fs-5 fw-semibold mb-2 text-left">Asset Description</label>
                            <input type="text" class="form-control form-control-solid" placeholder=""
                                name="asset_description" id="asset_description" readonly>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-5 text-start">
                        <div class="col-md-12">
                            <label class="required fs-5 fw-semibold mb-2 text-left">Choose Model</label>

                            <select id="vendor_model" name="vendor_model" class="form-select" data-control="select2"
                                data-placeholder="Vendor Model" disabled>
                            </select>

                        </div>

                    </div>
                    <div class="row mb-5">
                        <div class="col-md-6 text-start">
                            <div class="d-flex flex-stack">
                                <div class="me-5 text-start">
                                    <label class="fs-6 fw-semibold form-label">Is asset enabled?</label>
                                    <div class="fs-7 fw-semibold text-muted">You can change services while
                                        disabled
                                    </div>
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="asset_enabled"
                                            value="y" checked="checked">
                                        <span class="form-check-label fw-semibold text-muted">Enabled</span>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 text-start">
                            <div class="d-flex flex-stack">
                                <div class="me-5 text-start">
                                    <label class="fs-6 fw-semibold form-label">Prevent Transfer</label>
                                    <div class="fs-7 fw-semibold text-muted">Can asset be transfered to another
                                        acc
                                    </div>
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="asset_transfer"
                                            value="y">
                                        <span class="form-check-label fw-semibold text-muted">Yes</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer justify-content-center mt-12">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary add-asset-click">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
