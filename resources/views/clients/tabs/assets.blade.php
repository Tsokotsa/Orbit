<div class="card mb-5 mb-xl-10">
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Search user">
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Add user-->
            @if ($assets->count())
                <div class="">
                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                        data-bs-target="#add_asset_modal">Add New Asset</a>
                </div>
            @endif
            <!--end::Add user-->
            <!--begin::Group actions-->
            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bold me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                </div>
                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">Delete
                    Selected</button>
            </div>
            <!--end::Group actions-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <div class="card-body pt-9 pb-0">
        <div class="table-responsive">
            <table id="assets-table" class="table table-row-bordered gy-5">
                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Serial #</th>
                        <th>Product Name</th>
                        <th>Model</th>
                        <th>Created Date</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                @if ($assets->count())
                    @foreach ($assets as $asset)
                        <tbody>
                            <tr>
                                <td>
                                    <div class="px-3 py-0 border border-dashed rounded border-warning d-inline-block">
                                        {{ $asset->asset_serial ?? 'NA' }}
                                    </div>
                                </td>

                                <td>
                                    <div class="px-3 py-0 border-start border-3 border-primary">
                                        <strong>{{ $asset->asset_name ?? 'NA' }}</strong>
                                    </div>
                                </td>

                                <td>
                                    <div class="px-3 py-0 border-start border-3 border-info">
                                        {{ $asset->model_name ?? 'NA' }}
                                    </div>
                                </td>

                                <td>
                                    <span
                                        class="px-3 py-1 border border-dashed rounded border-secondary d-inline-flex align-items-center gap-2">
                                        <i class="fa-regular fa-calendar text-muted"></i>
                                        {{ $asset->created_at?->format('Y-m-d') ?? 'NA' }}
                                    </span>
                                </td>

                                <td class="text-center">
                                    <div class="d-inline-flex align-items-center gap-3">

                                        {{-- Link --}}
                                        <a href="#" class="text-primary" title="Link Asset">
                                            <i class="fa-solid fs-4 fa-link fa-lg text-success"></i>
                                        </a>

                                        {{-- Approve / Thumbs up --}}
                                        <a href="#" class="text-success" title="Approve Asset">
                                            <i class="fa-regular fs-4 fa-thumbs-up fa-lg"></i>
                                        </a>

                                        {{-- Ethernet / Network --}}
                                        <a href="#" class="text-dark" title="Network Port">
                                            <i class="fa-solid fs-4 fa-ethernet fa-lg"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        </tbody>
                    @endforeach
            </table>
        </div>
    @else
        <tfoot>
            <tr>
                <th colspan="6" class="text-center">
                    <div class="mt-6">
                        <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                            data-bs-target="#add_asset_modal">Add New Asset</a>
                    </div>
                </th>
            </tr>
        </tfoot>
        </table>
        @endif

        <div class="modal fade" tabindex="-1" id="add_asset_modal">
            <div class="modal-dialog mw-650px">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Add Asset</h3>
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="asset-form" action="/assets/assign">
                            @csrf

                            <input type="hidden" id="cid" name="client_id" value="{{ $cid }}">
                            <input type="hidden" id="asset_id" name="asset_id">
                            <div class="d-flex flex-column mb-8 fv-row fv-plugins-icon-container">

                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                    <span class="required">Asset S/N</span>
                                    <span class="ms-1" data-bs-toggle="tooltip"
                                        aria-label="Start type and should autocomplete"
                                        data-bs-original-title="Start type and should autocomplete"
                                        data-kt-initialized="1">
                                        <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                    </span>
                                </label>
                                <!--end::Label-->
                                {{-- <input type="text" class="form-control form-control-solid" placeholder="Start typing..." name="target_title"> --}}

                                <div class="position-relative">
                                    <input type="text" id="asset-search" class="form-control" name="asset_serial"
                                        placeholder="Start typing asset name…" autocomplete="off">

                                    <div id="asset-suggestions" class="list-group position-absolute w-100 shadow"
                                        style="z-index: 1056; display:none;">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 text-start">
                                    <label class="required fs-5 fw-semibold mb-2 text-left">Asset Name</label>
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="asset_name" id="asset_name" readonly>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                                <div class="col-md-6 text-start">
                                    <label class="required fs-5 fw-semibold mb-2 text-left">Asset Description</label>
                                    <input type="text" class="form-control form-control-solid" placeholder=""
                                        name="asset_description" id="asset_description" readonly>
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5 text-start">
                                <div class="col-md-12">
                                    <label class="required fs-5 fw-semibold mb-2 text-left">Choose Model</label>

                                    <select id="vendor_model" name="vendor_model" class="form-select"
                                        data-control="select2" data-placeholder="Vendor Model" disabled>
                                    </select>

                                </div>

                            </div>
                            <div class="row mb-5">
                                <div class="col-md-6 text-start">
                                    <div class="d-flex flex-stack">
                                        <div class="me-5 text-start">
                                            <label class="fs-6 fw-semibold form-label">Is asset enabled?</label>
                                            <div class="fs-7 fw-semibold text-muted">You can change services while
                                                disabled
                                            </div>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="asset_enabled"
                                                    value="y" checked="checked">
                                                <span class="form-check-label fw-semibold text-muted">Enabled</span>
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-6 text-start">
                                    <div class="d-flex flex-stack">
                                        <div class="me-5 text-start">
                                            <label class="fs-6 fw-semibold form-label">Prevent Transfer</label>
                                            <div class="fs-7 fw-semibold text-muted">Can asset be transfered to another
                                                acc
                                            </div>
                                            <label class="form-check form-switch form-check-custom form-check-solid">
                                                <input class="form-check-input" type="checkbox" name="asset_transfer"
                                                    value="y">
                                                <span class="form-check-label fw-semibold text-muted">Yes</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-center mt-12">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary add-asset-click">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
