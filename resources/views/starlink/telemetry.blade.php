@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10">
                <div class="col-xl-6">
                    <div class="card card-flush overflow-hidden h-lg-100">
                        <div class="card-header pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                
                                <span class="card-label fw-bold text-gray-900">Starlink Telemetry</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">
                                    Last 24 hours
                                </span>
                            </h3>
                        </div>
                        <div class="card-body d-flex align-items-end p-0">
                            {{-- <div id="starlink_usage" style="height: 300px;"></div> --}}
                            <iframe src="http://dashcenter.paratus.co.mz:3000/d-solo/ad24xsq/uem-core-01?folderUid=afblykxu0o9vkc&orgId=1&from=1769668234111&to=1769689834111&timezone=browser&showCategory=panel-options-override-1&panelId=panel-1&__feature.dashboardSceneSolo=true" width="850" height="300" frameborder="0"></iframe>
                            {{-- <div id="kt_charts_widget_36" style="height: 300px;"></div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')


@endpush
