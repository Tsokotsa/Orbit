{{-- {{ dd($service) }} --}}
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                    <span class="required">Package Name</span>
                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="This is auto generated and should be unique"
                        data-bs-original-title="This is auto generated and should be unique" data-kt-initialized="1">
                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                    </span>
                </label>
                <!--end::Label-->
                <div class="position-relative">
                    <input type="text" id="package_name" class="form-control" name="package_name"
                        placeholder="Dont Mannualy update this" autocomplete="off"
                        value="{{ $service->service_name ?? '-' }}">

                    <div id="asset-suggestions" class="list-group position-absolute w-100 shadow"
                        style="z-index: 1056; display:none;"></div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <label class="required fs-5 fw-semibold mb-2 text-left">Interface Type</label>
            <select class="form-select" data-control="select2" data-placeholder="Select an option"
                name="interface_type">
                <option></option>
                <option value="bdi">BDI</option>
                <option value="vlan">VLAN</option>
            </select>
        </div>
        <div class="col-md-3 text-start">
            <label class="required fs-5 fw-semibold mb-2 text-left">Int ID</label>
            <input type="text" class="form-control form-control" placeholder="" name="termination_number"
                id="termination_number">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 text-start">
            <label class="required fs-5 fw-semibold mb-2 text-left">Service IP</label>
            <input type="text" class="form-control form-control" placeholder="" name="service_ip" id="service_ip">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
        </div>
        <div class="col-md-4 text-start">
            <label class="required fs-5 fw-semibold mb-2 text-left">Termination Device</label>
            <input type="text" class="form-control form-control-solid" placeholder="" name="termination_device"
                id="termination_device" readonly="">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
        </div>
        <div class="col-md-4 text-start">
            <label class="required fs-5 fw-semibold mb-2 text-left">Physical Port</label>
            <input type="text" class="form-control form-control-solid" placeholder="" name="service_port"
                id="service_port" readonly="">
            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-4 text-start">
            <label class="required fs-5 fw-semibold mb-2 text-left">Service POP</label>
            <select class="form-select" data-control="select2" data-placeholder="Select an option" name="service_pop">
                <option></option>
                <option value="1">Radio Islam</option>
                <option value="2">Matola N4</option>
                <option value="2">Zimpeto</option>
            </select>
        </div>
    </div>
    <div class="form-floating">
        <textarea class="form-control" placeholder="Usefull Info about this client" name="service_additional_info"
            id="service_additional_info" maxlength="160" style="min-height: 100px !important; max-height: 100px !important"></textarea>
        <label class="fs-8" for="floatingTextarea2">This client should be visited only in afternoons</label>
    </div>
</form>
