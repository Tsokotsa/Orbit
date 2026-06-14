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

                    <div class="card-body">

                        <div class="accordion" id="quoteAccordion">

                            <!-- ROUTE & TRAVEL -->
                            <div class="accordion-item border-0 mb-5 shadow-sm rounded">

                                <h2 class="accordion-header">
                                    <button class="accordion-button fw-bold fs-5" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#travel_section">

                                        <i class="ki-duotone ki-geolocation text-primary fs-2 me-3"></i>

                                        Route & Travel
                                    </button>
                                </h2>

                                <div id="travel_section" class="accordion-collapse collapse show"
                                    data-bs-parent="#quoteAccordion">

                                    <div class="accordion-body">

                                        <div class="row g-5">

                                            <!-- Head Office -->
                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">
                                                    Head Office
                                                </label>

                                                <input type="text" class="form-control bg-light-primary"
                                                    value="Paratus HQ Marginal" readonly>
                                            </div>

                                            <!-- Customer -->
                                            <div class="col-md-6 position-relative">

                                                <label class="form-label fw-bold">
                                                    Customer Location
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        <i class="ki-duotone ki-geolocation fs-2 text-primary">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>

                                                    <input type="text" id="customer_location" class="form-control"
                                                        placeholder="Search city, district or customer location">

                                                </div>

                                                <div id="location_results"></div>

                                            </div>

                                            <div class="col-md-3">

                                                <label class="form-label fw-bold">
                                                    Distance
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        <i class="ki-duotone ki-car fs-2 text-primary">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>

                                                    <input type="text" id="distance" class="form-control fw-bold"
                                                        readonly>

                                                    <span class="input-group-text fw-bold">
                                                        KM
                                                    </span>

                                                </div>

                                            </div>

                                            <div class="col-md-3">

                                                <label class="form-label fw-bold">
                                                    Travel Duration
                                                </label>

                                                <div class="input-group input-group-solid">

                                                    <span class="input-group-text">
                                                        <i class="ki-duotone ki-time fs-2 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </span>

                                                    <input type="text" id="duration" class="form-control fw-bold"
                                                        readonly>

                                                    <span class="input-group-text fw-bold">
                                                        Hours
                                                    </span>

                                                </div>

                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">
                                                    Round Trip
                                                </label>

                                                <select id="round_trip" class="form-select" data-control="select2">
                                                    <option value="1">One Way</option>
                                                    <option value="2" selected>Round Trip</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">
                                                    Fuel Type
                                                </label>

                                                <select id="fuel_type" class="form-select" data-control="select2">

                                                    <option value="diesel">
                                                        Diesel
                                                    </option>

                                                    <option value="petrol">
                                                        Petrol
                                                    </option>

                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">
                                                    Vehicle
                                                </label>

                                                <select id="vehicle_model" class="form-select" data-control="select2">

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

                                            <div class="col-md-4">
                                                <label class="form-label fw-bold">
                                                    Fuel Price
                                                </label>

                                                <input type="number" id="fuel_price" class="form-control bg-light-primary"
                                                    readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">
                                                    Fuel Consumption (L/100KM)
                                                </label>

                                                <input type="number" id="fuel_consumption"
                                                    class="form-control bg-light-primary" readonly>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-bold">
                                                    Wear & Tear / KM
                                                </label>

                                                <input type="number" id="wear_tear"
                                                    class="form-control bg-light-primary" value="9" readonly>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- LABOUR -->
                            <div class="accordion-item border-0 mb-5 shadow-sm rounded">

                                <h2 class="accordion-header">

                                    <button class="accordion-button collapsed fw-bold fs-5" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#labour_section">

                                        <i class="ki-duotone ki-profile-user text-success fs-2 me-3"></i>

                                        Labour & Accommodation

                                    </button>

                                </h2>

                                <div id="labour_section" class="accordion-collapse collapse"
                                    data-bs-parent="#quoteAccordion">

                                    <div class="accordion-body">

                                        <div class="row g-5">

                                            <div class="col-md-4">

                                                <label class="form-label fw-bold">
                                                    Labour Duration
                                                </label>

                                                <select id="labour_duration" class="form-select" data-control="select2">

                                                    <option value="1">1 Hour</option>
                                                    <option value="2">2 Hours</option>
                                                    <option value="4">4 Hours</option>
                                                    <option value="8">Full Day</option>

                                                </select>

                                            </div>

                                            <div class="col-md-4">

                                                <label class="form-label fw-bold">
                                                    Staff
                                                </label>

                                                <select id="staff" class="form-select" data-control="select2">

                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>

                                                </select>

                                            </div>

                                            <div class="col-md-4">

                                                <label class="form-label fw-bold">
                                                    Hourly Rate
                                                </label>

                                                <input type="number" id="hourly_rate"
                                                    class="form-control form-control-solid" readonly value="800.00">

                                            </div>

                                            <div class="col-md-5">

                                                <label class="form-label fw-bold">
                                                    Per Diem
                                                </label>

                                                <input type="number" id="per_diem"
                                                    class="form-control form-control-solid" value="750.00" readonly>

                                            </div>

                                            {{-- <div class="col-md-5">

                                                <label class="form-label fw-bold">
                                                    Accommodation Per Staff
                                                </label>

                                                <input type="number" id="accommodation"
                                                    class="form-control bg-light-primary fw-bold" value="0.00" readonly>

                                            </div> --}}

                                            <div class="col-md-4">

                                                <label class="form-label fw-bold">
                                                    Include Accommodation
                                                </label>

                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input h-40px w-60px" type="checkbox"
                                                        value="1" id="accomodation" />
                                                    <label class="form-check-label" for="flexSwitchDefault">
                                                        Yes
                                                    </label>
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <!-- COMMERCIAL -->
                            <div class="accordion-item border-0 shadow-sm rounded">

                                <h2 class="accordion-header">

                                    <button class="accordion-button collapsed fw-bold fs-5" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#commercial_section">

                                        <i class="ki-duotone ki-dollar text-warning fs-2 me-3"></i>

                                        Commercial Terms

                                    </button>

                                </h2>

                                <div id="commercial_section" class="accordion-collapse collapse"
                                    data-bs-parent="#quoteAccordion">

                                    <div class="accordion-body">

                                        <div class="row g-5">

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Toll Gates
                                                </label>

                                                <input type="number" id="toll" class="form-control"
                                                    value="0">

                                            </div>

                                            <div class="col-md-6">

                                                <label class="form-label fw-bold">
                                                    Additional Costs
                                                </label>

                                                <input type="number" id="extra_cost" class="form-control"
                                                    value="0">

                                            </div>

                                            <div class="col-md-12">

                                                <label class="form-label fw-bold">
                                                    Profit Margin
                                                </label>

                                                <select id="profit" class="form-select" data-control="select2">

                                                    <option value="20">20%</option>
                                                    <option value="25">25%</option>
                                                    <option value="35">35%</option>
                                                    <option value="40">40%</option>

                                                </select>

                                            </div>

                                            <div class="col-md-12">

                                                <label class="form-label fw-bold">
                                                    Notes
                                                </label>

                                                <textarea id="notes" class="form-control" rows="4"></textarea>

                                            </div>

                                            <div class="col-md-12">

                                                <button class="btn btn-primary btn-lg w-100">

                                                    <i class="ki-duotone ki-file-down fs-2 me-2"></i>

                                                    Generate Professional Quote

                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                {{-- SUMMARY --}}
                <div class="col-xl-4">

                    <div class="card border-0 shadow-lg position-sticky overflow-hidden"
                        style="top:120px;border-radius:20px;">

                        <!-- HEADER -->
                        <div class="card-header border-0 py-5"
                            style="background:linear-gradient(135deg,#0F172A,#1E293B);">

                            <div class="d-flex align-items-center w-100">

                                <div class="symbol symbol-50px me-4">
                                    <div class="symbol-label bg-primary">
                                        <i class="ki-duotone ki-chart-line-up fs-2 text-white">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                </div>

                                <div>
                                    <h3 class="text-white fw-bold mb-1">
                                        Quote Summary
                                    </h3>

                                    <div class="text-gray-400 fs-7">
                                        Real-time cost estimation
                                    </div>
                                </div>

                            </div>

                        </div>

                        <div class="card-body p-6 bg-light">

                            <!-- CALLOUT TYPE -->
                            <div class="mb-5 text-center">

                                <span id="callout_type" class="badge badge-light-primary fs-7 px-5 py-3 fw-bold">
                                    Local Callout
                                </span>

                            </div>

                            <!-- BREAKDOWN -->
                            <div class="mb-6">

                                <div class="fw-bold text-gray-700 text-uppercase fs-8 mb-4">
                                    Cost Breakdown <small class="fs-9 text-success">(MZM)</small>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-gas-pump text-primary fs-4 me-2"></i>
                                        Fuel Cost
                                    </div>
                                    <strong id="fuel_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-sad-tear text-dark fs-4 me-2"></i>
                                        Wear & Tear
                                    </div>
                                    <strong id="wear_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-hands-helping text-dark fs-4 me-2"></i>
                                        Labour
                                    </div>
                                    <strong id="labour_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-wallet text-success fs-4 me-2"></i>
                                        Per Diem
                                    </div>
                                    <strong id="perdiem_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="ki-duotone ki-home text-danger fs-4 me-2"></i>
                                        Accommodation
                                    </div>
                                    <strong id="accommodation_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-road fs-4 me-2 text-dark"></i>
                                        Toll Fees
                                    </div>
                                    <strong id="toll_cost"> 0.00</strong>
                                </div>

                                <div class="summary-row">
                                    <div>
                                        <i class="las la-plus-circle fs-4 me-2 text-dark"></i>
                                        Additional Costs
                                    </div>
                                    <strong id="extra_cost_summary"> 0.00</strong>
                                </div>

                                <div class="summary-row border-0">
                                    <div>
                                        <i class="ki-duotone ki-chart-simple fs-4 me-2 text-primary"></i>
                                        Profit Margin
                                    </div>
                                    <strong id="profit_summary">20%</strong>
                                </div>

                            </div>

                            <!-- TOTAL -->
                            <div class="bg-dark rounded-4 p-5 text-center">

                                <div class="text-gray-400 fw-semibold mb-2">
                                    TOTAL QUOTE VALUE
                                </div>

                                <div id="total_quote" class="fs-1 fw-bolder text-success">
                                    MZM 0.00
                                </div>

                                <div class="text-gray-500 fs-8 mt-2">
                                    Including operational costs and margin
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection

<style>
    .summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0;
        border-bottom: 1px solid #E4E6EF;
        font-size: 14px;
        color: #5E6278;
    }

    .summary-row strong {
        color: #181C32;
        font-weight: 700;
        font-size: 14px;
    }

    .summary-row:hover {
        background: rgba(0, 0, 0, .02);
        transition: all .2s ease;
        padding-left: 8px;
        padding-right: 8px;
        border-radius: 8px;
    }

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

    .accordion-button {
        background: #fff !important;
        border-radius: 12px !important;
        box-shadow: none !important;
    }

    .accordion-button:not(.collapsed) {
        background: #F8F9FA !important;
    }

    .select2-container .select2-selection--single {
        height: 44px !important;
        border: 1px solid #E4E6EF !important;
    }

    .select2-selection__rendered {
        line-height: 42px !important;
    }

    .select2-selection__arrow {
        height: 42px !important;
    }
</style>

@push('scripts')
    <script>
        const headOffice = {
            lat: -25.925235395855076,
            lng: 32.63714653366664
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

        <div class="location-title">

            <i class="ki-duotone ki-geolocation text-primary fs-4">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>

            ${item.properties.address_line1 ?? 'Location'}

        </div>

        <div class="location-subtitle">
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

            let isRemoteCallout = distance > 80;

            let isAccomodate = distance > 400;


            // if (isRemoteCallout) {

            //     $('#callout_type')
            //         .removeClass('alert-info')
            //         .addClass('alert-warning')
            //         .html(
            //             '<i class="ki-duotone ki-map fs-3 me-2"></i> Remote Callout (>80 KM)'
            //         );

            // } else {

            //     $('#callout_type')
            //         .removeClass('alert-warning')
            //         .addClass('alert-info')
            //         .html(
            //             '<i class="ki-duotone ki-geolocation fs-3 me-2"></i> Local Callout (≤80 KM)'
            //         );
            // }

            $('#callout_type')
                .removeClass('badge-light-primary badge-light-warning')
                .addClass(isRemoteCallout ? 'badge-light-warning' : 'badge-light-primary')
                .text(isRemoteCallout ? 'Remote Callout ' : 'Local Callout ');

            // distance = distance * roundTrip;
            let fuelPrice =
                parseFloat($('#fuel_price').val()) || 0;

            let accommodationPerStaff = 0;

            if (isRemoteCallout) {
                accommodationPerStaff = 3500.00;
            }

            $('#accommodation').val(accommodationPerStaff);

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


            let toll =
                parseFloat($('#toll').val()) || 0;

            let extra =
                parseFloat($('#extra_cost').val()) || 0;

            let profit =
                parseFloat($('#profit').val()) || 0;

            let perDiem =
                parseFloat($('#per_diem').val()) || 0;

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

            let perDiemCost = 0;

            let accommodationCost = 0;

            if (isRemoteCallout) {

                perDiemCost =
                    staff * perDiem;

                accommodationCost = 0;
                // accommodationCost =
                //     staff * accommodationPerStaff;
            }

            if (isAccomodate) {

                accommodationCost =
                    staff * accommodationPerStaff;
            }

            let subtotal =
                fuelCost +
                wearCost +
                labourCost +
                perDiemCost +
                accommodationCost +
                toll +
                extra;

            let total =
                subtotal + (subtotal * profit / 100);

            // console.log({
            //     distance,
            //     staff,
            //     perDiemCost,
            //     accommodationCost,
            //     isRemoteCallout
            // });
            /*
            |--------------------------------------------------------------------------
            | UPDATE UI
            |--------------------------------------------------------------------------
            */

            $('#fuel_cost').text(
                fuelCost.toFixed(2)
            );

            $('#wear_cost').text(
                wearCost.toFixed(2)
            );

            $('#labour_cost').text(
                labourCost.toFixed(2)
            );

            $('#perdiem_cost').text(
                perDiemCost.toFixed(2)
            );

            $('#accommodation_cost').text(
                accommodationCost.toFixed(2)
            );

            $('#toll_cost').text(
                toll.toFixed(2)
            );

            $('#extra_cost_summary').text(
                extra.toFixed(2)
            );

            $('#profit_summary').text(
                profit + '%'
            );

            $('#total_quote').text(
                'MZM ' + total.toFixed(2)
            );

        }

        /*
        |--------------------------------------------------------------------------
        | INITIALIZE
        |--------------------------------------------------------------------------
        */

        $('#fuel_type').trigger('change');
        $('#vehicle_model').trigger('change');

        $(document).ready(function() {

            $('[data-control="select2"]').select2();

        });
    </script>
@endpush
