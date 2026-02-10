@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- Card 1: Account Info + Ribbon + Tabs -->
            <div class="card mb-5 mb-xl-10 position-relative overflow-hidden card-rounded">
                <!-- Ribbon Top-Left -->
                <div class="ribbon ribbon-triangle ribbon-top-start border-primary">
                    <div class="ribbon-icon mt-n5 ms-n6">
                        <i class="bi bi-star-fill fs-2 text-white"></i>
                    </div>
                </div>

                {{-- <!-- Country Flag Top-Right -->
                        <div class="position-absolute top-0 end-0 p-3">
                            <span class="flag-icon flag-icon-sa fs-2 rounded shadow-sm"></span>
                        </div> --}}

                <!-- Header -->
                <div class="card-header py-4">
                    <div class="card-title d-flex flex-column">
                        <span class="text-muted text-uppercase fw-semibold fs-6 mb-1 pt-4">
                            {{ $account['content']['accountName'] ?? '—' }}
                        </span>
                        <span class="fw-bold fs-9 text-gray-900 letter-spacing">
                            {{ $account['content']['accountNumber'] ?? '—' }}
                        </span>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body pt-0 pb-0">
                    <!-- Optional summary badges/stats -->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-5">
                        <!-- You can add KPI badges or account summary here -->
                    </div>

                    <!-- Nav Tabs -->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold"
                        id="dataTabs" role="tablist">
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                                data-tab="Subscribers" href="#">Subscribers</a>
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="assets"
                                href="#">Orders</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- End Card 1 -->

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

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-8 gy-4" id="subscribersTable">
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
                            <tbody>
                                @foreach ($subscribers['content']['results'] ?? [] as $sub)
                                    <tr>
                                        <td class="fw-semibold text-gray-800">
                                            <code class="fs-9 text-dark">{{ $sub['serviceLineNumber'] ?? '—' }}</code>
                                        </td>
                                        <td>{{ Str::before($sub['nickname'] ?? '—', '[') }}</td>
                                        <td>
                                            @if (!empty($sub['productReferenceId']) && $sub['productReferenceId'] !== 'null')
                                                <span class="badge badge-light-info">{{ $sub['productReferenceId'] }}</span>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if (!empty($sub['dataBlocks']['recurringBlocksCurrentBillingCycle']))
                                                @foreach ($sub['dataBlocks']['recurringBlocksCurrentBillingCycle'] as $block)
                                                    @php
                                                        $totalGb = ($block['count'] ?? 0) * ($block['dataAmount'] ?? 0);
                                                        if ($totalGb >= 1000) {
                                                            $value = round($totalGb / 1000, 2);
                                                            $unit = 'TB';
                                                        } else {
                                                            $value = $totalGb;
                                                            $unit = 'GB';
                                                        }
                                                    @endphp
                                                    <div class="d-flex flex-column gap-1 rounded">
                                                        <span
                                                            class="badge badge-light-primary">{{ Str::ucfirst(implode('-', array_slice(explode('-', $block['productId']), 2, 3))) ?? '—' }}</span>
                                                        <span class="badge badge-dark " data-bs-toggle="tooltip"
                                                            title="Monthly Plan" style="width: fit-content;">
                                                            Plan:
                                                            {{ $value }} {{ $unit }}
                                                        </span>
                                                        <div class="text-muted fs-8">
                                                            <i class="bi bi-calendar-event me-1"></i>
                                                            {{ isset($block['startDate']) ? \Carbon\Carbon::parse($block['startDate'])->format('d M Y') : '—' }}
                                                            →
                                                            {{ isset($block['expirationDate']) ? \Carbon\Carbon::parse($block['expirationDate'])->format('d M Y') : '—' }}
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span class="text-muted">No packages</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($sub['active'] ?? false)
                                                <i class="bi bi-check-circle-fill text-success" data-bs-toggle="tooltip"
                                                    title="Active"></i>
                                            @else
                                                <i class="bi bi-x-circle-fill text-danger" data-bs-toggle="tooltip"
                                                    title="Inactive"></i>
                                            @endif
                                        </td>
                                        <td>
                                            <!-- Action Button -->
                                            <button class="btn btn-icon btn-color-gray-500 btn-active-color-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                <i class="ki-outline ki-dots-square fs-1"></i>
                                            </button>

                                            <!-- Dropdown Menu -->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                data-kt-menu="true">
                                                <!-- Header -->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                                        Actions</div>
                                                </div>
                                                <div class="separator mb-3 opacity-75"></div>

                                                <!-- Menu item 1 -->
                                                <div class="menu-item px-3">
                                                    <a href="javascript:void(0);" class="menu-link px-3"
                                                        data-bs-toggle="modal" data-bs-target="#topupModal"
                                                        data-service="{{ $sub['serviceLineNumber'] }}">
                                                        <span class="menu-icon">
                                                            <i class="ki-outline ki-arrow-up fs-5 text-success"></i>
                                                        </span>
                                                        <span class="menu-title">Top Up</span>
                                                    </a>
                                                </div>


                                                <!-- Menu item 2 -->
                                                <div class="menu-item px-3">
                                                    <a href="javascript:void(0);" class="menu-link px-3"
                                                        data-bs-toggle="modal" data-bs-target="#view-subscriber"
                                                        data-service="{{ $sub['serviceLineNumber'] }}">
                                                        <span class="menu-icon"><i
                                                                class="ki-outline ki-eye fs-5 text-success"></i></span>
                                                        <span class="menu-title">View Subscriber</span>
                                                    </a>
                                                </div>

                                                <!-- Menu item 3 -->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                        data-bs-target="{{ $sub['active'] ?? false ? '#suspendModal' : '#activateModal' }}"
                                                        data-service="{{ $sub['serviceLineNumber'] }}">

                                                        <span class="menu-icon">
                                                            <i
                                                                class="bi {{ $sub['active'] ?? false ? 'bi-lock text-danger' : 'bi-unlock  text-success' }} fs-5"></i>
                                                        </span>

                                                        <span class="menu-title">
                                                            {{ $sub['active'] ?? false ? 'Suspend' : 'Activate' }}
                                                        </span>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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
        const table = $('#subscribersTable').DataTable({
            // $('#subscribersTable').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 6, // ✅ default rows per page
            lengthMenu: [5, 10, 25, 50], // optional dropdown options
            order: [
                [0, 'asc']
            ],
            language: {
                emptyTable: "No subscribers found",
                processing: "Loading Orbit subscribers…"
            }
        });

        table.on('draw', function() {
            KTMenu.createInstances();
        });

        const searchInput = document.querySelector('[data-kt-customer-table-filter="search"]');

        searchInput.addEventListener('keyup', function(e) {
            table.search(e.target.value).draw();
        });

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
    </script>
@endpush
