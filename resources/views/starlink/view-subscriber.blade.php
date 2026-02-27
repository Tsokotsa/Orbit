<style>
    .legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
    }
</style>
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
            </div>
            <!-- End Card 1 -->
            <div class="row g-4">

                <!-- Chart Column -->
                <div class="col-12 col-md-6">

                    <div class="card shadow-sm border-0 rounded-4 h-100">

                        <!-- Card Header -->
                        <div
                            class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center flex-wrap gap-2">

                            <!-- Title -->
                            <div class="px-4 pb-2 pt-8">
                                <div class="d-flex justify-content-between align-items-center flex-wrap">

                                    <!-- LEFT: Totals (unchanged structure) -->
                                    <div class="d-flex gap-4 small text-muted">
                                        <div>
                                            <span class="fw-semibold text-primary">
                                                <i class="bi bi-download me-1"></i>
                                                <span id="totalDownload">0 GB</span>
                                            </span>
                                            <div class="small">Total Download</div>
                                        </div>

                                        <div>
                                            <span class="fw-semibold text-success">
                                                <i class="bi bi-upload me-1"></i>
                                                <span id="totalUpload">0 GB</span>
                                            </span>
                                            <div class="small">Total Upload</div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- Buttons -->
                            <div>
                                <button class="btn btn-sm btn-primary me-2" onclick="loadChart('current')">
                                    Current Month
                                </button>

                                <button class="btn btn-sm btn-light" onclick="loadChart('last')">
                                    Last Month
                                </button>
                            </div>

                        </div>

                        <!-- Chart -->
                        <div class="card-body pt-0">
                            <div id="tsokotsa_chart"></div>
                        </div>
                        <!-- End Chart -->

                    </div>

                </div>

                <!-- Future Columns -->
                <div class="col-12 col-md-6">
                    <!-- You can place another chart or stats card here -->
                </div>

            </div>


        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let chart = null;

            // Helper function to format totals in MB / GB
            function formatDataSize(valueInMb) {
                if (valueInMb >= 1024) {
                    return (valueInMb / 1024).toFixed(2) + " GB";
                } else if (valueInMb >= 1) {
                    return valueInMb.toFixed(2) + " MB";
                } else {
                    return (valueInMb * 1024).toFixed(2) + " KB";
                }
            }

            function renderChart(data) {

                // Dynamically show MB / GB
                document.getElementById('totalDownload').innerText = formatDataSize(data.total_download);
                document.getElementById('totalUpload').innerText = formatDataSize(data.total_upload);

                const options = {
                    series: [{
                            name: "Download",
                            data: data.download.map(Number)
                        },
                        {
                            name: "Upload",
                            data: data.upload.map(Number)
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 300,
                        toolbar: {
                            show: false
                        }
                    },
                    noData: {
                        text: 'No data available on this orbit ...',
                        align: 'center',
                        verticalAlign: 'middle',
                        style: {
                            color: '#6c757d',
                            fontSize: '16px',
                            fontFamily: 'Inter, sans-serif'
                        }
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 6,
                            columnWidth: '45%',
                            dataLabels: {
                                position: 'top'
                            }
                        }
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    zoom: {
                        enabled: false
                    },
                    animations: {
                        enabled: true,
                        easing: "easeinout",
                        speed: 800
                    },
                    fill: {
                        type: "gradient",
                        gradient: {
                            shade: "light",
                            type: "vertical",
                            shadeIntensity: 0.4,
                            opacityTo: 0.4,
                            stops: [0, 100]
                        }
                    },
                    colors: ["#1B84FF", "#17C653"],
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 4,
                        strokeWidth: 2,
                        hover: {
                            size: 6
                        }
                    },
                    grid: {
                        borderColor: "#f1f1f1",
                        strokeDashArray: 4
                    },
                    xaxis: {
                        type: "datetime",
                        categories: data.labels,
                        labels: {
                            style: {
                                colors: "#6c757d",
                                fontSize: "12px"
                            }
                        }
                    },
                    yaxis: {
                        min: 0,
                        decimalsInFloat: 1,
                        labels: {
                            formatter: val => formatDataSize(val),
                            style: {
                                colors: "#6c757d",
                                fontSize: "12px"
                            }
                        }
                    },
                    tooltip: {
                        theme: "light",
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: val => val.toFixed(2) + " Mbps"
                        }
                    },
                    legend: {
                        position: "top",
                        horizontalAlign: "right",
                        fontSize: "13px",
                        labels: {
                            colors: "#212529"
                        }
                    },
                };

                if (chart) chart.destroy();
                chart = new ApexCharts(document.querySelector("#tsokotsa_chart"), options);
                chart.render();
            }

            // Initial render
            const initialUsage = @json($usage);
            renderChart(initialUsage);

            // Buttons for Current / Last month
            window.loadChart = function(month, serviceLine) {
                fetch(`/starlink/${serviceLine}/monthly-usage?month=${month}`)
                    .then(res => res.json())
                    .then(data => renderChart(data));
            };

        });
    </script>
@endpush
