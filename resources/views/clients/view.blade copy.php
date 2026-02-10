@extends('layouts.master')

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-fluid">

        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap"></div>
                <!--end::Details-->
                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="dataTabs"
                    role="tablist">
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" data-bs-toggle="tab"
                            data-tab="overview" href="#">Overview</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="assets"
                            href="#">Assets</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="services"
                            href="#">Services</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="billing"
                            href="#">Billing</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="contacts"
                            href="#">Contacts</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab"
                            data-tab="addresses" href="#">Adresses</a>
                    </li>
                    <!--end::Nav item-->
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" data-tab="logs"
                            href="#">Logs</a>
                    </li>
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>

        <!-- Include The Tabs -->
        <div class="tab-content mt-3">
            <div id="tab-content" class="border rounded">
                <div id="loading" class="d-flex align-items-center justify-content-center" style="min-height: 200px;">
                    <p class="text-muted fs-4 mb-0">Loading on Orbit ...</p>
                </div>
            </div>
        </div>

        <!-- End of Including Tabs -->

    </div>
    <!--end::Content container-->
</div>
<div class="modal fade" tabindex="-1" id="edit-contact">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Edit Contact</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Inject in the USL the cid Tsokotsa
    window.CLIENT_ID = @json($client_id);

    $(document).ready(function () {
        const client_id = $('#client_id').val();

        function loadTab(tab) {

            $('#tab-content').html(`
        <div id="loading"
             class="d-flex align-items-center justify-content-center"
             style="min-height: 200px;">
            <p class="text-muted fs-4 mb-0">Loading on Orbit ...</p>
        </div>`);

            $.ajax({
                url: `/client_tabs/${tab}`,
                method: 'GET',
                data: {
                    client_id: window.CLIENT_ID,
                },
                success: function (response) {
                    $('#tab-content').html(response);
                    KTComponents.init();
                    if (tab === 'services') {
                        loadServiceTab('fiber');
                    }
                },
                error: function () {
                    $('#tab-content').html('Failed to load data');
                }
            });
        }

        // Load first tab on page load
        loadTab('overview');

        $('.nav-link').on('click', function (e) {
            e.preventDefault();

            $('.nav-link').removeClass('active');
            $(this).addClass('active');

            let tab = $(this).data('tab');
            loadTab(tab);
        });
    });

</script>

<script>

    function loadServiceTab(service) {
        $('#service-tab-content').html(`
        <div class="d-flex justify-content-center align-items-center" style="min-height:200px">
            <p class="text-muted fs-4 mb-0">Loading Orbit service...</p>
        </div>
    `);
        $.get(`/client/services/${service}`, function (response) {
            $('#service-tab-content').html(response);

        });
    }

    // initial load
    loadServiceTab('fiber');

    // delegated click handler
    $(document).on('click', '#services-module .menu-link', function (e) {
        e.preventDefault(); // ⬅️ THIS stops # navigation

        $('#services-module .menu-link').removeClass('active');
        $(this).addClass('active');

        const service = $(this).data('service-tab');
        loadServiceTab(service);
    });
</script>


<script>
    document.getElementById('assets-tab').addEventListener('shown.bs.tab', function () {
        const container = document.getElementById('assets-content');

        // Prevent reloading every time
        if (container.dataset.loaded) return;

        fetch("{{ route('assets.tab') }}")
            .then(response => response.text())
            .then(html => {
                container.innerHTML = html;
                container.dataset.loaded = "true";
            })
            .catch(() => {
                container.innerHTML = '<span class="text-danger">Failed to load assets</span>';
            });
    });
</script>


<script>
    // Modal To Add Contact and Submit
    "use strict";

    // Class definition
    var KTUsersAddUser = function () {
        // Shared variables
        const element = document.getElementById('modal_add_contact');
        const form = element.querySelector('#modal_add_contact_form');
        const modal = new bootstrap.Modal(element);

        // Init add schedule modal
        var initAddUser = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form, {
                fields: {
                    'name': {
                        validators: {
                            notEmpty: {
                                message: 'Name is required'
                            }
                        }
                    },
                    'surname': {
                        validators: {
                            notEmpty: {
                                message: 'Surname is required'
                            }
                        }
                    },
                    'email': {
                        validators: {
                            notEmpty: {
                                message: 'Valid email address is required'
                            }
                        }
                    },
                    'cell1': {
                        validators: {
                            notEmpty: {
                                message: 'Atleast one cellphone must be selected'
                            }
                        }
                    },
                },

                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
            );

            // Submit button handler
            const submitButton = element.querySelector('[data-kt-users-modal-action="submit"]');
            submitButton.addEventListener('click', e => {
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            // Show loading indication
                            submitButton.setAttribute('data-kt-indicator', 'on');

                            // Disable button to avoid multiple click 
                            submitButton.disabled = true;

                            //Serialize the form
                            var form_data = $('#modal_add_contact_form').serialize();

                            $.ajax({
                                type: "POST",
                                url: "/contact/add",
                                data: form_data, // serializes the form's elements.
                                success: function (response) {
                                    Swal.fire({
                                        title: "Woohoooo!",
                                        text: "Message Sent",
                                        icon: "success",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });

                                    submitButton.removeAttribute(
                                        'data-kt-indicator');
                                    submitButton.disabled = false;
                                },
                                error: function (xhr, status, error) {
                                    var responseJson = JSON.parse(xhr.responseText);
                                    // Access the message property from the response
                                    var errorMessage = responseJson.message;

                                    submitButton.removeAttribute(
                                        'data-kt-indicator');
                                    submitButton.disabled = false;
                                    // Display error message
                                    // alert('Error: ' + errorMessage);
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: "top-end",
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.onmouseenter = Swal
                                                .stopTimer;
                                            toast.onmouseleave = Swal
                                                .resumeTimer;
                                        }
                                    });
                                    Toast.fire({
                                        icon: "error",
                                        title: "Erro: " + errorMessage
                                    });
                                },

                            });

                        } else {
                            // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-kt-users-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });

            // Close button handler
            const closeButton = element.querySelector('[data-kt-users-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();

                Swal.fire({
                    text: "Are you sure you would like to cancel?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, cancel it!",
                    cancelButtonText: "No, return",
                    customClass: {
                        confirmButton: "btn btn-primary",
                        cancelButton: "btn btn-active-light"
                    }
                }).then(function (result) {
                    if (result.value) {
                        form.reset(); // Reset form			
                        modal.hide();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been cancelled!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary",
                            }
                        });
                    }
                });
            });
        }

        return {
            // Public functions
            init: function () {
                initAddUser();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTUsersAddUser.init();
    });
</script>
<script>
    // Here i create the clients DT 
    var KTDatatablesServerSide = function () {
        var dt;

        var initDatatable = function () {
            dt = $("#clients_dt").DataTable({
                searchDelay: 500,
                processing: true,
                serverSide: true,
                order: [
                    [5, 'desc']
                ],
                stateSave: true,
                //select: {
                //    style: 'multi',
                //selector: 'td:first-child input[type="checkbox"]',
                //className: 'row-selected'
                //   },
                ajax: {
                    url: "/clients/data",
                    type: 'GET'
                },
                columnDefs: [{
                    targets: 0,
                    createdCell: function (td, cellData) {
                        td.classList.add('client_id');
                        td.setAttribute('data-id', cellData); // optional but recommended
                    }
                },
                    // keep your other columnDefs here
                ],

                columns: [{
                    data: 'id'
                },
                {
                    data: 'name'
                },
                {
                    data: 'email'
                },
                {
                    data: 'phone'
                },
                {
                    data: 'company_type'
                },
                {
                    data: 'create_date'
                }
                ],
                pageLength: 10, // rows per page
                lengthMenu: [5, 10, 20, 50], // page size options
                paging: true, // ✅ enable pagination
            });
            $('#clients_dt tbody').on('click', 'tr', function (e) {

                // Prevent row click when clicking buttons / inputs / links
                if (
                    $(e.target).closest('a, button, input, label, .form-check, [data-kt-menu]').length
                ) {
                    return;
                }

                // ✅ Get client_id from td.client_id
                const client_id = $(this).find('td.client_id').data('id') ||
                    $(this).find('td.client_id').text().trim();

                if (!client_id) return;

                window.location.href = `/client/view?client_id=${client_id}`;

            });

        }

        return {
            init: function () {
                initDatatable();
            }
        }
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTDatatablesServerSide.init();
    });



    let assetTimer = null;

    $(document).on('input', '#asset-search', function () {
        clearTimeout(assetTimer);

        const query = this.value.trim();
        const $suggestions = $('#asset-suggestions');

        if (query.length < 2) {
            $suggestions.hide().empty();
            return;
        }

        assetTimer = setTimeout(() => {
            $.ajax({
                url: '/assets/get_all',
                method: 'GET',
                data: {
                    q: query
                },
                success: function (data) {
                    if (!data.length) {
                        $suggestions.html(
                            '<div class="list-group-item text-muted">No results</div>'
                        ).show();
                        return;
                    }

                    let html = '';
                    data.forEach(item => {
                        html +=
                            `<div class="btn btn-sm btn-light-dark w-100 text-start d-flex align-items-center asset-item rounded-0"
                        data-id="${item.id}" 
                        data-serial="${item.serial}"
                        data-name="${item.asset_name}" 
                        data-dsc="${item.description}"
                        data-vendor_id="${item.vendor_id}"
                        data-model_id="${item.model}"
                        data-model_name="${item.model_name}">
                    <span class="flex-grow-1">${item.serial}</span>
                    </div>`;
                    });

                    $suggestions.html(html).show();
                }
            });
        }, 300);
    });



    // Handle clicking an asset item
    $(document).on('click', '.asset-item', function () {
        const id = $(this).data('id');
        const serial = $(this).data('serial');
        const name = $(this).data('name')
        const dsc = $(this).data('dsc');


        const model_id = $(this).data('model_id');
        const model_name = $(this).data('model_name');

        // Set values
        $('#asset_id').val(id); // hidden input for form submission
        $('#asset-search').val(serial); // visible input for user
        $('#asset_name').val(name);
        $('#asset_description').val(dsc);
        $('#asset-suggestions').hide().empty();


        // 🔥 Populate Select2 with ONE option
        const $vendorModel = $('#vendor_model');

        $vendorModel
            .empty()
            .append(
                new Option(model_name, model_id, true, true)
            )
            .trigger('change');

        console.log('Selected Asset:', id, serial, dsc, name, model_id, model_name);
    });

    // Optional: hide suggestions if clicking outside
    $(document).on('click', function (e) {
        if (!$(e.target).closest('#asset-search, #asset-suggestions').length) {
            $('#asset-suggestions').hide().empty();
        }
    });



    $(document).on('click', '.add-asset-click', function (e) {

        e.preventDefault();
        const $form = $('#asset-form');


        $.ajax({
            url: '/assets/store',
            method: 'POST',
            data: $form.serialize(),
            success: function () {
                alert('Asset saved successfully');
            },
            error: function (xhr) {
                alert('Error saving asset');
                console.error(xhr.responseText);
            }
        });
    });
</script>

@endpush