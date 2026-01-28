<style>
    .form-disabled {
        opacity: 0.5;
        pointer-events: none;
    }
</style>


<div class="modal fade" tabindex="-1" id="view-subscriber">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Subscriber</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <!--begin::Notice-->
                <!--begin::Notice-->
                <div
                    class="notice d-flex bg-light rounded border-light border border-dashed mb-9 p-6 align-items-start">
                    <!-- Icon -->
                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>

                    <!-- Wrapper -->
                    <div class="d-flex flex-stack flex-grow-1">

                        <!-- Content (left) -->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Proceed with caution!</h4>
                            <div class="fs-8 text-gray-700">This is pushed immediately to starlink subscriber.
                            </div>
                        </div>

                        <!-- Switch (right) -->
                        <label class="form-check form-switch form-check-custom form-check-solid m-0">
                            <input class="form-check-input" id="understand" type="checkbox" value="1">
                            <span class="form-check-label fw-semibold text-muted">
                                I understand
                            </span>
                        </label>

                    </div>
                </div>
                <!--end::Notice-->
                <!--begin::Form-->
                <form id="starlink-subscriber-form"
                    class="form fv-plugins-bootstrap5 fv-plugins-framework form-disabled" action="#">
                    <!--begin::Input group-->
                    <div class="row">
                        <div class="fv-row mb-4 fv-plugins-icon-container col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Nickname</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div class="input-group mb-5">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="ki-duotone ki-profile-circle fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span></i>
                                </span>
                                <input type="text" class="form-control" placeholder="nickname" aria-label="Username"
                                    aria-describedby="basic-addon1" />
                            </div>
                            <!--end::Input-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                        <div class="fv-row mb-4 fv-plugins-icon-container col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Service Plan</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select class="form-select" data-control="select2" data-placeholder="Select an option">
                                <option></option>
                                <optgroup label="Local Priority">
                                    <option value="l50">50 GB</option>
                                    <option value="l500">500 GB</option>
                                    <option value="l1000" class="text-muted" disabled>1TB - Comming soon</option>
                                </optgroup>
                                <optgroup label="Global Priority">
                                    <option value="g50">50 GB</option>
                                    <option value="g500">500 GB</option>
                                    <option value="g1000" class="text-muted" disabled>1TB - Comming soon</option>
                                </optgroup>
                            </select>
                            <!--end::Input-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row">
                        <!-- IP Policy -->
                        <div class="fv-row mb-7 col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">IP Policy</span>
                            </label>

                            <select id="ip_policy" class="form-select" data-control="select2">
                                <option value="">Select an option</option>
                                <option value="50">Default</option>
                                <option value="2">Public IP</option>
                            </select>
                        </div>

                        <!-- IP Address (hidden initially) -->
                        <div id="ip_field" class="fv-row mb-7 col-md-6 d-none">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">IP Address</span>
                            </label>

                            <input type="text" class="form-control" name="ip_address" placeholder="e.g. 192.168.1.1">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Auto Top Up</span>
                            </label>

                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-30px" type="checkbox" value="1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Force Suspension</span>
                            </label>

                            <div class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input h-20px w-30px" type="checkbox" value="1">
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3"
                            data-bs-dismiss="modal">Discard</button>
                        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->

</div>