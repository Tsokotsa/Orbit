<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Heading-->
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                <input type="text" data-kt-user-table-filter="search"
                    class="form-control form-control-solid w-250px ps-13" placeholder="Search activities...">
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
                        <th class="min-w-100px">Doc Ref #</th>
                        <th class="min-w-250px">Type</th>
                    </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody class="fw-6 fw-semibold text-gray-600">
                    @forelse ($docs as $doc)
                        <tr>
                            <td>
                                <a href="#" class="text-hover-primary text-gray-600">{{ $doc['id'] }}</a>
                            </td>
                            <td>
                                <span class="badge badge-light-success fs-7 fw-bold">{{ $doc['type'] }}</span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">No Finance activities found on this
                                plannet ...
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
