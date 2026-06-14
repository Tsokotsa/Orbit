<div class="modal fade" id="addSystemLinkModal" tabindex="-1" aria-hidden="true">

    <div class="modal-dialog modal-dialog-centered modal-lg mw-700px">

        <div class="modal-content rounded-4 shadow">

            <form id="systemLinkForm">

                @csrf

                <!-- Header -->
                <div class="modal-header border-0 pb-3">

                    <div class="d-flex align-items-center">

                        <div class="symbol symbol-50px me-4">

                            <div class="symbol-label bg-light-primary">

                                <i class="ki-outline ki-link fs-2x text-primary"></i>

                            </div>

                        </div>

                        <div>

                            <h2 class="fw-bolder mb-1">
                                Add System Link
                            </h2>

                            <div class="text-muted fs-7">
                                Create a shortcut to an internal or external system
                            </div>

                        </div>

                    </div>

                    <button type="button" class="btn btn-sm btn-icon btn-light" data-bs-dismiss="modal">

                        <i class="ki-outline ki-cross fs-2"></i>

                    </button>

                </div>

                <!-- Body -->
                <div class="modal-body pt-0">

                    <!-- Tabs -->
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-8 fs-6">

                        <li class="nav-item">

                            <a class="nav-link active fw-bold" data-bs-toggle="tab" href="#tab_general">

                                <i class="ki-outline ki-information-5 me-2"></i>
                                General

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#tab_link">

                                <i class="ki-outline ki-link me-2"></i>
                                Link Details

                            </a>

                        </li>

                        <li class="nav-item">

                            <a class="nav-link fw-bold" data-bs-toggle="tab" href="#tab_security">

                                <i class="ki-outline ki-shield-tick me-2"></i>
                                Access

                            </a>

                        </li>

                    </ul>

                    <div class="tab-content">

                        <!-- General Tab -->
                        <div class="tab-pane fade show active" id="tab_general">

                            <div class="row g-6">

                                <div class="col-md-6">

                                    <label class="required form-label fw-bold">
                                        Name
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-code fs-4"></i>
                                        </span>

                                        <input type="text" name="name" class="form-control form-control-solid"
                                            placeholder="zabbix" />

                                    </div>

                                    <div class="form-text">
                                        Internal unique identifier
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="required form-label fw-bold">
                                        Section
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-category fs-4"></i>
                                        </span>

                                        <input type="text" name="section" class="form-control form-control-solid"
                                            placeholder="Monitoring" />

                                    </div>

                                    <div class="form-text">
                                        Menu grouping
                                    </div>

                                </div>

                                <div class="col-12">

                                    <label class="required form-label fw-bold">
                                        Display Title
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-text fs-4"></i>
                                        </span>

                                        <input type="text" name="title" class="form-control form-control-solid"
                                            placeholder="Zabbix Monitoring" />

                                    </div>

                                    <div class="form-text">
                                        Name shown to users
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-bold">
                                        Icon
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-element-11 fs-4"></i>
                                        </span>

                                        <input type="text" name="icon" class="form-control form-control-solid"
                                            placeholder="ki-monitor" />

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <label class="form-label fw-bold">
                                        Sort Order
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-sort fs-4"></i>
                                        </span>

                                        <input type="number" name="sort_order" class="form-control form-control-solid"
                                            value="0">

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Link Tab -->
                        <div class="tab-pane fade" id="tab_link">

                            <div class="row g-6">

                                <div class="col-12">

                                    <label class="required form-label fw-bold">
                                        URL
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-link fs-4"></i>
                                        </span>

                                        <input type="url" name="url" class="form-control form-control-solid"
                                            placeholder="https://zabbix.company.com">

                                    </div>

                                    <div class="form-text">
                                        Include https://
                                    </div>

                                </div>

                                <div class="col-12">

                                    <label class="form-label fw-bold">
                                        Environment
                                    </label>

                                    <select name="environment" class="form-select form-select-solid">

                                        <option value="production">
                                            🟢 Production
                                        </option>

                                        <option value="staging">
                                            🟡 Staging
                                        </option>

                                        <option value="development">
                                            🔵 Development
                                        </option>

                                    </select>

                                </div>

                                <div class="col-12">

                                    <div class="border rounded p-5">

                                        <div class="form-check form-switch form-check-custom form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="new_tab" checked>

                                            <label class="form-check-label fw-bold ms-3">

                                                Open In New Tab

                                            </label>

                                        </div>

                                        <div class="text-muted fs-7 mt-2">

                                            Launch the destination in a separate browser tab.

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- Access Tab -->
                        <div class="tab-pane fade" id="tab_security">

                            <div class="row g-6">

                                <div class="col-12">

                                    <label class="form-label fw-bold">
                                        Permission
                                    </label>

                                    <div class="input-group">

                                        <span class="input-group-text">
                                            <i class="ki-outline ki-security-user fs-4"></i>
                                        </span>

                                        <input type="text" name="permission"
                                            class="form-control form-control-solid" placeholder="monitoring.view">

                                    </div>

                                    <div class="form-text">
                                        Leave empty for all users
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="border rounded p-5 h-100">

                                        <div class="form-check form-switch form-check-custom form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="is_active" checked>

                                            <label class="form-check-label fw-bold ms-3">
                                                Active
                                            </label>

                                        </div>

                                        <div class="text-muted fs-7 mt-2">
                                            Link is enabled
                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="border rounded p-5 h-100">

                                        <div class="form-check form-switch form-check-custom form-check-solid">

                                            <input class="form-check-input" type="checkbox" name="visible_in_sidebar"
                                                checked>

                                            <label class="form-check-label fw-bold ms-3">
                                                Sidebar Visibility
                                            </label>

                                        </div>

                                        <div class="text-muted fs-7 mt-2">
                                            Show in navigation menu
                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Footer -->
                <div class="modal-footer border-top">

                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">

                        Cancel

                    </button>

                    <button type="button" class="btn btn-primary" id="submitSystemLink">

                        <i class="ki-outline ki-check fs-5 me-2"></i>

                        <span class="indicator-label">
                            Create Link
                        </span>

                        <span class="indicator-progress">
                            Saving...
                            <span class="spinner-border spinner-border-sm ms-2"></span>
                        </span>

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@push('scripts')
    <script>
        $('#submitSystemLink').on('click', function() {

            const button = $(this);

            Swal.fire({
                title: 'Create System Link?',
                text: 'The new system link will be added to the platform.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, Save',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                button.attr('data-kt-indicator', 'on');
                button.prop('disabled', true);

                $.ajax({
                    url: "{{ route('system.link-store') }}",
                    type: "POST",
                    data: $('#systemLinkForm').serialize(),

                    success: function(response) {

                        button.removeAttr('data-kt-indicator');
                        button.prop('disabled', false);

                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonText: 'OK'
                        });

                        $('#systemLinkForm')[0].reset();

                        const modal =
                            bootstrap.Modal.getInstance(
                                document.getElementById('addSystemLinkModal')
                            );

                        modal.hide();

                        // Reload datatable if present
                        if ($.fn.DataTable.isDataTable('#systemLinksTable')) {
                            $('#systemLinksTable')
                                .DataTable()
                                .ajax
                                .reload(null, false);
                        }
                    },

                    error: function(xhr) {

                        button.removeAttr('data-kt-indicator');
                        button.prop('disabled', false);

                        let errorMessage =
                            'An unexpected error occurred.';

                        if (xhr.responseJSON) {

                            if (xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            if (xhr.responseJSON.errors) {

                                errorMessage = Object.values(
                                        xhr.responseJSON.errors
                                    )
                                    .flat()
                                    .join('<br>');
                            }
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed!',
                            html: errorMessage
                        });
                    }
                });
            });
        });
    </script>
@endpush
