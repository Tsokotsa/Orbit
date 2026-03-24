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
                <table class="table table-row-dashed align-middle gs-0 gy-3 my-0">
                    <thead>
                        <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                            <th class="min-w-200px">CONTACT</th>
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
                                <td colspan="6">
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

<!--begin::Modal - New Target-->
<div class="modal fade" id="contact_notification_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form method="POST" action="/notifications/store" class="form" id="kt_modal_new_target_form">
                    @csrf

                    <input type="hidden" name="client_id" value="{{ $cid }}">

                    <!-- ===================== -->
                    <!-- Name Section -->
                    <!-- ===================== -->
                    <div class="row g-9 mb-8">
                        <!-- Name -->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid"
                                placeholder="Enter name" />
                        </div>

                        <!-- Surname -->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Surname</label>
                            <input type="text" name="surname" class="form-control form-control-solid"
                                placeholder="Enter surname" />
                        </div>

                    </div>

                    <!-- ===================== -->
                    <!-- Threshold -->
                    <!-- ===================== -->
                    <div class="mb-8 fv-row">
                        <label class="required fs-6 fw-semibold mb-2">Usage Threshold (%)</label>
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                            name="threshold_percent">
                            <option value="50">50%</option>
                            <option value="60">60%</option>
                            <option value="75">75%</option>
                            <option value="90">90%</option>
                        </select>
                    </div>

                    <!-- ===================== -->
                    <!-- Notification Channels -->
                    <!-- ===================== -->
                    <div class="mb-8 fv-row">
                        <label class="required fs-6 fw-semibold mb-2">Notification Channels</label>
                        <select class="form-select form-select-solid" data-control="select2"
                            data-placeholder="Select channels" name="channels[]" multiple>
                            <option value="none" selected>None</option>
                            <option value="sms">SMS</option>
                            <option value="email">Email</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="telegram">Telegram</option>
                        </select>
                    </div>

                    <!-- ===================== -->
                    <!-- Contact Details -->
                    <!-- ===================== -->
                    <div class="row g-9 mb-8">

                        <!-- Mobile -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Mobile Number (SMS)</label>
                            <input type="text" name="mobile_number" class="form-control form-control-solid"
                                placeholder="+258..." />
                        </div>

                        <!-- Email -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Email</label>
                            <input type="email" name="email" class="form-control form-control-solid"
                                placeholder="example@email.com" />
                        </div>

                        <!-- WhatsApp -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">WhatsApp Number</label>
                            <input type="text" name="whatsapp_nr" class="form-control form-control-solid"
                                placeholder="+258..." />
                        </div>

                        <!-- Telegram -->
                        <div class="col-md-6 fv-row">
                            <label class="fs-6 fw-semibold mb-2">Telegram ID</label>
                            <input type="text" name="telegram_id" class="form-control form-control-solid"
                                placeholder="@username or ID" />
                        </div>

                    </div>

                    <!-- ===================== -->
                    <!-- Actions -->
                    <!-- ===================== -->
                    <div class="text-center">
                        <button type="reset" class="btn btn-light me-3">
                            Cancel
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Save Notification</span>
                            <span class="indicator-progress">
                                Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>

                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
