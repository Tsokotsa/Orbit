<div class="modal fade" tabindex="-1" id="view-subscriber">
    <div class="modal-dialog modal-dialog-centered mw-750px">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h2 class="fw-bold">Subscriber</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <!-- Warning Notice -->
                <div
                    class="notice d-flex bg-light rounded border-light border border-dashed mb-9 p-6 align-items-start">
                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                    <div class="d-flex flex-stack flex-grow-1">
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Proceed with caution!</h4>
                            <div class="fs-8 text-gray-700">
                                This is pushed immediately to Starlink subscriber.
                            </div>
                        </div>

                        <label class="form-check form-switch form-check-custom form-check-solid m-0">
                            <input class="form-check-input" id="understand" type="checkbox" value="1">
                            <span class="form-check-label fw-semibold text-muted">
                                I understand
                            </span>
                        </label>
                    </div>
                </div>

                <!-- Loader -->
                <div id="subscriberLoading" class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                    <div class="mt-2">Loading Subscriber data…</div>
                </div>

                <!-- Content -->
                <div id="subscriberContent" class="d-none">
                    <div id="subscriberContentBody">

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>