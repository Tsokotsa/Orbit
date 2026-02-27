@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <div class="card mb-5">
                <div class="card-body">
                    <h3 class="mb-4">Select Starlink Account</h3>

                    <div class="row g-4">
                        @if (isset($accounts) && $accounts->count())
                            @foreach ($accounts as $account)
                                <div class="col-md-4">
                                    <label
                                        class="btn btn-outline btn-outline-dashed btn-active-light-primary d-flex flex-stack text-start p-4 w-100 account-radio-card">

                                        <div class="d-flex align-items-center me-2">

                                            <!-- Radio -->
                                            <div
                                                class="form-check form-check-custom form-check-solid form-check-primary me-3">
                                                <input class="form-check-input account-radio" type="radio"
                                                    name="starlink_account" value="{{ $account->account_number }}" />
                                            </div>

                                            <!-- Info -->
                                            <div class="flex-grow-1">
                                                <h4 class="fs-6 fw-bold mb-1">{{ $account->account_name ?? '—' }}</h4>
                                                <div class="fw-semibold opacity-50">{{ $account->account_number }} | Region:
                                                    {{ $account->region_code ?? '—' }}</div>
                                                @if ($account->has_suspension)
                                                    <span class="badge badge-light-warning mt-1">Suspended</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Status -->
                                        <div class="text-end ms-3">
                                            @if ($account->is_valid)
                                                <span class="badge badge-light-success">Valid</span>
                                            @else
                                                <span class="badge badge-light-danger">Invalid</span>
                                            @endif

                                            <div class="fs-8 text-muted mt-1">
                                                {{ $account->last_synced_at?->diffForHumans() ?? 'Never' }}</div>
                                        </div>

                                    </label>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>



            {{-- <div class="card card-bordered">
                <div class="card-body">
                    <div id="tsokotsa_chart" class="min-h-auto w-100 ps-4 pe-6" style="height: 300px"></div>
                </div> --}}


            <!-- Card 2: Subscriptions Table -->
            <div class="card mb-5 card-bordered shadow-sm">
                <div class="card-header border-0 pt-6 d-flex flex-wrap justify-content-between">
                    <!-- Search -->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                        <input type="text" data-kt-customer-table-filter="search"
                            class="form-control form-control-solid w-250px ps-13" placeholder="Search Subscribers ...">
                    </div>

                    <!-- Toolbar -->
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_customers_export_modal">
                            <i class="ki-outline ki-exit-up fs-2"></i> Export
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_customer">Add Subscriber
                        </button>
                    </div>
                </div>
                <div class="card-body pt-0 position-relative">

                    <!-- Placeholder (shown initially) -->
                    <div id="subscribersPlaceholder" class="text-center py-15">
                        <i class="bi bi-arrow-up-circle fs-3x text-success mb-3"></i>
                        <div class="fw-semibold text-muted">
                            Select an account above to load subscribers ...
                        </div>
                    </div>

                    <!-- Loader Overlay -->
                    <div id="subscribersLoader"
                        class="d-none position-absolute top-0 start-0 w-100 h-100
               d-flex flex-column align-items-center justify-content-center
               bg-white bg-opacity-75 z-index-3">

                        <div class="spinner-border text-primary mb-3"></div>
                        <div class="fw-semibold text-muted">Loading subscribers...</div>
                    </div>

                    <!-- Table (hidden initially) -->
                    <div id="subscribersTableWrapper" class="table-responsive d-none">
                        <table class="table align-middle table-row-dashed pt-16 fs-8 gy-4" id="subscribersTable">
                            <thead>
                                <tr class="fw-bold text-gray-600 text-uppercase">
                                    <th>Service Line</th>
                                    <th>Nickname</th>
                                    <th>Product Ref</th>
                                    <th>Package Details</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                </div>


            </div>
            <!-- End Card 2 -->

            <!-- Begin of Includes Modal -->
            @include('starlink.modals.top-up')
            @include('starlink.modals.view-subscriber')
            @include('starlink.modals.suspend-subscriber')
            @include('starlink.modals.activate-subscriber')
            <!-- END Includes Modal -->


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        // Show and Hide IP Field       
        $(document).on('change', '#ip_policy', function() {
            if ($(this).val() === '2') {
                $('#ip_field').removeClass('d-none');
            } else {
                $('#ip_field').addClass('d-none');
                $('#ip_field input').val('');
            }
        });



        // I Understand Checkbox
        function toggleForm(enabled) {
            const $form = $('#starlink-subscriber-form');
            const $understand = $('#understand');

            if (!$form.length) return;

            // Sync checkbox state
            $understand.prop('checked', enabled);

            if (enabled) {
                $form.removeClass('form-disabled');
                $form.find(':input').prop('disabled', false);
            } else {
                $form.addClass('form-disabled');
                $form.find(':input').prop('disabled', true);
            }

            // Refresh select2
            $form.find('select[data-control="select2"]').each(function() {
                $(this).trigger('change.select2');
            });
        }

        // Start disabled when form appears
        $(document).on('change', '#understand', function() {
            toggleForm(this.checked);
        });

        // Suspend Subscriber Modal
        const suspendModal = document.getElementById('suspendModal');

        suspendModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const serviceLine = button.getAttribute('data-service');
            suspendModal.querySelector('#serviceLineNumber').value = serviceLine;
        });

        // Suspend Starlink 
        const button = document.getElementById('confirmSuspend');

        button.addEventListener('click', e => {
            e.preventDefault();

            const serviceLine = document.getElementById('serviceLineNumber').value;
            const form = document.getElementById('suspendForm');
            const token = form.querySelector('input[name="_token"]').value;

            Swal.fire({
                text: "Are you sure you want to proceed?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, suspend!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-danger",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/starlink/service-line/${serviceLine}`, {
                            method: 'DELETE',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success("Service line suspended successfully", "Success");
                                location.reload();
                            } else {
                                toastr.error("Failed to suspend service line: " + data.error, "Error");
                            }

                            const modalInstance = bootstrap.Modal.getOrCreateInstance(suspendModal);
                            modalInstance.hide();
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error("Error suspending service line", "Error");

                            const modalInstance = bootstrap.Modal.getOrCreateInstance(suspendModal);
                            modalInstance.hide();
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.info("Action cancelled. Service line was not suspended.", "Cancelled");
                }
            });
        });


        // Activate Service 
        const activateModal = document.getElementById('activateModal');

        activateModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const serviceLine = button.getAttribute('data-service');
            activateModal.querySelector('#serviceLineNumber2').value = serviceLine;
        });
        document.getElementById('confirmActivation').addEventListener('click', () => {
            const serviceLine = document.getElementById('serviceLineNumber2').value;
            const form = document.getElementById('activateForm');
            const token = form.querySelector('input[name="_token"]').value;

            Swal.fire({
                text: "Are you sure you want to activate this service line?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, activate!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-success",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(result => {
                if (result.isConfirmed) {
                    fetch(`/starlink/service-line/${serviceLine}/product`, {
                            method: 'PUT',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                toastr.success("Service line successfully activated", "Success");
                                location.reload();
                            } else {
                                toastr.error("Failed to activate service line: " + data.error, "Error");
                            }

                            const modalInstance = bootstrap.Modal.getOrCreateInstance(activateModal);
                            modalInstance.hide();
                        })
                        .catch(err => {
                            console.error(err);
                            toastr.error("Error activating service line", "Error");

                            const modalInstance = bootstrap.Modal.getOrCreateInstance(activateModal);
                            modalInstance.hide();
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    toastr.info("Action cancelled. Service line was not activated.", "Cancelled");
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const topupModal = document.getElementById('topupModal');

            topupModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;

                if (!button) {
                    console.warn('Topup modal opened without trigger button');
                    return;
                }

                const serviceLine = button.getAttribute('data-service');

                const input = topupModal.querySelector('#topup-serviceLine');

                if (!input) {
                    console.error('Service line input not found');
                    return;
                }

                input.value = serviceLine;
            });

        });


        // View Subscriber Modal
        const subscriberModal = document.getElementById('view-subscriber');
        let currentServiceLine = null;
        let subscriberLoaded = false;

        /**
         * Capture service line when modal is opened
         */
        subscriberModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            currentServiceLine = button.getAttribute('data-service');
            subscriberLoaded = false;

            // RESET UI
            $('#subscriberLoading').removeClass('d-none');
            $('#subscriberContent').addClass('d-none');
            $('#subscriberContentBody').empty();
        });

        /**
         * Load subscriber content when modal is visible
         */
        $('#view-subscriber').on('shown.bs.modal', function() {

            if (!currentServiceLine || subscriberLoaded) {
                return;
            }

            subscriberLoaded = true;

            $.ajax({
                url: `/starlink/subscriber-view/${encodeURIComponent(currentServiceLine)}`,
                method: 'GET',

                success: function(html) {
                    $('#subscriberContentBody').html(html);
                    toggleForm(false);

                    // Re-init Metronic components
                    if (typeof KTComponents !== 'undefined') {
                        KTComponents.init();
                    }

                    // SHOW CONTENT
                    $('#subscriberLoading').addClass('d-none');
                    $('#subscriberContent').removeClass('d-none');
                },

                error: function() {
                    $('#subscriberContentBody').html(
                        '<div class="text-danger text-center py-5">Failed to load subscriber data</div>'
                    );

                    // SHOW CONTENT (with error)
                    $('#subscriberLoading').addClass('d-none');
                    $('#subscriberContent').removeClass('d-none');
                }
            });
        });

        /**
         * Cleanup when modal closes
         */
        $('#view-subscriber').on('hidden.bs.modal', function() {
            $('#subscriberContentBody').empty();
        });


        // Radio Button of the Account


        document.addEventListener('DOMContentLoaded', function() {

            let subscribersTable = null;

            function initSubscribersTable(accountNumber) {

                // Show custom loading overlay
                document.getElementById('subscribersLoader').classList.remove('d-none');

                // Destroy existing table properly
                if ($.fn.DataTable.isDataTable('#subscribersTable')) {
                    $('#subscribersTable').DataTable().clear().destroy();
                }

                subscribersTable = $('#subscribersTable').DataTable({
                    processing: false,
                    serverSide: true,
                    destroy: true,
                    ajax: {
                        url: '/starlink/subscribers/ajax',
                        type: 'GET',
                        data: function(d) {
                            d.account_number = accountNumber;
                        },
                        complete: function() {
                            // Hide loader when finished
                            document.getElementById('subscribersLoader').classList.add('d-none');
                        }
                    },

                    language: {
                        // processing: "Loading subscribers...",
                        emptyTable: "No subscribers found for this account",
                        zeroRecords: "No matching subscribers found",
                        lengthMenu: "Show _MENU_ subscribers",
                        info: "Showing _START_ to _END_ of _TOTAL_ subscribers",
                        infoEmpty: "No subscribers available",
                        search: "Search subscribers:"
                    },

                    columns: [{
                            data: 'serviceLineNumber',
                            render: data => `<code class="fs-9 text-dark">${data ?? '—'}</code>`
                        },
                        {
                            data: 'nickname',
                            render: data => data ? data.split('[')[0] : '—'
                        },
                        {
                            data: 'productReferenceId',
                            render: data => data && data !== 'null' ?
                                `<span class="badge badge-light-info">${data}</span>` :
                                '<span class="text-muted">—</span>'
                        },
                        {
                            data: 'dataBlocks',
                            orderable: false,
                            render: blocks => {
                                if (!blocks?.recurringBlocksCurrentBillingCycle ||
                                    blocks.recurringBlocksCurrentBillingCycle.length === 0)
                                    return '<span class="text-muted">No packages</span>';

                                let html = '';

                                blocks.recurringBlocksCurrentBillingCycle.forEach(block => {
                                    let totalGb = (block.count ?? 0) * (block.dataAmount ??
                                        0);
                                    let value = totalGb >= 1000 ?
                                        (totalGb / 1000).toFixed(2) :
                                        totalGb;
                                    let unit = totalGb >= 1000 ? 'TB' : 'GB';

                                    let productName = block.productId?.split('-')
                                        .slice(2, 5).join('-') ?? '—';

                                    let start = block.startDate ?
                                        moment(block.startDate).format('D MMM YYYY') :
                                        '—';

                                    let end = block.expirationDate ?
                                        moment(block.expirationDate).format('D MMM YYYY') :
                                        '—';

                                    html += `
                                <div class="d-flex flex-column gap-1 rounded mb-2">
                                    <span class="badge badge-light-primary">${productName}</span>
                                    <span class="badge badge-dark" style="width: fit-content;">
                                        Plan: ${value} ${unit}
                                    </span>
                                    <div class="text-muted fs-8">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        ${start} → ${end}
                                    </div>
                                </div>`;
                                });

                                return html;
                            }
                        },
                        {
                            data: 'active',
                            render: active => active ?
                                '<i class="bi bi-check-circle-fill text-success" data-bs-toggle="tooltip" title="Active"></i>' :
                                '<i class="bi bi-x-circle-fill text-danger" data-bs-toggle="tooltip" title="Inactive"></i>'
                        },
                        {
                            data: null,
                            orderable: false,
                            render: row => `
                        <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary"
                            data-kt-menu-trigger="click"
                            data-kt-menu-placement="bottom-end">
                            <i class="ki-outline ki-dots-square fs-1"></i>
                        </button>

                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded
                                    menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                             data-kt-menu="true">

                            <div class="menu-item px-3">
                                <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                    Actions
                                </div>
                            </div>

                            <div class="separator mb-3 opacity-75"></div>

                            <div class="menu-item px-3">
                                <a href="javascript:void(0);" class="menu-link px-3"
                                   data-bs-toggle="modal"
                                   data-bs-target="#topupModal"
                                   data-service="${row.serviceLineNumber}">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-arrow-up fs-5 text-success"></i>
                                    </span>
                                    <span class="menu-title">Top Up</span>
                                </a>
                            </div>

                            <div class="menu-item px-3">
                                <a href="javascript:void(0);" class="menu-link px-3"
                                   data-bs-toggle="modal"
                                   data-bs-target="#view-subscriber"
                                   data-service="${row.serviceLineNumber}">
                                    <span class="menu-icon">
                                        <i class="ki-outline ki-eye fs-5 text-success"></i>
                                    </span>
                                    <span class="menu-title">View Subscriber</span>
                                </a>
                            </div>

                            <div class="menu-item px-3">
                                <a href="#"
                                   class="menu-link px-3"
                                   data-bs-toggle="modal"
                                   data-bs-target="${row.active ? '#suspendModal' : '#activateModal'}"
                                   data-service="${row.serviceLineNumber}">
                                    <span class="menu-icon">
                                        <i class="bi ${row.active ? 'bi-lock text-danger' : 'bi-unlock text-success'} fs-5"></i>
                                    </span>
                                    <span class="menu-title">
                                        ${row.active ? 'Suspend' : 'Activate'}
                                    </span>
                                </a>
                            </div>
                        </div>
                    `

                        }
                    ],

                    drawCallback: function() {

                        // Bootstrap tooltips
                        $('[data-bs-toggle="tooltip"]').tooltip();

                        // Reinitialize Metronic KT Menu
                        if (typeof KTMenu !== "undefined") {
                            KTMenu.createInstances();
                        }
                    }

                });
            }
            // Seach Filed of the datatable
            const searchInput = document.querySelector('[data-kt-customer-table-filter="search"]');

            searchInput.addEventListener('keyup', function(e) {
                subscribersTable.search(e.target.value).draw();
            });

            // ONLY load when radio is clicked
            document.querySelectorAll('.account-radio').forEach(radio => {
                radio.addEventListener('change', function() {

                    // 1️⃣ Hide placeholder
                    const placeholder = document.getElementById('subscribersPlaceholder');
                    if (placeholder) {
                        placeholder.classList.add('d-none');
                    }

                    // 2️⃣ Show table wrapper
                    const tableWrapper = document.getElementById('subscribersTableWrapper');
                    if (tableWrapper) {
                        tableWrapper.classList.remove('d-none');
                    }

                    // 3️⃣ Show loader immediately
                    document.getElementById('subscribersLoader')
                        .classList.remove('d-none');

                    // 4️⃣ Load table
                    initSubscribersTable(this.value);

                    // 5️⃣ Highlight selected card
                    document.querySelectorAll('.account-radio-card')
                        .forEach(c => c.classList.remove('active'));

                    this.closest('.account-radio-card')
                        .classList.add('active');
                });
            });

        });
        // End of radio button of the account

        // document.addEventListener("DOMContentLoaded", function() {
        //     var element = document.getElementById('tsokotsa_chart');
        //     if (!element) return;

        //     // Replace with your device ID
        //     var deviceId = 1;

        //     fetch(`/starlink/${deviceId}/data`)
        //         .then(res => res.json())
        //         .then(data => {
        //             console.log(data); // check if labels/download/upload are arrays
        //             if (!data.download || !data.upload || data.download.length === 0) {
        //                 console.error('No data for chart!');
        //                 return;
        //             }
        //             var options = {
        //                 series: [{
        //                         name: 'Download',
        //                         data: data.download.map(Number)
        //                     },
        //                     {
        //                         name: 'Upload',
        //                         data: data.upload.map(Number)
        //                     }
        //                 ],
        //                 chart: {
        //                     type: 'bar',
        //                     height: 350,
        //                     toolbar: {
        //                         show: false
        //                     },
        //                     zoom: {
        //                         enabled: false
        //                     }
        //                 },
        //                 stroke: {
        //                     curve: 'smooth',
        //                     width: 2
        //                 },
        //                 fill: {
        //                     type: 'gradient',
        //                     gradient: {
        //                         shadeIntensity: 1,
        //                         opacityFrom: 0.35,
        //                         opacityTo: 0.05,
        //                         stops: [0, 90, 100]
        //                     }
        //                 },
        //                 dataLabels: {
        //                     enabled: false // 🚀 remove clutter numbers
        //                 },
        //                 markers: {
        //                     size: 0 // remove circle markers
        //                 },
        //                 xaxis: {
        //                     type: 'datetime',
        //                     categories: data.labels,
        //                     labels: {
        //                         datetimeFormatter: {
        //                             hour: 'HH:mm',
        //                             minute: 'HH:mm'
        //                         }
        //                     }
        //                 },
        //                 yaxis: {
        //                     min: 0,
        //                     decimalsInFloat: 1,
        //                     labels: {
        //                         formatter: function(val) {
        //                             return val.toFixed(1) + " Mbps";
        //                         }
        //                     }
        //                 },
        //                 tooltip: {
        //                     shared: true,
        //                     intersect: false,
        //                     x: {
        //                         format: 'HH:mm'
        //                     },
        //                     y: {
        //                         formatter: function(val) {
        //                             return val.toFixed(2) + " Mbps";
        //                         }
        //                     }
        //                 },
        //                 legend: {
        //                     position: 'top',
        //                     horizontalAlign: 'right'
        //                 },
        //                 grid: {
        //                     strokeDashArray: 4,
        //                     padding: {
        //                         left: 10,
        //                         right: 10
        //                     }
        //                 },
        //                 colors: ['#009EF7', '#50CD89']
        //             };

        //             setTimeout(() => {
        //                 new ApexCharts(element, options).render();
        //             }, 100);
        //         })

        //         .catch(err => console.error(err));
        // });


        // Start of graph

        document.addEventListener("DOMContentLoaded", function() {

            let chart = null;

            // Function to load the chart for a specific service line
            function loadChart(month = 'current', serviceLine) {
                if (!serviceLine) return;

                fetch(`/starlink/${serviceLine}/monthly-usage?month=${month}`)
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('totalDownload').innerText =
                            data.total_download + " GB";
                        document.getElementById('totalUpload').innerText =
                            data.total_upload + " GB";

                        let options = {
                            series: [{
                                    name: 'Download (GB)',
                                    data: data.download
                                },
                                {
                                    name: 'Upload (GB)',
                                    data: data.upload
                                }
                            ],
                            chart: {
                                type: 'bar',
                                height: 380,
                                toolbar: {
                                    show: false
                                }
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '55%',
                                    borderRadius: 6
                                }
                            },
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                show: true,
                                width: 1,
                                colors: ['transparent']
                            },
                            xaxis: {
                                categories: data.labels,
                                title: {
                                    text: 'Day of Month'
                                }
                            },
                            yaxis: {
                                title: {
                                    text: 'Usage (GB)'
                                },
                                labels: {
                                    formatter: val => val + " GB"
                                }
                            },
                            tooltip: {
                                y: {
                                    formatter: val => val + " GB"
                                }
                            },
                            legend: {
                                position: 'top',
                                horizontalAlign: 'right'
                            },
                            colors: ['#009EF7', '#50CD89']
                        };

                        // Destroy previous chart if exists
                        if (chart) chart.destroy();

                        chart = new ApexCharts(document.querySelector("#tsokotsa_chart"), options);
                        chart.render();
                    });
            }

            // Reference to modal
            const modal = document.getElementById('view-subscriber');

            if (modal) {
                // When modal opens
                modal.addEventListener('shown.bs.modal', function(event) {
                    const button = event.relatedTarget; // button that triggered modal
                    const serviceLine = button.getAttribute('data-service');

                    // Optional: store in hidden input if needed
                    const hiddenInput = document.getElementById('serviceLineNumber');
                    if (hiddenInput) hiddenInput.value = serviceLine;

                    // Load chart immediately if chart tab is active
                    const activeTab = modal.querySelector('.tab-pane.active');
                    if (activeTab && activeTab.id === 'tab-usage') {
                        setTimeout(() => loadChart('current', serviceLine), 150);
                    }

                    // Listen for tab changes inside modal to refresh chart
                    modal.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
                        tab.addEventListener('shown.bs.tab', function(event) {
                            if (event.target.getAttribute('href') === '#tab-usage') {
                                const currentServiceLine = hiddenInput ? hiddenInput.value :
                                    serviceLine;
                                setTimeout(() => loadChart('current', currentServiceLine),
                                    150);
                            }
                        });
                    });
                });
            }

            // Expose globally if needed
            window.loadChart = loadChart;

        });

        // End of load the graph




        // document.addEventListener("DOMContentLoaded", function() {

        //     let chart = null;

        //     const serviceLine = document.getElementById('serviceLineNumber').value;

        //     function loadChart(month = 'current') {

        //         fetch(`/starlink/${serviceLine}/monthly-usage?month=${month}`)
        //             .then(res => res.json())
        //             .then(data => {

        //                 document.getElementById('totalDownload').innerText =
        //                     data.total_download + " GB";

        //                 document.getElementById('totalUpload').innerText =
        //                     data.total_upload + " GB";

        //                 let options = {
        //                     series: [{
        //                             name: 'Download (GB)',
        //                             data: data.download
        //                         },
        //                         {
        //                             name: 'Upload (GB)',
        //                             data: data.upload
        //                         }
        //                     ],
        //                     chart: {
        //                         type: 'bar',
        //                         height: 380,
        //                         toolbar: {
        //                             show: false
        //                         }
        //                     },
        //                     plotOptions: {
        //                         bar: {
        //                             horizontal: false,
        //                             columnWidth: '55%',
        //                             borderRadius: 6
        //                         }
        //                     },
        //                     dataLabels: {
        //                         enabled: false
        //                     },
        //                     stroke: {
        //                         show: true,
        //                         width: 1,
        //                         colors: ['transparent']
        //                     },
        //                     xaxis: {
        //                         categories: data.labels,
        //                         title: {
        //                             text: 'Day of Month'
        //                         }
        //                     },
        //                     yaxis: {
        //                         title: {
        //                             text: 'Usage (GB)'
        //                         },
        //                         labels: {
        //                             formatter: function(val) {
        //                                 return val + " GB";
        //                             }
        //                         }
        //                     },
        //                     tooltip: {
        //                         y: {
        //                             formatter: function(val) {
        //                                 return val + " GB";
        //                             }
        //                         }
        //                     },
        //                     legend: {
        //                         position: 'top',
        //                         horizontalAlign: 'right'
        //                     },
        //                     colors: ['#009EF7', '#50CD89']
        //                 };

        //                 // Destroy previous chart (important inside modals)
        //                 if (chart) {
        //                     chart.destroy();
        //                 }

        //                 chart = new ApexCharts(
        //                     document.querySelector("#tsokotsa_chart"),
        //                     options
        //                 );

        //                 chart.render();
        //             });
        //     }

        //     // Load chart when modal becomes visible
        //     const modal = document.getElementById('view-subscriber');

        //     if (modal) {
        //         modal.addEventListener('shown.bs.modal', function() {
        //             loadChart('current');
        //         });
        //     }

        //     // If chart is inside a tab inside modal
        //     document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
        //         tab.addEventListener('shown.bs.tab', function(event) {

        //             // Replace #usage-tab with your actual tab pane ID
        //             if (event.target.getAttribute('href') === '#tab-usage') {
        //                 setTimeout(() => {
        //                     loadChart('current');
        //                 }, 150);
        //             }

        //         });
        //     });

        //     window.loadChart = loadChart;

        // });
    </script>
@endpush
