@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!-- Content container -->
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- OLT Device Cards -->
            <div class="row gy-5 g-xl-10 px-6">
                @foreach ($variables as $key => $olts)
                    @php
                        $isEven = $key % 2 === 0;
                    @endphp
                    <div class="col-xl-4 col-md-6">
                        <div class="card card-flush border-0 h-100"
                            style="background-color: {{ $isEven ? '#22232B' : '#ffffff' }}; color: {{ $isEven ? '#fff' : '#000' }}">
                            <!-- Card Header -->
                            <div class="card-header pt-2 d-flex justify-content-between align-items-center">
                                <h3 class="card-title fs-3 fw-bold">
                                    <span
                                        class="fs-3 fw-bold me-2 {{ $key % 2 === 0 ? 'text-white' : 'text-dark' }}">{{ Str::upper($olts['name']) }}</span>
                                    <span class="badge badge-success ms-2">{{ Str::ucfirst($olts['state']) }}</span>
                                </h3>
                                <!-- Toolbar Menu -->
                                <div class="card-toolbar">
                                    <button
                                        class="btn btn-icon {{ $isEven ? 'btn-color-white bg-white bg-opacity-10' : 'btn-color-dark bg-dark bg-opacity-10' }} btn-active-success"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i
                                            class="ki-outline ki-black-right fs-5 {{ $isEven ? 'text-white' : 'text-dark' }}"></i>
                                    </button>
                                    <!-- Menu Content -->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 fw-semibold w-200px"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">Actions</div>
                                        </div>
                                        <div class="separator mb-3 opacity-75"></div>
                                        <div class="menu-item px-3"><a href="#" class="menu-link px-3">Edit OLT</a>
                                        </div>
                                        <div class="menu-item px-3"><a href="/calix/subscribers/list"
                                                class="menu-link px-3">Subscribers</a></div>
                                        <div class="menu-item px-3"><a href="#" class="menu-link px-3">Unassigned</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Card Body -->
                            <div class="card-body pt-3">

                                <div class="d-flex flex-wrap gap-3">

                                    <!-- Provisioned -->
                                    <div
                                        class="rounded min-w-125px py-3 px-4 border border-dashed {{ $isEven ? 'border-white-50' : 'border-gray-300' }}">

                                        <div class="fs-2 fw-bold count-up" data-count="{{ $olts['provisionedONTsCount'] }}">
                                            0
                                        </div>

                                        <div class="fw-semibold fs-7 opacity-50">
                                            Provisioned
                                        </div>

                                    </div>

                                    <!-- Online -->
                                    <div
                                        class="rounded min-w-125px py-3 px-4 border border-dashed {{ $isEven ? 'border-white-50' : 'border-gray-300' }}">

                                        <div class="fs-2 fw-bold text-success count-up"
                                            data-count="{{ $olts['provisionedONTsCount'] - $olts['missingONTsCount'] }}">
                                            0
                                        </div>

                                        <div class="fw-semibold fs-7 opacity-50">
                                            Online
                                        </div>

                                    </div>

                                    <!-- Missing -->
                                    <div
                                        class="rounded min-w-125px py-3 px-4 border border-dashed {{ $isEven ? 'border-white-50' : 'border-gray-300' }}">

                                        <div class="fs-2 fw-bold text-danger count-up"
                                            data-count="{{ $olts['missingONTsCount'] }}">
                                            0
                                        </div>

                                        <div class="fw-semibold fs-7 opacity-50">
                                            Missing
                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- End OLT Cards -->

            <!-- Tabs Section (Outside Cards) -->
            <div class="mt-8 px-6">
                <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-5 fs-6">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_4">Available OLT Devices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Unassigned Subscribers</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Available OLT Devices -->
                    <div class="tab-pane fade show active" id="kt_tab_pane_4">
                        <div class="card">
                            <div class="card-header border-0 pt-6 d-flex justify-content-between align-items-center">
                                <!-- Search -->
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                                    <input type="text" data-kt-customer-table-filter="search"
                                        class="form-control form-control-solid w-250px ps-13"
                                        placeholder="Search OLT's ...">
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-light-primary">Export</button>
                                    <button type="button" class="btn btn-primary">Add OLT</button>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div class="table-responsive">
                                    <table class="table table-row-dashed align-middle fs-9 gy-5">
                                        <thead>
                                            <tr class="fw-bold text-gray-600 text-uppercase fs-7">
                                                <th>OLT</th>
                                                <th>IP</th>
                                                <th>Address</th>
                                                <th>MAC Address</th>
                                                <th>Vendor - Model - Type</th>
                                                <th>Serial #</th>
                                                <th class="text-end">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($variables as $key => $olts)
                                                <tr>
                                                    <td><span
                                                            class="badge badge-light">{{ Str::upper($olts['name']) }}</span>
                                                    </td>
                                                    <td>{{ $olts['address'] }}</td>
                                                    <td>{{ $olts['DeviceAddress'] }}</td>
                                                    <td><code>{{ $olts['systemMacAddress'] }}</code></td>
                                                    <td><span class="badge badge-light-primary">{{ $olts['vendor'] }} -
                                                            {{ $olts['model'] }} - {{ $olts['type'] }}</span></td>
                                                    <td><span
                                                            class="badge badge-light-success">{{ $olts['serialNumber'] }}</span>
                                                    </td>
                                                    <td class="text-end">
                                                        <!-- Action Button -->
                                                        <button
                                                            class="btn btn-icon btn-color-gray-500 btn-active-color-primary"
                                                            data-kt-menu-trigger="click"
                                                            data-kt-menu-placement="bottom-end">
                                                            <i class="ki-outline ki-dots-square fs-1"></i>
                                                        </button>

                                                        <!-- Dropdown Menu -->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                                            data-kt-menu="true">
                                                            <!-- Header -->
                                                            <div class="menu-item px-3">
                                                                <div
                                                                    class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                                                    Actions</div>
                                                            </div>
                                                            <div class="separator mb-3 opacity-75"></div>

                                                            <!-- Menu item 1 -->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">
                                                                    <span class="menu-icon"><i
                                                                            class="ki-outline ki-pencil fs-5"></i></span>
                                                                    <span class="menu-title">Edit OLT</span>
                                                                </a>
                                                            </div>

                                                            <!-- Menu item 2 -->
                                                            <div class="menu-item px-3">
                                                                <a href="/calix/subscribers/list" class="menu-link px-3">
                                                                    <span class="menu-icon"><i
                                                                            class="ki-outline ki-eye fs-5 text-success"></i></span>
                                                                    <span class="menu-title">Subscribers</span>
                                                                </a>
                                                            </div>

                                                            <!-- Menu item 3 -->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">
                                                                    <span class="menu-icon"><i
                                                                            class="ki-outline ki-disconnect fs-5 text-success"></i></span>
                                                                    <span class="menu-title">Unassigned</span>
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
                    </div>

                    <!-- Unassigned Subscribers -->
                    <div class="tab-pane fade" id="kt_tab_pane_5">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Unassigned ONT's</h3>
                                <div class="card-toolbar">
                                    <button type="button" class="btn btn-sm btn-light">Sync Request</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped gy-3 gs-3">
                                        <thead>
                                            <tr class="fw-semibold fs-6 text-gray-800 border-bottom border-gray-200">
                                                <th>Serial #</th>
                                                <th>Device</th>
                                                <th>Vendor ID</th>
                                                <th>Model</th>
                                                <th>Firmware Ver.</th>
                                                <th>Device Mac #</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($unassigned as $item)
                                                <tr>
                                                    <td><strong>{{ $item['device-name'] }}</strong></td>
                                                    <td>{{ $item['port-id'] }}</td>
                                                    <td><span
                                                            class="badge badge-light-primary">{{ $item['serial-number'] }}</span>
                                                    </td>
                                                    <td>{{ $item['model'] }}</td>
                                                    <td><span
                                                            class="badge badge-light-success">{{ $item['curr-version'] }}</span>
                                                    </td>
                                                    <td><code>{{ $item['onu-mac-addr'] }}</code></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="text-center"><span
                                                            class="badge badge-light-primary">Nothing to assign on
                                                            Orbit</span></td>
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
            <!-- End Tabs Section -->

        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function formatNumber(value) {
            return new Intl.NumberFormat().format(value);
        }

        function animateCountUp(el, duration = 2500) {

            let target = parseInt(el.getAttribute('data-count')) || 0;
            let startTime = null;

            function easeOutQuad(t) {
                return t * (2 - t);
            }

            function step(timestamp) {

                if (!startTime) startTime = timestamp;

                let progress = (timestamp - startTime) / duration;

                if (progress > 1) progress = 1;

                let eased = easeOutQuad(progress);

                let value = Math.floor(eased * target);

                el.innerText = formatNumber(value);

                if (progress < 1) {
                    window.requestAnimationFrame(step);
                } else {
                    el.innerText = formatNumber(target);
                }

            }

            window.requestAnimationFrame(step);
        }

        document.addEventListener('DOMContentLoaded', function() {

            let elements = document.querySelectorAll('.count-up');

            elements.forEach((el, index) => {

                // ⬇️ stagger effect (feels like loading wave)
                setTimeout(() => {
                    animateCountUp(el);
                }, index * 150);

            });

        });
    </script>
@endpush
