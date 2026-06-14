<div class="modal fade" id="kt_modal_add_rfo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-fullscreen-xl-down modal-xl">
        <div class="modal-content">
            <form id="create_rfo_form">
                <input type="hidden" name="id" id="rfo_id">
                <input type="hidden" name="action" id="rfo_action" value="create">
                @csrf
                {{-- HEADER --}}
                <div class="modal-header border-bottom border-dashed py-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="symbol symbol-35px">
                            <span class="symbol-label bg-light-primary">
                                <i class="ki-outline ki-document text-primary fs-3"></i>
                            </span>
                        </div>
                        <div>
                            <h4 class="modal-title fw-bold mb-0">RFO Generation</h4>
                            <span class="text-muted fs-7">Reason for outage report</span>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                {{-- BODY --}}
                <div class="modal-body p-0">
                    <div class="d-flex h-100">

                        {{-- SIDEBAR TABS --}}
                        <div class="d-flex flex-column flex-shrink-0 border-end border-dashed bg-lighten py-4 px-3"
                            style="width: 180px; min-height: 500px;">
                            <ul class="nav nav-pills flex-column gap-1" id="rfoTabList" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4 active"
                                        id="tab-document-link" data-bs-toggle="pill" href="#rfo_document"
                                        role="tab">
                                        <i class="ki-outline ki-folder fs-4"></i>
                                        <span class="fs-7 fw-semibold">Document</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4" id="tab-incident-link"
                                        data-bs-toggle="pill" href="#rfo_incident" role="tab">
                                        <i class="las la-skull-crossbones fs-4"></i>
                                        <span class="fs-7 fw-semibold">Incident</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4" id="tab-timeline-link"
                                        data-bs-toggle="pill" href="#rfo_timeline" role="tab">
                                        <i class="ki-outline ki-time fs-4"></i>
                                        <span class="fs-7 fw-semibold">Timeline</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4" id="tab-rca-link"
                                        data-bs-toggle="pill" href="#rfo_rca" role="tab">
                                        <i class="ki-outline ki-search-list fs-4"></i>
                                        <span class="fs-7 fw-semibold">Root Cause</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4" id="tab-impact-link"
                                        data-bs-toggle="pill" href="#rfo_impact" role="tab">
                                        <i class="ki-outline ki-chart-simple fs-4"></i>
                                        <span class="fs-7 fw-semibold">Impact</span>
                                    </a>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <a class="nav-link d-flex align-items-center gap-2 py-3 px-4" id="tab-actions-link"
                                        data-bs-toggle="pill" href="#rfo_actions" role="tab">
                                        <i class="ki-outline ki-verify fs-4"></i>
                                        <span class="fs-7 fw-semibold">Actions</span>
                                    </a>
                                </li>

                            </ul>
                        </div>

                        {{-- TAB CONTENT --}}

                        <div class="tab-content flex-grow-1 p-7 overflow-auto" style="max-height: 580px;">

                            {{-- DOCUMENT --}}
                            <div class="tab-pane fade show active" id="rfo_document" role="tabpanel">

                                <div class="mb-5">
                                    <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-4">Document Details</h6>
                                    <div class="row g-5">

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold fs-7">RFO Number</label>

                                            <div class="form-control form-control-solid d-flex align-items-center">
                                                <span id="rfo_number_badge"
                                                    class="badge badge-light-success fs-7 fw-bold">
                                                    Auto Generated
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="required form-label fw-semibold fs-7">Classification</label>
                                            <select name="classification" class="form-select form-select-solid fs-7"
                                                data-control="select2" data-dropdown-parent="#kt_modal_add_rfo">
                                                <option value="internal">Internal</option>
                                                <option value="clients">Customer</option>
                                                <option value="do not disclose">Do Not Disclose</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label fw-semibold fs-7">Document Version</label>
                                            <input type="text" name="document_version" value="1.0"
                                                class="form-control form-control-solid fs-7">
                                        </div>

                                    </div>
                                </div>

                                <div class="separator separator-dashed my-5"></div>

                                <div class="row g-5">

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7">Prepared By</label>
                                        <input type="text" class="form-control form-control-solid fs-7"
                                            value="{{ $user->name }}" readonly>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold fs-7">Approver</label>
                                        <select name="approver_id" class="form-select form-select-solid fs-7"
                                            data-control="select2" data-dropdown-parent="#kt_modal_add_rfo">
                                            <option value="">Select Approver</option>
                                            @foreach ($users as $all_users)
                                                <option value="{{ $all_users->id }}">
                                                    {{ $all_users->name . ' ' . $all_users->surname . ' | ' . $all_users->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                <div class="my-5"></div>
                                <!--begin::Input group-->
                                <div class="row g-0">
                                    <div
                                        class="notice d-flex align-items-center justify-content-between rounded border border-secondary border-dashed p-5 mt-10">

                                        <div class="d-flex align-items-center">

                                            <div class="symbol symbol-40px me-4">
                                                <span class="symbol-label bg-primary">
                                                    <i class="ki-outline ki-note-2 fs-2 text-white"></i>
                                                </span>
                                            </div>

                                            <div>
                                                <div class="fw-bold fs-6">
                                                    Save as Draft
                                                </div>

                                                <div class="text-muted fs-7">
                                                    Save this RFO without submitting it for approval. You can review,
                                                    modify and submit it later when all information is available.
                                                </div>
                                            </div>

                                        </div>

                                        <label class="form-check form-switch form-check-custom form-check-solid ms-5">
                                            <input class="form-check-input" type="checkbox" name="is_draft"
                                                value="1" checked />

                                            <span class="form-check-label fw-semibold text-gray-700 ms-2">
                                                Yes
                                            </span>
                                        </label>

                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>




                            {{-- INCIDENT --}}
                            <div class="tab-pane fade" id="rfo_incident" role="tabpanel">

                                <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-4">Incident Details</h6>

                                <div class="row g-5">

                                    <div class="col-12">
                                        <label class="required form-label fw-semibold fs-7">Incident Title</label>
                                        <input type="text" name="title"
                                            class="form-control form-control-solid fs-7"
                                            placeholder="e.g. Network outage – core router failure">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="required form-label fw-semibold fs-7">Incident Date</label>
                                        <div class="input-group" id="td_incident_date">
                                            <input type="text" name="incident_date" id="incident_date"
                                                class="form-control form-control-solid fs-7 dt-picker"
                                                placeholder="Select date" data-td-target="#td_incident_date">
                                            <span class="input-group-text bg-light border-0 cursor-pointer"
                                                data-td-target="#td_incident_date" data-td-toggle="datetimepicker">
                                                <i class="ki-outline ki-calendar fs-4 text-gray-500"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="required form-label fw-semibold fs-7">Detection Time</label>
                                        <div class="input-group" id="td_detection_time">
                                            <input type="text" name="detection_time" id="detection_time"
                                                class="form-control form-control-solid fs-7 dt-picker"
                                                placeholder="Select date & time" data-td-target="#td_detection_time">
                                            <span class="input-group-text bg-light border-0 cursor-pointer"
                                                data-td-target="#td_detection_time" data-td-toggle="datetimepicker">
                                                <i class="ki-outline ki-calendar fs-4 text-gray-500"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold fs-7">Partial Restoration</label>
                                        <div class="input-group" id="td_partial_restore">
                                            <input type="text" name="partial_restore_time"
                                                id="partial_restore_time"
                                                class="form-control form-control-solid fs-7 dt-picker"
                                                placeholder="Select date & time" data-td-target="#td_partial_restore">
                                            <span class="input-group-text bg-light border-0 cursor-pointer"
                                                data-td-target="#td_partial_restore" data-td-toggle="datetimepicker">
                                                <i class="ki-outline ki-calendar fs-4 text-gray-500"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="required form-label fw-semibold fs-7">Full Restoration</label>
                                        <div class="input-group" id="td_full_restore">
                                            <input type="text" name="full_restore_time" id="full_restore_time"
                                                class="form-control form-control-solid fs-7 dt-picker"
                                                placeholder="Select date & time" data-td-target="#td_full_restore">
                                            <span class="input-group-text bg-light border-0 cursor-pointer"
                                                data-td-target="#td_full_restore" data-td-toggle="datetimepicker">
                                                <i class="ki-outline ki-calendar fs-4 text-gray-500"></i>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold fs-7">Duration</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-light border-0">
                                                <i class="ki-outline ki-timer fs-4 text-gray-500"></i>
                                            </span>
                                            <input type="text" id="total_duration"
                                                class="form-control form-control-solid fs-7" readonly
                                                placeholder="Auto calculated">
                                        </div>
                                    </div>

                                    <div class="col-md-5">
                                        <label class="required form-label fw-semibold fs-7">Severity</label>
                                        <div class="nav-group nav-group-outline" data-kt-buttons="true">

                                            <input type="radio" class="btn-check" name="severity"
                                                id="severity_low" value="low" checked>

                                            <label for="severity_low"
                                                class="btn btn-color-gray-500 btn-active-secondary px-4 py-2 fs-8 me-2">
                                                Low
                                            </label>

                                            <input type="radio" class="btn-check" name="severity"
                                                id="severity_medium" value="medium">

                                            <label for="severity_medium"
                                                class="btn btn-color-gray-500 btn-active-primary px-4 py-2 fs-8 me-2">
                                                Medium
                                            </label>

                                            <input type="radio" class="btn-check" name="severity"
                                                id="severity_high" value="high">

                                            <label for="severity_high"
                                                class="btn btn-color-gray-500 btn-active-warning px-4 py-2 fs-8">
                                                High
                                            </label>
                                            <input type="radio" class="btn-check" name="severity"
                                                id="severity_disaster" value="disaster">
                                            <label for="severity_disaster"
                                                class="btn btn-color-gray-500 btn-active-danger px-4 py-2 fs-8">
                                                Disaster
                                            </label>

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="required form-label fw-semibold fs-7">Affected Services</label>
                                        <input class="form-control form-control-solid fs-7" name="affected_services"
                                            value="" id="affected_services">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7">Affected PoP</label>
                                        <input class="form-control form-control-solid fs-7" name="affected_pop"
                                            value="" id="affected_pop">
                                    </div>

                                </div>
                            </div>

                            {{-- TIMELINE --}}
                            <div class="tab-pane fade" id="rfo_timeline" role="tabpanel">

                                {{-- HEADER --}}
                                <div class="d-flex align-items-center justify-content-between mb-4">
                                    <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-0">
                                        Event Timeline
                                    </h6>

                                    <button type="button" id="addTimeline" class="btn btn-sm btn-light-primary">
                                        <i class="ki-outline ki-plus fs-5"></i> Add Event
                                    </button>
                                </div>

                                {{-- ===================== --}}
                                {{-- EXISTING TIMELINES --}}
                                {{-- ===================== --}}

                                <div id="existing-timelines" class="mb-5"></div>

                                {{-- ===================== --}}
                                {{-- NEW TIMELINE INPUTS --}}
                                {{-- ===================== --}}
                                <div id="timeline-container" class="d-flex flex-column gap-3">

                                    <div class="timeline-row d-flex align-items-center gap-3 bg-light rounded p-3">

                                        {{-- ICON --}}
                                        <i class="ki-outline ki-abstract-26 fs-5 text-gray-500 flex-shrink-0"></i>

                                        {{-- DATE/TIME --}}
                                        <div class="input-group flex-shrink-0" style="width: 220px;">
                                            <input type="text" name="timeline_time[]"
                                                class="form-control form-control-sm fs-7 dt-picker"
                                                placeholder="Date & time">

                                            <span class="input-group-text bg-white border-start-0">
                                                <i class="ki-outline ki-calendar fs-5 text-gray-400"></i>
                                            </span>
                                        </div>

                                        {{-- ACTION --}}
                                        <input type="text" name="timeline_action[]"
                                            class="form-control form-control-sm fs-7"
                                            placeholder="Describe what happened">

                                        {{-- REMOVE --}}
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-light-danger remove-timeline flex-shrink-0">
                                            <i class="ki-outline ki-trash fs-5"></i>
                                        </button>

                                    </div>

                                </div>

                            </div>

                            {{-- ROOT CAUSE --}}
                            <div class="tab-pane fade" id="rfo_rca" role="tabpanel">

                                <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-4">Root Cause Analysis</h6>

                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-4 mb-5">
                                    <i class="ki-outline ki-information fs-3 text-warning me-3 flex-shrink-0"></i>
                                    <div class="fs-7 text-gray-700">Describe what failed, why it failed, and what
                                        conditions allowed the failure to occur.</div>
                                </div>


                                <div id="root_cause_editor" style="height: 250px;"></div>
                                <input type="hidden" name="root_cause" id="root_cause">


                                {{-- <textarea name="root_cause" rows="14" class="form-control form-control-solid fs-7"
                                    placeholder="Detailed root cause analysis..."></textarea> --}}

                            </div>

                            {{-- IMPACT --}}
                            <div class="tab-pane fade" id="rfo_impact" role="tabpanel">

                                <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-4">Impact Analysis</h6>

                                <div class="row g-5">

                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-7">Service Impact</label>
                                        <textarea name="service_impact" rows="4" class="form-control form-control-solid fs-7"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7">Partial Restoration Notes</label>
                                        <textarea name="partial_restoration_notes" rows="4" class="form-control form-control-solid fs-7"></textarea>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold fs-7">Full Restoration Notes</label>
                                        <textarea name="full_restoration_notes" rows="4" class="form-control form-control-solid fs-7"></textarea>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-semibold fs-7">Data Integrity</label>
                                        <textarea name="data_integrity" rows="4" class="form-control form-control-solid fs-7"></textarea>
                                    </div>

                                </div>
                            </div>

                            {{-- CORRECTIVE ACTIONS --}}
                            <div class="tab-pane fade" id="rfo_actions" role="tabpanel">

                                <h6 class="text-muted text-uppercase fw-bold fs-8 ls-1 mb-4">Corrective Actions</h6>

                                <div
                                    class="notice d-flex bg-light-success rounded border-success border border-dashed p-4 mb-5">
                                    <i class="ki-outline ki-shield-tick fs-3 text-success me-3 flex-shrink-0"></i>
                                    <div class="fs-7 text-gray-700">List all corrective and preventive actions to be
                                        taken
                                        following this incident.</div>
                                </div>
                                <div id="corrective_actions_quill" style="height: 250px;"></div>
                                <input type="hidden" name="corrective_actions" id="corrective_actions">


                                {{-- <textarea name="corrective_actions" rows="14" class="form-control form-control-solid fs-7"></textarea> --}}

                            </div>

                        </div>

                        {{-- END TAB CONTENT --}}

                    </div>
                </div>
                {{-- END BODY --}}

                {{-- FOOTER --}}
                <div class="modal-footer border-top border-dashed py-4">
                    <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="save_rfo_btn">

                        <span class="indicator-label">
                            Save RFO
                        </span>

                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        // The DOM elements you wish to replace with Tagify
        var input1 = document.querySelector("#affected_pop");

        // Initialize Tagify script on the above inputs
        var affectedregionTagify = new Tagify(input1, {
            whitelist: ["UEM", "Joss", "Jat", "33 Andares", "Servisis", "Raxio", "Icolo", "Tempo", "Radio Islam",
                "Jardim"
            ],
            maxTags: 10,
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });

        var input2 = document.querySelector("#affected_services");

        var affectedServicesTagify = new Tagify(input2, {
            whitelist: ["All", "Mpls", "L2vpn", "Internet", "Broad Band", "Starlink"],
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: "tagify__inline__suggestions",
                enabled: 0,
                closeOnSelect: false
            }
        });


        // The All Shoud desapera when i select other value
        // affectedServicesTagify.on('add', function(e) {

        //     const selected = affectedServicesTagify.value.map(t => t.value);

        //     if (e.detail.data.value === 'All') {
        //         affectedServicesTagify.removeAllTags();
        //         affectedServicesTagify.addTags(['All']);
        //         return;
        //     }

        //     if (selected.includes('All') && selected.length > 1) {
        //         affectedServicesTagify.removeTags('All');
        //     }
        // });
        // END Tagify all logic

        // Save Rfo
        // $('#save_rfo').on('click', function() {

        //     Swal.fire({
        //         title: 'Save Changes?',
        //         text: 'This Will Generate new RFO',
        //         icon: 'question',
        //         showCancelButton: true,
        //         confirmButtonText: 'Continue'
        //     }).then((result) => {

        //         if (!result.isConfirmed) {
        //             return;
        //         }

        //         $.ajax({

        //             url: "{{ route('rfo.store') }}",

        //             type: "POST",

        //             data: $('#create_rfo_form').serialize(),

        //             success: function() {

        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'RFO Created'
        //                 });

        //                 $('#kt_modal_add_rfo').modal('hide');

        //             },

        //             error: function(xhr) {

        //                 Swal.fire({
        //                     icon: 'error',
        //                     title: 'Update Failed',
        //                     text: xhr.responseJSON?.message ??
        //                         'Unable to update product'
        //                 });

        //             }

        //         });

        //     });

        // });

        $('#save_rfo_btn').on('click', function() {

            $('#root_cause').val(
                rootCauseEditor.root.innerHTML
            );

            $('#corrective_actions').val(
                correctiveActionEditor.root.innerHTML
            );



            let form = $('#create_rfo_form');

            let rfoId = $('#rfo_id').val();

            let url = rfoId ? `/rfos/${rfoId}` : "{{ route('rfo.store') }}";

            let method = rfoId ? 'PUT' : 'POST';

            $.ajax({
                url: url,
                type: method,
                data: form.serialize(),

                success: function(response) {

                    Swal.fire({
                        icon: 'success',
                        title: rfoId ? 'RFO Updated' : 'RFO Created',
                        text: response.message
                    });

                    $('#kt_modal_add_rfo').modal('hide');
                },

                error: function(xhr) {

                    Swal.fire({
                        icon: 'error',
                        title: 'Operation Failed',
                        text: xhr.responseJSON?.message ?? 'Unable to save RFO'
                    });

                }
            });
        });


        /*
        |--------------------------------------------------------------------------
        | EDIT RFO
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.edit-rfo-btn', function() {

            let id = $(this).data('id');

            $.get('/rfos/' + id + '/edit', function(rfo) {

                $('#rfo_id').val(rfo.id);

                // Document
                $('[name="classification"]').val(rfo.classification).trigger('change');
                $('[name="document_version"]').val(rfo.document_version);
                $('[name="rfo_number"]').val(rfo.rfo_number);

                // Incident
                $('[name="title"]').val(rfo.title);
                $('[name="incident_summary"]').val(rfo.incident_summary);
                $('input[name="severity"][value="' + rfo.severity + '"]').prop('checked', true);
                let services = rfo.affected_services;

                if (typeof services === 'string') {
                    services = JSON.parse(services);
                }

                if (Array.isArray(services) && typeof services[0] === 'object') {
                    services = services.map(item => item.value);
                }

                affectedServicesTagify.removeAllTags(true); // silent remove
                affectedServicesTagify.addTags(services);

                $('[name="affected_services"]').val(services).trigger('change');

                let regions = rfo.affected_region;

                if (typeof region === 'string') {
                    region = JSON.parse(regions);
                }

                if (Array.isArray(regions) && typeof regions[0] === 'object') {
                    regions = regions.map(item => item.value);
                }

                affectedregionTagify.removeAllTags(true); // silent remove
                affectedregionTagify.addTags(regions);

                $('[name="affected_pop"]').val(services).trigger('change');

                // Times
                $('[name="incident_date"]').val(rfo.incident_date);
                $('[name="detection_time"]').val(rfo.detection_time);
                $('[name="full_restore_time"]').val(rfo.full_restore_time);

                // Impacts
                $('[name="service_impact"]').val(rfo.service_impact);
                $('[name="partial_restoration_notes"]').val(rfo.partial_restoration_notes);
                $('[name="full_restoration_notes"]').val(rfo.full_restoration_notes);
                $('[name="data_integrity"]').val(rfo.data_integrity);

                // RCA
                rootCauseEditor.root.innerHTML = rfo.root_cause;
                correctiveActionEditor.root.innerHTML = rfo.corrective_actions;

                // Approver
                $('[name="approver_id"]').val(rfo.approver_id).trigger('change');

                // Draft
                $('[name="is_draft"]').prop('checked', rfo.status === 'draft');

                // Duration (FROM DB — NO recalculation)
                $('#total_duration').val(
                    rfo.total_duration_minutes ?
                    Math.floor(rfo.total_duration_minutes / 60) + 'h ' + (rfo.total_duration_minutes %
                        60) + 'm' :
                    ''
                );

                updateSubmitButton();

                $('#kt_modal_add_rfo').modal('show');

            });

        });
        // End Save RFO

        // Start Timeline events
        document.getElementById('addTimeline').addEventListener('click', function() {

            const container = document.getElementById('timeline-container');

            const row = document.createElement('div');
            row.className = 'timeline-row d-flex align-items-center gap-3 bg-light rounded p-3';

            row.innerHTML = `
        <i class="ki-outline ki-abstract-26 fs-5 text-gray-500 flex-shrink-0"></i>

        <div class="input-group flex-shrink-0" style="width: 220px;">
            <input type="text"
                   name="timeline_time[]"
                   class="form-control form-control-sm fs-7 dt-picker"
                   placeholder="Date & time">

            <span class="input-group-text bg-white border-start-0">
                <i class="ki-outline ki-calendar fs-5 text-gray-400"></i>
            </span>
        </div>

        <input type="text"
               name="timeline_action[]"
               class="form-control form-control-sm fs-7"
               placeholder="Describe what happened">

        <button type="button"
                class="btn btn-sm btn-icon btn-light-danger remove-timeline flex-shrink-0">
            <i class="ki-outline ki-trash fs-5"></i>
        </button>
    `;

            container.appendChild(row);

            // ✅ IMPORTANT: initialize ONLY the new input
            const newInput = row.querySelector('.dt-picker');
            initDateTimePicker(newInput);

        });


        // Remove Timeline 
        $('#timeline-container').on('click', '.remove-timeline', function() {
            $(this).closest('.timeline-row').remove();
        });
        // END Timelines Events

        // Start Root cause quill


        const quillOptions = {
            modules: {
                toolbar: [
                    [{
                        header: [1, 2, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        list: 'ordered'
                    }, {
                        list: 'bullet'
                    }],
                    [{
                        'align': []
                    }],
                ]
            },
            placeholder: 'Type your text here. Be as much elaborated as possible ....',
            theme: 'snow'
        };

        var rootCauseEditor = new Quill('#root_cause_editor', quillOptions);

        var correctiveActionEditor = new Quill('#corrective_actions_quill', quillOptions);

        // END Rootcause quill
    </script>
@endpush
