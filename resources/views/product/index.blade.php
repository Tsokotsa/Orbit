@extends('layouts.master')

@section('content')
    <div class="container-fluid">

        <!--begin::Row-->
        <div class="row g-5 g-xl-8 mb-8">

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-package fs-2x text-primary"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fs-2hx fw-bold text-dark">
                                    {{ number_format($stats['total']) }}
                                </div>

                                <div class="fw-semibold text-gray-500">
                                    Total Products
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="ki-outline ki-check-circle fs-2x text-success"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fs-2hx fw-bold text-dark">
                                    {{ number_format($stats['active']) }}
                                </div>

                                <div class="fw-semibold text-gray-500">
                                    Active Services
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-info">
                                    <i class="ki-outline ki-global fs-2x text-info"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fs-2hx fw-bold text-dark">
                                    {{ number_format($stats['public_ip']) }}
                                </div>

                                <div class="fw-semibold text-gray-500">
                                    Public IP Plans
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8 shadow-sm border-0">
                    <div class="card-body">
                        <div class="d-flex align-items-center">

                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-warning">
                                    <i class="ki-outline ki-wallet fs-2x text-warning"></i>
                                </span>
                            </div>

                            <div>
                                <div class="fs-2hx fw-bold text-dark">
                                    {{ number_format($stats['prepaid']) }}
                                </div>

                                <div class="fw-semibold text-gray-500">
                                    Prepaid Plans
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--end::Col-->

        </div>
        <!--end::Row-->



        <!--begin::Card-->
        <div class="card shadow-sm border-0">

            <!--begin::Card header-->
            <div class="card-header border-0 pt-6">

                <!--begin::Card title-->
                <div class="card-title">

                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">

                        <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>

                        <input type="text" data-kt-filter="search" class="form-control form-control-solid w-250px ps-13"
                            placeholder="Search products/services..." />

                    </div>
                    <!--end::Search-->

                </div>
                <!--begin::Card title-->

                <!--begin::Card toolbar-->
                <div class="card-toolbar">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_add_product">

                        <i class="ki-outline ki-plus fs-2"></i>

                        Add Product

                    </button>

                </div>
                <!--end::Card toolbar-->

            </div>
            <!--end::Card header-->


            <!--begin::Card body-->
            <div class="card-body py-4">

                <div class="table-responsive">

                    <table class="table align-middle table-row-dashed fs-8 gy-5" id="products_table">

                        <!--begin::Table head-->
                        <thead>

                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                                <th class="min-w-200px">
                                    Product
                                </th>

                                <th class="min-w-180px">
                                    Speed
                                </th>

                                <th class="min-w-120px">
                                    Price
                                </th>

                                <th class="min-w-120px">
                                    Public IP
                                </th>

                                <th class="min-w-120px">
                                    Billing
                                </th>

                                <th class="min-w-120px">
                                    Status
                                </th>

                                <th class="text-end min-w-100px">
                                    Actions
                                </th>

                            </tr>

                        </thead>
                        <!--end::Table head-->

                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">

                            @forelse($products as $product)
                                <tr>

                                    <!--begin::Product-->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45px me-5">

                                                @if ($product->logo)
                                                    <img src="{{ asset($product->logo) }}" alt="{{ $product->name }}" />
                                                @else
                                                    <span class="symbol-label bg-light-primary">

                                                        <i class="ki-outline ki-package fs-2 text-primary"></i>

                                                    </span>
                                                @endif

                                            </div>
                                            <!--end::Symbol-->



                                            <!--begin::Details-->
                                            <div class="d-flex flex-column">

                                                <span class="text-gray-800 fw-bold fs-6">
                                                    {{ $product->name }}
                                                </span>

                                                @if ($product->description)
                                                    <span class="text-muted fs-7">
                                                        {{ Str::limit($product->description, 60) }}
                                                    </span>
                                                @endif

                                            </div>
                                            <!--end::Details-->

                                        </div>

                                    </td>
                                    <!--end::Product-->
                                    <!--begin::Speed-->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <div class="d-flex align-items-center me-6">

                                                <i class="ki-outline ki-arrow-down text-success fs-4 me-2"></i>

                                                <span class="fw-bold text-gray-800">
                                                    {{ $product->d_speed ?? '0' }}
                                                </span>

                                                <span class="text-muted fs-8 ms-1">
                                                    Mbps
                                                </span>

                                            </div>

                                            <div class="d-flex align-items-center">

                                                <i class="ki-outline ki-arrow-up text-primary fs-4 me-2"></i>

                                                <span class="fw-bold text-gray-800">
                                                    {{ $product->u_speed ?? '0' }}
                                                </span>

                                                <span class="text-muted fs-8 ms-1">
                                                    Mbps
                                                </span>

                                            </div>

                                        </div>

                                    </td>
                                    <!--end::Speed-->

                                    <!--begin::Price-->
                                    <td>

                                        <div class="d-flex align-items-center">

                                            <i class="fa fa-coins text-warning fs-2 me-2"></i>

                                            <span class="fw-bold text-dark">
                                                {{ number_format($product->price, 2) }}
                                            </span>

                                        </div>

                                    </td>
                                    <!--end::Price-->

                                    <!--begin::Public IP-->
                                    <td>

                                        @if ($product->public_ip == 'y')
                                            <span class="badge badge-light-success">
                                                YES
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger">
                                                NO
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Public IP-->

                                    <!--begin::Billing-->
                                    <td>

                                        @if ($product->is_prepaid == 'y')
                                            <span class="badge badge-light-dark d-inline-flex align-items-center">


                                                PREPAID

                                            </span>
                                        @else
                                            <span class="badge badge-light-dark d-inline-flex align-items-center">



                                                POSTPAID

                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Billing-->

                                    <!--begin::Status-->
                                    <td>

                                        @if ($product->active == 'y')
                                            <span class="badge badge-light-success">
                                                ACTIVE
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger">
                                                INACTIVE
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Status-->



                                    <!--begin::Actions-->
                                    <td class="text-end">

                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                                            Actions

                                            <i class="ki-outline ki-down fs-5 ms-1"></i>

                                        </a>



                                        <!--begin::Menu-->
                                        <div
                                            class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 fs-6 w-200px">

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">

                                                <a href="{{ route('product.show', $product->id) }}"
                                                    class="menu-link px-3">

                                                    View

                                                </a>

                                            </div>
                                            <!--end::Menu item-->



                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">

                                                <a href="{{ route('product.edit', $product->id) }}"
                                                    class="menu-link px-3">

                                                    Edit

                                                </a>

                                            </div>
                                            <!--end::Menu item-->



                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">

                                                <a href="javascript:void(0)" class="menu-link px-3 text-danger">

                                                    Delete

                                                </a>

                                            </div>
                                            <!--end::Menu item-->

                                        </div>
                                        <!--end::Menu-->

                                    </td>
                                    <!--end::Actions-->

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9">

                                        <div class="d-flex flex-column flex-center py-10">

                                            <i class="ki-outline ki-package fs-5tx text-gray-300 mb-5"></i>

                                            <div class="fs-1 fw-bold text-gray-500 mb-2">
                                                No Products Found
                                            </div>

                                            <div class="fs-6 text-gray-400">
                                                Start by creating your first product/service.
                                            </div>

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>
                        <!--end::Table body-->

                    </table>

                </div>

            </div>
            <!--end::Card body-->

        </div>
        <!--end::Card-->

    </div>
    <!-- BEGIN Includes -->
    <!--begin::Modal-->
    <div class="modal fade" id="kt_modal_add_product" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <!--begin::Modal header-->
                    <div class="modal-header">

                        <h2 class="fw-bold">
                            Add Product / Service
                        </h2>

                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">

                            <i class="ki-outline ki-cross fs-1"></i>

                        </div>

                    </div>
                    <!--end::Modal header-->



                    <!--begin::Modal body-->
                    <div class="modal-body py-10 px-lg-17">

                        <div class="row g-5">

                            <!--begin::Name-->
                            <div class="col-md-6">

                                <label class="required form-label">
                                    Product Name
                                </label>

                                <input type="text" name="name" class="form-control form-control-solid" required>

                            </div>
                            <!--end::Name-->



                            <!--begin::Price-->
                            <div class="col-md-6">

                                <label class="required form-label">
                                    Price
                                </label>

                                <input type="number" step="0.01" name="price"
                                    class="form-control form-control-solid" required>

                            </div>
                            <!--end::Price-->



                            <!--begin::Download-->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Download Speed
                                </label>

                                <div class="input-group">

                                    <input type="number" name="d_speed" class="form-control form-control-solid">

                                    <span class="input-group-text">
                                        Mbps
                                    </span>

                                </div>

                            </div>
                            <!--end::Download-->



                            <!--begin::Upload-->
                            <div class="col-md-6">

                                <label class="form-label">
                                    Upload Speed
                                </label>

                                <div class="input-group">

                                    <input type="number" name="u_speed" class="form-control form-control-solid">

                                    <span class="input-group-text">
                                        Mbps
                                    </span>

                                </div>

                            </div>
                            <!--end::Upload-->



                            <!--begin::Description-->
                            <div class="col-md-12">

                                <label class="form-label">
                                    Description
                                </label>

                                <textarea name="description" rows="3" class="form-control form-control-solid"></textarea>

                            </div>
                            <!--end::Description-->



                            <!--begin::Public IP-->
                            <div class="col-md-4">

                                <label class="form-label">
                                    Public IP
                                </label>

                                <select name="public_ip" class="form-select form-select-solid">

                                    <option value="n">No</option>
                                    <option value="y">Yes</option>

                                </select>

                            </div>
                            <!--end::Public IP-->



                            <!--begin::Billing-->
                            <div class="col-md-4">

                                <label class="form-label">
                                    Billing Type
                                </label>

                                <select name="is_prepaid" class="form-select form-select-solid">

                                    <option value="n">Postpaid</option>
                                    <option value="y">Prepaid</option>

                                </select>

                            </div>
                            <!--end::Billing-->



                            <!--begin::Status-->
                            <div class="col-md-4">

                                <label class="form-label">
                                    Status
                                </label>

                                <select name="active" class="form-select form-select-solid">

                                    <option value="y">Active</option>
                                    <option value="n">Inactive</option>

                                </select>

                            </div>
                            <!--end::Status-->

                        </div>

                    </div>
                    <!--end::Modal body-->



                    <!--begin::Modal footer-->
                    <div class="modal-footer flex-center">

                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">

                            Cancel

                        </button>

                        <button type="submit" class="btn btn-primary">

                            <span class="indicator-label">

                                Save Product

                            </span>

                        </button>

                    </div>
                    <!--end::Modal footer-->

                </form>

            </div>

        </div>

    </div>
    <!--end::Modal-->
    <!-- END Includes -->
@endsection



@push('scripts')
    <script>
        $(document).ready(function() {

            let table = $('#products_table').DataTable({});

            $('[data-kt-filter="search"]').on('keyup', function() {

                table.search(this.value).draw();

            });

        });
    </script>
@endpush
