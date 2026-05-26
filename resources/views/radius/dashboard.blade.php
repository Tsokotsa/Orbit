@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8 mb-8">

                <!--begin::Total Subscribers-->
                <div class="col-sm-6 col-xl-3">

                    <div class="card card-bordered border-gray-200 h-xl-100 shadow-sm">

                        <!--begin::Header-->
                        <div class="card-header border-0 pt-6 position-relative">

                            <!--begin::Title-->
                            <div class="d-flex align-items-center">

                                <div class="symbol symbol-45px me-4">

                                    <span class="symbol-label bg-light-primary">

                                        <i class="ki-outline ki-profile-circle fs-2 text-primary"></i>

                                    </span>

                                </div>

                                <div class="d-flex flex-column">

                                    <span class="text-gray-800 fw-semibold fs-5">
                                        Subscribers
                                    </span>

                                    <span class="text-muted fw-medium fs-8">
                                        Total registered users
                                    </span>

                                </div>

                            </div>
                            <!--end::Title-->

                        </div>
                        <!--end::Header-->



                        <!--begin::Body-->
                        <div class="card-body pt-2 d-flex flex-column justify-content-end">

                            <div class="d-flex align-items-end mb-3">

                                <span class="fs-1 fw-semibold text-gray-900 lh-1">
                                    2,481
                                </span>

                            </div>



                            <div class="separator separator-dashed mb-4"></div>



                            <div class="d-flex align-items-center justify-content-between">

                                <span class="text-muted fs-8 fw-medium">
                                    Active Radius database entries
                                </span>

                            </div>

                        </div>
                        <!--end::Body-->

                    </div>

                </div>
                <!--end::Total Subscribers-->

                <!--begin::Online Users-->
                <div class="col-sm-6 col-xl-3">

                    <div class="card card-bordered border-gray-200 h-xl-100 shadow-sm">

                        <div class="card-header border-0 pt-6 position-relative">




                            <div class="d-flex align-items-center">

                                <div class="symbol symbol-45px me-4">

                                    <span class="symbol-label bg-light-success">

                                        <i class="ki-outline ki-wifi-square fs-2 text-success"></i>

                                    </span>

                                </div>



                                <div class="d-flex flex-column">

                                    <span class="text-gray-800 fw-semibold fs-5">
                                        Online Users
                                    </span>

                                    <span class="text-muted fw-medium fs-8">
                                        Active PPPoE sessions
                                    </span>

                                </div>

                            </div>

                        </div>



                        <div class="card-body pt-2 d-flex flex-column justify-content-end">

                            <div class="d-flex align-items-end mb-3">

                                <span class="fs-1 fw-semibold text-gray-900 lh-1">
                                    1,932
                                </span>

                            </div>



                            <div class="separator separator-dashed mb-4"></div>



                            <div class="d-flex align-items-center justify-content-between">

                                <span class="text-muted fs-8 fw-medium">
                                    Connected subscribers
                                </span>

                            </div>

                        </div>

                    </div>

                </div>
                <!--end::Online Users-->



                <!--begin::Offline Users-->
                <div class="col-sm-6 col-xl-3">

                    <div class="card card-bordered border-gray-200 h-xl-100 shadow-sm">

                        <div class="card-header border-0 pt-6 position-relative">



                            <div class="d-flex align-items-center">

                                <div class="symbol symbol-45px me-4">

                                    <span class="symbol-label bg-light-danger">

                                        <i class="ki-outline ki-wifi-square fs-2 text-danger"></i>

                                    </span>

                                </div>



                                <div class="d-flex flex-column">

                                    <span class="text-gray-800 fw-semibold fs-5">
                                        Offline Users
                                    </span>

                                    <span class="text-muted fw-medium fs-8">
                                        Inactive subscribers
                                    </span>

                                </div>

                            </div>

                        </div>



                        <div class="card-body pt-2 d-flex flex-column justify-content-end">

                            <div class="d-flex align-items-end mb-3">

                                <span class="fs-1 fw-semibold text-gray-900 lh-1">
                                    549
                                </span>

                            </div>



                            <div class="separator separator-dashed mb-4"></div>



                            <div class="d-flex align-items-center justify-content-between">

                                <span class="text-muted fs-8 fw-medium">
                                    Currently disconnected
                                </span>

                            </div>

                        </div>

                    </div>

                </div>
                <!--end::Offline Users-->



                <!--begin::Suspended Users-->
                <div class="col-sm-6 col-xl-3">

                    <div class="card card-bordered border-gray-200 h-xl-100 shadow-sm">

                        <div class="card-header border-0 pt-6 position-relative">

                            <div class="d-flex align-items-center">

                                <div class="symbol symbol-45px me-4">

                                    <span class="symbol-label bg-light-warning">

                                        <i class="ki-outline ki-shield-cross fs-2 text-warning"></i>

                                    </span>

                                </div>



                                <div class="d-flex flex-column">

                                    <span class="text-gray-800 fw-semibold fs-5">
                                        Suspended Users
                                    </span>

                                    <span class="text-muted fw-medium fs-8">
                                        Authentication rejected
                                    </span>

                                </div>

                            </div>

                        </div>



                        <div class="card-body pt-2 d-flex flex-column justify-content-end">

                            <div class="d-flex align-items-end mb-3">

                                <span class="fs-1 fw-semibold text-gray-900 lh-1">
                                    27
                                </span>

                            </div>



                            <div class="separator separator-dashed mb-4"></div>



                            <div class="d-flex align-items-center justify-content-between">

                                <span class="text-muted fs-8 fw-medium">
                                    Disabled accounts
                                </span>

                            </div>

                        </div>

                    </div>

                </div>
                <!--end::Suspended Users-->

            </div>
            <!--end::Row-->


            <!-- Begin card with users -->
            <div class="container-fluid mt-3">

                <!-- Begin Management Area -->
                <div class="row g-5 g-xl-8">

                    <!-- LEFT MENU -->
                    <div class="col-xl-3">

                        <div class="card card-bordered border-gray-200 shadow-sm h-100">

                            <div class="card-header border-0 pt-5">

                                <h3 class="card-title fw-bold text-gray-900">
                                    Radius Management
                                </h3>

                            </div>

                            <div class="card-body pt-2">

                                <!--begin::Menu-->
                                <div class="menu menu-column menu-rounded menu-state-bg fw-semibold">

                                    <!-- USERS -->
                                    <div class="menu-item mb-2">

                                        <a href="/radius" class="menu-link">

                                            <span class="menu-icon">
                                                <i class="ki-outline ki-setting-4 fs-2"></i>
                                            </span>

                                            <span class="menu-title">
                                                Dashboard
                                            </span>

                                        </a>

                                    </div>

                                    <!-- USERS -->
                                    <div class="menu-item mb-2">

                                        <a href="javascript:void(0)" class="menu-link radius-menu-link"
                                            data-url="{{ route('radius.users-list') }}">

                                            <span class="menu-icon">
                                                <i class="ki-outline ki-user fs-2"></i>
                                            </span>

                                            <span class="menu-title">
                                                List Users
                                            </span>

                                        </a>

                                    </div>

                                    <!-- PROFILES -->
                                    <div class="menu-item mb-2">

                                        <a href="javascript:void(0)" class="menu-link radius-menu-link"
                                            data-url="{{ route('radius.profiles-list') }}">

                                            <span class="menu-icon">
                                                <i class="ki-outline ki-setting-2 fs-2"></i>
                                            </span>

                                            <span class="menu-title">
                                                Profiles
                                            </span>

                                        </a>

                                    </div>

                                    <!-- NAS -->
                                    <div class="menu-item mb-2">

                                        <a href="javascript:void(0)" class="menu-link radius-menu-link"
                                            data-url="{{ route('nas.view') }}">

                                            <span class="menu-icon">
                                                <i class="ki-outline ki-router fs-2"></i>
                                            </span>

                                            <span class="menu-title">
                                                NAS Devices
                                            </span>

                                        </a>

                                    </div>

                                    <!-- LOGS -->
                                    <div class="menu-item">

                                        <a href="/radius/logs" class="menu-link">

                                            <span class="menu-icon">
                                                <i class="ki-outline ki-chart-simple fs-2"></i>
                                            </span>

                                            <span class="menu-title">
                                                Logs
                                            </span>

                                            <span class="badge badge-warning ms-auto">
                                                Coming Soon
                                            </span>

                                        </a>

                                    </div>

                                </div>
                                <!--end::Menu-->

                            </div>

                        </div>

                    </div>
                    <!-- END LEFT MENU -->


                    <!-- RIGHT CONTENT -->
                    <div class="col-xl-9">

                        <div class="card card-bordered border-gray-200 shadow-sm" id="radius-content-area">

                            <!--begin::Header-->
                            <div class="card-header border-0 pt-6">

                                <div>

                                    <h3 class="fw-bold text-gray-900">
                                        Radius Dashboard
                                    </h3>

                                    <span class="text-muted fs-7">
                                        In orbit or in earth we manage Authentication
                                    </span>

                                </div>

                            </div>
                            <!--end::Header-->

                            <!--begin::Body-->
                            <div class="card-body pt-2">

                                <!-- QUICK ACTIONS -->
                                <div class="row g-5 mb-8">

                                    <!-- ADD USER -->
                                    <div class="col-md-4">

                                        <a href="#"
                                            class="card card-bordered border-gray-200 shadow-sm hover-elevate-up"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">

                                            <div class="card-body d-flex align-items-center p-5">

                                                <div class="symbol symbol-45px me-4">

                                                    <span class="symbol-label bg-light-primary">

                                                        <i class="ki-outline ki-user fs-2 text-primary"></i>

                                                    </span>

                                                </div>

                                                <div>

                                                    <div class="fw-bold text-gray-900 fs-6">
                                                        Add User
                                                    </div>

                                                    <div class="text-muted fs-8">
                                                        Create subscriber
                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                    </div>

                                    <!-- ADD PROFILE -->
                                    <div class="col-md-4">

                                        <a href="#"
                                            class="card card-bordered border-gray-200 shadow-sm hover-elevate-up"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_profile">

                                            <div class="card-body d-flex align-items-center p-5">

                                                <div class="symbol symbol-45px me-4">

                                                    <span class="symbol-label bg-light-success">

                                                        <i class="ki-outline ki-setting-2 fs-2 text-success"></i>

                                                    </span>

                                                </div>

                                                <div>

                                                    <div class="fw-bold text-gray-900 fs-6">
                                                        Add Profile
                                                    </div>

                                                    <div class="text-muted fs-8">
                                                        Service package
                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                    </div>

                                    <!-- ADD NAS -->
                                    <div class="col-md-4">

                                        <a href="#"
                                            class="card card-bordered border-gray-200 shadow-sm hover-elevate-up"
                                            data-bs-toggle="modal" data-bs-target="#kt_modal_add_nas">

                                            <div class="card-body d-flex align-items-center p-5">

                                                <div class="symbol symbol-45px me-4">

                                                    <span class="symbol-label bg-light-warning">

                                                        <i class="ki-outline ki-router fs-2 text-warning"></i>

                                                    </span>

                                                </div>

                                                <div>

                                                    <div class="fw-bold text-gray-900 fs-6">
                                                        Add NAS
                                                    </div>

                                                    <div class="text-muted fs-8">
                                                        Register device
                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                    </div>

                                </div>

                                <!-- AJAX CONTENT -->
                                <div>

                                    <div class="border border-dashed border-gray-300 rounded p-10 text-center">

                                        <i class="ki-outline ki-abstract-26 fs-3tx text-muted mb-5"></i>

                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Select an option from the left menu
                                        </div>

                                    </div>

                                </div>

                            </div>
                            <!--end::Body-->

                        </div>

                    </div>
                    <!-- END RIGHT CONTENT -->

                </div>
                <!-- End Management Area -->

            </div>
            <!-- End Card Users -->
        </div>
    </div>
    <!-- begin of Includes -->
    @include('radius.modals.add-profile')
    @include('radius.modals.add-user')
    @include('radius.modals.edit-user')
    @include('radius.modals.add-nas')
    @include('radius.modals.edit-nas')
    @include('radius.modals.edit-profile')

    <!-- End Includes -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            /*
            |--------------------------------------------------------------------------
            | LOAD AJAX CONTENT
            |--------------------------------------------------------------------------
            */
            $('.radius-menu-link').on('click', function(e) {

                e.preventDefault();

                $('.radius-menu-link').removeClass('active');

                $(this).addClass('active');

                let url = $(this).data('url');

                $('#radius-content-area').html(`
                <div class="d-flex justify-content-center py-15">
                    <div class="spinner-border text-primary"></div>
                </div>
            `);

                $.ajax({

                    url: url,
                    type: 'GET',

                    success: function(response) {

                        $('#radius-content-area').html(response);

                        /*
                        |--------------------------------------------------------------------------
                        | AUTO INIT ALL TABLES
                        |--------------------------------------------------------------------------
                        */
                        initAjaxTables();

                    },

                    error: function() {

                        $('#radius-content-area').html(`
                        <div class="alert alert-danger">
                            Failed to load content.
                        </div>
                    `);

                    }

                });

            });

            /*
            |--------------------------------------------------------------------------
            | GLOBAL TABLE INITIALIZER
            |--------------------------------------------------------------------------
            */
            function initAjaxTables() {

                $('#radius-content-area table').each(function() {

                    let table = $(this);

                    /*
                    |--------------------------------------------------------------------------
                    | SKIP IF ALREADY INITIALIZED
                    |--------------------------------------------------------------------------
                    */
                    if ($.fn.DataTable.isDataTable(table)) {

                        table.DataTable().destroy();

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | WRAP TABLE
                    |--------------------------------------------------------------------------
                    */
                    if (!table.parent().hasClass('table-responsive')) {

                        table.wrap('<div class="table-responsive"></div>');

                    }

                    /*
                    |--------------------------------------------------------------------------
                    | INIT DATATABLE
                    |--------------------------------------------------------------------------
                    */
                    let dt = table.DataTable({

                        pageLength: 5,

                        lengthChange: false,

                        searching: true,

                        ordering: true,

                        info: true,

                        //  responsive: true,

                        autoWidth: false,

                        language: {

                            search: "",

                            searchPlaceholder: "Search..."

                        },

                        dom: "<'row mb-5'" +
                            "<'col-md-6 d-flex align-items-center'f>" +
                            "<'col-md-6 d-flex justify-content-end'l>" +
                            ">" +

                            "<'table-responsive'tr>" +

                            "<'row mt-5'" +
                            "<'col-md-5'i>" +
                            "<'col-md-7 d-flex justify-content-end'p>" +
                            ">"

                    });

                    /*
                    |--------------------------------------------------------------------------
                    | STYLE SEARCH INPUT
                    |--------------------------------------------------------------------------
                    */
                    table.closest('.dataTables_wrapper')
                        .find('input[type="search"]')
                        .addClass('form-control form-control-solid w-250px')
                        .removeClass('form-control-sm');

                });

            }

        });
    </script>
@endpush
@push('scripts')
    <script>
        // $(document).on('click', '.edit-user-btn', function() {

        //     let username = $(this).data('username');
        //     let profile = $(this).data('profile');
        //     let framedip = $(this).data('framedip');
        //     let suspended = $(this).data('suspended');

        //     // fill modal fields
        //     $('#edit_username').val(username);
        //     $('#edit_username_display').val(username);

        //     $('#edit_profile').val(profile).trigger('change');
        //     $('#edit_framed_ip').val(framedip);

        //     // store state
        //     $('#is_suspended').val(suspended);

        //     // toggle button UI
        //     updateSuspendButton(suspended);

        //     // open modal
        //     const modal = new bootstrap.Modal(
        //         document.getElementById('kt_modal_edit_user')
        //     );

        //     modal.show();
        // });

        $(document).on('click', '.delete-user-btn', function() {

            let username = $(this).data('username');

            Swal.fire({
                title: 'Delete User?',
                text: 'This will permanently remove the User and all accounting data',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#d33'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({

                    url: `/radius/user/${username}`,

                    type: 'DELETE',

                    success: function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'User deleted successfully'
                        }).then(() => {

                            location.reload();

                        });

                    },

                    error: function(xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message ??
                                'Unable to delete user'
                        });

                    }

                });

            });

        });


        $(document).on('click', '.edit-user-btn', function() {

            let username = $(this).data('username');

            /*
            |--------------------------------------------------------------------------
            | LOADING STATE
            |--------------------------------------------------------------------------
            */

            Swal.fire({
                text: 'Loading user details...',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            /*
            |--------------------------------------------------------------------------
            | FETCH USER
            |--------------------------------------------------------------------------
            */

            $.ajax({

                url: "{{ url('/radius/user') }}/" + encodeURIComponent(username),

                type: 'GET',

                success: function(response) {

                    Swal.close();

                    if (!response.success) {

                        toastr.error('Failed to load user');

                        return;
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | RESET STATE
                    |--------------------------------------------------------------------------
                    */

                    $('#rate_limit_source_wrapper')
                        .addClass('d-none');

                    $('#bandwidth_override_wrapper')
                        .addClass('d-none');

                    $('#enable_bandwidth_override')
                        .prop('checked', false);

                    $('#rate_limit_source_wrapper .rounded-3')
                        .removeClass(
                            'bg-light-success border-success bg-light-warning border-warning'
                        )
                        .addClass('bg-light-info border-info');

                    $('#user_edit_download')
                        .prop('readonly', false)
                        .val('');

                    $('#user_edit_upload')
                        .prop('readonly', false)
                        .val('');

                    /*
                    |--------------------------------------------------------------------------
                    | FILL MODAL
                    |--------------------------------------------------------------------------
                    */

                    $('#edit_username')
                        .val(response.username);

                    $('#edit_username_display')
                        .val(response.username);

                    $('#edit_framed_ip')
                        .val(response.framed_ip ?? '');

                    /*
                    |--------------------------------------------------------------------------
                    | PROFILE SELECT
                    |--------------------------------------------------------------------------
                    */

                    $('#edit_profile')
                        .val(response.profile)
                        .trigger('change');

                    /*
                    |--------------------------------------------------------------------------
                    | RATE LIMIT
                    |--------------------------------------------------------------------------
                    */

                    if (response.rate_limit) {

                        let rates = response.rate_limit.split('/');

                        $('#user_edit_download')
                            .val(rates[0] ?? '');

                        $('#user_edit_upload')
                            .val(rates[1] ?? '');

                        $('#rate_limit_source_wrapper')
                            .removeClass('d-none');

                        $('#bandwidth_override_wrapper')
                            .removeClass('d-none');

                        /*
                        |--------------------------------------------------------------------------
                        | PROFILE CONTROLLED
                        |--------------------------------------------------------------------------
                        */

                        if (response.rate_limit_source === 'profile') {

                            $('#enable_bandwidth_override')
                                .prop('checked', false);

                            $('#rate_limit_source_wrapper .rounded-3')
                                .removeClass(
                                    'bg-light-success border-success bg-light-warning border-warning'
                                )
                                .addClass('bg-light-info border-info');

                            $('#rate_limit_source_title')
                                .text('Profile Controlled Bandwidth');

                            $('#rate_limit_source_description')
                                .text(
                                    'Subscriber inherits bandwidth limits from assigned profile.'
                                );

                            $('#user_edit_download')
                                .prop('readonly', true);

                            $('#user_edit_upload')
                                .prop('readonly', true);
                        }

                        /*
                        |--------------------------------------------------------------------------
                        | USER OVERRIDE
                        |--------------------------------------------------------------------------
                        */
                        else {

                            $('#enable_bandwidth_override')
                                .prop('checked', true);

                            $('#rate_limit_source_wrapper .rounded-3')
                                .removeClass(
                                    'bg-light-info border-info bg-light-warning border-warning'
                                )
                                .addClass('bg-light-success border-success');

                            $('#rate_limit_source_title')
                                .text('User Bandwidth Override');

                            $('#rate_limit_source_description')
                                .text(
                                    'Subscriber has custom bandwidth limits overriding profile values.'
                                );

                            $('#user_edit_download')
                                .prop('readonly', false);

                            $('#user_edit_upload')
                                .prop('readonly', false);
                        }
                    }

                    /*
                    |--------------------------------------------------------------------------
                    | SUSPEND STATE
                    |--------------------------------------------------------------------------
                    */

                    $('#is_suspended')
                        .val(response.suspended ? 1 : 0);

                    updateSuspendButton(response.suspended);

                    /*
                    |--------------------------------------------------------------------------
                    | OPEN MODAL
                    |--------------------------------------------------------------------------
                    */

                    const modal = new bootstrap.Modal(
                        document.getElementById('kt_modal_edit_user')
                    );

                    modal.show();
                },

                error: function(xhr) {

                    Swal.close();

                    toastr.error(
                        xhr.responseJSON?.message ||
                        'Failed to fetch user details'
                    );
                }

            });

        });

        /*
        |--------------------------------------------------------------------------
        | BANDWIDTH OVERRIDE TOGGLE
        |--------------------------------------------------------------------------
        */

        $(document).on('change', '#enable_bandwidth_override', function() {

            let enabled = $(this).is(':checked');

            $('#user_edit_download')
                .prop('readonly', !enabled);

            $('#user_edit_upload')
                .prop('readonly', !enabled);

            /*
            |--------------------------------------------------------------------------
            | PROFILE MODE
            |--------------------------------------------------------------------------
            */

            if (!enabled) {

                $('#rate_limit_source_wrapper .rounded-3')
                    .removeClass(
                        'bg-light-success border-success bg-light-warning border-warning'
                    )
                    .addClass('bg-light-info border-info');

                $('#rate_limit_source_title')
                    .text('Profile Controlled Bandwidth');

                $('#rate_limit_source_description')
                    .text(
                        'Subscriber inherits bandwidth limits from assigned profile.'
                    );
            }

            /*
            |--------------------------------------------------------------------------
            | OVERRIDE MODE
            |--------------------------------------------------------------------------
            */
            else {

                $('#rate_limit_source_wrapper .rounded-3')
                    .removeClass(
                        'bg-light-info border-info bg-light-success border-success'
                    )
                    .addClass('bg-light-warning border-warning');

                $('#rate_limit_source_title')
                    .text('Override Mode Enabled');

                $('#rate_limit_source_description')
                    .text(
                        'Custom subscriber bandwidth will override profile limits.'
                    );
            }
        });
        /*
        |--------------------------------------------------------------------------
        | SAVE CHANGES
        |--------------------------------------------------------------------------
        */

        $('#save_user_changes').on('click', function() {

            Swal.fire({
                title: 'Save Changes?',
                text: 'Radius subscriber will be updated',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Save Changes'
            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                $.ajax({

                    url: "{{ route('radius.users.update') }}",

                    type: "POST",

                    data: $('#kt_edit_user_form').serialize(),

                    success: function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'Subscriber Updated'
                        });

                        $('#kt_modal_edit_user').modal('hide');

                    },

                    error: function() {

                        Swal.fire({
                            icon: 'error',
                            title: 'Update Failed'
                        });

                    }

                });

            });

        });


        /*
        |--------------------------------------------------------------------------
        | DISCONNECT USER
        |--------------------------------------------------------------------------
        */

        $('#disconnect_user_btn').on('click', function() {

            Swal.fire({
                title: 'Disconnect User?',
                text: 'Active PPPoE session will be terminated',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Disconnect'
            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                $.post(
                    "{{ route('radius.users.disconnect') }}", {
                        _token: "{{ csrf_token() }}",
                        username: $('#edit_username').val()
                    },
                    function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'User Disconnected'
                        });

                    }
                );

            });

        });


        /*
        |--------------------------------------------------------------------------
        | SUSPEND USER
        |--------------------------------------------------------------------------
        */

        // $('#suspend_user_btn').on('click', function() {

        //     Swal.fire({
        //         title: 'Suspend User?',
        //         text: 'Subscriber authentication will be blocked',
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Suspend User'
        //     }).then((result) => {

        //         if (!result.isConfirmed) {
        //             return;
        //         }

        //         $.post(
        //             "{{ route('radius.users.suspend') }}", {
        //                 _token: "{{ csrf_token() }}",
        //                 username: $('#edit_username').val()
        //             },
        //             function() {

        //                 Swal.fire({
        //                     icon: 'success',
        //                     title: 'Subscriber Suspended'
        //                 });

        //             }
        //         );

        //     });

        // });

        $('#suspend_user_btn').on('click', function() {

            let username = $('#edit_username').val();
            let state = $(this).data('state');

            let url = state === 'unsuspend' ?
                "{{ route('radius.users.unsuspend') }}" :
                "{{ route('radius.users.suspend') }}";

            let actionText = state === 'unsuspend' ?
                'Unsuspend user?' :
                'Suspend user?';

            Swal.fire({
                title: actionText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Confirm'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.post(url, {
                    _token: "{{ csrf_token() }}",
                    username: username
                }, function() {

                    Swal.fire({
                        icon: 'success',
                        title: 'Updated'
                    });

                    // flip state locally
                    let newState = state === 'unsuspend' ? 0 : 1;

                    $('#is_suspended').val(newState);
                    updateSuspendButton(newState);

                });

            });

        });

        function updateSuspendButton(isSuspended) {

            if (parseInt(isSuspended) === 1) {

                $('#suspend_user_btn')
                    .removeClass('btn-light-warning')
                    .addClass('btn-light-success');

                $('#suspend_btn_text').text('Unsuspend');

                $('#suspend_user_btn').data('state', 'unsuspend');

            } else {

                $('#suspend_user_btn')
                    .removeClass('btn-light-success')
                    .addClass('btn-light-warning');

                $('#suspend_btn_text').text('Suspend');

                $('#suspend_user_btn').data('state', 'suspend');
            }
        }

        /*
        |--------------------------------------------------------------------------
        | RESET PASSWORD
        |--------------------------------------------------------------------------
        */

        $('#reset_password_btn').on('click', function() {

            Swal.fire({
                title: 'Reset Password?',
                text: 'A new password will be generated',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Reset Password'
            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }

                $.post(
                    "{{ route('radius.users.reset.password') }}", {
                        _token: "{{ csrf_token() }}",
                        username: $('#edit_username').val()
                    },
                    function(res) {

                        Swal.fire({
                            icon: 'success',
                            title: 'Password Reset',
                            html: `
                            <div class="mt-3">
                                <div class="fw-semibold mb-2">
                                    New Password
                                </div>

                                <div class="badge badge-light-primary fs-6 px-4 py-3">
                                    ${res.password}
                                </div>
                            </div>
                        `
                        });

                    }
                );

            });

        });


        // Edit Nas #
        $(document).on('click', '.edit-nas-btn', function() {

            $('#edit_nas_id').val($(this).data('id'));
            $('#edit_description').val($(this).data('name'));
            $('#edit_shortname').val($(this).data('shortname'));
            $('#edit_nasname').val($(this).data('ip'));
            $('#edit_secret').val($(this).data('secret'));
            $('#edit_type').val($(this).data('type'));

            new bootstrap.Modal(document.getElementById('kt_modal_edit_nas')).show();
        });


        /*
        |--------------------------------------------------------------------------
        | ADD NAS
        |--------------------------------------------------------------------------
        */
        $('#save_nas_btn').on('click', function() {

            Swal.fire({
                title: 'Create NAS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.post("{{ route('nas.store') }}", $('#add_nas_form').serialize(), function() {

                    Swal.fire('Success', 'NAS created', 'success');

                    location.reload();

                });

            });

        });


        /*
        |--------------------------------------------------------------------------
        | UPDATE NAS
        |--------------------------------------------------------------------------
        */
        $('#update_nas_btn').on('click', function() {

            let id = $('#edit_nas_id').val();

            Swal.fire({
                title: 'Update NAS?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Update'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.post("/radius/nas/update/" + id, $('#edit_nas_form').serialize(), function() {

                    Swal.fire('Updated', 'NAS updated', 'success');

                    location.reload();

                });

            });

        });
        // END Edit NAS
    </script>
@endpush

@push('scripts')
    <script>
        // OPEN EDIT
        $(document).on('click', '.edit-profile-btn', function() {

            let group = $(this).data('group');

            $('#edit_profile_old').val(group);

            $.get(`/radius/profiles/${group}`, function(res) {

                let p = res.profile;

                console.log(p); // keep for debugging

                // =========================
                // BASIC FIELDS
                // =========================
                $('#edit_profile_name').val(p.groupname ?? '');

                // =========================
                // BANDWIDTH
                // =========================
                $('#edit_download').val(p.download ?? '');
                $('#edit_upload').val(p.upload ?? '');

                // =========================
                // SESSION CONTROL
                // =========================
                $('#edit_max_sessions').val(p.max_sessions ?? '');
                $('#edit_idle_timeout').val(p.idle_timeout ?? '');
                $('#edit_session_timeout').val(p.session_timeout ?? '');

                // =========================
                // AUTH TYPE (SUSPEND LOGIC)
                // =========================
                let suspended = (p.auth_type === 'Reject') ? 1 : 0;

                $('#is_suspended').val(suspended);

                $('#suspend_btn_text').text(
                    suspended ? 'Unsuspend' : 'Suspend'
                );

                $('#profile_edit_auth_type').val(p.auth_type ?? '');

                // =========================
                // SHOW MODAL
                // =========================
                new bootstrap.Modal(
                    document.getElementById('kt_modal_edit_profile')
                ).show();

            });

        });

        // UPDATE
        $('#update_profile_btn').on('click', function() {

            Swal.fire({
                title: 'Update Profile?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes Update'
            }).then((result) => {

                if (!result.isConfirmed) return;

                let group = $('#edit_profile_old').val();

                let formData = new FormData(document.getElementById('edit_profile_form'));

                $.ajax({
                    url: `/radius/profiles/${group}/update`,
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        Swal.fire('Updated', 'Profile updated', 'success')
                            .then(() => location.reload());
                    }
                });

            });

        });

        $.ajaxSetup({

            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        // DELETE
        $(document).on('click', '.delete-profile-btn', function() {

            let group = $(this).data('group');

            Swal.fire({
                title: 'Delete Profile?',
                text: 'This will permanently remove the profile and all its attributes.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                confirmButtonColor: '#d33'
            }).then((result) => {

                if (!result.isConfirmed) return;

                $.ajax({

                    url: `/radius/profiles/${group}`,

                    type: 'DELETE',

                    success: function() {

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted',
                            text: 'Profile deleted successfully'
                        }).then(() => {

                            location.reload();

                        });

                    },

                    error: function(xhr) {

                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: xhr.responseJSON?.message ??
                                'Unable to delete profile'
                        });

                    }

                });

            });

        });
    </script>
@endpush
