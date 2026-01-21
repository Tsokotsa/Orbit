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
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                                        data-tab="assets" href="#">Orders</a>
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
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Search Subscribers ...">
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subscribers['content']['results'] ?? [] as $sub)
                                            <tr>
                                                <td class="fw-semibold text-gray-800">
                                                    <code
                                                        class="fs-9 text-dark">{{ $sub['serviceLineNumber'] ?? '—' }}</code>
                                                </td>
                                                <td>{{ Str::before($sub['nickname'] ?? '—', '[') }}</td>
                                                <td>
                                                    @if (!empty($sub['productReferenceId']) && $sub['productReferenceId'] !== 'null')
                                                        <span
                                                            class="badge badge-light-info">{{ $sub['productReferenceId'] }}</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (!empty($sub['dataBlocks']['recurringBlocksCurrentBillingCycle']))
                                                        @foreach ($sub['dataBlocks']['recurringBlocksCurrentBillingCycle'] as $block)
                                                            @php
                                                                $totalGb =
                                                                    ($block['count'] ?? 0) *
                                                                    ($block['dataAmount'] ?? 0);
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
                                                                    class="badge badge-light-primary">{{ $block['productId'] ?? '—' }}</span>
                                                                <span class="badge badge-dark "
                                                                    data-bs-toggle="tooltip" title="Monthly Plan" style="width: fit-content;">
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
                                                <td>
                                                    @if ($sub['active'] ?? false)
                                                        <i class="bi bi-check-circle-fill text-success"
                                                            data-bs-toggle="tooltip" title="Active"></i>
                                                    @else
                                                        <i class="bi bi-x-circle-fill text-danger" data-bs-toggle="tooltip"
                                                            title="Inactive"></i>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- End Card 2 -->




        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const table = $('#subscribersTable').DataTable({
            // $('#subscribersTable').DataTable({
            processing: true,
            serverSide: false,
            pageLength: 5, // ✅ default rows per page
            lengthMenu: [5, 10, 25, 50], // optional dropdown options
            order: [
                [0, 'asc']
            ],
            language: {
                emptyTable: "No subscribers found",
                processing: "Loading Orbit subscribers…"
            }
        });

        const searchInput = document.querySelector('[data-kt-customer-table-filter="search"]');

        searchInput.addEventListener('keyup', function(e) {
            table.search(e.target.value).draw();
        });

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTUsersList.init();
        });
    </script>
@endpush
