    <div class="d-flex flex-column flex-lg-row">
        @if ($client_services)
            <div class="flex-column flex-lg-row-auto w-100 w-lg-200px w-xl-300px mb-10">
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2 class="mb-0">Linked Services</h2>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Menu-->
                    <div class="menu menu-column menu-rounded menu-state-bg menu-state-primary fw-semibold"
                        id="services-module">
                        <!-- Tsokotsa cid -->
                        <input type="hidden" id="client_id" value="{{ $client_id }}">
                        <!-- END -->

                        @forelse($client_services as $services)
                            <div class="menu-item">
                                <a href="#" class="menu-link" data-service-tab="{{ $services['service_name'] }}">
                                    <span class="menu-icon">
                                        <i class="{{ $services['icon'] }}"></i>
                                    </span>
                                    <span class="menu-title">{{ Str::ucfirst($services['service_name']) }}</span>
                                    <span class="menu-badge">
                                        <span
                                            class="badge badge-sm badge-circle badge-warning">{{ $services['count'] }}</span>
                                    </span>
                                </a>
                            </div>
                        @empty
                            <div class="menu-item text-center">
                                <h6 class="text-muted">No Services Found</h6>
                            </div>
                        @endforelse
                    </div>
                    <!--end::Menu-->
                </div>
            </div>
        @endif
        <div class="flex-lg-row-fluid ms-lg-10">
            <div class="card card-flush mb-6 mb-xl-9">
                <div class="card-body pt-0">
                    <div class="card-body">
                        <div id="service-tab-content">
                            <div class="d-flex justify-content-center align-items-center" style="min-height:200px">
                                <p class="text-muted fs-4 mb-0">Loading service...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
