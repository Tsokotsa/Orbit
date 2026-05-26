<div class="card mb-5 mb-xl-10">

    <!-- CARD HEADER -->
    <div class="card-header border-0 pt-6">

        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Search user">
            </div>
        </div>

        <div class="card-toolbar">

            @if ($assets->isNotEmpty())
                <div>
                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                        data-bs-target="#add_asset_modal">
                        Add New Asset
                    </a>
                </div>
            @endif

            <div class="d-flex justify-content-end align-items-center d-none" data-kt-user-table-toolbar="selected">
                <div class="fw-bold me-5">
                    <span class="me-2" data-kt-user-table-select="selected_count"></span>
                    Selected
                </div>
                <button type="button" class="btn btn-danger" data-kt-user-table-select="delete_selected">
                    Delete Selected
                </button>
            </div>

        </div>
    </div>
    <!-- END HEADER -->


    <!-- CARD BODY -->
    <div class="card-body pt-9 pb-0">
        <div class="table-responsive">
            <table id="assets-table" class="table table-row-bordered gy-5">

                <thead>
                    <tr class="fw-semibold fs-6 text-muted">
                        <th>Serial #</th>
                        <th>Product Name</th>
                        <th class="text-start">Model</th>
                        <th>Created Date</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($assets as $asset)
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
                                <div class="px-3 py-0 border-start border-3 border-info text-start">
                                    {{ $asset->model_name ?? 'NA' }}
                                </div>
                            </td>

                            <td>
                                <span
                                    class="px-3 py-1 border border-dashed rounded border-secondary d-inline-flex align-items-center gap-2">
                                    <i class="fa-regular fa-calendar text-muted"></i>
                                    {{ $asset->created_at ?? 'NA' }}
                                </span>
                            </td>

                            <td class="text-center">
                                <div class="d-inline-flex align-items-center gap-3">
                                    <a href="#" class="text-primary" title="Link Asset">
                                        <i class="fa-solid fs-4 fa-link fa-lg text-success"></i>
                                    </a>

                                    <a href="#" class="text-success" title="Approve Asset">
                                        <i class="fa-regular fs-4 fa-thumbs-up fa-lg"></i>
                                    </a>

                                    <a href="#" class="text-dark" title="Network Port">
                                        <i class="fa-solid fs-4 fa-ethernet fa-lg"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                @if ($assets->isEmpty())
                    <tfoot>
                        <tr>
                            <td colspan="5" class="text-center">
                                <div class="mt-6">
                                    <a href="#" class="btn btn-primary er fs-6 px-8 py-4" data-bs-toggle="modal"
                                        data-bs-target="#add_asset_modal">
                                        Add New Asset
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                @endif

            </table>
        </div>
    </div>
    <!-- END BODY -->

</div>



<!-- Add Asset Modal -->
@include('clients.modals.add-asset')
<!-- END ASSet Modal -->
