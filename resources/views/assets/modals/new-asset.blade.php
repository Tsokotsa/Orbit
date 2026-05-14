<div class="modal fade" tabindex="-1" id="assetModal">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px" data-select2-id="select2-data-110-ebbj">
        <!--begin::Modal content-->
        <div class="modal-content rounded" data-select2-id="select2-data-109-gla0">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">

                <!-- Loading -->
                <div id="assetLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <div class="mt-2">Loading Orbit asset....</div>
                </div>
                <!-- Content (hidden until ready) -->
                <div id="assetContent" class="d-none">
                    <!--begin:Form-->
                    <form id="add_asset_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                        data-select2-id="select2-data-kt_modal_new_target_form">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Add Asset</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-semibold fs-5">If vendor is not listed you need to
                                <a href="#" class="fw-bold link-primary">Add Vendor first</a>.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Asset Serial</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Avoid spaces while typing"
                                    data-bs-original-title="Avoid spaces while typing" data-kt-initialized="1">
                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <div class="position-relative">
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid"
                                    placeholder="Enter asset s/n" name="asset_serial">
                                <!--end::Input-->
                                <!--begin::CVV icon-->
                                <div class="position-absolute translate-middle-y top-50 end-0 me-3">
                                    <i class="ki-outline ki-barcode fs-2hx"></i>
                                </div>
                                <!--end::CVV icon-->
                            </div>
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8" data-select2-id="select2-data-108-soyj">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Vendor</label>
                                <select class="form-select" name="vendor_id" data-control="asset_select_vendor"
                                    data-placeholder="Select Vendor ..." id="asset_vendor_select">
                                    <option></option>
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Medium</label>
                                <select class="form-select" name="medium_id" data-control="asset_select_medium"
                                    data-placeholder="Select Medium ..." id="asset_medium_select">
                                    <option></option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-semibold mb-2">Asset Description</label>
                            <textarea class="form-control form-control-solid" rows="3" name="asset_description"
                                placeholder="Some short description"></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-stack mb-8">
                            <!--begin::Label-->
                            <div class="me-5">
                                <label class="fs-6 fw-semibold">Asset is enabled</label>
                                <div class="fs-7 fw-semibold text-muted">Disabled assets cant be allocated to clients
                                </div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" checked="checked">
                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                            </label>
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-15 fv-row">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="fw-semibold me-5">
                                    <label class="fs-6">Notify Sales Team</label>
                                    <div class="fs-7 text-muted">For asset creation</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Checkboxes-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px" type="checkbox"
                                            name="communication[]" value="email" checked="checked">
                                        <span class="form-check-label fw-semibold">Email</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input h-20px w-20px" type="checkbox"
                                            name="communication[]" value="phone">
                                        <span class="form-check-label fw-semibold">SMS</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Checkboxes-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="kt_modal_new_target_submit"
                                class="btn btn-primary add-asset-submit">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>

            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
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
                        url: "/assets/store",
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
    </script>
@endpush
