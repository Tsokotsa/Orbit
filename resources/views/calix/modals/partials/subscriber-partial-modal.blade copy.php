<form id="modal_add_contact_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
    @csrf
    <div class="card border-0">
        <div class="card-header card-header-stretch">
            <h3 class="card-title" id="subscriberModalTitle">Subscriber
                <span class="badge bg-warning text-dark ms-2">
                    {{ $subscriber[0]['subscriber']['name'] }}
                </span>
            </h3>
            <div class="card-toolbar">
                <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_7">Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_8">Profile</a>
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
                                    <span class="required">Acc Name</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="The acc name on calix"
                                        data-bs-original-title="The acc name on calix" data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" name="subscriber_acc_name"
                                    id="subscriber_acc_name" value="{{ $subscriber[0]['subscriber']['name'] }}">
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
                                    <span>Custom ID</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Country where device is located"
                                        data-bs-original-title="Country where device is located"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" name="country"
                                    value="{{ $subscriber[0]['subscriber']['customId'] }} ">
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
                            <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enter the Acc's address"
                                data-bs-original-title="Enter the Acc's address" data-kt-initialized="1">
                                <i class="ki-outline ki-information fs-7"></i>
                            </span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-solid" name="address"
                            value="{{ $subscriber[0]['subscriber']['locations'][0]['address'][0]['streetLine1'] }}">
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
                                        data-bs-original-title="Enter the contact's email." data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid" name="email"
                                    value="{{ $subscriber[0]['subscriber']['locations'][0]['contacts'][0]['email'] }}">
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
                                    <span>Acc Status</span>
                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="Enabled on calix"
                                        data-bs-original-title="Enabled on calix" data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input name="enable_notification" class="form-check-input h-40px w-60px"
                                        type="checkbox" id="flexSwitchDefault" checked />
                                    <label class="form-check-label" for="flexSwitchDefault">
                                        Disabled Acc will suspend services
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
                                    <span class="required">OLT Name</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="The OLT where it connects to"
                                        data-bs-original-title="The OLT where it connects to" data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid moz_mask"
                                    name="subscriber_olt"
                                    value="{{ $subscriber[0]['associate-port'][0]['network-name'] }}">
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
                                    <span>Configured Port(s)</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Which ports are configured"
                                        data-bs-original-title="Which ports are configured" data-kt-initialized="1">
                                        <i class="ki-outline ki-information fs-7"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-solid moz_mask"
                                    name="subscriber_ports" value="{{ $subscriber[0]['associate-port'][0]['port'] }}">
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!-- End Contacts -->
                    <!-- Begin Telegram -->
                    <div class="row row-cols-sm-2 rol-cols-md-1 row-cols-lg-2">
                        <!--begin::Col-->
                        <!--begin::Input group-->
                        <div class="fv-row col-md-6">
                            <!--begin::Label-->
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span>Device S/N</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Devices Serial number / ID"
                                    data-bs-original-title="Devices Serial number / ID" data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--begin::Input group-->
                            <div class="input-group">
                                <input type="text" name="telegram_id" class="form-control" aria-label=""
                                    aria-describedby="basic-addon2"
                                    value="{{ $subscriber[0]['associate-port'][0]['device-serial'] }}" />
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-barcode fs-4"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                            </div>

                            <!--end::Input group-->
                            <!--end::Input group-->
                        </div>
                        <div class="col-md-6">

                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span>Device Profile</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Devices Serial number / ID"
                                    data-bs-original-title="Devices Serial number / ID" data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--begin::Input group-->
                            <div class="input-group col-md-4">
                                <input type="text" name="telegram_id" class="form-control" placeholder=""
                                    aria-label="" aria-describedby="basic-addon2"
                                    value="{{ $subscriber[0]['associate-port'][0]['associate-service'][0]['serviceTemplate'] }}" />
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fa-solid fa-gear fs-4"><span class="path1"></span><span
                                            class="path2"></span></i>
                                </span>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--end::Col-->
                        <!--begin::Col-->

                        <!--end::Col-->
                    </div>
                    <div class="row row-cols-sm-2 rol-cols-md-1 row-cols-lg-2 mt-6">
                        <div class="col-md-4">
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">VLAN OLT</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Configured Vln for service"
                                    data-bs-original-title="Configured Vlan for service" data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="subscriber_acc_name"
                                id="subscriber_acc_name" value="{{ $subscriber[0]['associate-port'][0]['associate-service'][0]['vlan']}}">
                            <!--end::Input-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label class="fs-6 fw-semibold form-label mt-3">
                                <span class="required">Service Tag</span>
                                <span class="ms-1" data-bs-toggle="tooltip" aria-label="Ctag Vlan"
                                    data-bs-original-title="Ctag Vlan" data-kt-initialized="1">
                                    <i class="ki-outline ki-information fs-7"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" name="subscriber_acc_name"
                                id="subscriber_ctag" value="{{ $subscriber[0]['associate-port'][0]['associate-service'][0]['ctag']}}">
                            <!--end::Input-->
                            <div
                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--begin::Actions-->
    <div class="text-center pt-10">
        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel">Discard</button>
        <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
            <span class="indicator-label">Submit</span>
            <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
    <!--end::Actions-->
</form>
