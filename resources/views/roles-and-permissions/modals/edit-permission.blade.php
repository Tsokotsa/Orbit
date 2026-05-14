<div class="modal fade" tabindex="-1" id="kt_modal_edit_permission">

    <div class="modal-dialog">

        <form id="edit_permission_form" class="modal-content">

            @csrf

            <input type="hidden" name="permission_id" id="edit_permission_id">

            <!--begin::Header-->
            <div class="modal-header">

                <h3 class="modal-title">
                    Edit Permission
                </h3>

                <div class="btn btn-icon btn-sm btn-active-light-primary" data-bs-dismiss="modal">

                    <i class="ki-outline ki-cross fs-2"></i>

                </div>

            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="modal-body py-10 px-lg-17">

                <!-- Permission -->
                <div class="fv-row mb-7">

                    <label class="required fw-semibold fs-6 mb-2">
                        Permission Name
                    </label>

                    <input type="text" name="name" id="edit_permission_name" class="form-control" />

                </div>

                <!-- Description -->
                <div class="fv-row mb-7">

                    <label class="fw-semibold fs-6 mb-2">
                        Description
                    </label>

                    <textarea name="description" id="edit_permission_description" rows="4" class="form-control form-control-solid"></textarea>

                </div>

            </div>
            <!--end::Body-->

            <!--begin::Footer-->
            <div class="modal-footer flex-center">

                <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">

                    Cancel

                </button>

                <button type="submit" class="btn btn-primary">

                    <span class="indicator-label">
                        Save Changes
                    </span>

                </button>

            </div>
            <!--end::Footer-->

        </form>

    </div>

</div>
