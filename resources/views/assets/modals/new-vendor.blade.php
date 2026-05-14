<div class="modal fade" tabindex="-1" id="vendorModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Add New vendor</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed p-6 mb-8">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Pay attention!</h4>
                            <div class="fs-8 text-gray-700">Make sure you not duplicating Vendors
                                <a class="fw-bold" href="#">Show Existing Vendors</a>.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--begin::Input group-->
                <form class="form" id="add_vendor_form" method="POST" action="/add-vendor"
                    enctype="multipart/form-data">
                    @csrf
                    <!--begin::Image input-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-4">
                        <span class="required">Vendor Logo</span>
                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Default logo will be paratus"
                            data-bs-original-title="Default logo will be paratus" data-kt-initialized="1">
                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                        </span>
                    </label>
                    <div class="image-input image-input-circle mb-4" data-kt-image-input="true"
                        style="background-image: url(/assets/media/svg/avatars/blank.svg)">
                        <!--begin::Image preview wrapper-->
                        <div class="image-input-wrapper w-125px h-125px"
                            style="background-image: url(/assets/media/logos/Paratus_P_Only.png"></div>
                        <!--end::Image preview wrapper-->

                        <!--begin::Edit button-->
                        <label
                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                            title="Change avatar">
                            <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                    class="path2"></span></i>

                            <!--begin::Inputs-->
                            <input type="file" name="avatar" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Edit button-->

                        <!--begin::Cancel button-->
                        <span
                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                            title="Cancel logo">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Cancel button-->

                        <!--begin::Remove button-->
                        <span
                            class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                            data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                            title="Remove logo">
                            <i class="ki-outline ki-cross fs-3"></i>
                        </span>
                        <!--end::Remove button-->
                    </div>
                    <!--end::Image input-->

                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Vendors</span>
                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Default logo will be paratus"
                                data-bs-original-title="Default logo will be paratus" data-kt-initialized="1">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <input class="form-control fs-12" value="" name="vendor_name" id="vendor_name"
                            placeholder="Vendor name" />
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>


                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="vendor_desc" id="vendor_desc" maxlength="160"
                            style="min-height: 150px !important; max-height: 150px !important"></textarea>
                        <label class="fs-8" for="floatingTextarea2">Vendor description... e.g: Paratus</label>
                    </div>
                </form>
            </div>
            <!-- End to -->

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-vendor-submit">Add Vendor</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.add-vendor-submit').click(function(e) {

            e.preventDefault();

            Swal.fire({
                text: "Are you sure you want to add this vendor?",
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

                    //var form_data = $('#add_vendor_form').serialize();
                    let form = document.getElementById('add_vendor_form');
                    let formData = new FormData(form);

                    $.ajax({
                        url: '/vendors/add',
                        type: 'POST',
                        data: formData,
                        processData: false, // VERY IMPORTANT
                        contentType: false, // 

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
                        text: "Vendor was not added.",
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
