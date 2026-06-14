<div class="modal fade" tabindex="-1" id="assetModal">

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
                            Add New Asset
                        </h2>

                        <div class="text-muted fs-7">
                            Register a new infrastructure asset in Orbit
                        </div>

                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-secondary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body px-8 py-7 bg-white">

                {{-- LOADING --}}
                <div id="assetLoading" class="text-center py-15 d-none">

                    <div class="spinner-border text-primary mb-5" style="width:3rem;height:3rem;">
                    </div>

                    <div class="fw-semibold fs-6 text-muted">
                        Preparing asset form...
                    </div>

                </div>

                {{-- CONTENT --}}
                <div id="assetContent">

                    <form id="add_asset_form">

                        @csrf

                        {{-- INFORMATION --}}
                        <div class="alert alert-light-primary d-flex align-items-center mb-7">

                            <i class="ki-duotone ki-information-5 fs-2hx text-primary me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>

                            <div>

                                <div class="fw-bold">
                                    Asset Registration
                                </div>

                                <div class="text-muted fs-7">
                                    Complete the information below to register a new asset in the inventory.
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

                                    <input type="text" class="form-control" name="asset_name"
                                        placeholder="e.g Core Router, GPON OLT, Cisco Switch">

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

                                    <input type="text" class="form-control" name="asset_serial"
                                        placeholder="Asset Serial">

                                </div>

                            </div>

                            {{-- VENDOR --}}
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Vendor
                                </label>

                                <select class="form-select" name="vendor_id" id="asset_vendor_select"
                                    data-control="select2" data-placeholder="Select Vendor"
                                    data-dropdown-parent="#assetModal">

                                    <option></option>

                                </select>

                            </div>

                            {{-- MEDIUM --}}
                            <div class="col-md-6">

                                <label class="required form-label fw-semibold">
                                    Medium
                                </label>

                                <select class="form-select" name="medium_id" id="asset_medium_select"
                                    data-control="select2" data-placeholder="Select Medium"
                                    data-dropdown-parent="#assetModal">

                                    <option></option>

                                </select>

                            </div>

                            {{-- MODEL --}}
                            <div class="col-md-12">

                                <label class="required form-label fw-semibold">
                                    Asset Model
                                </label>

                                <select class="form-select" name="model_id" id="asset_model_select"
                                    data-control="select2" data-placeholder="Select Asset Model"
                                    data-dropdown-parent="#assetModal" disabled>

                                    <option></option>

                                </select>

                                <div class="text-muted fs-7 mt-2">
                                    Models are automatically loaded after selecting a vendor.
                                </div>

                            </div>

                            {{-- DESCRIPTION --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Description
                                </label>

                                <textarea class="form-control" rows="5" name="asset_description"
                                    placeholder="Technical notes, specifications or additional information..."></textarea>

                            </div>

                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Asset Status
                                </label>

                                <div class="border rounded p-5 h-100">

                                    <div class="d-flex justify-content-between align-items-center">

                                        <div>

                                            <div class="fw-bold">
                                                Asset Enabled
                                            </div>

                                            <div class="text-muted fs-7">
                                                Disabled assets cannot be assigned.
                                            </div>

                                        </div>

                                        <label class="form-check form-switch form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="is_enabled"
                                                value="1" checked>

                                        </label>

                                    </div>

                                </div>

                            </div>

                            {{-- NOTIFICATIONS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Sales Notification
                                </label>

                                <div class="border rounded p-5 h-100">

                                    <div class="mb-4">

                                        <div class="fw-bold">
                                            Notify Sales Team
                                        </div>

                                        <div class="text-muted fs-7">
                                            Send notifications after asset creation.
                                        </div>

                                    </div>

                                    <div class="d-flex gap-6">

                                        <label class="form-check form-check-custom form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="communication[]"
                                                value="email" checked>

                                            <span class="form-check-label">
                                                Email
                                            </span>

                                        </label>

                                        <label class="form-check form-check-custom form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="communication[]"
                                                value="sms">

                                            <span class="form-check-label">
                                                SMS
                                            </span>

                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- FOOTER ALERT --}}
                        <div class="alert alert-light-warning d-flex align-items-center mt-7 mb-0">

                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>

                            <div>

                                <div class="fw-bold">
                                    Inventory Notice
                                </div>

                                <div class="text-muted fs-7">
                                    Ensure the serial number is unique before creating the asset. Duplicate serials may
                                    cause inventory and assignment issues.
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

                <button type="button" class="btn btn-primary add-asset-submit">

                    <i class="ki-duotone ki-plus fs-4 me-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>

                    Create Asset

                </button>

            </div>

        </div>

    </div>

</div>


@push('scripts')
    <script>
        $('.add-asset-submit').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Show confirmation first
            Swal.fire({
                text: "Are you sure you want to add this asset?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, add it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-success",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    // User confirmed → proceed with AJAX
                    var form_data = $('#add_asset_form').serialize();

                    $.ajax({
                        type: "POST",
                        url: "/asset/store",
                        data: form_data,
                        success: function(response) {
                            Swal.fire({
                                title: "Good job!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        },
                        error: function(xhr, status, error) {
                            let responseJson = {};
                            try {
                                responseJson = JSON.parse(xhr.responseText);
                            } catch (e) {
                                responseJson.message = "Something went wrong";
                            }

                            let errorMessage = responseJson.message || "Something went wrong";

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });

                            Toast.fire({
                                icon: "error",
                                title: "Error: " + errorMessage
                            });
                        }
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User cancelled
                    Swal.fire({
                        text: "Asset was not added.",
                        icon: "info",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            });
        });

        $(document).on('change', '#asset_vendor_select', function() {

            let vendorId = $(this).val();

            $('#asset_model_select')
                .prop('disabled', true)
                .html('<option></option>');

            if (!vendorId) {
                return;
            }

            $.ajax({
                url: '/asset/models/' + vendorId,
                type: 'GET',

                success: function(response) {

                    let options = '<option></option>';

                    response.models.forEach(function(model) {

                        options += `
                    <option value="${model.id}">
                        ${model.name}
                    </option>
                `;
                    });

                    $('#asset_model_select')
                        .html(options)
                        .prop('disabled', false)
                        .trigger('change');
                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        title: 'Failed',
                        text: 'Could not load vendor models'
                    });
                }
            });
        });
    </script>
@endpush
