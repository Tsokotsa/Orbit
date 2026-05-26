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
                                <span class="symbol-label bg-light-primary">
                                    <i class="ki-outline ki-underlining fs-2x text-dark"></i>
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
                                            <span class="badge badge-light-success fs-9">
                                                YES
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger fs-9">
                                                NO
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Public IP-->

                                    <!--begin::Billing-->
                                    <td>

                                        @if ($product->is_prepaid == 'y')
                                            <span class="badge badge-light-dark d-inline-flex align-items-center fs-9">


                                                PREPAID

                                            </span>
                                        @else
                                            <span class="badge badge-light-dark d-inline-flex align-items-center fs-9">



                                                POSTPAID

                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Billing-->

                                    <!--begin::Status-->
                                    <td>

                                        @if ($product->active == 'y')
                                            <span class="badge badge-light-success fs-9">
                                                ACTIVE
                                            </span>
                                        @else
                                            <span class="badge badge-light-danger fs-9">
                                                INACTIVE
                                            </span>
                                        @endif

                                    </td>
                                    <!--end::Status-->



                                    <!--begin::Actions-->
                                    <td class="text-end">

                                        <button type="button"
                                            class="btn btn-icon btn-light-primary btn-sm edit-product-btn"
                                            data-id="{{ $product->id }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Edit Product">

                                            <i class="ki-outline ki-pencil fs-5"></i>

                                        </button>

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
    @include('product.modals.add-product')
    @include('product.modals.edit-product')
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
