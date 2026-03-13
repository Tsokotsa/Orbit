@extends('layouts.master')
{{-- {{ dd($service_line) }} --}}
@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">

            <!-- Account Card -->
            {{-- <div class="card mb-5 mb-xl-10 position-relative overflow-hidden card-rounded">

                <!-- Ribbon -->
                <div class="ribbon ribbon-triangle ribbon-top-start border-primary">
                    <div class="ribbon-icon mt-n5 ms-n6">
                        <i class="bi bi-star-fill fs-2 text-white"></i>
                    </div>
                </div>

                <!-- Header -->
                <div class="card-header py-4">
                    <div class="card-title d-flex flex-column">

                        <span class="text-muted text-uppercase fw-semibold fs-6 mb-1 pt-4">
                            {{ $account->raw_payload['content']['accountName'] ?? '—' }}
                        </span>

                        <span class="fw-bold fs-9 text-gray-900 letter-spacing">
                            {{ $account->raw_payload['content']['accountNumber'] ?? '—' }} | {{ $service_line }}
                        </span>

                    </div>
                </div>

            </div> --}}
            <!-- END Account Card -->

            <!-- Top ROW with buttons -->
            <div class="row g-4">
                <div class="col-12 col-md-xl">

                    <div class="card shadow-sm border-0 rounded-4 h-100">

                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <!-- Device Status -->
                            <div class="d-flex align-items-center gap-3">

                                <a href="#" class="btn btn-icon btn-light pulse pulse-success">
                                    <i class="ki-duotone ki-satellite fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    <span class="pulse-ring"></span>
                                </a>
                                <span class="fw-bold fs-5 text-gray-800">
                                    STARLINK
                                </span>

                            </div>

                            <!-- Device Actions -->
                            <div class="d-flex align-items-center gap-2 flex-wrap">

                                <button class="btn btn-sm btn-light device-action" data-action="reboot">
                                    <i class="ki-outline ki-arrows-circle fs-5 me-1"></i>
                                    Reboot
                                </button>

                                <button class="btn btn-sm btn-light device-action" data-action="check_update">
                                    <i class="ki-outline ki-cloud-change fs-5 me-1"></i>
                                    Check Update
                                </button>

                                <button class="btn btn-sm btn-light device-action" data-action="stow">
                                    <i class="ki-outline ki-arrow-down fs-5 me-1"></i>
                                    Stow
                                </button>

                                <button class="btn btn-sm btn-light device-action" data-action="configure">
                                    <i class="ki-outline ki-setting-3 fs-5 me-1"></i>
                                    Configure
                                </button>

                                <button class="btn btn-sm btn-light-danger device-action" data-action="remove">
                                    <i class="ki-outline ki-trash fs-5 me-1"></i>
                                    Remove Device
                                </button>

                            </div>


                        </div>

                    </div>

                </div>
            </div>
            <!-- END of ROW -->
            <!-- Begin of device info -->
            <!-- DEVICE INFO CARD -->
            <div class="card mt-6 bg-dark border border-gray-700">
                <div class="card-header border-0">
                    <h3 class="card-title text-white">
                        <i class="ki-outline ki-satellite fs-2 me-2 text-primary"></i>
                        Device Information
                    </h3>
                </div>

                <div class="card-body">

                    <div class="row g-5">

                        <!-- Starlink ID -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-satellite fs-2 text-primary me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Starlink ID</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['terminal_id'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Software Version -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-code fs-2 text-info me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Software Version</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['software_version'] ?? '—' }}
                                </div>
                            </div>
                        </div>

                        <!-- Uptime -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-time fs-2 text-success me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Uptime</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['uptime'] ?? '—' }}
                                </div>
                            </div>
                        </div>

                        <!-- Serial Number -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-barcode fs-2 text-light me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Serial Number</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['dish_sn'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Kit Number -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-chip fs-2 text-warning me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Kit Number</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['kit'] }}
                                </div>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-watch fs-2 text-gray-300 me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Last Updated</div>
                                <div class="fw-bold text-white">
                                    {{ $device_data['router_last_updated'] ?? '—' }}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <!-- GRAPHS ROW -->
            <div class="row mt-6 g-5">

                <!-- LEFT CARD : NETWORK HEALTH -->
                <div class="col-lg-6">

                    <div class="card bg-dark border border-gray-700 h-100">

                        <div class="card-header border-0">
                            <h3 class="card-title text-white">
                                <i class="ki-outline ki-chart-line fs-2 me-2 text-success"></i>
                                Network Health
                            </h3>
                        </div>

                        <div class="card-body">

                            <div class="row g-4 text-center">

                                <div class="col-4">
                                    <div id="internetDrop"></div>
                                    <div class="text-gray-400 fs-7">Internet Drop</div>
                                </div>

                                <div class="col-4">
                                    <div id="internetLatency"></div>
                                    <div class="text-gray-400 fs-7">Internet Latency</div>
                                </div>

                                <div class="col-4">
                                    <div id="popLatency"></div>
                                    <div class="text-gray-400 fs-7">POP Latency</div>
                                </div>

                                <div class="col-4">
                                    <div id="popDrop"></div>
                                    <div class="text-gray-400 fs-7">POP Drop</div>
                                </div>

                                <div class="col-4">
                                    <div id="dishLatency"></div>
                                    <div class="text-gray-400 fs-7">Dish Latency</div>
                                </div>

                                <div class="col-4">
                                    <div id="dishDrop"></div>
                                    <div class="text-gray-400 fs-7">Dish Drop</div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <!-- RIGHT CARD : OTHER METRICS -->
                <div class="col-lg-6">

                    <div class="card bg-dark border border-gray-700 h-100">

                        <div class="card-header border-0">
                            <h3 class="card-title text-white">
                                <i class="ki-outline ki-chart-bar fs-2 me-2 text-primary"></i>
                                Throughput & Client Metrics
                            </h3>
                        </div>

                        <div class="card-body">

                            <!-- Future ApexCharts Graph -->
                            <div id="throughputChart" style="height:320px;"></div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // On Click of REBOOT 
        $(document).on("click", ".device-action", function() {

            let action = $(this).data("action");

            let actionLabels = {
                reboot: "Reboot Device",
                check_update: "Check for Updates",
                stow: "Stow Device",
                configure: "Open Configuration",
                remove: "Remove Device"
            };

            Swal.fire({
                title: actionLabels[action],
                text: "Are you sure you want to perform this action?",
                icon: action === "remove" ? "warning" : "question",
                showCancelButton: true,
                confirmButtonText: "Yes, continue",
                cancelButtonText: "Cancel",
                confirmButtonColor: action === "remove" ? "#d33" : "#3085d6"
            }).then((result) => {

                if (result.isConfirmed) {

                    $.ajax({
                        url: "/starlink/device-action",
                        method: "POST",
                        data: {
                            action: action,
                        },

                        success: function() {

                            Swal.fire({
                                icon: "success",
                                title: "Action completed",
                                timer: 1500,
                                showConfirmButton: false
                            });

                        },

                        error: function() {

                            Swal.fire(
                                "Error",
                                "Unable to perform action",
                                "error"
                            );

                        }

                    });

                }

            });

        });
        // END REBOOT confirm

        // Start Ping Graph

        document.addEventListener("DOMContentLoaded", function() {

            const telemetry = @json($device_status ?? []);

            console.log("Telemetry:", telemetry);

            const routers = telemetry?.content?.routers || {};
            const router = Object.values(routers)[0] || {};

            console.log("Router:", router);

            function num(v) {
                return Number(v ?? 0);
            }

            function createGauge(element, value) {

                const options = {

                    series: [value],

                    chart: {
                        height: 160,
                        type: 'radialBar',
                        offsetY: -10,
                        sparkline: {
                            enabled: true
                        }
                    },

                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,

                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '97%',
                                margin: 5
                            },

                            dataLabels: {
                                name: {
                                    show: false
                                },

                                value: {
                                    offsetY: -2,
                                    fontSize: '20px',
                                    color: '#ffffff', // <-- Make value text visible on dark background
                                    formatter: function(val) {
                                        return Number(val).toFixed(2);
                                    }
                                }
                            }
                        }
                    },

                    labels: ['']
                };

                const chart = new ApexCharts(
                    document.querySelector(element),
                    options
                );

                chart.render();
            }

            // Create all gauges
            createGauge("#internetLatency", num(router.internetPingLatencyMs));
            createGauge("#internetDrop", num(router.internetPingDropRate));
            createGauge("#popLatency", num(router.popPingLatencyMs));
            createGauge("#popDrop", num(router.popPingDropRate));
            createGauge("#dishLatency", num(router.dishPingLatencyMs));
            createGauge("#dishDrop", num(router.dishPingDropRate));

        });
    </script>
@endpush
