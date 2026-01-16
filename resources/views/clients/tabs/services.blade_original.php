    <div class="d-flex flex-column flex-lg-row">
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

                    <div class="menu-item">
                        <a href="#" class="menu-link active" data-service-tab="fiber">
                            <span class="menu-icon">
                                <i class="bi bi-optical-audio fs-3"></i>
                            </span>
                            <span class="menu-title">Fiber</span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="#" class="menu-link" data-service-tab="wireless">
                            <span class="menu-icon">
                                <i class="fa fa-wifi fs-3"></i>
                            </span>
                            <span class="menu-title">Wireless</span>
                            <span class="menu-badge">
                                <span class="badge badge-sm badge-circle badge-danger">5</span>
                            </span>
                        </a>
                    </div>

                    <div class="menu-item">
                        <a href="#" class="menu-link" data-service-tab="vsat">
                            <span class="menu-icon">
                                <i class="fa fa-satellite fs-3"></i>
                            </span>
                            <span class="menu-title">Vsat</span>
                        </a>
                    </div>


                </div>
                <!--end::Menu-->
            </div>
        </div>

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
