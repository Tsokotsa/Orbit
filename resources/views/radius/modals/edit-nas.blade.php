<div class="modal fade" id="kt_modal_edit_nas" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg">

        <div class="modal-content shadow-sm border-0 rounded-4">

            {{-- HEADER --}}
            <div class="modal-header border-0 pb-0 px-10 pt-8">

                <div>

                    <h2 class="fw-bold text-gray-900 mb-1">
                        Edit NAS Device
                    </h2>

                    <div class="text-muted fs-7">
                        Update network access server configuration and authentication settings
                    </div>

                </div>

                <button type="button" class="btn btn-icon btn-sm btn-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </button>

            </div>

            {{-- BODY --}}
            <div class="modal-body px-10 pt-6 pb-8">

                {{-- NOTICE --}}
                <div class="notice d-flex bg-light-secondary rounded-3 border border-dashed border-gray-300 p-5 mb-8">

                    {{-- ICON --}}
                    <i class="ki-outline ki-information-5 fs-2tx text-gray-700 me-4"></i>

                    {{-- CONTENT --}}
                    <div class="d-flex flex-stack flex-grow-1">

                        <div class="fw-semibold">

                            <h4 class="text-gray-900 fw-bold mb-1">
                                NAS Authentication Notice
                            </h4>

                            <div class="fs-7 text-muted">
                                Changes applied here immediately affect FreeRADIUS authentication
                                and authorization for this device.
                            </div>

                        </div>

                    </div>

                </div>

                <form id="edit_nas_form">

                    @csrf

                    <input type="hidden" name="id" id="edit_nas_id">

                    {{-- ====================================================== --}}
                    {{-- BASIC INFORMATION --}}
                    {{-- ====================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">

                                <span class="symbol-label bg-light-primary">

                                    <i class="ki-outline ki-abstract-26 fs-2 text-primary"></i>

                                </span>

                            </div>

                            <div>

                                <h4 class="mb-0 text-gray-900">
                                    Basic Information
                                </h4>

                                <div class="fs-7 text-muted">
                                    Device identity and description
                                </div>

                            </div>

                        </div>

                        <div class="row g-5">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Description
                                </label>

                                <input type="text" id="edit_description" name="description"
                                    class="form-control form-control-solid" placeholder="Main MikroTik POP">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Short Name
                                </label>

                                <input type="text" id="edit_shortname" name="shortname"
                                    class="form-control form-control-solid" placeholder="POP-01">

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- NETWORK --}}
                    {{-- ====================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6 mb-8">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">

                                <span class="symbol-label bg-light-success">

                                    <i class="ki-outline ki-wifi-square fs-2 text-success"></i>

                                </span>

                            </div>

                            <div>

                                <h4 class="mb-0 text-gray-900">
                                    Network Configuration
                                </h4>

                                <div class="fs-7 text-muted">
                                    Connectivity and vendor configuration
                                </div>

                            </div>

                        </div>

                        <div class="row g-5">

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    NAS IP Address
                                </label>

                                <input type="text" id="edit_nasname" name="nasname"
                                    class="form-control form-control-solid" placeholder="192.168.1.1">

                            </div>

                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Device Type
                                </label>

                                <select id="edit_type" name="type" class="form-select form-select-solid"
                                    data-control="select2" data-hide-search="true"
                                    data-dropdown-parent="#kt_modal_edit_nas">

                                    <option value="mikrotik">
                                        MikroTik
                                    </option>

                                    <option value="cisco">
                                        Cisco
                                    </option>

                                    <option value="other">
                                        Other
                                    </option>

                                </select>

                            </div>

                        </div>

                    </div>

                    {{-- ====================================================== --}}
                    {{-- SECURITY --}}
                    {{-- ====================================================== --}}
                    <div class="border border-gray-200 border-dashed rounded-3 p-6">

                        <div class="d-flex align-items-center mb-5">

                            <div class="symbol symbol-40px me-3">

                                <span class="symbol-label bg-light-danger">

                                    <i class="ki-outline ki-shield-tick fs-2 text-danger"></i>

                                </span>

                            </div>

                            <div>

                                <h4 class="mb-0 text-gray-900">
                                    Security
                                </h4>

                                <div class="fs-7 text-muted">
                                    Shared secret used between NAS and FreeRADIUS
                                </div>

                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12">

                                <label class="form-label fw-semibold">
                                    Shared Secret
                                </label>

                                <div class="input-group">

                                    <input type="password" id="edit_secret" name="secret"
                                        class="form-control form-control-solid" placeholder="********">

                                    <button type="button" class="btn btn-light-primary" onclick="toggleSecret()">

                                        <i class="ki-outline ki-eye fs-5"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

            {{-- FOOTER --}}
            <div class="modal-footer border-0 px-10 pb-8 pt-5">

                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="button" class="btn btn-primary" id="update_nas_btn">

                    <i class="ki-outline ki-check fs-5 me-1"></i>

                    Save Changes

                </button>

            </div>

        </div>

    </div>

</div>


@push('scripts')
    <script>
        function toggleSecret() {

            let input = document.getElementById('edit_secret');

            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        }
    </script>
@endpush
