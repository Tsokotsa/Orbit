<div class="modal fade" id="kt_modal_edit_product" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content border-0 shadow-sm rounded-4 overflow-hidden">

            <form id="editProductForm">

                @csrf

                <input type="hidden" name="product_id" id="edit_product_id">

                <!--begin::Header-->
                <div class="modal-header border-0 px-10 pt-8 pb-5">

                    <div>

                        <div class="d-flex align-items-center gap-3 mb-2">

                            <div
                                class="symbol symbol-50px bg-light-primary rounded-circle d-flex align-items-center justify-content-center">

                                <i class="ki-outline ki-package fs-1 text-primary"></i>

                            </div>

                            <div>

                                <h2 class="fw-bold mb-1">
                                    Edit Product
                                </h2>

                                <div class="text-muted fs-6">
                                    Manage package settings and service attributes
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="btn btn-sm btn-icon btn-light-primary rounded-circle" data-bs-dismiss="modal">

                        <i class="ki-outline ki-cross fs-2"></i>

                    </div>

                </div>
                <!--end::Header-->



                <!--begin::Body-->
                <div class="modal-body px-10 py-5">

                    <div class="row g-7">

                        <!--begin::General Information-->
                        <div class="col-lg-8">

                            <div class="card card-bordered border-gray-200 rounded-4 h-100">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            General Information
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <div class="row g-6">

                                        <!-- Product Name -->
                                        <div class="col-12">

                                            <label class="required form-label fw-semibold">
                                                Product Name
                                            </label>

                                            <input type="text" name="name" id="edit_name"
                                                class="form-control form-control-solid form-control-lg"
                                                placeholder="Enter product name" required>

                                        </div>

                                        <!-- Description -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Description
                                            </label>

                                            <textarea name="description" id="edit_description" rows="5" class="form-control form-control-solid"
                                                placeholder="Add product or package description..."></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::General Information-->



                        <!--begin::Pricing-->
                        <div class="col-lg-4">

                            <div class="card card-bordered border-gray-200 rounded-4 h-100">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            Pricing
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <!-- Price -->
                                    <div class="mb-6">

                                        <label class="required form-label fw-semibold">
                                            Monthly Price
                                        </label>

                                        <div class="input-group input-group input-group-lg">

                                            <span class="input-group-text fw-bold">
                                                MZN
                                            </span>

                                            <input type="number" step="0.01" name="price" id="edit_price"
                                                class="form-control" placeholder="0.00" required>

                                        </div>

                                    </div>

                                    <!-- Download -->
                                    <div class="mb-6">

                                        <label class="form-label fw-semibold">
                                            Download Speed
                                        </label>

                                        <div class="input-group input-group-solid">

                                            <input type="text" id="edit_download_speed"
                                                class="form-control form-control-solid fw-bold" readonly>

                                            <span class="input-group-text">
                                                Mbps
                                            </span>

                                        </div>

                                    </div>

                                    <!-- Upload -->
                                    <div>

                                        <label class="form-label fw-semibold">
                                            Upload Speed
                                        </label>

                                        <div class="input-group input-group-solid">

                                            <input type="text" id="edit_upload_speed"
                                                class="form-control form-control-solid fw-bold" readonly>

                                            <span class="input-group-text">
                                                Mbps
                                            </span>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::Pricing-->



                        <!--begin::Service Settings-->
                        <div class="col-12">

                            <div class="card card-bordered border-gray-200 rounded-4">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            Service Settings
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <div class="row g-6">

                                        <!-- Billing -->
                                        <div class="col-md-4">

                                            <label class="form-label fw-semibold">
                                                Billing Type
                                            </label>

                                            <select name="is_prepaid" id="edit_is_prepaid"
                                                class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true" data-placeholder="Select Billing Type"
                                                data-dropdown-parent="#kt_modal_edit_product">

                                                <option></option>

                                                <option value="n">
                                                    Postpaid
                                                </option>

                                                <option value="y">
                                                    Prepaid
                                                </option>

                                            </select>

                                        </div>



                                        <!-- Public IP -->
                                        <div class="col-md-4">

                                            <label class="form-label fw-semibold">
                                                Public IP
                                            </label>

                                            <select name="public_ip" id="edit_public_ip"
                                                class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true" data-placeholder="Select Option"
                                                data-dropdown-parent="#kt_modal_edit_product">

                                                <option></option>

                                                <option value="n">
                                                    No
                                                </option>

                                                <option value="y">
                                                    Yes
                                                </option>

                                            </select>

                                        </div>



                                        <!-- Status -->
                                        <div class="col-md-4">

                                            <label class="form-label fw-semibold">
                                                Status
                                            </label>

                                            <select name="active" id="edit_active"
                                                class="form-select form-select-solid" data-control="select2"
                                                data-hide-search="true" data-placeholder="Select Status"
                                                data-dropdown-parent="#kt_modal_edit_product">

                                                <option></option>

                                                <option value="y">
                                                    Active
                                                </option>

                                                <option value="n">
                                                    Inactive
                                                </option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::Service Settings-->

                    </div>

                </div>
                <!--end::Body-->



                <!--begin::Footer-->
                <div class="modal-footer border-0 px-10 py-7">

                    <button type="button" class="btn btn-light btn-active-light-primary px-7"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" class="btn btn-primary px-8">

                        <i class="ki-outline ki-check fs-2"></i>

                        <span class="indicator-label">
                            Update Product
                        </span>

                    </button>

                </div>
                <!--end::Footer-->

            </form>

        </div>

    </div>

</div>

@push('scripts')
    <script>
        $(document).on('click', '.edit-product-btn', function() {

            let productId = $(this).data('id');

            /*
            |--------------------------------------------------------------------------
            | LOADING STATE
            |--------------------------------------------------------------------------
            */

            Swal.fire({
                text: 'Loading product details...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            /*
            |--------------------------------------------------------------------------
            | FETCH PRODUCT
            |--------------------------------------------------------------------------
            */

            $.ajax({

                url: `/product/${productId}`,

                type: 'GET',

                success: function(response) {

                    let product = response.data;

                    /*
                    |--------------------------------------------------------------------------
                    | POPULATE FORM
                    |--------------------------------------------------------------------------
                    */

                    $('#edit_product_id').val(product.id);

                    $('#edit_name').val(product.name);

                    $('#edit_description').val(product.description);

                    $('#edit_price').val(product.price);

                    $('#edit_speed')
                        .val(product.speed_id)
                        .trigger('change');

                    $('#edit_public_ip').val(product.public_ip);

                    $('#edit_active').val(product.active);

                    $('#edit_is_prepaid').val(product.is_prepaid);

                    $('#edit_download_speed').val(product.d_speed);

                    $('#edit_upload_speed').val(product.u_speed);

                    $('#edit_is_prepaid')
                        .val(product.is_prepaid)
                        .trigger('change');

                    $('#edit_public_ip')
                        .val(product.public_ip)
                        .trigger('change');

                    $('#edit_active')
                        .val(product.active)
                        .trigger('change');

                    /*
                    |--------------------------------------------------------------------------
                    | CLOSE LOADER
                    |--------------------------------------------------------------------------
                    */

                    Swal.close();

                    /*
                    |--------------------------------------------------------------------------
                    | OPEN MODAL
                    |--------------------------------------------------------------------------
                    */

                    $('#kt_modal_edit_product').modal('show');

                },

                error: function(xhr) {

                    Swal.fire({

                        icon: 'error',
                        title: 'Failed',
                        text: xhr.responseJSON?.message ??
                            'Unable to load product'

                    });

                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | UPDATE PRODUCT
        |--------------------------------------------------------------------------
        */

        $('#editProductForm').on('submit', function(e) {

            e.preventDefault();

            let productId = $('#edit_product_id').val();

            let formData = $(this).serialize();

            Swal.fire({

                title: 'Update Product?',
                text: 'Changes will be saved.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Update',
                confirmButtonColor: '#009ef7'

            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({

                    url: `/product/${productId}`,

                    type: 'PUT',

                    data: formData,

                    success: function(response) {

                        Swal.fire({

                            icon: 'success',
                            title: 'Updated',
                            text: response.message

                        }).then(() => {

                            location.reload();

                        });

                    },

                    error: function(xhr) {

                        Swal.fire({

                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message ??
                                'Unable to update product'

                        });

                    }

                });

            });

        });



        /*
        |--------------------------------------------------------------------------
        | INITIALIZE SELECT2 INSIDE MODAL
        |--------------------------------------------------------------------------
        */

        function initializeProductSelects() {
            $('#kt_modal_edit_product select[data-control="select2"]').select2({

                dropdownParent: $('#kt_modal_edit_product'),

                minimumResultsForSearch: Infinity

            });
        }

        /*
        |--------------------------------------------------------------------------
        | INIT ON PAGE LOAD
        |--------------------------------------------------------------------------
        */

        $(document).ready(function() {

            initializeProductSelects();

        });
    </script>
@endpush
