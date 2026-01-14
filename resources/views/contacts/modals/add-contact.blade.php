<!--begin::Modal - Add task-->
<div class="modal fade" id="modal_add_contact" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">

            <!--begin::Modal body-->
            <div class="modal-body px-5 my-7">
                <!--begin::Form-->
                <form id="modal_add_contact_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                    @csrf
                    <div class="card border-0">
                        <div class="card-header card-header-stretch">
                            <h3 class="card-title">Create Contact</h3>
                            <div class="card-toolbar">
                                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab"
                                            href="#kt_tab_pane_7">Details</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">Contact
                                            Instructions</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="kt_tab_pane_7" role="tabpanel">
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Name</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's name."
                                                        data-bs-original-title="Enter the contact's name."
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    name="name">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Surname</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's surname."
                                                        data-bs-original-title="Enter the contact's surname."
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    name="surname">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!-- Begin Address -->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3">
                                            <span>Address</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="Enter the contact's address"
                                                data-bs-original-title="Enter the contact's address"
                                                data-kt-initialized="1">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <input type="text" class="form-control form-control-solid" name="address"
                                            value="">
                                        <!--end::Input-->
                                    </div>
                                    <!-- End Address -->
                                    <!-- Begin Cell fields -->
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">E-mail</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's email."
                                                        data-bs-original-title="Enter the contact's email."
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid"
                                                    name="email">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Campaings</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Select to enable notifications"
                                                        data-bs-original-title="Select to enable notifications"
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input name="enable_notification"
                                                        class="form-check-input h-40px w-60px" type="checkbox"
                                                        id="flexSwitchDefault" checked />
                                                    <label class="form-check-label" for="flexSwitchDefault">
                                                        Enable Communication
                                                    </label>
                                                </div>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!-- End Cell Fields -->
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_8" role="tabpanel">
                                    <!-- Begin Contacts -->
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span class="required">Cell1</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's primary cell."
                                                        data-bs-original-title="Enter the contact's primary cell."
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid moz_mask"
                                                    name="cell1">
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Cell 2</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's secondary cell."
                                                        data-bs-original-title="Enter the contact's secondary cell."
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid moz_mask"
                                                    name="cell2">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!-- End Contacts -->
                                    <!-- Begin Telegram -->
                                    <div class="row row-cols-1 row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7 col-md-8">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Telegram ID</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Enter the contact's telegram id"
                                                        data-bs-original-title="Enter the contact's telegram id"
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <!--begin::Input group-->
                                                <div class="input-group mb-5">
                                                    <input type="text" name="telegram_id" class="form-control"
                                                        placeholder="" aria-label=""
                                                        aria-describedby="basic-addon2" />
                                                    <span class="input-group-text" id="basic-addon2">
                                                        <i class="ki-duotone ki-send fs-4"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                                <!--end::Input group-->
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mt-3">
                                                    <span>Linked Location</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip"
                                                        aria-label="Link to all or specific"
                                                        data-bs-original-title="Link to all or specific"
                                                        data-kt-initialized="1">
                                                        <i class="ki-outline ki-information fs-7"></i>
                                                    </span>
                                                </label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="linked_location[]" class="form-select form-select-solid"
                                                    data-control="select2" data-close-on-select="false"
                                                    data-placeholder="Select an option" data-allow-clear="true"
                                                    multiple="multiple">
                                                    <option></option>
                                                    @foreach ($sites as $site)
                                                        <option value="{{ $site->id }}">
                                                            {{ $site->name }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!-- End Telegram -->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-semibold form-label mt-3 mb-7">
                                            <span>Notify Simultaneous</span>
                                            <span class="ms-1" data-bs-toggle="tooltip"
                                                aria-label="Enter the contact's address"
                                                data-bs-original-title="To which medias must we sent"
                                                data-kt-initialized="1">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <div class="col-12">
                                            <div class="form-check form-check-inline">
                                                <input name="notify_on[]" class="form-check-input" type="checkbox"
                                                    id="inlineCheckbox1" checked="checked" value="All">
                                                <label class="form-check-label" for="inlineCheckbox1">All</label>
                                            </div>
                                            @foreach ($campaigns as $campaign)
                                                <div class="form-check form-check-inline">
                                                    <input name="notify_on[]" class="form-check-input"
                                                        type="checkbox" id="inlineCheckbox1"
                                                        value="{{ $campaign->id }}">
                                                    <label class="form-check-label"
                                                        for="inlineCheckbox1">{{ $campaign->type }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!--end::Input-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--begin::Actions-->
                    <div class="text-center pt-10">
                        <button type="reset" class="btn btn-light me-3"
                            data-kt-users-modal-action="cancel">Discard</button>
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
<!--end::Modal - Add task-->
