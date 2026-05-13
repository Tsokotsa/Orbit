<div class="modal fade" tabindex="-1" id="modelModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New Model</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-8">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Pay attention!</h4>
                            <div class="fs-8 text-gray-700">Make sure you bind the model to the correct Vendor
                                <a class="fw-bold" href="#">New Vendor</a>.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--begin::Input group-->

                <div class="modal-body">
                    <div id="vendorLoading" class="text-center py-5">
                        <div class="spinner-border text-primary" role="status"></div>
                        <div class="mt-2">Loading Orbit vendors…</div>
                    </div>

                    <div id="vendorContent" class="d-none">
                        <form class="form" id="add_model_form" method="POST" action="/add-model">
                            @csrf
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Vendors</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Make sure you select correct vendor"
                                        data-bs-original-title="Make sure you select correct vendor"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <select class="form-select" name="vendor_id" data-control="model_select"
                                    data-placeholder="Select Vendor ..." id="vendorSelect">
                                    <option></option>
                                </select>
                                <div
                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                </div>
                            </div>

                            <div class="mb-10">
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Vendors Model</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Multiple models will get same description"
                                        data-bs-original-title="Multiple models will get same description"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </label>
                                <input class="form-control fs-12" value="" name="vendor_model" id="vendor_model"
                                    placeholder="Type one or more models then press enter" />
                            </div>

                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" name="model_desc" id="model_desc" maxlength="160"
                                    style="min-height: 150px !important; max-height: 150px !important"></textarea>
                                <label class="fs-8" for="floatingTextarea2">Model short description... e.g: Wi-fi
                                    Router</label>
                            </div>
                        </form>
                    </div>
                </div>



            </div>
            <!-- End to -->

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-model-submit">Add Model</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.add-model-submit').click(function(e) {

            e.preventDefault();

            Swal.fire({
                text: "Are you sure you want to add this Model?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, add!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-primary",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {

                if (result.value) {

                    var form_data = $('#add_model_form').serialize();

                    $.ajax({
                        type: "POST",
                        url: "/models/add",
                        data: form_data,

                        success: function(response) {

                            Swal.fire({
                                text: response.message,
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            }).then(function() {
                                location.reload(); // optional
                            });

                        },

                        error: function(xhr) {

                            var responseJson = JSON.parse(xhr.responseText);
                            var errorMessage = responseJson.message ?? "Something went wrong.";

                            Swal.fire({
                                text: errorMessage,
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn fw-bold btn-primary"
                                }
                            });
                        }
                    });

                } else if (result.dismiss === 'cancel') {

                    Swal.fire({
                        text: "Model was not added.",
                        icon: "error",
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
