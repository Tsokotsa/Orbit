@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10 px-6">
                @foreach ($variables as $key => $olts)
                    @php
                        $isEven = $key % 2 === 0;
                    @endphp
                    <div class="col-xl-12 col-xxl-4">
                        <!--begin::Row-->
                        <div class="row gy-5 g-xl-10">
                            <!--begin::Col-->
                            <div class="col-md-6 col-xxl-12">
                                <!--begin::Card widget 1-->
                                <div class="card card-flush border-0 h-xl-100"
                                    data-bs-theme="{{ $isEven ? 'light' : 'default' }}"
                                    style="background-color: {{ $isEven ? '#22232B' : '#ffffff' }}">
                                    <!--begin::Header-->
                                    <div class="card-header pt-2">
                                        <!--begin::Title-->
                                        <h3 class="card-title">
                                            <span
                                                class="fs-3 fw-bold me-2 {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}">
                                                {{ Str::upper($olts['name']) }}
                                            </span>
                                            <span class="badge badge-success">{{ Str::ucfirst($olts['state']) }}</span>
                                        </h3>
                                        <!--end::Title-->
                                        <!--begin::Toolbar-->
                                        <div class="card-toolbar">
                                            <!--begin::Menu-->
                                            <button
                                                class="btn btn-icon w-25px h-25px
           {{ $isEven
               ? 'bg-white bg-opacity-10 btn-color-white btn-active-success'
               : 'bg-dark bg-opacity-10 btn-color-dark btn-active-success' }}"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                                data-kt-menu-overflow="true">
                                                <i
                                                    class="ki-outline ki-black-right fs-5 {{ $isEven ? 'text-white' : 'text-dark' }}"></i>
                                            </button>

                                            <!--begin::Menu 2-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Quick
                                                        Actions
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mb-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Customer</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                                    data-kt-menu-placement="right-start">
                                                    <!--begin::Menu item-->
                                                    <a href="#" class="menu-link px-3">
                                                        <span class="menu-title">New Group</span>
                                                        <span class="menu-arrow"></span>
                                                    </a>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu sub-->
                                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Admin Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Staff Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3">Member Group</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu sub-->
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">New Contact</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator mt-3 opacity-75"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3 py-3">
                                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate
                                                            Reports</a>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu 2-->
                                            <!--end::Menu-->
                                        </div>
                                        <!--end::Toolbar-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body d-flex justify-content-between flex-column pt-1 px-0 pb-0">
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-wrap px-9 mb-5">
                                            <!--begin::Stat-->
                                            <div class="rounded min-w-125px py-3 px-4 my-1 me-6"
                                                style="border: 1px dashed {{ $key % 2 === 0 ? 'rgba(255,255,255,0.15)' : 'rgba(0,0,0,0.15)' }}">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}"
                                                        data-kt-countup="true"
                                                        data-kt-countup-value="{{ $olts['provisionedONTsCount'] }}"
                                                        data-kt-countup-prefix="$" data-kt-initialized="1">
                                                        {{ $olts['provisionedONTsCount'] }}</div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-7 opacity-50 {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}">
                                                    Provisioned
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div class="rounded min-w-125px py-3 px-4 my-1 me-6"
                                                style="border: 1px dashed {{ $key % 2 === 0 ? 'rgba(255,255,255,0.15)' : 'rgba(0,0,0,0.15)' }}">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold text-success" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $olts['provisionedONTsCount'] - $olts['missingONTsCount'] }}"
                                                        data-kt-initialized="1">
                                                        {{ $olts['provisionedONTsCount'] - $olts['missingONTsCount'] }}
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-7 opacity-50 {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}">
                                                    Online
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                            <div class="rounded min-w-125px py-3 px-4 my-1 me-6"
                                                style="border: 1px dashed {{ $key % 2 === 0 ? 'rgba(255,255,255,0.15)' : 'rgba(0,0,0,0.15)' }}">
                                                <!--begin::Number-->
                                                <div class="d-flex align-items-center">
                                                    <div class="fs-2 fw-bold text-danger" data-kt-countup="true"
                                                        data-kt-countup-value="{{ $olts['missingONTsCount'] }}"
                                                        data-kt-initialized="1">{{ $olts['missingONTsCount'] }}
                                                    </div>
                                                </div>
                                                <!--end::Number-->
                                                <!--begin::Label-->
                                                <div
                                                    class="fw-semibold fs-7 opacity-50 {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}">
                                                    Missing
                                                </div>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Wrapper-->

                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Card widget 1-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                @endforeach
            </div>

            <!-- Tabs to display the rows -->
            <div class="row gy-5 g-xl-10 p-6">
                <div class="row m-3 g-7">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Available OLT Devices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Unassigned Subscribbers</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_4" role="tabpanel">

                            <div class="card">
                                <!--begin::Card header-->
                                <div class="card-header border-0 pt-6">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                            <input type="text" data-kt-customer-table-filter="search"
                                                class="form-control form-control-solid w-250px ps-13"
                                                placeholder="Search Olt's ...">
                                        </div>
                                        <!--end::Search-->
                                    </div>
                                    <!--begin::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar">
                                        <!--begin::Toolbar-->
                                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                            <!--begin::Filter-->
                                            <div class="w-150px me-3">
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid select2-hidden-accessible"
                                                    data-control="select2" data-hide-search="true"
                                                    data-placeholder="Status" data-kt-ecommerce-order-filter="status"
                                                    data-select2-id="select2-data-1-1vwv" tabindex="-1"
                                                    aria-hidden="true" data-kt-initialized="1">
                                                    <option data-select2-id="select2-data-3-3q5x"></option>
                                                    <option value="all">All</option>
                                                    <option value="active">Active</option>
                                                    <option value="locked">Locked</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-2-jv03"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-89rv-container"
                                                            aria-controls="select2-89rv-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-89rv-container" role="textbox"
                                                                aria-readonly="true" title="Status"><span
                                                                    class="select2-selection__placeholder">Status</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Select2-->
                                            </div>
                                            <!--end::Filter-->
                                            <!--begin::Export-->
                                            <button type="button" class="btn btn-light-primary me-3"
                                                data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                                                <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                                            <!--end::Export-->
                                            <!--begin::Add customer-->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_add_customer">Add OLT</button>
                                            <!--end::Add customer-->
                                        </div>
                                        <!--end::Toolbar-->
                                        <!--begin::Group actions-->
                                        <div class="d-flex justify-content-end align-items-center d-none"
                                            data-kt-customer-table-toolbar="selected">
                                            <div class="fw-bold me-5">
                                                <span class="me-2"
                                                    data-kt-customer-table-select="selected_count"></span>Selected
                                            </div>
                                            <button type="button" class="btn btn-danger"
                                                data-kt-customer-table-select="delete_selected">Delete
                                                Selected</button>
                                        </div>
                                        <!--end::Group actions-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <div id="kt_customers_table_wrapper"
                                        class="dt-container dt-bootstrap5 dt-empty-footer">
                                        <div id="" class="table-responsive">
                                            <table class="table align-middle table-row-dashed fs-9 gy-5 dataTable">
                                                <thead>
                                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0"
                                                        role="row">
                                                        <th class="dt-orderable-asc dt-orderable-desc" data-dt-column="1"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Customer Name: Activate to sort" tabindex="0">
                                                            <span class="dt-column-title" role="button">OLT
                                                            </span><span class="dt-column-order"></span>
                                                        </th>
                                                        <th class="dt-orderable-asc dt-orderable-desc" data-dt-column="2"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Email: Activate to sort" tabindex="0"><span
                                                                class="dt-column-title" role="button">IP</span><span
                                                                class="dt-column-order"></span></th>
                                                        <th class="dt-orderable-asc dt-orderable-desc" data-dt-column="3"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Status: Activate to sort" tabindex="0"><span
                                                                class="dt-column-title" role="button">Address</span><span
                                                                class="dt-column-order"></span>
                                                        </th>
                                                        <th class="dt-orderable-asc dt-orderable-desc" data-dt-column="4"
                                                            rowspan="1" colspan="1"
                                                            aria-label="IP Address: Activate to sort" tabindex="0">
                                                            <span class="dt-column-title" role="button">MAC
                                                                Address</span><span class="dt-column-order"></span>
                                                        </th>
                                                        <th class="dt-orderable-asc dt-orderable-desc" data-dt-column="5"
                                                            rowspan="1" colspan="1"
                                                            aria-label="Created Date: Activate to sort" tabindex="0">
                                                            <span class="dt-column-title" role="button">Vendor -
                                                                Model -
                                                                Type
                                                            </span><span class="dt-column-order"></span>
                                                        </th>
                                                        <th class="dt-orderable-none" data-dt-column="6" rowspan="1"
                                                            colspan="1" aria-label="Actions"><span
                                                                class="dt-column-title">Serial
                                                                #</span><span class="dt-column-order"></span></th>
                                                        <th class="text-end dt-orderable-none" data-dt-column="6"
                                                            rowspan="1" colspan="1" aria-label="Actions"><span
                                                                class="dt-column-title">Actions
                                                            </span><span class="dt-column-order"></span></th>
                                                    </tr>
                                                </thead>
                                                @foreach ($variables as $key => $olts)
                                                    <tbody>
                                                        <tr>
                                                            <td><span data-kt-element="status"
                                                                    class="badge badge-light">{{ Str::upper($olts['name']) }}
                                                                </span>
                                                            </td>
                                                            <td>{{ $olts['address'] }}</td>
                                                            <td><span
                                                                    class="d-inline-flex align-items-center fs-8 fw-semibold">
                                                                    <i class="ki-outline ki-geolocation fs-6 me-1"></i>
                                                                    {{ $olts['DeviceAddress'] }}
                                                                </span></td>
                                                            <td> <code class="text-gray-600"> {{ $olts['systemMacAddress'] }} </code></td>
                                                            <td><span data-kt-element="status"
                                                                    class="badge badge-light-primary">{{ $olts['vendor'] }}
                                                                    -
                                                                    {{ $olts['model'] }}
                                                                    - {{ $olts['type'] }}</span></td>
                                                            <td>
                                                                <span
                                                                    class="d-inline-block px-3 py-1 fw-semibold fs-8 text-success" 
                                                                    style="border: 1px dashed #28a745; border-radius: 4px;">
                                                                    {{ $olts['serialNumber'] }}
                                                                </span>
                                                            </td>

                                                            <td class="text-end">
                                                                <button
                                                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                                                    data-kt-menu-trigger="click"
                                                                    data-kt-menu-placement="bottom-end"
                                                                    data-kt-menu-overflow="true">
                                                                    <i class="ki-outline ki-dots-square fs-1"></i>
                                                                </button>
                                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                                    data-kt-menu="true">

                                                                    <!-- Header -->
                                                                    <div class="menu-item px-3">
                                                                        <div
                                                                            class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                                                            Actions
                                                                        </div>
                                                                    </div>

                                                                    <div class="separator mb-3 opacity-75"></div>

                                                                    <!-- Menu item 1 -->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3">
                                                                            <span class="menu-icon">
                                                                                <i class="ki-outline ki-pencil fs-5"></i>
                                                                            </span>
                                                                            <span class="menu-title">Edit OLT</span>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Menu item 2 -->
                                                                    <div class="menu-item px-3">
                                                                        <a href="/calix/subscribers/list"
                                                                            class="menu-link px-3">
                                                                            <span class="menu-icon">
                                                                                <i
                                                                                    class="ki-outline ki-eye fs-5 text-success"></i>
                                                                            </span>
                                                                            <span class="menu-title">Subscribers</span>
                                                                        </a>
                                                                    </div>

                                                                    <!-- Menu item 2 -->
                                                                    <div class="menu-item px-3">
                                                                        <a href="#" class="menu-link px-3">
                                                                            <span class="menu-icon">
                                                                                <i
                                                                                    class="ki-outline ki-disconnect fs-5 text-success"></i>
                                                                            </span>
                                                                            <span class="menu-title">Unassigned</span>
                                                                        </a>
                                                                    </div>

                                                                </div>

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endforeach
                                                <!--end::Table body-->
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                        <div id="" class="row">
                                            <div id=""
                                                class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar">
                                                <div><select name="kt_customers_table_length"
                                                        aria-controls="kt_customers_table"
                                                        class="form-select form-select-solid form-select-sm"
                                                        id="dt-length-0">
                                                        <option value="10">10</option>
                                                        <option value="25">25</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select><label for="dt-length-0"></label></div>
                                            </div>
                                            <div id=""
                                                class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                                <div class="dt-paging paging_simple_numbers">
                                                    <ul class="pagination">
                                                        <li class="dt-paging-button page-item disabled"><a
                                                                class="page-link previous"
                                                                aria-controls="kt_customers_table" aria-disabled="true"
                                                                aria-label="Previous" data-dt-idx="previous"
                                                                tabindex="-1"><i class="previous"></i></a></li>
                                                        <li class="dt-paging-button page-item active"><a href="#"
                                                                class="page-link" aria-controls="kt_customers_table"
                                                                aria-current="page" data-dt-idx="0" tabindex="0">1</a>
                                                        </li>
                                                        <li class="dt-paging-button page-item"><a href="#"
                                                                class="page-link" aria-controls="kt_customers_table"
                                                                data-dt-idx="1" tabindex="0">2</a>
                                                        </li>
                                                        <li class="dt-paging-button page-item"><a href="#"
                                                                class="page-link" aria-controls="kt_customers_table"
                                                                data-dt-idx="2" tabindex="0">3</a>
                                                        </li>
                                                        <li class="dt-paging-button page-item"><a href="#"
                                                                class="page-link" aria-controls="kt_customers_table"
                                                                data-dt-idx="3" tabindex="0">4</a>
                                                        </li>
                                                        <li class="dt-paging-button page-item"><a href="#"
                                                                class="page-link next" aria-controls="kt_customers_table"
                                                                aria-label="Next" data-dt-idx="next" tabindex="0"><i
                                                                    class="next"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Card body-->
                            </div>

                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                            <div class="card px-4">
                                <div class="card-header">
                                    <h3 class="card-title">Unassigned ONT's</h3>
                                    <div class="card-toolbar">
                                        <button type="button" class="btn btn-sm btn-light">
                                            Sync Request
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped gy-3 gs-3">
                                            <thead class="fs-10">
                                                <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                    <th>Serial #</th>
                                                    <th>Device</th>
                                                    <th>Vendor ID</th>
                                                    <th>Model</th>
                                                    <th>Firmware Ver.</th>
                                                    <th>Device Mac #</th>
                                                </tr>
                                            </thead>
                                            <tbody class="fs-12">
                                                @forelse($unassigned as $item)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $item['device-name'] }}</strong>
                                                        </td>

                                                        <td>
                                                            <span class="text-muted">{{ $item['port-id'] }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-light-primary">
                                                                {{ $item['serial-number'] }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-700">{{ $item['model'] }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge badge-light-success fw-semibold">
                                                                {{ $item['curr-version'] }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <code class="text-gray-600">
                                                                {{ $item['onu-mac-addr'] }}
                                                            </code>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="5"><span class="badge badge-light-primary">
                                                                Nothing to be
                                                                assigned on Orbit</span></td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
@endsection

@push('scripts')
    <script></script>
@endpush
