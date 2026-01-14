@extends('layouts.master')

@section('content')
    <div id="kt_app_content_container" class="app-container container-fluid">
        <!--begin::Inbox App - Compose -->
        <div class="d-flex flex-column flex-lg-row">
            <!--begin::Content-->
            <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between py-3">
                        <h2 class="card-title m-0">Compose Message</h2>
                        <!--begin::Toggle-->
                        <a href="#"
                            class="btn btn-sm btn-icon btn-color-primary btn-light btn-active-light-primary d-lg-none"
                            data-bs-toggle="tooltip" data-bs-dismiss="click" data-bs-placement="top"
                            id="kt_inbox_aside_toggle" aria-label="Toggle inbox menu"
                            data-bs-original-title="Toggle inbox menu" data-kt-initialized="1">
                            <i class="ki-outline ki-burger-menu-2 fs-3 m-0"></i>
                        </a>
                        <!--end::Toggle-->
                    </div>
                    <div class="card-body p-0">
                        <!--begin::Form-->
                        <form id="kt_compose_email_form" class="compose_email-frm">
                            @csrf
                            <!--begin::Body-->
                            <div class="d-block">
                                <!--begin::To-->
                                <div class="d-flex align-items-center border-bottom px-8 min-h-50px">
                                    <!--begin::Label-->
                                    <div class="text-gray-900 fw-bold w-75px">To:</div>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" id="contactsInput" data-kt-inbox-form="tagify"
                                        class="form-control form-control-transparent border-0" name="compose_to"
                                        value="" tabindex="-1" placeholder="Type contact name / email">
                                    <!--end::Input-->
                                    <!--begin::CC & BCC buttons-->
                                    <div class="ms-auto w-75px text-end">
                                        <span class="text-muted fs-bold cursor-pointer text-hover-primary me-2"
                                            data-btn-cc="cc_button">Cc</span>
                                        <span class="text-muted fs-bold cursor-pointer text-hover-primary"
                                            data-btn-bcc="bcc_button">Bcc</span>
                                    </div>
                                    <!--end::CC & BCC buttons-->
                                </div>
                                <!--end::To-->
                                <!--begin::CC-->
                                <div class="d-none align-items-center border-bottom ps-8 pe-5 min-h-50px" data-cc-form="cc">
                                    <!--begin::Label-->
                                    <div class="text-gray-900 fw-bold w-75px">Cc:</div>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-transparent border-0"
                                        name="compose_cc" value="" data-kt-inbox-form="tagify" tabindex="-1">
                                    <!--end::Input-->
                                    <!--begin::Close-->
                                    <span class="btn btn-clean btn-xs btn-icon" data-cc-close="cc_close">
                                        <i class="ki-outline ki-cross fs-5"></i>
                                    </span>
                                    <!--end::Close-->
                                </div>
                                <!--end::CC-->
                                <!--begin::BCC-->
                                <div class="d-none align-items-center border-bottom inbox-to-bcc ps-8 pe-5 min-h-50px"
                                    data-bcc-form="bcc">
                                    <!--begin::Label-->
                                    <div class="text-gray-900 fw-bold w-75px">Bcc:</div>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="text" class="form-control form-control-transparent border-0"
                                        name="compose_bcc" value="" data-kt-inbox-form="tagify" tabindex="-1">
                                    <!--end::Input-->
                                    <!--begin::Close-->
                                    <span class="btn btn-clean btn-xs btn-icon" data-bcc-close="bcc_close">
                                        <i class="ki-outline ki-cross fs-5"></i>
                                    </span>
                                    <!--end::Close-->
                                </div>
                                <!--end::BCC-->
                                <!--begin::Subject-->
                                <div class="border-bottom">
                                    <input class="form-control form-control-transparent border-0 px-8 min-h-45px"
                                        name="compose_subject" placeholder="Subject" value="{{ $composed_email[0]->name }}">
                                </div>
                                <!--end::Subject-->
                                <!--begin::Message-->
                                <div id="compose_email_editor" class="bg-transparent border-0 h-350px px-3">
                                </div>
                                <!--end::Message-->
                                <!--begin::Attachments-->
                                <div class="dropzone dropzone-queue px-8 py-4" id="kt_inbox_reply_attachments"
                                    data-kt-inbox-form="dropzone_compose">
                                    <div class="dropzone-items">

                                    </div>
                                    <div class="dz-default dz-message"><button class="dz-button" type="button">Drop
                                            files here to upload</button></div>
                                </div>
                                <!--end::Attachments-->
                            </div>
                            <!--end::Body-->
                            <!--begin::Footer-->
                            <div class="d-flex flex-stack flex-wrap gap-2 py-5 ps-8 pe-5 border-top">
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Send-->
                                    <div class="btn-group me-4">
                                        <!--begin::Submit-->
                                        <span class="btn btn-primary fs-bold px-6" data-kt-inbox-form="send">
                                            <span class="indicator-label">Send</span>
                                            <span class="indicator-progress">Please wait...
                                                <span
                                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </span>
                                        <!--end::Submit-->
                                        <!--begin::Send options-->
                                        <span class="btn btn-primary btn-icon fs-bold w-30px pe-0" role="button">
                                            <span class="lh-0" data-kt-menu-trigger="click"
                                                data-kt-menu-placement="top-start">
                                                <i class="ki-outline ki-down fs-4 m-0"></i>
                                            </span>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4"
                                                data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Schedule send</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Save &amp; archive</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Cancel</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </span>
                                        <!--end::Send options-->
                                    </div>
                                    <!--end::Send-->
                                    <!--begin::Upload attachement-->
                                    <span class="btn btn-icon btn-sm btn-clean btn-active-light-primary me-2 dz-clickable" 
                                    id="kt_inbox_reply_attachments_select" data-kt-inbox-form="dropzone_upload_compose">
                                        <i class="ki-outline ki-paper-clip fs-2 m-0"></i>
                                    </span>
                                    <!--end::Upload attachement-->
                                    <!--begin::Pin-->
                                    <span class="btn btn-icon btn-sm btn-clean btn-active-light-primary">
                                        <i class="ki-outline ki-geolocation fs-2 m-0"></i>
                                    </span>
                                    <!--end::Pin-->
                                </div>
                                <!--end::Actions-->
                                <!--begin::Toolbar-->
                                <div class="d-flex align-items-center">
                                    <!--begin::More actions-->
                                    <span class="btn btn-icon btn-sm btn-clean btn-active-light-primary me-2"
                                         data-bs-toggle="modal" data-bs-target="#compose-settings">
                                        <i class="ki-outline ki-setting-2 fs-2"></i>
                                    </span>
                                    <!--end::More actions-->
                                    <!--begin::Dismiss reply-->
                                    <span class="btn btn-icon btn-sm btn-clean btn-active-light-primary"
                                        data-inbox="dismiss" data-toggle="tooltip" title="Dismiss reply">
                                        <i class="ki-outline ki-trash fs-2"></i>
                                    </span>
                                    <!--end::Dismiss reply-->
                                </div>
                                <!--end::Toolbar-->
                            </div>
                            <!--end::Footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Inbox App - Compose -->
    </div>
@endsection('content')

@push('scripts')
    <script>
        // Compose Email ==================== 
        "use strict";

        // Class definition
        var KTAppInboxCompose1 = function() {
            // Private functions
            // Init reply form
            const initForm = () => {
                // Set variables
                const form = document.querySelector('#kt_compose_email_form');
                const allTagify = form.querySelectorAll('[data-kt-inbox-form="tagify"]');

                // Handle CC and BCC
                handleCCandBCC(form);

                // Handle submit form
                handleSubmit(form);

                // Init tagify
                allTagify.forEach(tagify => {
                    initTagify(tagify);
                });

                // Init quill editor
                initQuill(form);

                // Init dropzone
                initDropzone(form);
            }

            // Handle CC and BCC toggle
            const handleCCandBCC = (el) => {
                // Get elements
                const ccElement = el.querySelector('[data-cc-form="cc"]');
                const ccButton = el.querySelector('[data-btn-cc="cc_button"]');
                const ccClose = el.querySelector('[data-cc-close="cc_close"]');
                const bccElement = el.querySelector('[data-bcc-form="bcc"]');
                const bccButton = el.querySelector('[data-btn-bcc="bcc_button"]');
                const bccClose = el.querySelector('[data-bcc-close="bcc_close"]');

                // Handle CC button click
                ccButton.addEventListener('click', e => {
                    e.preventDefault();

                    ccElement.classList.remove('d-none');
                    ccElement.classList.add('d-flex');
                });

                // Handle CC close button click
                ccClose.addEventListener('click', e => {
                    e.preventDefault();

                    ccElement.classList.add('d-none');
                    ccElement.classList.remove('d-flex');
                });

                // Handle BCC button click
                bccButton.addEventListener('click', e => {
                    e.preventDefault();

                    bccElement.classList.remove('d-none');
                    bccElement.classList.add('d-flex');
                });

                // Handle CC close button click
                bccClose.addEventListener('click', e => {
                    e.preventDefault();

                    bccElement.classList.add('d-none');
                    bccElement.classList.remove('d-flex');
                });
            }

            // Handle submit form
            const handleSubmit = (el) => {
                const submitButton = el.querySelector('[data-kt-inbox-form="send"]');

                // Handle button click event
                submitButton.addEventListener("click", function(e) {
                    // Activate indicator
                    submitButton.setAttribute("data-kt-indicator", "on");

                    var quill = new Quill('#compose_email_editor');
                    // var delta = quill.getContents();
                    var editor_content = quill.root.innerHTML;
                    var text = quill.getText();

                    //   $('.send-test-email').click(function(e) {

                    e.preventDefault(); // avoid to execute the actual submit of the form.
                    var form_data = $('.compose_email-frm').serialize();
                    $.ajax({
                        type: "POST",
                        url: "/email/schedule",
                        data: form_data + '&compose-text=' +
                            editor_content, // serializes the form's elements.
                        success: function(response) {
                            Swal.fire({
                                title: response.title,
                                text: response.message,
                                icon: response.status,
                                showConfirmButton: false,
                                timer: 2000
                            });
                            $("#test_email_modal").modal('hide');
                            submitButton.removeAttribute('data-kt-indicator');
                            quill.deleteText(0, quill.getLength());
                        },
                        error: function(xhr, status, error) {
                            var responseJson = JSON.parse(xhr.responseText);
                            // Access the message property from the response
                            var errorMessage = responseJson.message;
                            // Display error message
                            // alert('Error: ' + errorMessage);
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Erro: " + errorMessage
                            });
                        },

                    });

                    // Disable indicator after 3 seconds
                    setTimeout(function() {
                        submitButton.removeAttribute("data-kt-indicator");
                    }, 3000);
                });
            }

            const initTagify = (el) => {
                var inputElm = el;

                // Initialize Tagify
                var tagify = new Tagify(inputElm, {
                    tagTextProp: 'name', // Important for custom templates to use the 'name' property
                    enforceWhitelist: true, // Only allow tags from the whitelist
                    skipInvalid: true, // Do not temporarily add invalid tags
                    dropdown: {
                        closeOnSelect: false, // Keep the dropdown open after selecting a suggestion
                        enabled: 0, // Show suggestions immediately when typing
                        classname: 'users-list', // Custom class for the dropdown
                        searchKeys: ['name', 'email'] // Keys to search by when filtering suggestions
                    },
                    templates: {
                        tag: tagTemplate,
                        dropdownItem: suggestionItemTemplate
                    },
                    whitelist: [] // Initially empty; will be populated dynamically
                });

                // Event listener for input changes (to fetch suggestions)
                tagify.on('input', onInput);

                // Event listener for dropdown show/update
                tagify.on('dropdown:show dropdown:updated', onDropdownShow);

                // Event listener for selecting a suggestion
                tagify.on('dropdown:select', onSelectSuggestion);

                var addAllSuggestionsElm;

                // Fetch users from the server as the user types
                function onInput(e) {
                    var value = e.detail.value;

                    // Make an AJAX request to fetch users from the server
                    fetch('/contacts/get-all?query=' + value)
                        .then(response => response.json())
                        .then(usersList => {
                            // Update Tagify's whitelist with fetched users
                            tagify.settings.whitelist = usersList;

                            // Trigger dropdown to show the suggestions
                            tagify.dropdown.show.call(tagify, value);
                        });
                }

                // Template for rendering selected tags
                function tagTemplate(tagData) {
                    return `
            <tag title="${tagData.email || tagData.title}"
                contenteditable='false'
                spellcheck='false'
                tabIndex="-1"
                class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ""}"
                ${this.getAttributes(tagData)}>
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <div class='tagify__tag__avatar-wrap ps-0'>
                        <img onerror="this.style.visibility='hidden'" class="rounded-circle w-25px me-2" src="${hostUrl}media/${tagData.avatar}">
                    </div>
                    <span class='tagify__tag-text'>${tagData.name}</span>
                </div>
            </tag>
        `;
                }

                // Template for rendering dropdown items (suggestions)
                function suggestionItemTemplate(tagData) {
                    return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">

                ${tagData.avatar ? `
                        <div class='tagify__dropdown__item__avatar-wrap me-2'>
                            <img onerror="this.style.visibility='hidden'"  class="rounded-circle w-50px me-2" src="${hostUrl}media/${tagData.avatar}">
                        </div>` : ''}

                <div class="d-flex flex-column">
                    <strong>${tagData.name}</strong>
                    <span>${tagData.email}</span>
                </div>
            </div>
        `;
                }

                // Event handler when the dropdown is shown
                function onDropdownShow(e) {
                    var dropdownContentElm = e.detail.tagify.DOM.dropdown.content;

                    if (tagify.suggestedListItems.length > 1) {
                        addAllSuggestionsElm = getAddAllSuggestionsElm();

                        // Insert "addAllSuggestionsElm" as the first element in the suggestions list
                        dropdownContentElm.insertBefore(addAllSuggestionsElm, dropdownContentElm.firstChild);
                    }
                }

                // Event handler when a suggestion is selected
                function onSelectSuggestion(e) {
                    if (e.detail.elm == addAllSuggestionsElm) {
                        tagify.dropdown.selectAll.call(tagify);
                    }
                }

                // Create a "Add All" custom suggestion element every time the dropdown changes
                function getAddAllSuggestionsElm() {
                    // Suggestions items should be based on "dropdownItem" template
                    return tagify.parseTemplate('dropdownItem', [{
                        class: "addAll",
                        name: "Add all",
                        email: `${tagify.settings.whitelist.length} Members`
                    }]);
                }
            }



            // Init quill editor 
            const initQuill = (el) => {
                var quill = new Quill('#compose_email_editor', {
                    modules: {
                        toolbar: [
                            [{
                                header: [1, 2, false]
                            }],
                            ['bold', 'italic', 'underline'],
                            ['image', 'code-block']
                        ]
                    },
                    placeholder: 'Type your text here...',
                    theme: 'snow' // or 'bubble'
                });

                // Customize editor
                const toolbar = el.querySelector('.ql-toolbar');

                if (toolbar) {
                    const classes = ['px-5', 'border-top-0', 'border-start-0', 'border-end-0'];
                    toolbar.classList.add(classes);
                }
            }

            // Init dropzone
            const initDropzone = (el) => {
                // set the dropzone container id
                const id = '[data-kt-inbox-form="dropzone_compose"]';
                const dropzone = el.querySelector(id);
                const uploadButton = el.querySelector('[data-kt-inbox-form="dropzone_upload_compose"]');

                // set the preview element template
                var previewNode = dropzone.querySelector(".dropzone-item");
                previewNode.id = "";
                var previewTemplate = previewNode.parentNode.innerHTML;
                previewNode.parentNode.removeChild(previewNode);

                var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
                    url: "https://preview.keenthemes.com/api/dropzone/void.php", // Set the url for your upload script location
                    parallelUploads: 20,
                    maxFilesize: 1, // Max filesize in MB
                    previewTemplate: previewTemplate,
                    previewsContainer: id +
                        " .dropzone-items", // Define the container to display the previews
                    clickable: uploadButton // Define the element that should be used as click trigger to select files.
                });


                myDropzone.on("addedfile", function(file) {
                    // Hookup the start button
                    const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
                    dropzoneItems.forEach(dropzoneItem => {
                        dropzoneItem.style.display = '';
                    });
                });

                // Update the total progress bar
                myDropzone.on("totaluploadprogress", function(progress) {
                    const progressBars = dropzone.querySelectorAll('.progress-bar');
                    progressBars.forEach(progressBar => {
                        progressBar.style.width = progress + "%";
                    });
                });

                myDropzone.on("sending", function(file) {
                    // Show the total progress bar when upload starts
                    const progressBars = dropzone.querySelectorAll('.progress-bar');
                    progressBars.forEach(progressBar => {
                        progressBar.style.opacity = "1";
                    });
                });

                // Hide the total progress bar when nothing"s uploading anymore
                myDropzone.on("complete", function(progress) {
                    const progressBars = dropzone.querySelectorAll('.dz-complete');

                    setTimeout(function() {
                        progressBars.forEach(progressBar => {
                            progressBar.querySelector('.progress-bar').style.opacity = "0";
                            progressBar.querySelector('.progress').style.opacity = "0";
                        });
                    }, 300);
                });
            }


            // Public methods
            return {
                init: function() {
                    initForm();
                }
            };
        }();

        // On document ready
        KTUtil.onDOMContentLoaded(function() {
            KTAppInboxCompose1.init();
        });
    </script>
@endpush
