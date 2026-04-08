@extends('layouts.master')
{{-- {{ dd($service_line) }} --}}
@section('content')
    @php
        $terminal = !empty($device_status['content']['userTerminals'])
            ? reset($device_status['content']['userTerminals'])
            : [];
    @endphp
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
                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                    <!-- Title -->
                    <h3 class="card-title text-white mb-0">
                        <i class="ki-outline ki-satellite fs-2 me-2 text-primary"></i>
                        Device Information
                    </h3>

                    <!-- Refresh Button -->
                    <button id="refreshTelemetryBtn" class="btn btn-sm btn-primary refresh-telemetry"
                        data-terminal="{{ $device_data['terminal_id'] ?? '' }}"
                        data-router="{{ $device_data['router_id'] ?? '' }}" title="Refresh telemetry data">
                        <i class="ki-outline ki-refresh fs-3 me-1"></i> Refresh
                    </button>
                </div>

                <div class="card-body">

                    <div class="row g-5">
                        <!-- Starlink ID -->
                        <div class="col-md-4 d-flex align-items-center">
                            <div>
                                <div class="text-gray-400 fs-7">Starlink ID</div>
                                <div class="fw-bold text-white">{{ $device_data['terminal_id'] ?? '' }}</div>
                            </div>
                        </div>

                        <!-- Software Version -->
                        <div class="col-md-4 d-flex align-items-center">
                            <div>
                                <div class="text-gray-400 fs-7">Software Version</div>
                                <div class="fw-bold text-white badge badge-success">
                                    {{ $device_data['software_version'] ?? '—' }}
                                </div>
                            </div>
                        </div>

                        <!-- Uptime -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-time fs-2 text-success me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Uptime</div>
                                <div class="fw-bold text-white">{{ $device_data['uptime'] ?? '—' }}</div>
                            </div>
                        </div>

                        <!-- Serial Number -->
                        <div class="col-md-4 d-flex align-items-center">
                            <div>
                                <div class="text-gray-400 fs-7">Serial Number</div>
                                <div class="fw-bold text-white">{{ $device_data['dish_sn'] ?? '' }}</div>
                            </div>
                        </div>

                        <!-- Kit Number -->
                        <div class="col-md-4 d-flex align-items-center">
                            <div>
                                <div class="text-gray-400 fs-7">Kit Number</div>
                                <div class="fw-bold text-white">{{ $device_data['kit'] ?? '' }}</div>
                            </div>
                        </div>

                        <!-- Last Updated -->
                        <div class="col-md-4 d-flex align-items-center">
                            <i class="ki-outline ki-watch fs-2 text-gray-300 me-3"></i>
                            <div>
                                <div class="text-gray-400 fs-7">Last Updated</div>
                                <div class="fw-bold text-white">{{ $device_data['router_last_updated'] ?? '—' }}</div>
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

                                <!-- Gauges -->
                                <div class="col-6 pb-10">
                                    <div id="internetLatency"></div>
                                    <div class="text-gray-400 fs-7">Internet Latency</div>
                                </div>

                                <div class="col-6 pb-10">
                                    <div id="popLatency"></div>
                                    <div class="text-gray-400 fs-7">POP Latency</div>
                                </div>

                                <!-- Drop metrics -->
                                <div class="col-3">
                                    <div id="internetDrop"></div>
                                    <div class="text-gray-400 fs-7">Internet Drop</div>
                                </div>

                                <div class="col-3">
                                    <div id="popDrop"></div>
                                    <div class="text-gray-400 fs-7">POP Drop</div>
                                </div>

                                <div class="col-3">
                                    <div id="dishDrop"></div>
                                    <div class="text-gray-400 fs-7">Dish Drop</div>
                                </div>

                                <!-- Dish latency -->
                                <div class="col-3">
                                    <div id="dishLatency"></div>
                                    <div class="text-gray-400 fs-7">Dish Latency</div>
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
                                Avarage Wi-Fi Throughput
                            </h3>
                        </div>

                        <div class="card-body">
                            <!-- Combined Throughput-->
                            <div id="chart"></div>
                            <!-- End of thoughput graph -->
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

            const routers = telemetry?.content?.routers || {};
            const router = Object.values(routers)[0] || {};

            function num(v) {
                return Number(v ?? 0);
            }

            function createGauge(element, value, max = 200) {

                const options = {

                    series: [value],

                    chart: {
                        height: 160,
                        type: 'radialBar',
                        sparkline: {
                            enabled: true
                        }
                    },

                    plotOptions: {
                        radialBar: {

                            startAngle: -90,
                            endAngle: 90,

                            hollow: {
                                size: "60%"
                            },

                            track: {
                                background: "#2a2a2a"
                            },

                            dataLabels: {

                                name: {
                                    show: false
                                },

                                value: {
                                    offsetY: -5,
                                    fontSize: "20px",
                                    color: "#ffffff",

                                    formatter: function(val) {
                                        return val.toFixed(1) + " ms";
                                    }
                                }
                            }
                        }
                    },

                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "dark",
                            type: "horizontal",
                            gradientToColors: ["#00E396"],
                            stops: [0, 100]
                        }
                    },

                    labels: ['Latency'],

                };

                new ApexCharts(document.querySelector(element), options).render();
            }

            function updateMetric(element, value, unit = "") {

                const el = document.querySelector(element);

                let color = "text-success";

                if (value > 1) color = "text-warning";
                if (value > 5) color = "text-danger";

                el.innerHTML = `
            <div class="fs-2 fw-bold ${color}">
                ${value.toFixed(2)} ${unit}
            </div>
        `;
            }

            // Gauges
            createGauge("#internetLatency", num(router.internetPingLatencyMs));
            createGauge("#popLatency", num(router.popPingLatencyMs));

            // Numeric metrics
            updateMetric("#internetDrop", num(router.internetPingDropRate), "%");
            updateMetric("#popDrop", num(router.popPingDropRate), "%");
            updateMetric("#dishLatency", num(router.dishPingLatencyMs), "ms");
            updateMetric("#dishDrop", num(router.dishPingDropRate), "%");

        });
        // END Of Gauges
    </script>



    <script>
        @php
            // Grab the routerId from the device_status
            $routerId = !empty($device_status['content']['routers']) ? array_key_first($device_status['content']['routers']) : null;

            $router = $routerId
                ? $device_status['content']['routers'][$routerId]
                : [
                    'clients2GhzRxRateMbpsAvg' => 0,
                    'clients2GhzTxRateMbpsAvg' => 0,
                    'clients5GhzRxRateMbpsAvg' => 0,
                    'clients5GhzTxRateMbpsAvg' => 0,
                ];
        @endphp
        document.addEventListener("DOMContentLoaded", function() {

            var data = {
                clients2GhzRxRateAvg: Number(@json($router['clients2GhzRxRateMbpsAvg'] ?? 0)),
                clients2GhzTxRateAvg: Number(@json($router['clients2GhzTxRateMbpsAvg'] ?? 0)),
                clients5GhzRxRateAvg: Number(@json($router['clients5GhzRxRateMbpsAvg'] ?? 0)),
                clients5GhzTxRateAvg: Number(@json($router['clients5GhzTxRateMbpsAvg'] ?? 0)),
            };

            var options = {
                series: [{
                    name: "Throughput",
                    data: [
                        data.clients2GhzRxRateAvg,
                        data.clients2GhzTxRateAvg,
                        data.clients5GhzRxRateAvg,
                        data.clients5GhzTxRateAvg
                    ]
                }],
                chart: {
                    type: 'bar',
                    height: 260,
                    background: 'transparent'
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                        borderRadius: 6,
                        barHeight: "45%"
                    }
                },
                colors: ['#00E396', '#FEB019', '#008FFB', '#775DD0'],
                dataLabels: {
                    enabled: true,
                    textAnchor: 'start',
                    offsetX: 30,
                    style: {
                        colors: ['#ffffff'],
                        fontSize: '12px'
                    },
                    formatter: function(val) {
                        return val.toFixed(1) + " Mbps";
                    }
                },
                grid: {
                    show: false
                },
                xaxis: {
                    categories: ['2.4GHz RX', '2.4GHz TX', '5GHz RX', '5GHz TX'],
                    labels: {
                        style: {
                            colors: '#cbd5e1'
                        }
                    },
                    axisBorder: {
                        show: false
                    },
                    axisTicks: {
                        show: false
                    }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: '#cbd5e1'
                        }
                    }
                },
                tooltip: {
                    theme: "dark",
                    y: {
                        formatter: function(val) {
                            return val.toFixed(1) + " Mbps";
                        }
                    }
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();

        });


        // Refresh graph data
        $(document).on("click", ".refresh-telemetry", function() {

            let btn = $(this);
            let originalHtml = btn.html();

            Swal.fire({
                title: "Refresh Graph",
                text: "This will take some time to process?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Yes, refresh data",
                cancelButtonText: "Cancel",
            }).then((result) => {

                if (result.isConfirmed) {

                    // Disable button + spinner
                    btn.prop("disabled", true);
                    btn.html('<i class="fa fa-spinner fa-spin"></i> Refreshing...');

                    $.ajax({
                        url: "/starlink/refresh-telemetry",
                        method: "POST",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },

                        success: function(data) {

                            Swal.fire({
                                icon: "success",
                                title: "Completed",
                                text: data.message,
                                timer: 4000,
                                showConfirmButton: true
                            });

                            // Optional: reload graph or page
                            setTimeout(function() {
                                location.reload();
                            }, 1500);

                        },

                        error: function(data) {

                            Swal.fire(
                                "Error",
                                data.responseJSON?.message || "Something went wrong",
                                "error"
                            );

                        },

                        complete: function() {

                            // Restore button
                            btn.prop("disabled", false);
                            btn.html(originalHtml);

                        }
                    });

                }

            });

        });


        // END Of refresh
    </script>
@endpush
