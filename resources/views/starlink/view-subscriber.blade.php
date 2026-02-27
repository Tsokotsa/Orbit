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

            <div>
                <button class="btn btn-sm btn-primary" onclick="loadChart('current')">Current
                    Month</button>
                <button class="btn btn-sm btn-light" onclick="loadChart('last')">Last
                    Month</button>
            </div>

            <div>
                <strong>Total Download:</strong> <span id="totalDownload">0 GB</span> |
                <strong>Total Upload:</strong> <span id="totalUpload">0 GB</span>
            </div>
        </div>

        <div id="tsokotsa_chart"></div>


    </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let chart = null;

            function renderChart(data) {
                document.getElementById('totalDownload').innerText = data.total_download + " GB";
                document.getElementById('totalUpload').innerText = data.total_upload + " GB";

                const options = {
                    series: [{
                            name: 'Download',
                            data: data.download.map(Number)
                        },
                        {
                            name: 'Upload',
                            data: data.upload.map(Number)
                        }
                    ],
                    chart: {
                        type: 'bar',
                        height: 350,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 2
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.35,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    markers: {
                        size: 0
                    },
                    xaxis: {
                        type: 'datetime',
                        categories: data.labels
                    },
                    yaxis: {
                        min: 0,
                        decimalsInFloat: 1,
                        labels: val => val.toFixed(1) + " Mbps"
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: val => val.toFixed(2) + " Mbps"
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right'
                    },
                    colors: ['#009EF7', '#50CD89']
                };

                if (chart) chart.destroy();
                chart = new ApexCharts(document.querySelector("#tsokotsa_chart"), options);
                chart.render();
            }

            // Initial render from controller
            const initialUsage = @json($usage);
            renderChart(initialUsage);

            // Buttons for Current/Last month
            window.loadChart = function(month, serviceLine) {
                fetch(`/starlink/${serviceLine}/monthly-usage?month=${month}`)
                    .then(res => res.json())
                    .then(data => renderChart(data));
            };

        });
    </script>
@endpush
