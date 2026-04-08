<div class="row g-5">
    <div class="card card-flush h-xl-100">
        <!--begin::Header-->
        <div class="card-header pt-7">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold text-gray-800">Usage Notifications</span>
                <span class="text-gray-500 mt-1 fw-semibold fs-6">Starlink alerts per contact</span>
            </h3>

            <div class="card-toolbar">
                <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal"
                    data-bs-target="#contact_notification_modal">
                    <i class="bi bi-plus-lg"></i> Add
                </a>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Body-->
        <div class="card-body">
            <div class="table-responsive">
                <table id="notifications_table" class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="min-w-200px">CONTACT</th>
                            <th class="text-start">DEVICE</th>
                            <th class="text-center">THRESHOLD</th>
                            <th class="text-center">CHANNELS</th>
                            <th class="text-center">LIMIT</th>
                            <th class="text-center">STATUS</th>
                            <th class="text-end">ACTIONS</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($contacts_notification as $contact)
                            <tr>
                                <!-- CONTACT -->
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-45px me-3">
                                            <span class="symbol-label bg-light-primary text-primary fw-bold">
                                                {{ strtoupper(substr($contact->name ?? 'N', 0, 1)) }}
                                            </span>
                                        </div>

                                        <div class="d-flex flex-column">
                                            <span class="text-gray-800 fw-bold fs-6">
                                                {{ $contact->name }} {{ $contact->surname }}
                                            </span>

                                            <span class="text-gray-500 fs-7">
                                                {{ $contact->email ?? ($contact->mobile_number ?? 'No contact info') }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <!-- THRESHOLD -->
                                <td class="text-start">

                                    <span class="fw-bold d-inline-flex align-items-center">
                                        <!-- Icon -->
                                        <i class="ki-outline ki-satellite fs-4 me-2" data-bs-toggle="tooltip"
                                            title="{{ $contact->service_id }}"></i>
                                    </span>

                                </td>

                                <!-- THRESHOLD -->
                                <td class="text-center">
                                    <span class="badge badge-light-warning fw-bold">
                                        {{ $contact->threshold_percent }}%
                                    </span>
                                </td>

                                <!-- CHANNELS -->
                                <td class="text-center">
                                    @php
                                        // $channels = json_decode($contact['chanels'], true) ?? [];
                                        $channels = $contact['channels'];
                                    @endphp

                                    @foreach ($channels as $channel)
                                        <span class="badge badge-light-info me-1">
                                            {{ strtoupper($channel) }}
                                        </span>
                                    @endforeach

                                    @if (empty($channels))
                                        <span class="text-muted">None</span>
                                    @endif
                                </td>

                                <!-- LIMIT -->
                                <td class="text-center">
                                    @if ($contact->is_limited)
                                        <span class="badge badge-light-danger">
                                            Max: {{ $contact->max_notifications }}
                                        </span>
                                    @else
                                        <span class="badge badge-light-success">
                                            Unlimited
                                        </span>
                                    @endif
                                </td>

                                <!-- STATUS -->
                                <td class="text-center">
                                    @if ($contact->active)
                                        <span class="badge badge-light-success">Active</span>
                                    @else
                                        <span class="badge badge-light-secondary">Disabled</span>
                                    @endif
                                </td>

                                <!-- ACTIONS -->
                                <td class="text-end">
                                    <a href="#"
                                        class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary me-1">
                                        <i class="ki-outline ki-pencil fs-2"></i>
                                    </a>

                                    <a href="#" class="btn btn-sm btn-icon btn-bg-light btn-active-color-danger">
                                        <i class="ki-outline ki-trash fs-2"></i>
                                    </a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="7">
                                    <div class="text-center py-10">
                                        <i class="bi bi-person-plus fs-2x text-muted mb-4"></i>

                                        <div class="fw-semibold fs-5 text-gray-700 mb-2">
                                            No contacts found
                                        </div>

                                        <div class="text-gray-500 mb-4">
                                            No notification rules configured yet.
                                        </div>

                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#contact_notification_modal">
                                            <i class="bi bi-plus-lg me-2"></i>
                                            Add Contact
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--begin::Modal -Usage Notification-->
@include('starlink.modals.usage-notification')
<!--end::Modal -Usage Notification-->
