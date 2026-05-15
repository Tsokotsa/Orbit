@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">


            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-8">
                <!--begin::Icon-->
                <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-semibold">
                        <h4 class="text-gray-900 fw-bold">Pay attention!</h4>
                        <div class="fs-8 text-gray-700">Changes made here will be written to subscribers
                            <a class="fw-bold" href="/land">Learn More</a>.
                        </div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>

            <!-- Begin Card Tsokotsa to list Subscribers -->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-customer-table-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Search subscribers">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true"
                                id="kt-toolbar-filter">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-4 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Month:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-customer-table-filter="month" data-dropdown-parent="#kt-toolbar-filter"
                                            data-select2-id="select2-data-1-kcsw" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option data-select2-id="select2-data-3-bww8"></option>
                                            <option value="aug">August</option>
                                            <option value="sep">September</option>
                                            <option value="oct">October</option>
                                            <option value="nov">November</option>
                                            <option value="dec">December</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-2-cz7i" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-fvrj-container"
                                                    aria-controls="select2-fvrj-container"><span
                                                        class="select2-selection__rendered" id="select2-fvrj-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-semibold mb-3">Payment Type:</label>
                                        <!--end::Label-->
                                        <!--begin::Options-->
                                        <div class="d-flex flex-column flex-wrap fw-semibold"
                                            data-kt-customer-table-filter="payment_type">
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    value="all" checked="checked">
                                                <span class="form-check-label text-gray-600">All</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label
                                                class="form-check form-check-sm form-check-custom form-check-solid mb-3 me-5">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    value="visa">
                                                <span class="form-check-label text-gray-600">Visa</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid mb-3">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    value="mastercard">
                                                <span class="form-check-label text-gray-600">Mastercard</span>
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                                <input class="form-check-input" type="radio" name="payment_type"
                                                    value="american_express">
                                                <span class="form-check-label text-gray-600">American Express</span>
                                            </label>
                                            <!--end::Option-->
                                        </div>
                                        <!--end::Options-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2"
                                            data-kt-menu-dismiss="true"
                                            data-kt-customer-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true"
                                            data-kt-customer-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_customers_export_modal">
                                <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                            <!--end::Export-->
                            <!--begin::Add customer-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_customer">Add Subscriber</button>
                            <!--end::Add customer-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-customer-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-customer-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="kt_customers_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <div id="" class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 g-3 dataTable" id="subscribers-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody class="fs-8"></tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>

            <!-- END of Card -->

        </div>
        <!--end::Content container-->
    </div>

    <!-- Include Modals -->
    @include('calix.modals.view-subscriber-modal')
    <!-- End Inclusion Modals -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#subscribers-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('calix.get-all') }}',
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'street',
                        name: 'Address',
                        render: function(data) {
                            return `<span class="d-inline-flex align-items-center fs-8 fw-semibold"> <i class="ki-outline ki-geolocation fs-6 me-1"></i>${data} </span>`
                        }
                    },
                    {
                        data: 'phone',
                        name: 'Phone',
                        render: function(data) {
                            return `<span class="badge badge-primary d-inline-flex align-items-center fs-8 fw-semibold"></i>${data} </span>`
                        }

                    },
                    {
                        data: 'email',
                        name: 'Email',
                        render: function(data) {
                            return `<span class="badge badge-light d-inline-flex align-items-center fs-8 fw-semibold"> </i>${data} </span>`
                        }
                    },
                ],
                createdRow: function(row, data) {
                    // add pointer cursor
                    $(row).addClass('cursor-pointer');

                    // attach click handler
                    $(row).on('click', function() {
                        openSubscriberModal(data.customId);
                    });
                },
                responsive: false,
                pageLength: 10,
                lengthMenu: [10, 25, 50, 100],
                language: {
                    emptyTable: "No subscribers found",
                    processing: "<i class='fa fa-spinner fa-spin'></i> Loading orbit data..."
                }
            });
        });


        // Open Subscribers Modal and load Data 
        // function openSubscriberModal(customId) {

        //     $('#subscriberModalTitle').html(`
    //         <strong>Subscriber</strong>
    //             <span class="badge bg-warning text-dark rounded-pill ms-2 px-3">
    //                 ${customId}
    //             </span>
    //         `);

        //     $('#subscriberModal').modal('show');
        //     $('#subscriberModalBody').html('Loading Orbit subscriber...');

        //     $.get(`/calix/subscribers/${customId}`, function(response) {
        //         $('#subscriberModalBody').html(response);
        //     }).fail(function() {
        //         $('#subscriberModalBody').html('<div class="text-danger">Failed to load data</div>');
        //     });
        // }

        function openSubscriberModal(customId) {

            $('#subscriberModalTitle').html(`
        Subscriber
        <span class="badge bg-warning text-dark ms-2">
            ${customId}
        </span>
    `);

            $('#subscriberModalBody').html(
                '<div class="text-center py-4">Loading Orbit subscriber...</div>'
            );

            $('#subscriberModal').modal('show');

            $.get(`/calix/subscribers/${customId}`, function(response) {
                $('#subscriberModalBody').html(response);
            }).fail(function() {
                $('#subscriberModalBody').html(
                    '<div class="alert alert-danger">Failed to load subscriber</div>'
                );
            });
        }
    </script>
@endpush
