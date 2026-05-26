<div class="accordion accordion-icon-toggle" id="kt_ports_accordion">

    @foreach ($subscribers[0]['associate-port'] ?? [] as $index => $port)
        @php
            $collapseId = "port_collapse_$index";
            $detailsTab = "details_tab_$index";
            $profileTab = "profile_tab_$index";
            $ipv4Tab = "ipv4_tab_$index";
            $actionsTab = "actions_tab_$index";
        @endphp

        <div class="mb-5">
            <!-- Header -->
            <div class="accordion-header py-3 d-flex {{ $index !== 0 ? 'collapsed' : '' }}" data-bs-toggle="collapse"
                data-bs-target="#{{ $collapseId }}">

                <span class="accordion-icon">
                    <i class="ki-duotone ki-arrow-right fs-4">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </span>
                <h6
                    class="fs-8 fw-semibold mb-0 ms-4 badge {{ $port['ont_status']['oper-status'] === 'present' ? 'bg-light-primary' : 'bg-light-danger' }} text-dark">
                    {{ $port['port'] ?? '—' }}
                    <span class="badge badge-light ms-2">
                        {{ $port['network-name'] ?? 'Unknown OLT' }}
                    </span>
                </h6>
            </div>

            <!-- Body -->
            <div id="{{ $collapseId }}" class="collapse {{ $index === 0 ? 'show' : '' }} ps-5"
                data-bs-parent="#kt_ports_accordion">

                <!-- FORM -->
                <form class="form">

                    <div class="card border-0">
                        <div class="ms-auto px-4">
                            <ul class="nav nav-tabs nav-line-tabs fs-7 border-0">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" onclick="event.stopPropagation()"
                                        href="#{{ $detailsTab }}">
                                        Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" onclick="event.stopPropagation()"
                                        href="#{{ $profileTab }}">
                                        Stats
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" onclick="event.stopPropagation()"
                                        href="#{{ $ipv4Tab }}">
                                        IpV4
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" onclick="event.stopPropagation()"
                                        href="#{{ $actionsTab }}">
                                        Actions
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">

                                <!-- DETAILS -->
                                <div class="tab-pane fade show active" id="{{ $detailsTab }}">
                                    <div class="row g-5">
                                        <div class="col-md-5 input-group-sm">
                                            <label class="form-label">Service Template</label>
                                            <input type="text" class="form-control"
                                                value="{{ $port['associate-service'][0]['serviceTemplate'] ?? '' }}">
                                        </div>

                                        <div class="col-md-4 input-group-sm">
                                            <label class="form-label">Device s/n</label>
                                            <input type="text" class="form-control"
                                                value="{{ $port['device-serial'] ?? '' }}">
                                        </div>

                                        <div class="col-md-3 input-group-sm">
                                            <label class="form-label">Vlan</label>
                                            <input type="text" class="form-control"
                                                value="{{ $port['associate-service'][0]['vlan'] ?? '' }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Stats -->
                                <div class="tab-pane fade" id="{{ $profileTab }}">
                                    <div class="row g-5">
                                        <div class="table-responsive">
                                            <table
                                                class="table table-row-dashed table-row-gray-300 align-middle gs-4 gy-3 mb-0">
                                                <thead class="text-muted fw-semibold fs-9 text-uppercase top-3">
                                                    <tr>
                                                        <th>Serial #</th>
                                                        <th>Range Length</th>
                                                        <th>Uptime</th>
                                                        <th class="text-center">ONT Rx</th>
                                                        <th class="text-center">ONT Tx</th>
                                                        <th class="text-center">OLT Rx</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr class="fw-semibold fs-8">
                                                        <!-- Serial -->
                                                        <td>
                                                            <span class="text-gray-900">
                                                                {{ $port['ont_status']['serial-number'] ?? '—' }}
                                                            </span>
                                                        </td>

                                                        <!-- Range -->
                                                        <td>
                                                            {{ isset($port['ont_status']['range-length']) ? number_format($port['ont_status']['range-length'] / 1000, 2) : '—' }}
                                                            <span class="text-muted">km</span>
                                                        </td>

                                                        <!-- Uptime -->
                                                        <td>
                                                            <span class="text-success">
                                                                {{ \Carbon\CarbonInterval::seconds($port['ont_status']['up-time'])->cascade()->forHumans(short: true) ?? '—' }}
                                                            </span>
                                                        </td>

                                                        <!-- ONT RX -->
                                                        <td class="text-center">
                                                            <span class="badge badge-light">
                                                                {{ $port['ont_status']['opt-signal-level'] ?? '—' }}
                                                                dBm
                                                            </span>
                                                        </td>

                                                        <!-- ONT TX -->
                                                        <td class="text-center">
                                                            <span class="badge badge-light">
                                                                {{ $port['ont_status']['tx-opt-level'] ?? '—' }} dBm
                                                            </span>
                                                        </td>

                                                        <!-- OLT RX -->
                                                        <td class="text-center">
                                                            <span class="badge badge-light">
                                                                {{ $port['ont_status']['ne-opt-signal-level'] ?? '—' }}
                                                                dBm
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>

                                <!-- IPv4 Details -->
                                <div class="tab-pane fade" id="{{ $ipv4Tab }}">
                                    <div class="row g-5">
                                        <span class="text-mutted fs-4">Details Related to the IPv4 Address</span>
                                    </div>
                                </div>
                                <!-- End Ipv4 -->

                                <!-- IPv4 Details -->
                                <div class="tab-pane fade" id="{{ $actionsTab }}">
                                    <div class="row g-5">
                                        <div
                                            class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-4 mb-8">
                                            <!--begin::Icon-->
                                            <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                                            <!--end::Icon-->
                                            <!--begin::Wrapper-->
                                            <div class="d-flex flex-stack flex-grow-1">
                                                <!--begin::Content-->
                                                <div class="fw-semibold">
                                                    <h4 class="text-gray-900 fw-bold">Proceed with Caution!</h4>
                                                    <div class="fs-8 text-gray-700">Changes made here will be written on
                                                        <a class="fw-bold" href="/land">ONT</a>.
                                                    </div>
                                                </div>

                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>

                                        <!-- Begin of Actions -->
                                        <td class="text-center align-middle">

                                            <div class="d-inline-flex gap-2 justify-content-center flex-wrap">

                                                <!-- Pause / Resume -->
                                                <a href="#"
                                                    class="btn btn-sm btn-light d-inline-flex align-items-center gap-2">

                                                    <i
                                                        class="las {{ ($port['ont_status']['oper-status'] ?? '') === 'present' ? 'la-pause text-danger' : 'la-play text-success' }}"></i>

                                                    <span class="fw-semibold text-gray-700">
                                                        {{ ($port['ont_status']['oper-status'] ?? '') === 'present' ? 'Pause Service' : 'Resume Service' }}
                                                    </span>

                                                </a>

                                                <!-- Edit Profile -->
                                                <a href="#"
                                                    class="btn btn-sm btn-light d-inline-flex align-items-center gap-2">

                                                    <i class="las la-user-edit text-primary"></i>

                                                    <span class="fw-semibold text-gray-700">
                                                        Edit Profile
                                                    </span>

                                                </a>

                                                <!-- Delete Service -->
                                                <a href="#"
                                                    class="btn btn-sm btn-light d-inline-flex align-items-center gap-2"
                                                    onclick="return confirm('Delete this service?')">

                                                    <i class="las la-trash text-danger"></i>

                                                    <span class="fw-semibold text-gray-700">
                                                        Delete Service
                                                    </span>

                                                </a>

                                            </div>

                                        </td>

                                        <!-- End of Actions -->
                                    </div>
                                </div>
                                <!-- End Ipv4 -->
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    @endforeach
</div>
