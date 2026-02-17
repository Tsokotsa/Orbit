<div class="row g-8">

    <!-- LEFT MENU -->
    <div class="col-md-3">
        <div class="card card-flush h-100">

            <div class="card-header">
                <div class="card-title">
                    <h2 class="mb-0">Linked Services</h2>
                </div>
            </div>

            <div class="card-body pt-3">

                <div class="menu menu-column menu-rounded menu-state-bg menu-state-primary fw-semibold"
                    id="services-module">

                    <input type="hidden" id="client_id" value="{{ $client_id }}">

                    @forelse($client_services as $services)
                        <div class="menu-item">
                            <a href="#" class="menu-link" data-service-tab="{{ $services['service_name'] }}">

                                <span class="menu-icon">
                                    <i class="{{ $services['icon'] }}"></i>
                                </span>

                                <span class="menu-title">
                                    {{ Str::ucfirst($services['service_name']) }}
                                </span>

                                <span class="menu-badge">
                                    <span class="badge badge-sm badge-circle badge-warning">
                                        {{ $services['count'] }}
                                    </span>
                                </span>
                            </a>
                        </div>
                    @empty
                        <div class="menu-item text-center py-5">
                            <span class="text-muted">No Services Found</span>
                        </div>
                    @endforelse

                </div>

                <!-- ADD SERVICE BUTTON -->
                <div class="mt-4 text-center">
                    <a href="/client/service-link" class="btn btn-xs btn-primary px-4 py-2" data-bs-toggle="modal"
                        data-bs-target="#add-service-modal">
                        <i class="bi bi-plus-lg me-1 fs-7"></i>
                        Add Service
                    </a>
                </div>

            </div>
        </div>
    </div>


    <!-- RIGHT CONTENT -->
    <div class="col-md-9">
        <div class="card card-flush mb-6 mb-xl-8 h-100">
            <div class="card-body pt-0">
                <div id="service-tab-content">
                    <div class="d-flex justify-content-center align-items-center" style="min-height:200px">
                        <p class="text-muted fs-4 mb-0">
                            Loading service...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
