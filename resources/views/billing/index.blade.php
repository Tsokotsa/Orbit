@extends('layouts.master')
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-subscription-table-filter="search"
                                class="form-control form-control-solid w-250px ps-12" placeholder="Search orbit billing...">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-subscription-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Month:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-subscription-table-filter="month" data-hide-search="true"
                                            data-select2-id="select2-data-1-ga1e" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option data-select2-id="select2-data-3-jo6y"></option>
                                            <option value="jan">January</option>
                                            <option value="feb">February</option>
                                            <option value="mar">March</option>
                                            <option value="apr">April</option>
                                            <option value="may">May</option>
                                            <option value="jun">June</option>
                                            <option value="jul">July</option>
                                            <option value="aug">August</option>
                                            <option value="sep">September</option>
                                            <option value="oct">October</option>
                                            <option value="nov">November</option>
                                            <option value="dec">December</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-2-02a6" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-v91n-container"
                                                    aria-controls="select2-v91n-container"><span
                                                        class="select2-selection__rendered" id="select2-v91n-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-subscription-table-filter="status" data-hide-search="true"
                                            data-select2-id="select2-data-4-cu17" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option data-select2-id="select2-data-6-q045"></option>
                                            <option value="Active">Active</option>
                                            <option value="Expiring">Expiring</option>
                                            <option value="Suspended">Suspended</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-5-swk3" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-6p4b-container"
                                                    aria-controls="select2-6p4b-container"><span
                                                        class="select2-selection__rendered" id="select2-6p4b-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Billing Method:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option"
                                            data-allow-clear="true" data-kt-subscription-table-filter="billing"
                                            data-hide-search="true" data-select2-id="select2-data-7-e8jl" tabindex="-1"
                                            aria-hidden="true" data-kt-initialized="1">
                                            <option data-select2-id="select2-data-9-c6zo"></option>
                                            <option value="Auto-debit">Auto-debit</option>
                                            <option value="Manual - Credit Card">Manual - Credit Card</option>
                                            <option value="Manual - Cash">Manual - Cash</option>
                                            <option value="Manual - Paypal">Manual - Paypal</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-8-n2m9"
                                            style="width: 100%;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-9tul-container"
                                                    aria-controls="select2-9tul-container"><span
                                                        class="select2-selection__rendered" id="select2-9tul-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Product:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option"
                                            data-allow-clear="true" data-kt-subscription-table-filter="product"
                                            data-hide-search="true" data-select2-id="select2-data-10-4674" tabindex="-1"
                                            aria-hidden="true" data-kt-initialized="1">
                                            <option data-select2-id="select2-data-12-lrwd"></option>
                                            <option value="Basic">Basic</option>
                                            <option value="Basic Bundle">Basic Bundle</option>
                                            <option value="Teams">Teams</option>
                                            <option value="Teams Bundle">Teams Bundle</option>
                                            <option value="Enterprise">Enterprise</option>
                                            <option value=" Enterprise Bundle">Enterprise Bundle</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-11-h0u8"
                                            style="width: 100%;"><span class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-suzs-container"
                                                    aria-controls="select2-suzs-container"><span
                                                        class="select2-selection__rendered" id="select2-suzs-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                            data-kt-menu-dismiss="true"
                                            data-kt-subscription-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                                            data-kt-menu-dismiss="true"
                                            data-kt-subscription-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_subscriptions_export_modal">
                                <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                            <!--end::Export-->
                            <!--begin::Add subscription-->
                            <a href="apps/subscriptions/add.html" class="btn btn-primary">
                                <i class="ki-outline ki-plus fs-2"></i>Add Subscription</a>
                            <!--end::Add subscription-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-subscription-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-subscription-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-subscription-table-select="delete_selected">Delete Selected</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="" class="table-responsive">
                        <table id="billingTable" class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr>
                                    <th>Contract</th>
                                    <th>Account</th>
                                    <th>Billing</th>
                                    <th>Period</th>
                                    <th>User</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>

        </div>
        <!-- End Container Content -->
    </div>
@endsection

@push('scripts')
    <script>
        let table; // 👈 declare in outer scope

        $(function() {
            table = $('#billingTable').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '/billing/list',
                    type: 'GET',
                    error: function(xhr) {
                        console.error('Failed loading billing contracts', xhr.responseText);
                    }
                },
                columns: [{
                        data: 'name',
                        render: function(data) {
                            return `<small class="text-muted">${data}</small>`;
                        }
                    },
                    {
                        data: null,
                        render: function(row) {
                            if (!row.account_name) return '';

                            let initial = row.account_name.charAt(0).toUpperCase();

                            let amount = Number(row.amount_total_bill || 0).toLocaleString(
                                'en-US', {
                                    minimumFractionDigits: 2,
                                    maximumFractionDigits: 2
                                });

                            return `
            <div class="d-flex align-items-center gap-3">
                <div class="symbol-label fs-6 fw-semibold bg-light-success text-success rounded-circle"
                     style="width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                    ${initial}
                </div>
                <div>
                    <div class="fw-medium text-body">${row.account_name}</div>
                    <small class="text-muted">
                        <i class="fa fa-coins me-1"></i>${amount}
                    </small>
                </div>
            </div>
        `;
                        }

                    },
                    {
                        data: 'billing_method',
                        render: function(data) {
                            return data === 'prepaid' ?
                                `<span class="text-muted">Prepaid</span>` :
                                `<span class="text-light-success">${data}</span>`;
                        }
                    },
                    {
                        data: null,
                        render: function(row) {
                            return `
                                <i class="fa fa-calendar-alt text-muted me-1"></i>
                                <span class="fw-medium">${row.start_date}</span><br>
                                <small class="text-muted">→ ${row.next_billing_date}</small>
                            `;
                        }
                    },
                    {
                        data: 'username',
                        render: function(data) {
                            if (!data) return '';

                            return `
                                <div class="d-flex align-items-center ps-2"
                                     style="border-left:2px solid var(--bs-primary);">
                                    <div class="text-muted">${data}</div>
                                </div>
                            `;
                        }
                    },
                    {
                        data: 'state',
                        render: function(data) {
                            const map = {
                                'active': {
                                    cls: 'success',
                                    label: 'Active',
                                    solid: false
                                },
                                'to renew': {
                                    cls: 'warning',
                                    label: 'To Renew',
                                    solid: false
                                },
                                'suspended': {
                                    cls: 'danger',
                                    label: 'Suspended',
                                    solid: false
                                },
                                'done': {
                                    cls: 'success',
                                    label: 'Done',
                                    solid: true
                                },
                                'cancel': {
                                    cls: 'warning',
                                    label: 'Canceled',
                                    solid: false
                                },
                                'in overdue': {
                                    cls: 'warning',
                                    label: 'Overdue',
                                    solid: false
                                }
                            };

                            let key = data.toLowerCase();
                            let state = map[key] ?? {
                                cls: 'secondary',
                                label: data,
                                solid: false
                            };

                            return state.solid ?
                                `<span class="badge bg-${state.cls}">${state.label}</span>` :
                                `<span class="badge bg-${state.cls}-subtle text-${state.cls}">${state.label}</span>`;
                        }
                    }
                ],
                destroy: true, // ensures old instance is replaced if somehow called again
                language: {
                    processing: '<div class="spinner-border text-primary"></div> Loading Orbit Billing...'
                }
            });

            // 🔍 Bind search AFTER table is initialized
            const searchInput = document.querySelector('[data-kt-subscription-table-filter="search"]');

            searchInput.addEventListener('keyup', function() {
                table.search(this.value).draw();
            });
        });
    </script>
@endpush
