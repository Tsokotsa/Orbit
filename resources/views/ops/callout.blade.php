@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">

            {{-- HEADER --}}
            <div class="d-flex flex-column mb-8">

                <div class="d-flex align-items-center mb-2">

                    <div class="symbol symbol-60px me-5">
                        <div class="symbol-label bg-light-primary">
                            <i class="ki-duotone ki-map fs-1 text-primary">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                    </div>

                    <div>
                        <h1 class="fw-bold fs-2hx text-gray-900 mb-1">
                            Call-Out Quote Generator
                        </h1>

                        <div class="text-muted fs-6">
                            Enterprise field service quotation & travel estimation
                        </div>
                    </div>

                </div>

            </div>

            <div class="row g-5">

                {{-- MAIN CARD --}}
                <div class="col-xl-8">

                    <div class="card card-flush border-0 shadow-sm">

                        {{-- HEADER --}}
                        <div class="card-header border-0 pt-7">

                            <div class="card-title">

                                <div class="d-flex align-items-center">

                                    <div class="symbol symbol-45px me-3">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-setting-2 fs-2 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>

                                    <div>
                                        <h3 class="fw-bold mb-0">
                                            Quote Configuration
                                        </h3>

                                        <div class="text-muted fs-7">
                                            Configure route, vehicle, labour and costing
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        {{-- BODY --}}
                        <div class="card-body pt-3">

                            {{-- TABS --}}
                            <ul
                                class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-6 fw-bold mb-10">

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary active" data-bs-toggle="tab" href="#route_tab">
                                        <i class="ki-duotone ki-geolocation fs-3 me-2"></i>
                                        Route
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary" data-bs-toggle="tab" href="#vehicle_tab">
                                        <i class="ki-duotone ki-car fs-3 me-2"></i>
                                        Vehicle
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary" data-bs-toggle="tab" href="#labour_tab">
                                        <i class="ki-duotone ki-profile-user fs-3 me-2"></i>
                                        Labour
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary" data-bs-toggle="tab" href="#costs_tab">
                                        <i class="ki-duotone ki-dollar fs-3 me-2"></i>
                                        Costs
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link text-active-primary" data-bs-toggle="tab" href="#notes_tab">
                                        <i class="ki-duotone ki-notepad fs-3 me-2"></i>
                                        Notes
                                    </a>
                                </li>

                            </ul>

                            <div class="tab-content">

                                {{-- ROUTE TAB --}}
                                <div class="tab-pane fade show active" id="route_tab">

                                    <div class="row g-6">

                                        <div class="col-md-6">

                                            <div class="border border-gray-200 rounded-3 p-5 h-100">

                                                <label class="form-label fw-bold text-gray-700">
                                                    Head Office
                                                </label>

                                                <div class="position-relative">

                                                    <span class="position-absolute top-50 translate-middle-y ms-4">
                                                        <i class="ki-duotone ki-building fs-2 text-primary">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>

                                                    <input type="text"
                                                        class="form-control form-control-solid form-control-lg ps-13"
                                                        value="Maputo Head Office" readonly>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6 position-relative">

                                            <div class="border border-gray-200 rounded-3 p-5 h-100">

                                                <label class="form-label fw-bold text-gray-700">
                                                    Customer Location
                                                </label>

                                                <div class="position-relative">

                                                    <span class="position-absolute top-50 translate-middle-y ms-4">
                                                        <i class="ki-duotone ki-geolocation fs-2 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>

                                                    <input type="text" id="customer_location"
                                                        class="form-control form-control-solid form-control-lg ps-13"
                                                        placeholder="Search Mozambique location">

                                                </div>

                                                <div id="location_results"></div>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border border-dashed border-primary rounded-3 p-5">

                                                <div class="d-flex align-items-center mb-3">

                                                    <i class="ki-duotone ki-map fs-2 text-primary me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>

                                                    <label class="fw-bold mb-0">
                                                        Distance
                                                    </label>

                                                </div>

                                                <div class="input-group input-group-solid">
                                                    <input type="text" id="distance"
                                                        class="form-control form-control-lg fw-bold" readonly>

                                                    <span class="input-group-text">
                                                        KM
                                                    </span>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border border-dashed border-warning rounded-3 p-5">

                                                <div class="d-flex align-items-center mb-3">

                                                    <i class="ki-duotone ki-arrow-left-right fs-2 text-warning me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>

                                                    <label class="fw-bold mb-0">
                                                        Round Trip
                                                    </label>

                                                </div>

                                                <select id="round_trip"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="1">
                                                        No
                                                    </option>

                                                    <option value="2">
                                                        Yes (x2)
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border border-dashed border-success rounded-3 p-5">

                                                <div class="d-flex align-items-center mb-3">

                                                    <i class="ki-duotone ki-time fs-2 text-success me-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>

                                                    <label class="fw-bold mb-0">
                                                        Travel Duration
                                                    </label>

                                                </div>

                                                <div class="input-group input-group-solid">

                                                    <input type="text" id="duration"
                                                        class="form-control form-control-lg fw-bold" readonly>

                                                    <span class="input-group-text">
                                                        Hours
                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- VEHICLE TAB --}}
                                <div class="tab-pane fade" id="vehicle_tab">

                                    <div class="row g-6">

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Fuel Type
                                                </label>

                                                <select id="fuel_type"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="diesel">
                                                        Diesel
                                                    </option>

                                                    <option value="petrol">
                                                        Petrol
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Vehicle Brand
                                                </label>

                                                <select id="vehicle_model"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="12">
                                                        Toyota Hilux
                                                    </option>

                                                    <option value="14">
                                                        Ford Ranger
                                                    </option>

                                                    <option value="16">
                                                        Isuzu D-Max
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Fuel Price
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="fuel_price"
                                                        class="form-control form-control-lg fw-bold">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Fuel Consumption
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <input type="number" id="fuel_consumption"
                                                        class="form-control form-control-lg fw-bold">

                                                    <span class="input-group-text">
                                                        L/100KM
                                                    </span>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Wear & Tear / KM
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="wear_tear"
                                                        class="form-control form-control-lg" value="2">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- LABOUR TAB --}}
                                <div class="tab-pane fade" id="labour_tab">

                                    <div class="row g-6">

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Labour Duration
                                                </label>

                                                <select id="labour_duration"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="1">1 Hour</option>
                                                    <option value="2">2 Hours</option>
                                                    <option value="4">4 Hours</option>
                                                    <option value="8">Full Day</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Staff
                                                </label>

                                                <select id="staff"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-4">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Hourly Rate
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="hourly_rate"
                                                        class="form-control form-control-lg" value="100">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Per Diem Distance
                                                </label>

                                                <select id="per_diem_range"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="0">
                                                        0 - 50KM
                                                    </option>

                                                    <option value="500">
                                                        50 - 150KM
                                                    </option>

                                                    <option value="1000">
                                                        150KM+
                                                    </option>

                                                </select>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Per Diem Per Staff
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="per_diem"
                                                        class="form-control form-control-lg" value="750">

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- COSTS TAB --}}
                                <div class="tab-pane fade" id="costs_tab">

                                    <div class="row g-6">

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Toll Gates
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="toll"
                                                        class="form-control form-control-lg" value="0">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Additional Costs
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        MZN
                                                    </span>

                                                    <input type="number" id="extra_cost"
                                                        class="form-control form-control-lg" value="0">

                                                </div>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="border rounded-3 p-5">

                                                <label class="form-label fw-bold">
                                                    Profit Margin
                                                </label>

                                                <select id="profit"
                                                    class="form-select form-select-solid form-select-lg">

                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                                {{-- NOTES TAB --}}
                                <div class="tab-pane fade" id="notes_tab">

                                    <div class="border rounded-3 p-5 mb-5">

                                        <label class="form-label fw-bold">
                                            Additional Notes
                                        </label>

                                        <textarea id="notes" class="form-control form-control-solid" rows="6"></textarea>

                                    </div>

                                    <button class="btn btn-primary btn-lg w-100">

                                        <i class="ki-duotone ki-file-down fs-2 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>

                                        Generate PDF Quote

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SUMMARY --}}
                <div class="col-xl-4">

                    <div class="card bg-dark shadow-sm position-sticky" style="top:120px;">

                        <div class="card-header border-0">

                            <div class="card-title">

                                <h3 class="text-white">
                                    Itemized Quote Summary
                                </h3>

                            </div>

                        </div>

                        <div class="card-body">

                            <div class="summary-item">
                                <span>Fuel Cost</span>
                                <strong id="fuel_cost">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Wear & Tear</span>
                                <strong id="wear_cost">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Labour</span>
                                <strong id="labour_cost">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Per Diem</span>
                                <strong id="perdiem_cost">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Toll Fees</span>
                                <strong id="toll_cost">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Additional Costs</span>
                                <strong id="extra_cost_summary">MZN 0.00</strong>
                            </div>

                            <div class="summary-item">
                                <span>Profit Margin</span>
                                <strong id="profit_summary">20%</strong>
                            </div>

                            <div class="separator separator-dashed border-gray-600 my-7"></div>

                            <div class="d-flex justify-content-between align-items-center">

                                <span class="fs-2 fw-bold text-white">
                                    Total Quote
                                </span>

                                <span class="fs-1 fw-bolder text-success" id="total_quote">
                                    MZN 0.00
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

<style>
    #location_results {
        position: absolute;
        width: 100%;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .12);
        z-index: 9999;
        margin-top: 6px;
        overflow: hidden;
    }

    .location-item {
        padding: 14px;
        cursor: pointer;
        border-bottom: 1px solid #F1F1F4;
        transition: .2s;
    }

    .location-item:hover {
        background: #F1FAFF;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        padding-bottom: 18px;
        border-bottom: 1px dashed rgba(255, 255, 255, .15);
        color: #fff;
    }

    .card {
        border-radius: 16px;
    }
</style>

@push('scripts')
    <script>
        const headOffice = {
            lat: -25.9692,
            lng: 32.5732
        };

        let destinationLat = null;
        let destinationLng = null;

        /*
        |--------------------------------------------------------------------------
        | DEFAULT FUEL PRICES
        |--------------------------------------------------------------------------
        */

        const fuelPrices = {
            diesel: 116.25,
            petrol: 93.69
        };

        /*
        |--------------------------------------------------------------------------
        | VEHICLE CONSUMPTION
        |--------------------------------------------------------------------------
        */

        const vehicleConsumption = {
            12: 12,
            14: 14,
            16: 16
        };

        /*
        |--------------------------------------------------------------------------
        | FUEL TYPE CHANGE
        |--------------------------------------------------------------------------
        */

        $('#fuel_type').on('change', function() {

            let fuel = $(this).val();

            $('#fuel_price').val(
                fuelPrices[fuel]
            );

            calculateQuote();

        });

        /*
        |--------------------------------------------------------------------------
        | VEHICLE CHANGE
        |--------------------------------------------------------------------------
        */

        $('#vehicle_model').on('change', function() {

            let consumption =
                vehicleConsumption[$(this).val()];

            $('#fuel_consumption').val(consumption);

            calculateQuote();

        });

        /*
        |--------------------------------------------------------------------------
        | PER DIEM AUTO RANGE
        |--------------------------------------------------------------------------
        */

        function updatePerDiemRange(distance) {

            if (distance <= 50) {

                $('#per_diem_range').val(0);
                $('#per_diem').val(0);

            } else if (distance <= 150) {

                $('#per_diem_range').val(500);
                $('#per_diem').val(500);

            } else {

                $('#per_diem_range').val(1000);
                $('#per_diem').val(1000);

            }

        }

        /*
        |--------------------------------------------------------------------------
        | GEO SEARCH
        |--------------------------------------------------------------------------
        */

        let typingTimer;

        $('#customer_location').on('keyup', function() {

            clearTimeout(typingTimer);

            let query = $(this).val();

            if (query.length < 3) {
                $('#location_results').html('');
                return;
            }

            typingTimer = setTimeout(function() {

                $.ajax({
                    url: 'https://api.geoapify.com/v1/geocode/autocomplete',
                    method: 'GET',
                    data: {
                        text: query,
                        filter: 'countrycode:mz',
                        limit: 5,
                        apiKey: 'cbd54ae057ff43ae834cc1f97304bb2d'
                    },
                    success: function(res) {

                        $('#location_results').html('');

                        res.features.forEach(function(item) {

                            $('#location_results').append(`
                        <div class="location-item"
                             data-lat="${item.geometry.coordinates[1]}"
                             data-lng="${item.geometry.coordinates[0]}"
                             data-name="${item.properties.formatted}">

                            <div class="fw-bold">
                                ${item.properties.address_line1 ?? ''}
                            </div>

                            <div class="text-muted fs-7">
                                ${item.properties.formatted}
                            </div>

                        </div>
                    `);

                        });

                    }
                });

            }, 400);

        });

        /*
        |--------------------------------------------------------------------------
        | SELECT LOCATION
        |--------------------------------------------------------------------------
        */

        $(document).on('click', '.location-item', function() {

            destinationLat = parseFloat($(this).data('lat'));
            destinationLng = parseFloat($(this).data('lng'));

            $('#customer_location').val(
                $(this).data('name')
            );

            $('#location_results').html('');

            calculateRoute();

        });

        /*
        |--------------------------------------------------------------------------
        | ROUTE
        |--------------------------------------------------------------------------
        */

        function calculateRoute() {

            $.ajax({

                url: "{{ route('distance.calculate') }}",

                method: "POST",

                data: {
                    origin_lat: headOffice.lat,
                    origin_lng: headOffice.lng,
                    destination_lat: destinationLat,
                    destination_lng: destinationLng,
                    _token: "{{ csrf_token() }}"
                },

                success: function(res) {

                    $('#distance').val(res.distance_km);
                    $('#duration').val(res.duration_hours);

                    updatePerDiemRange(
                        parseFloat(res.distance_km)
                    );

                    calculateQuote();

                }

            });

        }

        /*
        |--------------------------------------------------------------------------
        | LIVE RECALCULATION
        |--------------------------------------------------------------------------
        */

        $(document).on('keyup change', 'input,select', function() {
            calculateQuote();
        });

        /*
        |--------------------------------------------------------------------------
        | MAIN ENGINE
        |--------------------------------------------------------------------------
        */

        function calculateQuote() {

            let distance =
                parseFloat($('#distance').val()) || 0;

            let roundTrip =
                parseFloat($('#round_trip').val()) || 1;

            distance = distance * roundTrip;

            let fuelPrice =
                parseFloat($('#fuel_price').val()) || 0;

            let fuelConsumption =
                parseFloat($('#fuel_consumption').val()) || 0;

            let wear =
                parseFloat($('#wear_tear').val()) || 0;

            let staff =
                parseFloat($('#staff').val()) || 1;

            let hourly =
                parseFloat($('#hourly_rate').val()) || 0;

            let labourDuration =
                parseFloat($('#labour_duration').val()) || 0;

            let perDiem =
                parseFloat($('#per_diem').val()) || 0;

            let toll =
                parseFloat($('#toll').val()) || 0;

            let extra =
                parseFloat($('#extra_cost').val()) || 0;

            let profit =
                parseFloat($('#profit').val()) || 0;

            /*
            |--------------------------------------------------------------------------
            | COSTS
            |--------------------------------------------------------------------------
            */

            let fuelCost =
                ((distance / 100) * fuelConsumption) * fuelPrice;

            let wearCost =
                distance * wear;

            let labourCost =
                labourDuration * staff * hourly;

            let perDiemCost =
                staff * perDiem;

            let subtotal =
                fuelCost +
                wearCost +
                labourCost +
                perDiemCost +
                toll +
                extra;

            let total =
                subtotal + (subtotal * profit / 100);

            /*
            |--------------------------------------------------------------------------
            | UPDATE UI
            |--------------------------------------------------------------------------
            */

            $('#fuel_cost').text(
                'MZN ' + fuelCost.toFixed(2)
            );

            $('#wear_cost').text(
                'MZN ' + wearCost.toFixed(2)
            );

            $('#labour_cost').text(
                'MZN ' + labourCost.toFixed(2)
            );

            $('#perdiem_cost').text(
                'MZN ' + perDiemCost.toFixed(2)
            );

            $('#toll_cost').text(
                'MZN ' + toll.toFixed(2)
            );

            $('#extra_cost_summary').text(
                'MZN ' + extra.toFixed(2)
            );

            $('#profit_summary').text(
                profit + '%'
            );

            $('#total_quote').text(
                'MZN ' + total.toFixed(2)
            );

        }

        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        $('#fuel_type').trigger('change');
        $('#vehicle_model').trigger('change');
    </script>
@endpush
