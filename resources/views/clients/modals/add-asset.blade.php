<div class="modal fade" tabindex="-1" id="add_asset_modal">

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
                            Add Asset
                        </h2>

                        <div class="text-muted fs-7">
                            Assign an asset to the customer account
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-secondary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body px-8 py-7">

                <form method="POST" id="asset-form">

                    @csrf

                    <input type="hidden" id="cid" name="client_id" value="{{ $cid }}">
                    <input type="hidden" id="asset_id" name="asset_id">

                    {{-- INFORMATION --}}
                    <div class="alert alert-light-primary d-flex align-items-center mb-7">

                        <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>

                        <div>

                            <div class="fw-bold">
                                Asset Assignment
                            </div>

                            <div class="text-muted fs-7">
                                Search for an existing asset and assign it to the selected customer account.
                            </div>

                        </div>

                    </div>

                    <div class="row g-6">

                        {{-- SEARCH ASSET --}}
                        <div class="col-12">

                            <label class="required form-label fw-semibold">
                                Search Asset
                            </label>

                            <div class="position-relative">

                                <span class="position-absolute top-50 translate-middle-y ms-4">

                                    <i class="ki-duotone ki-magnifier fs-2 text-gray-500">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>

                                </span>

                                <input type="text" id="asset-search" class="form-control ps-13" name="asset_serial"
                                    placeholder="Search by serial number or asset name..." autocomplete="off">

                                <div id="asset-suggestions" class="list-group position-absolute w-100 shadow-sm"
                                    style="z-index:1056;display:none;">
                                </div>

                            </div>

                        </div>

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

                                <input type="text" class="form-control" name="asset_name" id="asset_name" readonly>

                            </div>

                        </div>

                        {{-- DESCRIPTION --}}
                        <div class="col-md-4">

                            <label class="required form-label fw-semibold">
                                Description
                            </label>

                            <input type="text" class="form-control" name="asset_description" id="asset_description"
                                readonly>

                        </div>

                        {{-- MODEL --}}
                        <div class="col-md-12">

                            <label class="required form-label fw-semibold">
                                Vendor Model
                            </label>

                            <select id="vendor_model" name="vendor_model" class="form-select" data-control="select2"
                                data-placeholder="Select Vendor Model" disabled>

                                <option></option>

                            </select>

                        </div>

                        {{-- ENABLED --}}
                        <div class="col-md-6">

                            <div class="border rounded p-5 h-100">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <div class="fw-bold">
                                            Asset Enabled
                                        </div>

                                        <div class="text-muted fs-7">
                                            Asset can be used and assigned to services.
                                        </div>

                                    </div>

                                    <label class="form-check form-switch form-check-solid">

                                        <input class="form-check-input" type="checkbox" name="asset_enabled"
                                            value="y" checked>

                                    </label>

                                </div>

                            </div>

                        </div>

                        {{-- TRANSFER --}}
                        <div class="col-md-6">

                            <div class="border rounded p-5 h-100">

                                <div class="d-flex justify-content-between align-items-center">

                                    <div>

                                        <div class="fw-bold">
                                            Prevent Transfer
                                        </div>

                                        <div class="text-muted fs-7">
                                            Prevent this asset from being transferred to another account.
                                        </div>

                                    </div>

                                    <label class="form-check form-switch form-check-solid">

                                        <input class="form-check-input" type="checkbox" name="asset_transfer"
                                            value="y">

                                    </label>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- WARNING --}}
                    <div class="alert alert-light-warning d-flex align-items-center mt-7 mb-0">

                        <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>

                        <div>

                            <div class="fw-bold">
                                Important
                            </div>

                            <div class="text-muted fs-7">
                                Once assigned, the asset becomes associated with this customer account and may be used
                                for service provisioning and billing.
                            </div>

                        </div>

                    </div>

                </form>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-top px-8 py-5">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" class="btn btn-primary add-asset-click">

                    <i class="ki-duotone ki-check fs-4 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>

                    Save Asset

                </button>

            </div>

        </div>

    </div>

</div>
