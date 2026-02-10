<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Heading-->
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Search Orbit finances...">
            </div>
        </div>
        <!--end::Heading-->
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <div class="my-1 me-4" data-select2-id="select2-data-110-94hl">
                <!--begin::Select-->
                <select class="form-select form-select-sm form-select-solid w-125px select2-hidden-accessible"
                    data-control="select2" data-placeholder="Select Hours" data-hide-search="true"
                    data-select2-id="select2-data-1-wnsh" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                    <option value="1" selected="selected" data-select2-id="select2-data-3-lvio">1 Hours</option>
                    <option value="2" data-select2-id="select2-data-114-oa33">6 Hours</option>
                    <option value="3" data-select2-id="select2-data-115-xw6q">12 Hours</option>
                    <option value="4" data-select2-id="select2-data-116-xy7r">24 Hours</option>
                </select><span class="select2 select2-container select2-container--bootstrap5 select2-container--below"
                    dir="ltr" data-select2-id="select2-data-2-18hk" style="width: 100%;"><span
                        class="selection"><span
                            class="select2-selection select2-selection--single form-select form-select-sm form-select-solid w-125px"
                            role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0"
                            aria-disabled="false" aria-labelledby="select2-ez26-container"
                            aria-controls="select2-ez26-container"><span class="select2-selection__rendered"
                                id="select2-ez26-container" role="textbox" aria-readonly="true" title="1 Hours">1
                                Hours</span><span class="select2-selection__arrow" role="presentation"><b
                                    role="presentation"></b></span></span></span><span class="dropdown-wrapper"
                        aria-hidden="true"></span></span>
                <!--end::Select-->
            </div>
            <a href="#" class="btn btn-sm btn-primary my-1">View All</a>
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pt-9 pb-0">
        <!--begin::Table wrapper-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table align-middle table-row-bordered table-row-solid gy-4 gs-9" id="client_finance_data">
                <!--begin::Thead-->
                <thead class="fs-5 fw-semibold bg-lighten fw-semibold fs-6 text-muted">
                    <tr>
                        <th class="min-w-100px">Doc ID #</th>
                        <th class="">Doc Ref</th>
                        <th class="">Partner Ref</th>
                        <th class="">Invoice Date</th>
                        <th class="">Invoice Amount</th>
                        <th class="">Status</th>
                    </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody class="fw-6 fw-semibold text-gray-600">
                    @forelse ($invoices as $invoice)
                        <tr>

                            {{-- Doc ID --}}
                            <td>
                                <small class="text-muted">
                                    #{{ $invoice->odoo_id }}
                                </small>
                            </td>

                            {{-- Doc Ref --}}
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="symbol-label fs-7 fw-semibold bg-light-primary text-primary rounded-circle"
                                        style="width:30px;height:30px;display:flex;align-items:center;justify-content:center;">
                                        {{ strtoupper(substr($invoice->doc_ref ?? 'D', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-medium text-body">
                                            {{ $invoice->doc_ref ?? '—' }}
                                        </div>
                                        <small class="text-muted">
                                            <i class="fa fa-file-invoice me-1"></i>Document Ref
                                        </small>
                                    </div>
                                </div>
                            </td>

                            {{-- Partner Ref --}}
                            <td>
                                @if ($invoice->partner_ref)
                                    <div class="d-flex align-items-center ps-2"
                                        style="border-left:2px solid var(--bs-success);">
                                        <div>
                                            <div class="fw-medium text-body">
                                                {{ $invoice->partner_ref }}
                                            </div>
                                            <small class="text-muted">
                                                <i class="fa fa-user me-1"></i>Partner
                                            </small>
                                        </div>
                                    </div>
                                @else
                                    <small class="text-muted">—</small>
                                @endif
                            </td>

                            {{-- Invoice Date --}}
                            <td>
                                <i class="fa fa-calendar-alt text-muted me-1"></i>
                                <span class="fw-medium">
                                    {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}
                                </span>
                            </td>

                            {{-- Invoice Amount --}}
                            <td>
                                <div class="fw-medium text-body">
                                    {{ number_format($invoice->amount_total, 2) }}
                                </div>
                                <small class="text-muted">
                                    <i class="fa fa-coins me-1"></i>Total Amount
                                </small>
                            </td>

                            {{-- Status --}}
                            <td>
                                @php
                                    $map = [
                                        'open' => ['cls' => 'warning', 'label' => 'Open', 'solid' => false],
                                        'posted' => ['cls' => 'success', 'label' => 'Posted', 'solid' => true],
                                        'paid' => ['cls' => 'success', 'label' => 'Paid', 'solid' => true],
                                        'cancel' => ['cls' => 'danger', 'label' => 'Canceled', 'solid' => false],
                                    ];

                                    $stateKey = strtolower($invoice->state);
                                    $state = $map[$stateKey] ?? [
                                        'cls' => 'secondary',
                                        'label' => ucfirst($invoice->state),
                                        'solid' => false,
                                    ];
                                @endphp

                                {!! $state['solid']
                                    ? "<span class='badge bg-{$state['cls']}'>{$state['label']}</span>"
                                    : "<span class='badge bg-{$state['cls']}-subtle text-{$state['cls']}'>{$state['label']}</span>" !!}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-6">
                                <i class="fa fa-info-circle me-1"></i>
                                No Billing activities found on this plannet ...
                            </td>
                        </tr>
                    @endforelse
                </tbody>

                <!--end::Tbody-->
                <tfoot>

                </tfoot>
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table wrapper-->
    </div>
    <!--end::Card body-->
</div>
