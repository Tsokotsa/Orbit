    <div class="modal fade" id="edit-serviceplanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="edit-serviceplanForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="account_id" value="{{ $account->id }}">
                    <input type="hidden" name="service_line" value="{{ $service_line }}">
                    <input type="hidden" name="action_type" id="serviceplan-action">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Service Plan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="d-flex flex-column gap-4">

                            <!-- Change Plan -->
                            <div class="border border-gray-300 border-dashed rounded p-5 hover-elevate-up cursor-pointer action-btn"
                                data-action="change-plan">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-outline ki-arrow-up fs-2 text-primary"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold fs-6 text-gray-800">Change Plan</div>
                                        <div class="fs-7 text-gray-500">Upgrade or downgrade the current plan</div>
                                    </div>
                                    <i class="ki-outline ki-arrow-right fs-2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Pause Service -->
                            <div class="border border-gray-300 border-dashed rounded p-5 hover-elevate-up cursor-pointer action-btn"
                                data-action="pause-service">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label bg-light-warning">
                                            <i class="las la-pause fs-2 text-warning"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold fs-6 text-gray-800">Pause Service</div>
                                        <div class="fs-7 text-gray-500">Temporarily suspend the service</div>
                                    </div>
                                    <i class="ki-outline ki-arrow-right fs-2 text-gray-400"></i>
                                </div>
                            </div>

                            <!-- Cancel Service -->
                            <div class="border border-gray-300 border-dashed rounded p-5 hover-elevate-up cursor-pointer action-btn"
                                data-action="cancel-service">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-50px me-4">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-outline ki-cross-circle fs-2 text-danger"></i>
                                        </span>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold fs-6 text-gray-800">Cancel Service</div>
                                        <div class="fs-7 text-gray-500">Permanently terminate the service</div>
                                    </div>
                                    <i class="ki-outline ki-arrow-right fs-2 text-gray-400"></i>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('#edit-serviceplanModal .action-btn')
            .forEach(button => {

                button.addEventListener('click', function() {

                    const action = this.dataset.action;
                    const form = document.getElementById('edit-serviceplanForm');
                    const actionInput = document.getElementById('serviceplan-action');

                    let confirmText = '';
                    let confirmButtonClass = 'btn fw-bold btn-primary';

                    switch (action) {
                        case 'change-plan':
                            confirmText = "Are you sure you want to change the plan?";
                            confirmButtonClass = "btn fw-bold btn-primary";
                            break;

                        case 'pause-service':
                            confirmText = "Are you sure you want to pause this service?";
                            confirmButtonClass = "btn fw-bold btn-warning";
                            break;

                        case 'cancel-service':
                            confirmText = "Are you sure you want to permanently cancel this service?";
                            confirmButtonClass = "btn fw-bold btn-danger";
                            break;
                    }

                    Swal.fire({
                        text: confirmText,
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Yes, continue!",
                        cancelButtonText: "No, cancel",
                        customClass: {
                            confirmButton: confirmButtonClass,
                            cancelButton: "btn fw-bold btn-active-light-primary"
                        }
                    }).then((result) => {

                        if (!result.isConfirmed) return;

                        // Set hidden action value
                        actionInput.value = action;

                        $.ajax({
                            type: "POST",
                            url: "/starlink/update/serviceplan", // adjust route
                            data: $(form).serialize(),

                            success: function(response) {

                                Swal.fire({
                                    text: response.message,
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok!",
                                    customClass: {
                                        confirmButton: "btn fw-bold btn-primary"
                                    }
                                }).then(() => {

                                    const modal = bootstrap.Modal.getInstance(
                                        document.getElementById(
                                            'edit-serviceplanModal')
                                    );
                                    modal.hide();

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
                                        confirmButton: "btn fw-bold btn-danger"
                                    }
                                });
                            }
                        });

                    });

                });

            });
    </script>
