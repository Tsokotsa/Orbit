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
                <form class="form" id="add_model_form" method="POST" action="/add-model">
                    @csrf
                    <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Vendors</span>
                            <span class="ms-1" data-bs-toggle="tooltip"
                                aria-label="Make sure you select correct vendor"
                                data-bs-original-title="Make sure you select correct vendor" data-kt-initialized="1">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <select class="form-select" name="vendor_id" data-control="model_select" data-placeholder="Select Vendor ..."
                            id="vendorSelect">
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
                                data-bs-original-title="Multiple models will get same description" data-kt-initialized="1">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                            </span>
                        </label>
                        <input class="form-control fs-12" value="" name="vendor_model" id="vendor_model" placeholder="Type one or more models then press enter"/>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="model_desc" id="model_desc" maxlength="160"
                            style="min-height: 150px !important; max-height: 150px !important"></textarea>
                        <label class="fs-8" for="floatingTextarea2">Model short description... e.g: Wi-fi Router</label>
                    </div>
                </form>
            </div>
            <!-- End to -->

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add-vendor-submit">Add Model</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.add-vendor-submit').click(function(e) {
            //alert('olaaaaa');
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form_data = $('#add_model_form').serialize();
            $.ajax({
                type: "POST",
                url: "/vendor_model/add",
                data: form_data, // serializes the form's elements.
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
                    var responseJson = JSON.parse(xhr.responseText);
                    // Access the message property from the response
                    var errorMessage = responseJson.message;
                    // Display error message
                    // alert('Error: ' + errorMessage);
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
                        title: "Erro: " + errorMessage
                    });
                },

            });

        });
    </script>
@endpush
