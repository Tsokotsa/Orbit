<div class="modal fade" id="edit-nicknameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-600px">
        <div class="modal-content">

            <form method="POST" id="edit-nicknameForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="account_id" value="{{ $account->id }}">
                <input type="hidden" name="service_line" value="{{ $service_line }}">

                <div class="modal-header">
                    <h2 class="fw-bold">Edit Nickname</h2>
                    <div class="btn btn-sm btn-icon btn-active-light-primary" data-bs-dismiss="modal">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>

                <div class="modal-body py-10 px-lg-10">
                    <div class="fv-row mb-7">
                        <label class="required fw-semibold fs-6 mb-2">Nickname</label>
                        <input type="text" name="nickname" class="form-control form-control-solid"
                            value="{{ $subscriber['content']['nickname'] ?? '' }}" required />
                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="submit" class="btn btn-primary" id="nickname-submit">
                        <span class="indicator-label">
                            Save Changes
                        </span>
                        <span class="indicator-progress">
                            Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('edit-nicknameForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitButton = document.getElementById('nickname-submit');

        Swal.fire({
            text: "Are you sure you want to update the nickname?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, update!",
            cancelButtonText: "No, cancel",
            customClass: {
                confirmButton: "btn fw-bold btn-success",
                cancelButton: "btn fw-bold btn-active-light-primary"
            }
        }).then((result) => {

            if (!result.isConfirmed) return;

            // Show loading indicator
            submitButton.setAttribute("data-kt-indicator", "on");
            submitButton.disabled = true;

            $.ajax({
                type: "POST",
                url: "/starlink/update/nickname",
                data: $(form).serialize(),

                success: function(response) {

                    Swal.fire({
                        text: response.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary",
                        }
                    }).then(() => {

                        // Close modal
                        const modal = bootstrap.Modal.getInstance(
                            document.getElementById('edit-nicknameModal')
                        );
                        modal.hide();

                        // Optional: refresh page
                        location.reload();
                    });
                },

                error: function(xhr) {
                    let message = "Something went wrong";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-danger",
                        }
                    });
                },

                complete: function() {
                    // Remove loading state
                    submitButton.removeAttribute("data-kt-indicator");
                    submitButton.disabled = false;
                }
            });
        });
    });
</script>
