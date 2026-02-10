@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Row-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-client-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13"
                                placeholder="Search clients on orbit...">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                            <!--begin::Filter-->
                            <button type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-outline ki-filter fs-2"></i>Filter</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-gray-900 fw-bold">Filter Options</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5" data-kt-user-table-filter="form">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Role:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="role" data-hide-search="true"
                                            data-select2-id="select2-data-1-vx9x" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option data-select2-id="select2-data-3-tmop"></option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="Analyst">Analyst</option>
                                            <option value="Developer">Developer</option>
                                            <option value="Support">Support</option>
                                            <option value="Trial">Trial</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-2-asiz" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-hrk9-container"
                                                    aria-controls="select2-hrk9-container"><span
                                                        class="select2-selection__rendered" id="select2-hrk9-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Two Step Verification:</label>
                                        <select class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                            data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true"
                                            data-kt-user-table-filter="two-step" data-hide-search="true"
                                            data-select2-id="select2-data-4-7da5" tabindex="-1" aria-hidden="true"
                                            data-kt-initialized="1">
                                            <option data-select2-id="select2-data-6-lem6"></option>
                                            <option value="Enabled">Enabled</option>
                                        </select><span class="select2 select2-container select2-container--bootstrap5"
                                            dir="ltr" data-select2-id="select2-data-5-nc24" style="width: 100%;"><span
                                                class="selection"><span
                                                    class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                    role="combobox" aria-haspopup="true" aria-expanded="false"
                                                    tabindex="0" aria-disabled="false"
                                                    aria-labelledby="select2-1ybn-container"
                                                    aria-controls="select2-1ybn-container"><span
                                                        class="select2-selection__rendered" id="select2-1ybn-container"
                                                        role="textbox" aria-readonly="true" title="Select option"><span
                                                            class="select2-selection__placeholder">Select
                                                            option</span></span><span class="select2-selection__arrow"
                                                        role="presentation"><b
                                                            role="presentation"></b></span></span></span><span
                                                class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset"
                                            class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="reset">Reset</button>
                                        <button type="submit" class="btn btn-primary fw-semibold px-6"
                                            data-kt-menu-dismiss="true" data-kt-user-table-filter="filter">Apply</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                            <!--begin::Export-->
                            <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_export_users">
                                <i class="ki-outline ki-exit-up fs-2"></i>Export</button>
                            <!--end::Export-->
                            <!--begin::Add user-->
                            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#modal_add_contact"> --}}
                            <button class="btn btn-primary " type="button" id="dropdownMenuButton"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ki-outline ki-plus fs-2"></i>New Contact</button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal_add_contact">Add Contact</a></li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#modal_add_contact-bulk">Add Bulk (csv)</a></li>
                            </ul>
                            <!--end::Add user-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none"
                            data-kt-user-table-toolbar="selected">
                            <div class="fw-bold me-5">
                                <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                            </div>
                            <button type="button" class="btn btn-danger"
                                data-kt-user-table-select="delete_selected">Delete
                                Selected</button>
                        </div>
                        <!--end::Group actions-->
                        <!--begin::Modal - Adjust Balance-->
                        <div class="modal fade" id="kt_modal_export_users" tabindex="-1" aria-hidden="true">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="modal-content">
                                    <!--begin::Modal header-->
                                    <div class="modal-header">
                                        <!--begin::Modal title-->
                                        <h2 class="fw-bold">Export Users</h2>
                                        <!--end::Modal title-->
                                        <!--begin::Close-->
                                        <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                            data-kt-users-modal-action="close">
                                            <i class="ki-outline ki-cross fs-1"></i>
                                        </div>
                                        <!--end::Close-->
                                    </div>
                                    <!--end::Modal header-->
                                    <!--begin::Modal body-->
                                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                        <!--begin::Form-->
                                        <form id="kt_modal_export_users_form"
                                            class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10">
                                                <!--begin::Label-->
                                                <label class="fs-6 fw-semibold form-label mb-2">Select Roles:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="role" data-control="select2"
                                                    data-placeholder="Select a role" data-hide-search="true"
                                                    class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-select2-id="select2-data-7-538l" tabindex="-1"
                                                    aria-hidden="true" data-kt-initialized="1">
                                                    <option data-select2-id="select2-data-9-rfs7"></option>
                                                    <option value="Administrator">Administrator</option>
                                                    <option value="Analyst">Analyst</option>
                                                    <option value="Developer">Developer</option>
                                                    <option value="Support">Support</option>
                                                    <option value="Trial">Trial</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-8-vbjf"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-role-4a-container"
                                                            aria-controls="select2-role-4a-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-role-4a-container" role="textbox"
                                                                aria-readonly="true" title="Select a role"><span
                                                                    class="select2-selection__placeholder">Select a
                                                                    role</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row mb-10 fv-plugins-icon-container">
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-semibold form-label mb-2">Select Export
                                                    Format:</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <select name="format" data-control="select2"
                                                    data-placeholder="Select a format" data-hide-search="true"
                                                    class="form-select form-select-solid fw-bold select2-hidden-accessible"
                                                    data-select2-id="select2-data-10-xep0" tabindex="-1"
                                                    aria-hidden="true" data-kt-initialized="1">
                                                    <option data-select2-id="select2-data-12-s4r8"></option>
                                                    <option value="excel">Excel</option>
                                                    <option value="pdf">PDF</option>
                                                    <option value="cvs">CVS</option>
                                                    <option value="zip">ZIP</option>
                                                </select><span
                                                    class="select2 select2-container select2-container--bootstrap5"
                                                    dir="ltr" data-select2-id="select2-data-11-aqux"
                                                    style="width: 100%;"><span class="selection"><span
                                                            class="select2-selection select2-selection--single form-select form-select-solid fw-bold"
                                                            role="combobox" aria-haspopup="true" aria-expanded="false"
                                                            tabindex="0" aria-disabled="false"
                                                            aria-labelledby="select2-format-12-container"
                                                            aria-controls="select2-format-12-container"><span
                                                                class="select2-selection__rendered"
                                                                id="select2-format-12-container" role="textbox"
                                                                aria-readonly="true" title="Select a format"><span
                                                                    class="select2-selection__placeholder">Select a
                                                                    format</span></span><span
                                                                class="select2-selection__arrow" role="presentation"><b
                                                                    role="presentation"></b></span></span></span><span
                                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                <!--end::Input-->
                                                <div
                                                    class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                                </div>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Actions-->
                                            <div class="text-center">
                                                <button type="reset" class="btn btn-light me-3"
                                                    data-kt-users-modal-action="cancel">Discard</button>
                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">Submit</span>
                                                    <span class="indicator-progress">Please wait...
                                                        <span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>
                                            <!--end::Actions-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Modal body-->
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>
                        <!--end::Modal - New Card-->
                        {{-- @include('contacts.modals.add-contact')
                        @include('contacts.modals.add-contact-bulk') --}}
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed gy-4" id="clients_dt">
                            <thead>
                                <tr>
                                    <th class="text-start">ID</th>
                                    <th>Client Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Client Type</th>
                                    <th>Created date</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Row-->
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
        // Modal To Add Contact and Submit
        "use strict";

        // Class definition
        var KTUsersAddUser = function() {
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
                const submitButton = element.querySelector('[data-kt-client-modal-action="submit"]');
                submitButton.addEventListener('click', e => {
                    e.preventDefault();

                    // Validate form before submit
                    if (validator) {
                        validator.validate().then(function(status) {
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
                                    success: function(response) {
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
                                    error: function(xhr, status, error) {
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
                const cancelButton = element.querySelector('[data-kt-client-modal-action="cancel"]');
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
                    }).then(function(result) {
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
                const closeButton = element.querySelector('[data-kt-client-modal-action="close"]');
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
                    }).then(function(result) {
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
                init: function() {
                    initAddUser();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTUsersAddUser.init();
        });
    </script>
    <script>
        // Here i create the clients DT 
        var KTDatatablesServerSide = function() {
            var dt;

            var initDatatable = function() {
                dt = $("#clients_dt").DataTable({
                    searchDelay: 500,
                    processing: true,
                    serverSide: false,
                    stateSave: false,
                    autoWidth: false, // prevent automatic narrow columns
                    ajax: {
                        url: "/clients/data",
                        type: "GET"
                    },
                    columns: [{
                            data: "odoo_id",
                            className: "client_id fw-semibold text-start",
                            searchable: true
                        },
                        {
                            data: "name",
                            render: function(data) {
                                return `
                            <div class="d-flex flex-column">
                                <span class="client-name">${data}</span>
                            </div>
                        `;
                            }
                        },
                        {
                            data: "email",
                            render: function(data) {
                                if (!data) return `<span class="text-muted">—</span>`;
                                return `
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-envelope text-primary me-2"></i>
                                            <span class="text-truncate" style="max-width:150px;" title="${data}">${data}</span>
                                        </div>
                                    `;
                            }
                        },
                        {
                            data: "phone",
                            render: function(data) {
                                if (!data) return `<span class="text-muted">—</span>`;
                                return `
                                        <div class="d-flex align-items-center">
                                            <i class="fa-solid fa-phone text-success me-2"></i>
                                            <span class="text-truncate" style="max-width:120px;" title="${data}">${data}</span>
                                        </div>
                                    `;
                            }
                        },

                        {
                            data: "company_type",
                            render: function(data) {
                                return data === "company" ?
                                    `<span class="badge badge-light-primary"><i class="ki-duotone ki-office-bag"></i> Company</span>` :
                                    `<span class="badge badge-light-success"><i class="ki-duotone ki-user"></i> Person</span>`;
                            }
                        },
                        {
                            data: "odoo_create_date",
                            render: function(data) {
                                return `<span class="text-muted fs-8">${data}</span>`;
                            }
                        }
                    ],
                    order: [
                        [10, 'desc']
                    ],
                    pageLength: 5,
                    lengthMenu: [5, 10, 20, 50],
                    paging: true
                });

                // Row click navigation
                $("#clients_dt tbody").on("click", "tr", function(e) {
                    if ($(e.target).closest("a, button, input, label, .form-check, [data-kt-menu]")
                        .length) {
                        return;
                    }

                    const client_id = $(this).find("td.client_id").text().trim();
                    if (client_id) {
                        window.location.href = `/client/view?client_id=${client_id}`;
                    }
                });
            };

            var handleSearch = function() {
                const searchInput = document.querySelector('[data-kt-client-table-filter="search"]');

                if (!searchInput) return;

                searchInput.addEventListener('keyup', function() {
                    dt.search(this.value).draw();
                });
            };

            return {
                init: function() {
                    initDatatable();
                    handleSearch(); // ✅ bind search AFTER datatable exists
                }
            };
        }();


        // On document ready
        // KTUtil.onDOMContentLoaded(function() {
        KTDatatablesServerSide.init();
        // });
    </script>
@endpush
