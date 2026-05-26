<div class="card border-0 shadow-sm">

    <div class="card-body p-8">

        <!--begin::Section Title-->
        <div class="d-flex align-items-center justify-content-between mb-8">

            <div>

                <h3 class="fw-bold mb-1">
                    Client Overview
                </h3>

                <div class="text-muted fs-7">
                    General information, communication preferences and internal notes
                </div>

            </div>

            <button class="btn btn-sm btn-light-primary">

                <i class="ki-outline ki-pencil fs-3"></i>

                Edit Overview

            </button>

        </div>
        <!--end::Section Title-->

        <!--begin::Stats-->
        <div class="row g-5 mb-8">

            <!-- Primary Phone -->
            <div class="col-xl-4">

                <div class="border border-gray-200 rounded-3 p-6 h-100 bg-light-light">

                    <div class="d-flex align-items-center mb-4">

                        <div class="symbol symbol-45px me-4">

                            <span class="symbol-label bg-light-primary">

                                <i class="ki-outline ki-phone fs-2 text-primary"></i>

                            </span>

                        </div>

                        <div>

                            <div class="text-gray-500 fs-7 text-uppercase fw-semibold">
                                Primary Phone
                            </div>

                            <div class="fw-bold fs-4">
                                {{ $client['phone'] ?? 'N/A' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Secondary Phone -->
            <div class="col-xl-4">

                <div class="border border-gray-200 rounded-3 p-6 h-100">

                    <div class="d-flex align-items-center mb-4">

                        <div class="symbol symbol-45px me-4">

                            <span class="symbol-label bg-light-info">

                                <i class="ki-outline ki-phone fs-2 text-info"></i>

                            </span>

                        </div>

                        <div>

                            <div class="text-gray-500 fs-7 text-uppercase fw-semibold">
                                Secondary Phone
                            </div>

                            <div class="fw-bold fs-4">
                                {{ $client['phone2'] ?? 'N/A' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Client Type -->
            <div class="col-xl-4">

                <div class="border border-gray-200 rounded-3 p-6 h-100">

                    <div class="d-flex align-items-center mb-4">

                        <div class="symbol symbol-45px me-4">

                            <span class="symbol-label bg-light-success">

                                <i class="ki-outline ki-profile-circle fs-2 text-success"></i>

                            </span>

                        </div>

                        <div>

                            <div class="text-gray-500 fs-7 text-uppercase fw-semibold">
                                Client Type
                            </div>

                            <div class="fw-bold fs-4">
                                {{ Str::ucfirst($client['company_type']) ?? 'N/A' }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!--end::Stats-->

        <!--begin::Row-->
        <div class="row g-5 mb-8">

            <!-- Tags -->
            <div class="col-xl-6">

                <div class="card card-flush border rounded-3 h-100">

                    <div class="card-header">

                        <div class="card-title">

                            <h3 class="fw-bold">
                                Client Tags
                            </h3>

                        </div>

                    </div>

                    <div class="card-body pt-2">

                        <input name="client_tags" class="form-control form-control-solid"
                            value="Important, Priority, Partner" id="client_tags" />

                    </div>

                </div>

            </div>

            <!-- Notifications -->
            <div class="col-xl-6">

                <div class="card card-flush border rounded-3 h-100">

                    <div class="card-header">

                        <div class="card-title">

                            <h3 class="fw-bold">
                                Notifications
                            </h3>

                        </div>

                    </div>

                    <div class="card-body pt-2">

                        <div class="d-flex flex-column gap-5">

                            <div class="d-flex flex-stack">

                                <div>

                                    <div class="fw-semibold">
                                        Email Notifications
                                    </div>

                                    <div class="text-muted fs-7">
                                        Receive account updates via email
                                    </div>

                                </div>

                                <label class="form-check form-switch form-check-solid">

                                    <input class="form-check-input" type="checkbox" checked />

                                </label>

                            </div>

                            <div class="d-flex flex-stack">

                                <div>

                                    <div class="fw-semibold">
                                        SMS Notifications
                                    </div>

                                    <div class="text-muted fs-7">
                                        Receive alerts via SMS
                                    </div>

                                </div>

                                <label class="form-check form-switch form-check-solid">

                                    <input class="form-check-input" type="checkbox" />

                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!--end::Row-->

        <!--begin::Notes-->
        <div class="card card-flush border rounded-3">

            <div class="card-header">

                <div class="card-title">

                    <h3 class="fw-bold">
                        Internal Notes
                    </h3>

                </div>

            </div>

            <div class="card-body pt-2">

                <textarea class="form-control form-control-solid" rows="6"
                    placeholder="Add internal notes regarding this client..."></textarea>

            </div>

        </div>
        <!--end::Notes-->

    </div>

</div>
