<div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-xl">

        <div class="modal-content border-0 shadow-sm rounded-4 overflow-hidden">

            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <!--begin::Header-->
                <div class="modal-header border-0 px-10 pt-8 pb-5">

                    <div>

                        <h2 class="fw-bold mb-1">
                            Add Product / Service
                        </h2>

                        <div class="text-muted fs-6">
                            Create a new internet package or service offering
                        </div>

                    </div>

                    <div class="btn btn-icon btn-sm btn-light-primary rounded-circle" data-bs-dismiss="modal">

                        <i class="ki-outline ki-cross fs-2"></i>

                    </div>

                </div>
                <!--end::Header-->



                <!--begin::Body-->
                <div class="modal-body px-10 py-5">

                    <div class="row g-7">

                        <!--begin::Basic Info Card-->
                        <div class="col-12">

                            <div class="card card-bordered border-gray-200 rounded-4">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            Basic Information
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <div class="row g-6">

                                        <!-- Product Name -->
                                        <div class="col-md-6">

                                            <label class="required form-label fw-semibold">
                                                Product Name
                                            </label>

                                            <input type="text" name="name" class="form-control form-control-solid"
                                                placeholder="e.g Home Fiber 20Mbps" required>

                                        </div>

                                        <!-- Medium -->
                                        <div class="col-md-3">

                                            <label class="required form-label fw-semibold">
                                                Medium
                                            </label>

                                            <div class="input-group">

                                                {{-- <span class="input-group-text">
                                                    MZN
                                                </span> --}}

                                                <select name="medium_type" class="form-select" data-control="select2"
                                                    data-hide-search="true" data-placeholder="Select option">

                                                    <option></option>
                                                    @foreach ($mediums as $medium)
                                                        <option value="{{ $medium->name }}">{{ $medium->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>

                                        </div>

                                        <!-- Price -->
                                        <div class="col-md-3">

                                            <label class="required form-label fw-semibold">
                                                Monthly Price
                                            </label>

                                            <div class="input-group">

                                                <span class="input-group-text">
                                                    MZN
                                                </span>

                                                <input type="number" step="0.01" name="price"
                                                    class="form-control form-control" placeholder="0.00" required>

                                            </div>

                                        </div>

                                        <!-- Description -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Description
                                            </label>

                                            <textarea name="description" rows="4" class="form-control form-control-solid"
                                                placeholder="Add package or service description..."></textarea>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::Basic Info Card-->



                        <!--begin::Speed Configuration-->
                        <div class="col-lg-6">

                            <div class="card card-bordered border-gray-200 rounded-4 h-100">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            Speed Configuration
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <div class="row g-5">

                                        <!-- Download -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Download Speed
                                            </label>

                                            <div class="input-group">

                                                <input type="number" name="d_speed" class="form-control form-control"
                                                    placeholder="0">

                                                <span class="input-group-text">
                                                    Mbps
                                                </span>

                                            </div>

                                        </div>

                                        <!-- Upload -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Upload Speed
                                            </label>

                                            <div class="input-group">

                                                <input type="number" name="u_speed" class="form-control form-control"
                                                    placeholder="0">

                                                <span class="input-group-text">
                                                    Mbps
                                                </span>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::Speed Configuration-->



                        <!--begin::Settings-->
                        <div class="col-lg-6">

                            <div class="card card-bordered border-gray-200 rounded-4 h-100">

                                <div class="card-header border-0 pt-6">

                                    <div class="card-title">

                                        <h3 class="fw-bold m-0">
                                            Service Settings
                                        </h3>

                                    </div>

                                </div>

                                <div class="card-body pt-2">

                                    <div class="row g-5">

                                        <!-- Public IP -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Public IP
                                            </label>

                                            <select name="public_ip" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="Select option">

                                                <option></option>

                                                <option value="n">No</option>
                                                <option value="y">Yes</option>

                                            </select>

                                        </div>

                                        <!-- Billing -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Billing Type
                                            </label>

                                            <select name="is_prepaid" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="Select billing type">

                                                <option></option>

                                                <option value="n">Postpaid</option>
                                                <option value="y">Prepaid</option>

                                            </select>

                                        </div>

                                        <!-- Status -->
                                        <div class="col-12">

                                            <label class="form-label fw-semibold">
                                                Status
                                            </label>

                                            <select name="active" class="form-select form-select-solid"
                                                data-control="select2" data-hide-search="true"
                                                data-placeholder="Select status">

                                                <option></option>

                                                <option value="y">Active</option>
                                                <option value="n">Inactive</option>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>
                        <!--end::Settings-->

                    </div>

                </div>
                <!--end::Body-->



                <!--begin::Footer-->
                <div class="modal-footer border-0 px-10 py-7">

                    <button type="button" class="btn btn-light btn-active-light-primary px-6"
                        data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="submit" class="btn btn-primary px-8">

                        <i class="ki-outline ki-check fs-2"></i>

                        <span class="indicator-label">
                            Save Product
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
        // Select 2 of the add product

        // End of select2 of add product

        /*
        |--------------------------------------------------------------------------
        | ADD PRODUCT / SERVICE
        |--------------------------------------------------------------------------
        */

        $('#kt_modal_add_product form').on('submit', function(e) {

            e.preventDefault();

            let form = $(this);

            let formData = new FormData(this);

            /*
            |--------------------------------------------------------------------------
            | CONFIRMATION
            |--------------------------------------------------------------------------
            */

            Swal.fire({

                title: 'Create Product?',
                text: 'The new product/service will be added to the system.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Create',
                cancelButtonText: 'Cancel',
                confirmButtonColor: '#009ef7'

            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | LOADING STATE
                |--------------------------------------------------------------------------
                */

                Swal.fire({

                    title: 'Creating Product',
                    text: 'Please wait...',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }

                });

                /*
                |--------------------------------------------------------------------------
                | AJAX REQUEST
                |--------------------------------------------------------------------------
                */

                $.ajax({

                    url: form.attr('action'),

                    type: 'POST',

                    data: formData,

                    processData: false,

                    contentType: false,

                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                    success: function(response) {

                        /*
                        |--------------------------------------------------------------------------
                        | SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        Swal.fire({

                            icon: 'success',
                            title: 'Success',
                            text: response.message ?? 'Product created successfully',
                            confirmButtonColor: '#009ef7'

                        }).then(() => {

                            /*
                            |--------------------------------------------------------------------------
                            | CLOSE MODAL
                            |--------------------------------------------------------------------------
                            */

                            $('#kt_modal_add_product').modal('hide');

                            /*
                            |--------------------------------------------------------------------------
                            | RELOAD PARENT WINDOW
                            |--------------------------------------------------------------------------
                            */

                            window.location.reload();

                        });

                    },

                    error: function(xhr) {

                        let message = 'Something went wrong';

                        /*
                        |--------------------------------------------------------------------------
                        | VALIDATION ERRORS
                        |--------------------------------------------------------------------------
                        */

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            message = Object.values(errors)
                                .map(error => error[0])
                                .join('<br>');

                        } else if (xhr.responseJSON?.message) {

                            message = xhr.responseJSON.message;

                        }

                        /*
                        |--------------------------------------------------------------------------
                        | ERROR ALERT
                        |--------------------------------------------------------------------------
                        */

                        Swal.fire({

                            icon: 'error',
                            title: 'Failed',
                            html: message,
                            confirmButtonColor: '#d33'

                        });

                    }

                });

            });

        });
    </script>
@endpush
