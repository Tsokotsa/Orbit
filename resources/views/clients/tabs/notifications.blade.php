<div class="row g-5">

    @forelse ($contacts_notification as $contact)
    @empty

        <div class="col-12">
            <div class="card card-bordered">
                <div class="card-body text-center py-10">
                    <i class="bi bi-person-plus fs-2x text-muted mb-4"></i>

                    <div class="fw-semibold fs-5 text-gray-700 mb-2">
                        No contacts found
                    </div>

                    <div class="text-gray-500 mb-6">
                        This account does not have any contacts yet.
                    </div>
                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                        data-bs-target="#contact_notification_modal">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Contact
                    </a>
                </div>
            </div>
        </div>
    @endforelse

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
