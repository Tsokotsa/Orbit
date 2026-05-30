<div class="modal fade" tabindex="-1" id="assetModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow rounded-4">

            <!-- HEADER -->
            <div class="modal-header border-bottom px-8 py-6 bg-white">
                <div>
                    <h2 class="fw-bold mb-1 text-gray-900">
                        Add New Asset
                    </h2>

                    <div class="text-muted fs-7">
                        Register and manage infrastructure assets
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary rounded-circle"
                    data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>
                </button>
            </div>

            <!-- BODY -->
            <div class="modal-body px-8 py-7 bg-white">

                <!-- LOADING -->
                <div id="assetLoading" class="text-center py-15 d-none">
                    <div class="spinner-border text-primary mb-5" style="width: 3rem; height: 3rem;">
                    </div>

                    <h4 class="fw-semibold mb-2">
                        Preparing asset form...
                    </h4>

                    <div class="text-muted">
                        Please wait while Orbit loads resources
                    </div>
                </div>

                <!-- CONTENT -->
                <div id="assetContent">

                    <form id="add_asset_form">

                        @csrf

                        <!-- BASIC -->
                        <div class="mb-10">

                            <div class="mb-6">
                                <h4 class="fw-bold text-gray-900 mb-1">
                                    Basic Information
                                </h4>

                                <div class="text-muted fs-7">
                                    Main identification details for this asset
                                </div>
                            </div>

                            <div class="row g-7">

                                <!-- SERIAL -->
                                <div class="col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">
                                        Asset Serial
                                    </label>

                                    <div class="position-relative">
                                        <input type="text" class="form-control form-control-solid form-control-lg"
                                            name="asset_serial" placeholder="e.g ORBIT-SW-001">

                                        <div class="position-absolute top-50 end-0 translate-middle-y me-4">
                                            <i class="ki-outline ki-barcode fs-2 text-gray-400"></i>
                                        </div>
                                    </div>

                                    <div class="text-muted fs-8 mt-2">
                                        Unique serial number or inventory code
                                    </div>
                                </div>

                                <!-- MEDIUM -->
                                <div class="col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">
                                        Medium
                                    </label>

                                    <select class="form-select form-select-solid form-select-lg" name="medium_id"
                                        data-control="select2" data-placeholder="Select medium"
                                        id="asset_medium_select">

                                        <option></option>

                                    </select>
                                </div>

                            </div>

                        </div>

                        <!-- DETAILS -->
                        <div class="mb-10">

                            <div class="mb-6">
                                <h4 class="fw-bold text-gray-900 mb-1">
                                    Asset Details
                                </h4>

                                <div class="text-muted fs-7">
                                    Vendor and model information
                                </div>
                            </div>

                            <div class="row g-7">

                                <!-- VENDOR -->
                                <div class="col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">
                                        Vendor
                                    </label>

                                    <select class="form-select form-select-solid" name="vendor_id"
                                        data-control="select2" data-placeholder="Select vendor"
                                        id="asset_vendor_select">

                                        <option></option>

                                    </select>
                                </div>

                                <!-- MODEL -->
                                <div class="col-md-6">
                                    <label class="required fw-semibold fs-6 mb-2">
                                        Asset Model
                                    </label>

                                    <select class="form-select form-select-solid" name="model_id" data-control="select2"
                                        data-placeholder="Select model" id="asset_model_select" disabled>

                                        <option></option>

                                    </select>

                                    <div class="text-muted fs-8 mt-2">
                                        Models are loaded based on selected vendor
                                    </div>
                                </div>

                            </div>

                        </div>

                        <!-- DESCRIPTION -->
                        <div class="mb-10">

                            <div class="mb-6">
                                <h4 class="fw-bold text-gray-900 mb-1">
                                    Description
                                </h4>
                            </div>

                            <textarea class="form-control form-control-solid" rows="4" name="asset_description"
                                placeholder="Short description, notes or technical details..."></textarea>

                        </div>

                        <!-- SETTINGS -->
                        <div class="border rounded-4 p-6 bg-light-secondary">

                            <div class="mb-6">
                                <h4 class="fw-bold text-gray-900 mb-1">
                                    Asset Settings
                                </h4>

                                <div class="text-muted fs-7">
                                    Configure status and notifications
                                </div>
                            </div>

                            <div class="d-flex flex-column gap-7">

                                <!-- ENABLE -->
                                <div class="d-flex justify-content-between align-items-center">

                                    <div>
                                        <div class="fw-semibold">
                                            Asset Enabled
                                        </div>

                                        <div class="text-muted fs-7">
                                            Disabled assets cannot be assigned
                                        </div>
                                    </div>

                                    <label class="form-check form-switch form-check-solid">
                                        <input class="form-check-input" type="checkbox" name="is_enabled" value="1"
                                            checked>

                                        <span class="form-check-label">
                                            Active
                                        </span>
                                    </label>

                                </div>

                                <!-- NOTIFICATIONS -->
                                <div class="d-flex justify-content-between align-items-center">

                                    <div>
                                        <div class="fw-semibold">
                                            Sales Notification
                                        </div>

                                        <div class="text-muted fs-7">
                                            Notify sales team after creation
                                        </div>
                                    </div>

                                    <div class="d-flex gap-6">

                                        <label class="form-check form-check-solid">
                                            <input class="form-check-input" type="checkbox" name="communication[]"
                                                value="email" checked>

                                            <span class="form-check-label">
                                                Email
                                            </span>
                                        </label>

                                        <label class="form-check form-check-solid">
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

                    </form>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="modal-footer border-top px-8 py-5 bg-white">

                <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                    Cancel
                </button>

                <button type="button" class="btn btn-primary px-8 add-asset-submit">

                    <i class="ki-outline ki-plus fs-3"></i>

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
