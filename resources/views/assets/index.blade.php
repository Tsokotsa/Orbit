@extends('layouts.master')

<style>
    .table tbody tr td div.actions {
        display: none;
    }

    .table tbody tr:hover>td div.actions {
        display: block;
    }
</style>

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">

                <div class="col-xl-4">
                    <!--begin::List widget 23-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Vendors</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">All vendors and its models</span>
                            </h3>
                            <!--end::Title-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar"></div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-5">
                            <!--begin::Items-->
                            <div class="">
                                @foreach ($vendors as $vendorId => $vendor)
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <!--begin::Section-->
                                        <div class="d-flex align-items-center me-5">
                                            <!--begin::Flag-->
                                            <img src="{{ $vendor->logo_path }}" class="me-4 w-30px"
                                                style="border-radius: 4px" alt="">
                                            <!--end::Flag-->
                                            <!--begin::Content-->
                                            <div class="me-5">
                                                <!--begin::Title-->
                                                <a href="#"
                                                    class="text-gray-800 fw-bold text-hover-primary fs-6">{{ $vendor->name }}
                                                </a>
                                                <!--end::Title-->
                                                <!--begin::Desc-->
                                                <span
                                                    class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">{{ $vendor->description }}</span>
                                                <!--end::Desc-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Section-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Number-->
                                            {{-- <span class="text-gray-800 fw-bold fs-8 me-3">{{ $vendor->total_models }}</span> --}}
                                            <!--end::Number-->
                                            <!--begin::Info-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <span class="badge badge-light">
                                                    <i class="text-success ms-n1"></i>Models:
                                                    {{ $vendor->model_names ?? 'Not Defined' }}</span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Item-->
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-3"></div>
                                    <!--end::Separator-->
                                @endforeach
                            </div>
                            <!--end::Items-->
                            <div class="card-footer border-0 d-flex justify-content-center gap-3">
                                @can('vendor.add')
                                    <button type="button" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#vendorModal">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Add Vendor
                                    </button>
                                @endcan
                                @can('model.add')
                                    <!-- Secondary button (modal trigger) -->
                                    <button type="button" class="btn btn-sm btn-success fw-semibold" data-bs-toggle="modal"
                                        data-bs-target="#modelModal">
                                        <i class="bi bi-plus-circle me-1"></i>
                                        Add Model
                                    </button>
                                @endcan
                            </div>

                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::List widget 23-->
                </div>
                <!-- Right Table Assets -->
                <div class="col-xl-8">

                    <div class="card border-0 shadow-sm">

                        <!-- HEADER -->
                        <div class="card-header border-0 pt-5 pb-3">

                            <div class="card-title">

                                <div class="position-relative">

                                    <i
                                        class="ki-outline ki-magnifier fs-5 position-absolute top-50 translate-middle-y ms-4 text-muted"></i>

                                    <input type="text" data-kt-user-table-filter="search"
                                        class="form-control form-control-sm form-control-solid ps-11 w-225px"
                                        placeholder="Search assets...">

                                </div>

                            </div>

                            <div class="card-toolbar">

                                @can('asset.add')
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#assetModal">

                                        <i class="ki-outline ki-plus fs-3"></i>

                                        New Asset

                                    </button>
                                @endcan

                            </div>

                        </div>

                        <!-- BODY -->
                        <div class="card-body pt-0 pb-2">

                            <div class="table-responsive">

                                <table class="table align-middle gs-0 gy-3 fs-7" id="kt_table_assets">

                                    <thead>

                                        <tr class="fw-semibold text-muted border-bottom border-gray-200">

                                            <th class="min-w-150px">
                                                Serial
                                            </th>

                                            <th class="min-w-125px">
                                                Vendor
                                            </th>

                                            <th class="min-w-150px">
                                                Model
                                            </th>

                                            <th class="min-w-100px">
                                                Status
                                            </th>

                                            <th class="text-end min-w-70px">
                                                Actions
                                            </th>

                                        </tr>

                                    </thead>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>
                <!-- End Rught Table -->


            </div>

        </div>

    </div>
    <!-- Include Modals -->
    @include('assets.modals.new-model')
    @include('assets.modals.new-vendor')
    @include('assets.modals.new-asset')
    @include('assets.modals.edit-asset')
    <!-- END Include -->
@endsection

@push('scripts')
    <script>
        const table = $('#kt_table_assets');

        const datatable = table.DataTable({

            serverSide: true,
            processing: true,
            stateSave: true,
            pageLength: 8,
            searching: true,
            info: false,
            lengthChange: false,
            ordering: false,
            autoWidth: false,

            ajax: {
                url: '/asset/data'
            },

            columns: [{
                    data: 'serial'
                },
                {
                    data: 'vendor_name'
                },
                {
                    data: 'model_name'
                },
                {
                    data: 'active'
                },
                {
                    data: 'id'
                }
            ],

            columnDefs: [

                /*
                |--------------------------------------------------------------------------
                | SERIAL
                |--------------------------------------------------------------------------
                */
                {
                    targets: 0,
                    render: function(data, type, row) {

                        return `
            <div class="d-flex flex-column">

                <span class="fw-bold text-gray-900 fs-7">
                    ${data}
                </span>

                <div class="d-flex align-items-center gap-1 mt-1">

                    <span class="bullet bullet-dot bg-gray-500"></span>

                    <span class="text-muted fs-8">
                        ${row.medium_name ?? 'Unknown Medium'}
                    </span>

                </div>

            </div>
        `;
                    }
                },
                /*
                |--------------------------------------------------------------------------
                | VENDOR
                |--------------------------------------------------------------------------
                */
                {
                    targets: 1,
                    render: function(data, type, row) {

                        return `
            <div class="d-flex align-items-center gap-3">

                ${
                    row.logo_path
                    ? `
                                                                                                                                           <div class="symbol symbol-35px bg-light border">
                                                                                                                                            <img src="${row.logo_path}"
                                                                                                                                                 style="object-fit:contain;padding:4px;">
                                                                                                                                                </div>
                                                                                                                                            `
                    : ''
                }

            </div>
        `;
                    }
                },

                {
                    targets: 2,
                    render: function(data) {

                        return `
            <span class="badge badge-sm badge-light border border-gray-300 text-gray-700">

                ${data}

            </span>
        `;
                    }
                },
                /*
                |--------------------------------------------------------------------------
                | STATUS
                |--------------------------------------------------------------------------
                */
                {
                    targets: 3,
                    className: 'text-start',

                    render: function(data) {

                        if (data === 'y') {

                            return `
                        <span class="badge badge-light-success badge-sm">
                            Active
                        </span>
                    `;
                        }

                        return `
                    <span class="badge badge-light-danger badge-sm">
                        Disabled
                    </span>
                `;
                    }
                },

                /*
                |--------------------------------------------------------------------------
                | ACTIONS
                |--------------------------------------------------------------------------
                */
                {
                    targets: 4,
                    orderable: false,
                    searchable: false,
                    className: 'text-end',

                    render: function(data) {

                        return `
                    <button
                        class="btn btn-icon btn-sm btn-light-primary edit-asset"
                        data-id="${data}">

                        <i class="ki-outline ki-pencil fs-5"></i>

                    </button>
                `;
                    }
                }
            ],

            language: {
                emptyTable: `
            <div class="py-10 text-center">

                <div class="text-muted mb-2">
                    No assets found
                </div>

            </div>
        `
            }
        });


        // Loading Vendor to add Model
        let modelModalLoading = false;

        $('#modelModal').on('shown.bs.modal', function() {
            if (modelModalLoading) return; // prevent duplicate fetch
            modelModalLoading = true;

            const $select = $('#vendorSelect');
            const $loading = $('#vendorLoading');
            const $content = $('#vendorContent');

            $loading.removeClass('d-none');
            $content.addClass('d-none');

            if ($select.hasClass('select2-hidden-accessible')) {
                $select.select2('destroy');
            }

            $.ajax({
                url: '/vendors/get_all',
                method: 'GET',
                cache: false, // disable cache
                success: function(vendors) {
                    $select.empty().append('<option></option>');

                    vendors.forEach(vendor => {
                        const option = new Option(vendor.name, vendor.id, false, false);
                        $(option).data('logo', vendor.logo_path);
                        $select.append(option);
                    });

                    $select.select2({
                        dropdownParent: $('#modelModal'),
                        placeholder: 'Select a vendor',
                        allowClear: true,
                        width: '100%',
                        templateResult: formatVendor,
                        templateSelection: formatVendorSelection,
                        escapeMarkup: markup => markup
                    });

                    $loading.addClass('d-none');
                    $content.removeClass('d-none');
                    modelModalLoading = false;
                },
                error: function() {
                    $loading.html('<div class="text-danger">Failed to load vendors</div>');
                    modelModalLoading = false;
                }
            });
        });

        // END of Loading Vendor


        // Dropdown item template
        //     function formatVendor(vendor) {
        //         if (!vendor.id) return vendor.text;

        //         const logo = $(vendor.element).data('logo');

        //         return `
    //     <div class="d-flex align-items-center">
    //         <img src="${logo}" class="me-2" style="width:24px;height:24px;border-radius:4px;">
    //         <span>${vendor.text}</span>
    //     </div>
    // `;
        //     }

        //     // Selected item template
        //     function formatVendorSelection(vendor) {
        //         if (!vendor.id) return vendor.text;

        //         const logo = $(vendor.element).data('logo');

        //         return `
    //     <div class="d-flex align-items-center">
    //         <img src="${logo}" class="me-2" style="width:20px;height:20px;border-radius:4px;">
    //         <span>${vendor.text}</span>
    //     </div>
    // `;
        //     }

        // When New Asset Modal is Showing
        let assetModalLoading = false;

        $('#assetModal').on('shown.bs.modal', function() {
            if (assetModalLoading) return;
            assetModalLoading = true;

            const $vendorSelect = $('#asset_vendor_select');
            const $mediumSelect = $('#asset_medium_select');
            const $loading = $('#assetLoading');
            const $content = $('#assetContent');

            $loading.removeClass('d-none');
            $content.addClass('d-none');

            if ($vendorSelect.hasClass('select2-hidden-accessible')) {
                $vendorSelect.select2('destroy');
            }
            if ($mediumSelect.hasClass('select2-hidden-accessible')) {
                $mediumSelect.select2('destroy');
            }

            $.ajax({
                url: '/asset/add_new',
                method: 'GET',
                cache: false,
                success: function(response) {

                    $vendorSelect.empty().append('<option></option>');
                    response.vendors.forEach(vendor => {
                        const option = new Option(vendor.name, vendor.id, false, false);
                        $(option).data('logo', vendor.logo_path);
                        $vendorSelect.append(option);
                    });

                    $vendorSelect.select2({
                        dropdownParent: $('#assetModal'),
                        placeholder: 'Select a vendor',
                        allowClear: true,
                        width: '100%',
                        templateResult: formatVendor,
                        templateSelection: formatVendorSelection,
                        escapeMarkup: markup => markup
                    });

                    $mediumSelect.empty().append('<option></option>');
                    response.mediums.forEach(medium => {
                        const option = new Option(medium.name, medium.id, false, false);
                        $mediumSelect.append(option);
                    });

                    $mediumSelect.select2({
                        dropdownParent: $('#assetModal'),
                        placeholder: 'Select a medium',
                        allowClear: true,
                        width: '100%'
                    });

                    $loading.addClass('d-none');
                    $content.removeClass('d-none');
                    assetModalLoading = false;
                },
                error: function() {
                    $loading.html('<div class="text-danger">Failed to load asset data</div>');
                    assetModalLoading = false;
                }
            });
        });

        // END Asset Modal

        function formatVendor(vendor) {
            if (!vendor.id) return vendor.text;

            const logo = $(vendor.element).data('logo');

            return `
        <div class="d-flex align-items-center">
            <img src="${logo}" class="me-2" style="width:24px;height:24px;border-radius:4px;">
            <span>${vendor.text}</span>
        </div>
    `;
        }

        function formatVendorSelection(vendor) {
            if (!vendor.id) return vendor.text;

            const logo = $(vendor.element).data('logo');

            return `
        <div class="d-flex align-items-center">
            <img src="${logo}" class="me-2" style="width:20px;height:20px;border-radius:4px;">
            <span>${vendor.text}</span>
        </div>
    `;
        }



        // END New Asset Modal



        var vendor_model_input = document.querySelector("#vendor_model");

        new Tagify(vendor_model_input);

        $("#asset_medium_select, #asset_vendor_select").select2();



        // Edit Asset Modal 
        $(document).on('click', '.edit-asset', function() {

            let assetId = $(this).data('id');

            const modalEl = document.getElementById('editAssetModal');
            const modal = new bootstrap.Modal(modalEl);

            modal.show();

            // RESET UI
            $('#editAssetLoading').removeClass('d-none');
            $('#editAssetContent').addClass('d-none');

            $.ajax({
                url: `/asset/${assetId}/edit`,
                type: 'GET',

                success: function(response) {

                    /*
                    |--------------------------------------------------------------------------
                    | BASIC FIELDS
                    |--------------------------------------------------------------------------
                    */

                    $('#edit_asset_id').val(response.id);
                    $('input[name="serial"]').val(response.serial);
                    $('textarea[name="description"]').val(response.description);

                    $('#edit_model_display').val(response.model_name);

                    /*
                    |--------------------------------------------------------------------------
                    | WAIT UNTIL MODAL IS FULLY VISIBLE
                    |--------------------------------------------------------------------------
                    */

                    setTimeout(() => {

                        /*
                        |--------------------------------------------------------------------------
                        | MEDIUM (NO SELECT2 RELIANCE)
                        |--------------------------------------------------------------------------
                        */
                        $('#edit_medium_id')
                            .val(String(response.media_type))
                            .trigger('change');

                        /*
                        |--------------------------------------------------------------------------
                        | VENDOR (SELECT2 SAFE)
                        |--------------------------------------------------------------------------
                        */

                        $('#edit_vendor_id')
                            .val(String(response.vendor_id))
                            .trigger('change.select2');

                        /*
                        |--------------------------------------------------------------------------
                        | LOAD MODELS (WAIT FOR VENDOR CHANGE EFFECT)
                        |--------------------------------------------------------------------------
                        */

                        // loadEditModels(response.vendor_id, response.model_id);

                        /*
                        |--------------------------------------------------------------------------
                        | STATUS
                        |--------------------------------------------------------------------------
                        */

                        $('#edit_is_enabled').prop('checked', response.active === 'y');

                        /*
                        |--------------------------------------------------------------------------
                        | SHOW CONTENT
                        |--------------------------------------------------------------------------
                        */

                        $('#editAssetLoading').addClass('d-none');
                        $('#editAssetContent').removeClass('d-none');

                    }, 300); // IMPORTANT: 300ms not 100ms

                },

                error: function() {

                    Swal.fire({
                        icon: 'error',
                        text: 'Failed to load asset'
                    });

                }
            });
        });
        // END Edit Asset Modal 


        // Change Vendor Would reload Models
        $('#edit_vendor_id').on('change', function() {

            let vendorId = $(this).val();

            // reset model immediately
            $('#edit_model_id').html('<option>Loading...</option>');

            loadEditModels(vendorId);

        });
        // End

        // Asset Update 
        $('#submit_edit_asset').on('click', function() {

            const button = $(this);

            /*
            |--------------------------------------------------------------------------
            | CONFIRM UPDATE
            |--------------------------------------------------------------------------
            */

            Swal.fire({

                title: 'Update Asset?',
                text: 'The asset information will be updated.',
                icon: 'question',

                showCancelButton: true,

                confirmButtonText: 'Yes, update',
                cancelButtonText: 'Cancel',

                buttonsStyling: false,

                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }

            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | LOADING
                |--------------------------------------------------------------------------
                */

                button.attr('data-kt-indicator', 'on');
                button.prop('disabled', true);

                const assetId = $('#edit_asset_id').val();

                /*
                |--------------------------------------------------------------------------
                | AJAX UPDATE
                |--------------------------------------------------------------------------
                */

                $.ajax({

                    url: `/asset/${assetId}`,
                    type: 'PUT',

                    data: $('#edit_asset_form').serialize(),

                    success: function(response) {

                        /*
                        |--------------------------------------------------------------------------
                        | RESET BUTTON
                        |--------------------------------------------------------------------------
                        */

                        button.removeAttr('data-kt-indicator');
                        button.prop('disabled', false);

                        /*
                        |--------------------------------------------------------------------------
                        | CLOSE MODAL
                        |--------------------------------------------------------------------------
                        */

                        const modalEl = document.getElementById('editAssetModal');

                        const modal = bootstrap.Modal.getInstance(modalEl);

                        modal.hide();

                        /*
                        |--------------------------------------------------------------------------
                        | RELOAD TABLE
                        |--------------------------------------------------------------------------
                        */

                        datatable.ajax.reload(null, false);

                        /*
                        |--------------------------------------------------------------------------
                        | SUCCESS
                        |--------------------------------------------------------------------------
                        */

                        Swal.fire({

                            icon: 'success',
                            title: 'Asset Updated',
                            text: response.message ??
                                'Asset updated successfully',

                            buttonsStyling: false,

                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }

                        });

                    },

                    error: function(xhr) {

                        button.removeAttr('data-kt-indicator');
                        button.prop('disabled', false);

                        /*
                        |--------------------------------------------------------------------------
                        | VALIDATION ERRORS
                        |--------------------------------------------------------------------------
                        */

                        if (xhr.status === 422) {

                            let errors = xhr.responseJSON.errors;

                            let errorList = '';

                            Object.keys(errors).forEach(function(key) {

                                errorList += `
                            <div class="text-start mb-2">
                                • ${errors[key][0]}
                            </div>
                        `;
                            });

                            Swal.fire({

                                icon: 'error',
                                title: 'Validation Error',
                                html: errorList,

                                buttonsStyling: false,

                                customClass: {
                                    confirmButton: 'btn btn-primary'
                                }

                            });

                            return;
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | GENERAL ERROR
                        |--------------------------------------------------------------------------
                        */

                        Swal.fire({

                            icon: 'error',
                            title: 'Update Failed',
                            text: xhr.responseJSON?.message ??
                                'Failed to update asset',

                            buttonsStyling: false,

                            customClass: {
                                confirmButton: 'btn btn-primary'
                            }

                        });

                    }

                });

            });

        });
        // End Asset Update
    </script>
@endpush
