<div class="modal fade" tabindex="-1" id="topupModal">
    <div class="modal-dialog modal-dialog-centered mw-450px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Top Up Zone</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                    data-kt-users-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body">
                <!--begin::Form-->
                <form id="topup_starlink_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                    @csrf
                    <input type="text" class="form-control" id="topup-serviceLine" hidden readonly>
                    <!--begin::Notice-->
                    <div class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                        <!--begin::Icon-->
                        <i class="ki-outline ki-information fs-2tx text-primary me-4"></i>
                        <!--end::Icon-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-stack flex-grow-1">
                            <!--begin::Content-->
                            <div class="fw-semibold">
                                <div class="fs-6 text-gray-700">This incurs additional costs and is billed separately
                                    from the monthly invoice.</div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Notice-->
                    <!--end::Notice-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-7 fv-plugins-icon-container">
                        <!--begin::Label-->
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Add Data</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <select class="form-select" data-control="select2" data-placeholder="Select an option">
                            <option></option>
                            <option value="50">50 GB</option>
                            <option value="2" class="text-muted" disabled>500 GB - comming soon</option>
                        </select>
                        <!--end::Input-->
                        <div
                            class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-kt-users-modal-action="cancel"
                            data-bs-dismiss="modal">Discard</button>
                        <button type="button" class="btn btn-primary top-up-starlink"
                            data-kt-users-modal-action="submit">
                            <span class="indicator-label">Top Up</span>
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

@push('scripts')
    <script>
        $('.top-up-starlink').on('click', function(e) {
            e.preventDefault();

            const serviceLine = $('#topup-serviceLine').val();
            const token = $('meta[name="csrf-token"]').attr('content');

            if (!serviceLine) {
                Swal.fire({
                    icon: "error",
                    text: "Service line not found"
                });
                return;
            }

            Swal.fire({
                title: "Confirm Top-Up",
                text: "Are you sure you want to top up this Starlink service?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, proceed",
                cancelButtonText: "Cancel",
                buttonsStyling: false,
                customClass: {
                    confirmButton: "btn btn-primary fw-bold",
                    cancelButton: "btn btn-light fw-bold"
                }
            }).then((result) => {
                if (!result.isConfirmed) return;

                $.ajax({
                    type: "POST",
                    url: `/starlink/top-up/${serviceLine}`, // ✅ NO trailing slash
                    data: $('#topup_starlink_form').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Woowooooo!",
                            text: response.message,
                            icon: "success",
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => location.reload());
                    },
                    error: function(xhr) {
                        const errorMessage =
                            xhr.responseJSON?.message || "Something went wrong";

                        Swal.fire({
                            icon: "error",
                            text: errorMessage
                        });
                    }
                });
            });
        });

    </script>
@endpush
