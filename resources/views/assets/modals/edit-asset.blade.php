<div class="modal fade" tabindex="-1" id="editAssetModal">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content border-0 shadow-sm">

            {{-- HEADER --}}
            <div class="modal-header border-bottom px-8 py-6">

                <div class="d-flex align-items-center">

                    <div class="symbol symbol-50px me-4">

                        <div class="symbol-label bg-light-primary">

                            <i class="ki-duotone ki-package fs-2 text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>

                        </div>

                    </div>

                    <div>

                        <h2 class="fw-bold mb-1">
                            Edit Asset
                        </h2>

                        <div class="text-muted fs-7">
                            Update asset information, ownership and operational settings
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-secondary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body px-8 py-7">

                {{-- LOADING --}}
                <div id="editAssetLoading" class="text-center py-15">

                    <div class="spinner-border text-primary mb-5" style="width:3rem;height:3rem;">
                    </div>

                    <div class="fw-semibold fs-6 text-muted">
                        Loading asset information...
                    </div>

                </div>

                {{-- CONTENT --}}
                <div id="editAssetContent" class="d-none">

                    <form id="edit_asset_form">

                        @csrf

                        <input type="hidden" name="asset_id" id="edit_asset_id">

                        {{-- INFO ALERT --}}
                        <div class="alert alert-light-primary d-flex align-items-center mb-7">

                            <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>

                            <div>

                                <div class="fw-bold">
                                    Asset Information
                                </div>

                                <div class="text-muted fs-7">
                                    Update the details below and save your changes.
                                </div>

                            </div>

                        </div>

                        <div class="row g-6">

                            {{-- ASSET NAME --}}
                            <div class="col-md-8">

                                <label class="required form-label fw-semibold">
                                    Asset Name
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="ki-duotone ki-package fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </span>

                                    <input type="text" class="form-control" name="edit_asset_name"
                                        id="edit_asset_name" placeholder="Enter asset name">

                                </div>

                            </div>

                            {{-- SERIAL --}}
                            <div class="col-md-4">

                                <label class="required form-label fw-semibold">
                                    Asset Serial
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="ki-duotone ki-barcode fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>

                                    <input type="text" class="form-control" name="serial"
                                        placeholder="Serial Number">

                                </div>

                            </div>

                            {{-- VENDOR --}}
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Vendor
                                </label>

                                <select class="form-select" name="vendor_id" id="edit_vendor_id" data-control="select2"
                                    data-placeholder="Select vendor" data-dropdown-parent="#editAssetModal">

                                    <option></option>

                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">
                                            {{ $vendor->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- MEDIUM --}}
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Medium
                                </label>

                                <select class="form-select" name="medium_id" id="edit_medium_id" data-control="select2"
                                    data-placeholder="Select medium" data-dropdown-parent="#editAssetModal">

                                    <option></option>

                                    @foreach ($mediums as $medium)
                                        <option value="{{ $medium->id }}">
                                            {{ $medium->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            {{-- MODEL --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Model
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        <i class="ki-duotone ki-setting-2 fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>

                                    <input type="text" class="form-control" id="edit_model_display" readonly>

                                </div>

                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Asset Status
                                </label>

                                <div class="border rounded p-4 h-100">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="fw-bold">
                                                Active Asset
                                            </div>

                                            <div class="text-muted fs-7">
                                                Asset available for assignments
                                            </div>

                                        </div>

                                        <label class="form-check form-switch form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="is_enabled"
                                                value="y" id="edit_is_enabled">

                                        </label>

                                    </div>

                                </div>

                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Description
                                </label>

                                <textarea class="form-control" rows="5" name="description"
                                    placeholder="Additional information about this asset..."></textarea>

                            </div>

                        </div>

                        {{-- STATUS ALERT --}}
                        <div class="alert alert-light-warning d-flex align-items-center mt-7 mb-0">

                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>

                            <div>

                                <div class="fw-bold">
                                    Important
                                </div>

                                <div class="fs-7 text-muted">
                                    Disabling an asset will prevent it from being assigned
                                    to customers, projects and operational activities.
                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-top px-8 py-5">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" class="btn btn-primary" id="submit_edit_asset">

                    <span class="indicator-label">

                        <i class="ki-duotone ki-check fs-4 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>

                        Save Changes

                    </span>

                    <span class="indicator-progress">

                        Please wait...

                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span>

                    </span>

                </button>

            </div>

        </div>

    </div>

</div>
