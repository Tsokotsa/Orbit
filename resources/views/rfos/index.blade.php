@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!--begin::Row-->
        {{-- <div class="row g-5 g-xl-8 mb-8">

            <div class="card">

                <div class="card-header">

                    <div class="card-title">

                        Root Cause Analysis Reports

                    </div>

                    <div class="card-toolbar">

                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_rfo">

                            <i class="ki-outline ki-plus fs-2"></i>

                            New RFO

                        </button>

                    </div>

                </div>

                <div class="card-body">

                    <table id="rfoTable" class="table table-row-bordered gy-5">

                        <thead>

                            <tr>

                                <th>RFO Number</th>

                                <th>Title</th>

                                <th>Severity</th>

                                <th>Prepared By</th>

                                <th>Status</th>

                                <th>Created</th>

                                <th width="100">Actions</th>

                            </tr>

                        </thead>

                    </table>

                </div>

            </div>
        </div> --}}
        <!--end::Row-->

        <div class="card shadow-sm border-0">

            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">

                <!--begin::Card title-->
                <div class="card-title">

                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">

                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>

                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-13"
                            placeholder="Search Rfo..." />

                    </div>
                    <!--end::Search-->

                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">

                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_rfo">

                        <i class="ki-outline ki-plus fs-2"></i>

                        New RFO

                    </button>

                </div>
                <!--end::Card toolbar-->

            </div>
            <!--end::Card header-->


            <!--begin::Card body-->
            <div class="card-body py-4">

                <div class="table-responsive">

                    <table class="table align-middle table-row-dashed fs-8 gy-3" id="rfo_table">

                        <!--begin::Table head-->
                        <thead>

                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th>
                                    RFO #
                                </th>

                                <th>
                                    Classification
                                </th>

                                <th>
                                    Prepared By
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Created Date
                                </th>

                                <th class="text-end">
                                    Actions
                                </th>

                            </tr>

                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">

                            @foreach ($rfos as $rfo)
                                <tr>

                                    <!--begin::rfo-->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45px me-5">

                                                <span class="symbol-label bg-light-primary">

                                                    <i class="las la-edit fs-2 text-primary"></i>

                                                </span>

                                            </div>
                                            <!--end::Symbol-->



                                            <!--begin::Details-->
                                            <div class="d-flex flex-column">

                                                <span class="text-gray-800 fw-bold fs-8">
                                                    {{ $rfo->rfo_number }}
                                                </span>

                                                @if ($rfo->title)
                                                    <span class="text-muted fs-7">
                                                        {{ Str::limit($rfo->title, 60) }}
                                                    </span>
                                                @endif

                                            </div>
                                            <!--end::Details-->

                                        </div>

                                    </td>
                                    <!--end::Product-->
                                    <!--begin::Speed-->
                                    <td>

                                        @php
                                            $type = strtolower($rfo->classification ?? 'unknown');

                                            $config = match ($type) {
                                                'internal' => [
                                                    'class' => 'badge-light-primary',
                                                    'icon' => 'ki-outline ki-shield-tick text-primary',
                                                    'label' => 'Internal',
                                                ],
                                                'clients' => [
                                                    'class' => 'badge-light-secondary',
                                                    'icon' => 'ki-outline ki-user badge-light-secondary',
                                                    'label' => 'Client',
                                                ],
                                                'do not disclose' => [
                                                    'class' => 'badge-light-danger',
                                                    'icon' => 'ki-outline ki-eye-slash text-danger',
                                                    'label' => 'Do Not Disclose',
                                                ],
                                                default => [
                                                    'class' => 'badge-light-secondary',
                                                    'icon' => 'ki-outline ki-question text-muted',
                                                    'label' => ucfirst($type),
                                                ],
                                            };
                                        @endphp

                                        <div class="d-flex align-items-center">
                                            <span
                                                class="badge {{ $config['class'] }} px-3 py-2 d-flex align-items-center gap-2">
                                                <i class="{{ $config['icon'] }} fs-5"></i>
                                                <span class="fw-semibold">
                                                    {{ $config['label'] }}
                                                </span>
                                            </span>
                                        </div>

                                    </td>
                                    <!--end::Speed-->

                                    <!--begin::Price-->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <i class="las la-user-edit text-primary fs-4 me-2"></i>

                                            <span class="fw-bold text-dark">
                                                {{ $rfo->preparer['name'] . ' ' . $rfo->preparer['surname'] }}
                                            </span>

                                        </div>

                                    </td>
                                    <!--end::Price-->

                                    <!--begin::Public IP-->
                                    <td>

                                        @if ($rfo->status == 'draft')
                                            <span class="badge badge-light-success fs-9">
                                                {{ $rfo->status }}
                                            </span>
                                            <span class="badge badge-light-dark fs-9">
                                                {{ $rfo->approval_status }}
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger fs-9">
                                                Cant Be Edited
                                            </span>
                                            <span class="badge badge-light-dark fs-9">
                                                {{ $rfo->approval_status }}
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Public IP-->

                                    <!--begin::Billing-->
                                    <td>
                                        {{ $rfo->created_at }}

                                    </td>

                                    <!--begin::Actions-->
                                    <td class="text-end">

                                        @if ($rfo->status === 'draft')
                                            <span class="badge badge-light-primary p-2 edit-rfo-btn me-1"
                                                data-id="{{ $rfo->id }}" data-bs-toggle="tooltip" title="Edit RFO"
                                                style="cursor:pointer;">
                                                <i class="ki-outline ki-pencil fs-6"></i>
                                            </span>
                                        @endif

                                        @if (in_array($rfo->approval_status, ['submited']))
                                            <a href="{{ route('rfo.pdf', $rfo->id) }}" target="_blank"
                                                class="badge badge-light-success p-2 me-1" data-bs-toggle="tooltip"
                                                title="Preview PDF">
                                                <i class="ki-outline ki-file-down fs-6"></i>
                                            </a>
                                        @endif

                                        @if ($rfo->approval_status === 'pending' || $rfo->status === 'draft')
                                            <span class="badge badge-light-danger p-2 cancel-rfo-btn"
                                                data-id="{{ $rfo->id }}" data-bs-toggle="tooltip" title="Cancel RFO"
                                                style="cursor:pointer;">
                                                <i class="ki-outline ki-cross-circle fs-6"></i>
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Actions-->

                                </tr>
                            @endforeach

                        </tbody>
                        <!--end::Table body-->

                    </table>

                </div>

            </div>
            <!--end::Card body-->

        </div>


    </div>
    <!-- Include Modals -->
    @include('rfos.modals.add-rfo')
    <!-- END Includes -->
@endsection



@push('scripts')
    <script>
        // Search Filed
        $(document).ready(function() {

            let table = $('#rfo_table').DataTable({
                language: {
                    emptyTable: `
                <div class="d-flex flex-column flex-center py-10">
                    <i class="las la-pen fs-5tx text-gray-300 mb-5"></i>
                    <div class="fs-1 fw-bold text-gray-500 mb-2">No data Found</div>
                    <div class="fs-6 text-gray-400">Start by creating new rfo!</div>
                </div>
            `
                },
                columnDefs: [{
                    orderable: false,
                    targets: 5
                }]
            });

            $('[data-kt-filter="search"]').on('keyup', function() {
                table.search(this.value).draw();
            });

        });
        // End of Search Field

        var input1 = document.querySelector("#affected_pop");

        // Initialize Tagify script on the above inputs
        new Tagify(input1, {
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
        new Tagify(input2, {
            whitelist: ["Mpls", "L2vpn", "Internet", "Broad Band", "Starlink"],
            maxTags: 10,
            dropdown: {
                maxItems: 20, // <- mixumum allowed rendered suggestions
                classname: "tagify__inline__suggestions", // <- custom classname for this dropdown, so it could be targeted
                enabled: 0, // <- show suggestions on focus
                closeOnSelect: false // <- do not hide the suggestions dropdown once an item has been selected
            }
        });

        // Date time tempus

        document.querySelectorAll('.dt-picker').forEach(el => {
            initDateTimePicker(el);
        });

        function initDateTimePicker(element) {
            new tempusDominus.TempusDominus(element, {
                display: {
                    components: {
                        calendar: true,
                        clock: true,
                        useTwentyfourHour: true
                    }
                },
                localization: {
                    format: 'yyyy-MM-dd HH:mm' // Use uppercase 'HH' to remove AM/PM
                }
            });
        }
        // END Date Time

        // STart Date Calculation 
        function calculateDuration() {

            const detection = document.getElementById('detection_time').value;
            const restoration = document.getElementById('full_restore_time').value;

            if (!detection || !restoration) {
                $('#total_duration').val('');
                return;
            }

            const start = new Date(detection);
            const end = new Date(restoration);

            if (isNaN(start) || isNaN(end) || end < start) {
                $('#total_duration').val('Invalid');
                return;
            }

            let diff = Math.floor((end - start) / 1000);

            const days = Math.floor(diff / 86400);
            diff %= 86400;

            const hours = Math.floor(diff / 3600);
            diff %= 3600;

            const minutes = Math.floor(diff / 60);

            let duration = '';

            if (days > 0) {
                duration += `${days}d `;
            }

            if (hours > 0) {
                duration += `${hours}h `;
            }

            duration += `${minutes}m`;

            $('#total_duration').val(duration.trim());
        }

        document
            .getElementById('detection_time')
            .addEventListener('change', calculateDuration);

        document
            .getElementById('full_restore_time')
            .addEventListener('change', calculateDuration);
        // End Calculation of Duration


        // Load RFO Modal
        $(document).on('click', '.edit-rfo-btn', function() {


            let id = $(this).data('id');

            $.get('/rfos/' + id + '/edit', function(rfo) {
                console.log(rfo);


                $('#rfo_id').val(rfo.id);
                $('#rfo_action').val('edit');

                // Document
                $('[name="classification"]').val(rfo.classification).trigger('change');
                $('[name="document_version"]').val(rfo.document_version);
                $('[name="rfo_number"]').val(rfo.rfo_number);

                // Incident
                $('[name="title"]').val(rfo.title);
                $('[name="incident_summary"]').val(rfo.incident_summary);
                $('[name="affected_services"]').val(rfo.affected_services);

                // Times
                $('[name="incident_date"]').val(rfo.incident_date);
                $('[name="detection_time"]').val(rfo.detection_time);
                $('[name="full_restore_time"]').val(rfo.full_restore_time);

                // Duration from DB
                $('#total_duration').val(rfo.total_duration);

                // Impacts
                $('[name="service_impact"]').val(rfo.service_impact);
                $('[name="partial_restoration_notes"]').val(rfo.partial_restoration_notes);
                $('[name="full_restoration_notes"]').val(rfo.full_restoration_notes);
                $('[name="data_integrity"]').val(rfo.data_integrity);
                // $('[name="total_duration_minutes"]').val(rfo.total_duration);
                if (rfo.total_duration_minutes) {

                    let minutes = parseInt(rfo.total_duration_minutes);

                    let hours = Math.floor(minutes / 60);
                    let mins = minutes % 60;

                    $('#total_duration').val(`${hours}h ${mins}m`);
                }
                // $('#total_duration').val(rfo.total_duration_minutes);

                // RCA
                $('[name="root_cause"]').val(rfo.root_cause);
                $('[name="corrective_actions"]').val(rfo.corrective_actions);

                // Approver
                $('[name="approver_id"]').val(rfo.approver_id).trigger('change');

                // Draft switch
                $('[name="is_draft"]').prop(
                    'checked',
                    rfo.status === 'draft'
                );

                updateSubmitButton();

                $('#rfo_number_badge')
                    .removeClass('badge-light-primary')
                    .addClass('badge-light-success')
                    .text(rfo.rfo_number);

                // $('#kt_modal_add_rfo').modal('show');

                let timelineHtml = '';

                if (rfo.timelines && rfo.timelines.length > 0) {

                    timelineHtml += `
                <h6 class="text-muted fs-8 fw-bold mb-3">
                    Existing Timeline
                </h6>

                <div class="d-flex flex-column gap-3">
                            `;

                    rfo.timelines.forEach(function(timeline) {

                        let formattedDate = moment(timeline.timeline_time)
                            .format('DD MMM YYYY HH:mm');

                        timelineHtml += `
                <div class="d-flex align-items-start gap-3 p-3 bg-light rounded">

                    <i class="ki-outline ki-check-circle fs-4 text-success mt-1"></i>

                    <div class="flex-grow-1">

                        <div class="fw-semibold text-gray-800 fs-7">
                            ${timeline.timeline_action}
                        </div>

                        <div class="text-muted fs-8">
                            ${formattedDate}
                        </div>

                    </div>

                </div>
                        `;
                    });

                    timelineHtml += `</div>`;
                }

                $('#existing-timelines').html(timelineHtml);

                $('#kt_modal_add_rfo').modal('show');

            });

        });
        // End of RFO Load

        // Dynamic Button Text
        function updateSubmitButton() {

            let isDraft = $('[name="is_draft"]').is(':checked');

            if (isDraft) {

                $('#save_rfo_btn .indicator-label')
                    .text('Save RFO');

                $('#save_rfo_btn')
                    .removeClass('btn-success')
                    .addClass('btn-primary');

            } else {

                $('#save_rfo_btn .indicator-label')
                    .text('Submit For Approval');

                $('#save_rfo_btn')
                    .removeClass('btn-primary')
                    .addClass('btn-success');
            }
        }

        // Triggers on change
        $(document).on('change', '[name="is_draft"]', function() {
            // alert('olaaa');

            updateSubmitButton();

        });
        // End of Dynamic Button text

        // Start Reset Modal on Open
        // $('#create_rfo_btn').on('click', function() {

        //     $('#create_rfo_form')[0].reset();

        //     $('#rfo_id').val('');
        //     $('#rfo_action').val('create');

        //     $('[name="is_draft"]').prop('checked', true);

        //     $('#rfo_number_badge')
        //         .removeClass('badge-light-success')
        //         .addClass('badge-light-primary')
        //         .text('Auto Generated');

        //     updateSubmitButton();

        // });


        $('#kt_modal_add_rfo').on('hidden.bs.modal', function() {
            resetRfoModal();
        });

        $('#new_rfo_btn').on('click', function() {
            resetRfoModal();
            $('#kt_modal_add_rfo').modal('show');
        });

        function resetRfoModal() {

            $('#create_rfo_form')[0].reset();

            $('#rfo_id').val('');
            $('#rfo_action').val('create');

            $('#rfo_number_badge')
                .removeClass('badge-light-success')
                .addClass('badge-light-primary')
                .text('Auto Generated');

            $('[name="approver_id"]').val('').trigger('change');
            $('[name="classification"]').val('internal').trigger('change');

            $('[name="is_draft"]').prop('checked', true);

            updateSubmitButton();
        }
        // END Reset Modal
    </script>
@endpush
