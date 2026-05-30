<div class="modal fade" tabindex="-1" id="editAssetModal">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content border-0 rounded-4 shadow-sm">

            <!-- HEADER -->
            <div class="modal-header border-0 px-8 py-6">

                <div>

                    <h2 class="fw-bold mb-1">
                        Edit Asset
                    </h2>

                    <div class="text-muted fs-7">
                        Update asset information and settings
                    </div>

                </div>

                <button type="button" class="btn btn-sm btn-icon btn-light" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            <!-- BODY -->
            <div class="modal-body px-8 py-6">

                <!-- LOADING -->
                <div id="editAssetLoading" class="text-center py-15">

                    <div class="spinner-border text-primary mb-5" style="width:3rem;height:3rem;">
                    </div>

                    <div class="fw-semibold fs-6">
                        Loading asset details...
                    </div>

                </div>

                <!-- CONTENT -->
                <div id="editAssetContent" class="d-none">

                    <form id="edit_asset_form">

                        @csrf

                        <input type="hidden" name="asset_id" id="edit_asset_id">

                        <div class="row g-7">

                            <!-- SERIAL -->
                            <div class="col-md-6">

                                <label class="required fw-semibold fs-6 mb-2">
                                    Asset Serial
                                </label>

                                <input type="text" class="form-control form-control-solid" name="serial">

                            </div>

                            <!-- MEDIUM -->
                            <div class="col-md-6">

                                <label class="required fw-semibold fs-6 mb-2">
                                    Medium
                                </label>

                                <select class="form-select form-select-solid" name="medium_id" id="edit_medium_id"
                                    data-control="select2" data-dropdown-parent="#editAssetModal">

                                    @foreach ($mediums as $medium)
                                        <option value="{{ $medium->id }}">
                                            {{ $medium->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <!-- VENDOR -->
                            <div class="col-md-6">

                                <label class="required fw-semibold fs-6 mb-2">
                                    Vendor
                                </label>

                                <select class="form-select form-select-solid" name="vendor_id" id="edit_vendor_id"
                                    data-control="select2" data-dropdown-parent="#editAssetModal">

                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}">
                                            {{ $vendor->name }}
                                        </option>
                                    @endforeach

                                </select>

                            </div>

                            <!-- MODEL -->
                            <div class="col-md-6">

                                <label class="required fw-semibold fs-6 mb-2">
                                    Model
                                </label>
                                <input type="text" class="form-control form-control-solid" id="edit_model_display">

                            </div>

                            <!-- DESCRIPTION -->
                            <div class="col-12">

                                <label class="fw-semibold fs-6 mb-2">
                                    Description
                                </label>

                                <textarea class="form-control form-control-solid" rows="4" name="description"></textarea>

                            </div>

                            <!-- STATUS -->
                            <div class="col-12">

                                <div class="border rounded-3 p-5 bg-light">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="fw-bold">
                                                Asset Status
                                            </div>

                                            <div class="text-muted fs-7">
                                                Disabled assets cannot be assigned
                                            </div>

                                        </div>

                                        <label class="form-check form-switch form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="is_enabled"
                                                value="y" id="edit_is_enabled">

                                            <span class="form-check-label">
                                                Active
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-0 px-8 py-5">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" class="btn btn-primary" id="submit_edit_asset">

                    <span class="indicator-label">
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
