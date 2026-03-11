<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-8 pb-8">
        <div class="tab-pane fade active show" id="Overview" role="tabpanel">
            <form id="kt_modal_new_target_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#"
                data-select2-id="select2-data-kt_modal_new_target_form">

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <div class="col-md-8 fv-row fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Acc Name</span>
                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="This is the Acc from Odoo."
                                data-bs-original-title="This is the Acc from Odoo." data-kt-initialized="1">
                                <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span>
                        </label>
                        <!--end::Label-->
                        <input type="hidden" id="client_id" value="{{ $client_id }}">
                        <input type="text" class="form-control  disabled" value="{{ $client['name'] ?? 'N/A' }}">
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>

                    <!--begin::Col-->
                    <div class="col-md-4 fv-row fv-plugins-icon-container">
                        <label class="required fs-6 fw-semibold mb-2">Client Type</label>
                        <input type="text" class="form-control  disabled"
                            value="{{ Str::ucfirst($client['company_type']) ?? ' N/A' }}">
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Col-->


                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="row g-9 mb-8">
                    <!--begin::Col-->
                    <div class="col-md-4 fv-row fv-plugins-icon-container">
                        <label class="required fs-6 fw-semibold mb-2">Phone #1</label>
                        <input type="text" class="form-control  disabled" value="{{ $client['phone'] ?? ' N/A' }}">
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-4 fv-row fv-plugins-icon-container">
                        <label class="required fs-6 fw-semibold mb-2">Phone #2</label>
                        <input type="text" class="form-control  disabled" value="{{ $client['phone2'] ?? ' N/A' }}">
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Col-->

                    <!--begin::Col-->
                    <div class="col-md-4 fv-row">
                        <label class="required fs-6 fw-semibold mb-2">Created Date</label>

                        <!--begin::Input-->
                        <div class="position-relative d-flex align-items-center">
                            <!--begin::Icon-->
                            <i class="ki-outline ki-calendar-8 fs-2 position-absolute mx-4"></i>
                            <!--end::Icon-->

                            <!--begin::Datepicker-->
                            <input class="form-control  ps-12 flatpickr-input" readonly="readonly"
                                value="{{ $client['create_date'] ?? ' N/A' }}">
                            <!--end::Datepicker-->
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8">
                    <label class="fs-6 fw-semibold mb-2 text-gray-700">
                        Special Notes
                    </label>

                    <textarea class="form-control form-control-solid" rows="4" name="client_special_notes"
                        placeholder="Add any info regarding this client ...."></textarea>

                    <small class="text-muted mt-1">
                        Optional – visible to internal teams only
                    </small>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Tags</span>


                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="Specify a target priorty"
                            data-bs-original-title="Specify a target priorty" data-kt-initialized="1">
                            <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i></span> </label>
                    <!--end::Label-->

                    <label class="form-label">Default input style</label>
                    <input name="client_tags" class="form-control" value="Important, Priority, Partner"
                        id="client_tags" />
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-stack mb-8">
                    <!--begin::Label-->
                    <div class="me-5">
                        <label class="fs-6 fw-semibold">Notify Acc Manager</label>

                        <div class="fs-7 fw-semibold text-muted">If notifications rellated to this Acc
                        </div>
                    </div>
                    <!--end::Label-->

                    <!--begin::Switch-->
                    <label class="form-check form-switch form-check-custom form-check-solid">
                        <input class="form-check-input" type="checkbox" value="1" checked="checked">
                        <span class="form-check-label fw-semibold text-muted">
                            Allowed
                        </span>
                    </label>
                    <!--end::Switch-->
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="mb-15 fv-row">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack">
                        <!--begin::Label-->
                        <div class="fw-semibold me-5">
                            <label class="fs-6">Notifications</label>

                            <div class="fs-7 text-muted">What channels should be used to notify this client</div>
                        </div>
                        <!--end::Label-->

                        <!--begin::Checkboxes-->
                        <div class="d-flex align-items-center">
                            <!--begin::Checkbox-->
                            <label class="form-check form-check-custom form-check-solid me-10">
                                <input class="form-check-input h-20px w-20px" type="checkbox" name="communication[]"
                                    value="email" checked="checked">

                                <span class="form-check-label fw-semibold">
                                    Email
                                </span>
                            </label>
                            <!--end::Checkbox-->

                            <!--begin::Checkbox-->
                            <label class="form-check form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-20px" type="checkbox" name="communication[]"
                                    value="phone">

                                <span class="form-check-label fw-semibold">
                                    Phone
                                </span>
                            </label>
                            <!--end::Checkbox-->
                        </div>
                        <!--end::Checkboxes-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Input group-->

                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">
                        Cancel
                    </button>

                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Submit
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>
                <!--end::Actions-->
            </form>
        </div>
    </div>
</div>
