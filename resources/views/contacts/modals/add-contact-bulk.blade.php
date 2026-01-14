<div class="modal fade" tabindex="-1" id="modal_add_contact-bulk">
    <div class="modal-dialog  mw-600px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Bulk Contacts</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">

                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6 mb-8">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-information fs-2tx text-warning me-4"></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Note:</h4>
                            <div class="fs-8 text-gray-700">You can download the template contacts
                                <a class="fw-bold template-dwload" href="/contacts/templatedownload" target="_self">here</a>.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
<!--begin::Form-->
<form class="form mb-lg-10 pt-lg-10" action="#" method="post">
    @csrf
    <!--begin::Input group-->
    <div class="form-group row">
        <!--begin::Col-->
        <div class="col-lg-12">
            <!--begin::Dropzone-->
            <div class="dropzone dropzone-queue mb-2" id="import_contacts_dropzone">
                <!--begin::Controls-->
                <div class="dropzone-panel mb-lg-0 mb-2">
                    <a class="dropzone-select btn btn-sm btn-primary me-2">Upload contacts file</a>
                    <a class="dropzone-upload btn btn-sm btn-light-primary me-2">Upload All</a>
                    <a class="dropzone-remove-all btn btn-sm btn-light-primary">Remove All</a>
                </div>
                <!--end::Controls-->

                <!--begin::Items-->
                <div class="dropzone-items wm-200px">
                    <div class="dropzone-item" style="display:none">
                        <!--begin::File-->
                        <div class="dropzone-file">
                            <div class="dropzone-filename" title="Demo contacts">
                                <span data-dz-name>some_image_file_name.jpg</span>
                                <strong>(<span data-dz-size>340kb</span>)</strong>
                            </div>

                            <div class="dropzone-error" data-dz-errormessage></div>
                        </div>
                        <!--end::File-->

                        <!--begin::Progress-->
                        <div class="dropzone-progress">
                            <div class="progress">
                                <div
                                    class="progress-bar bg-primary"
                                    role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" data-dz-uploadprogress>
                                </div>
                            </div>
                        </div>
                        <!--end::Progress-->

                        <!--begin::Toolbar-->
                        <div class="dropzone-toolbar">
                            <span class="dropzone-start"><i class="bi bi-play-fill fs-3"></i></span>
                            <span class="dropzone-cancel" data-dz-remove style="display: none;"><i class="bi bi-x fs-3"></i></span>
                            <span class="dropzone-delete" data-dz-remove><i class="bi bi-x fs-1"></i></span>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                </div>
                <!--end::Items-->
            </div>
            <!--end::Dropzone-->

            <!--begin::Hint-->
            <span class="form-text text-muted">Max file size is 1MB and max number of files is 1.</span>
            <!--end::Hint-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
</form>
<!--end::Form-->
            </div>

            <div class="modal-footer">
  
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
// set the dropzone container id
const id = "#import_contacts_dropzone";
const dropzone = document.querySelector(id);

// set the preview element template
var previewNode = dropzone.querySelector(".dropzone-item");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone(id, { // Make the whole body a dropzone
    url: "/contact/import", // Set the url for your upload script location
    parallelUploads: 20,
    acceptedFiles: ".csv",  //
    previewTemplate: previewTemplate,
    maxFilesize: 1, // Max filesize in MB
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: id + " .dropzone-items", // Define the container to display the previews
    clickable: id + " .dropzone-select" // Define the element that should be used as click trigger to select files.
});

myDropzone.on("addedfile", function (file) {
    // Hookup the start button
    file.previewElement.querySelector(id + " .dropzone-start").onclick = function () { myDropzone.enqueueFile(file); };
    const dropzoneItems = dropzone.querySelectorAll('.dropzone-item');
    dropzoneItems.forEach(dropzoneItem => {
        dropzoneItem.style.display = '';
    });
    dropzone.querySelector('.dropzone-upload').style.display = "inline-block";
    dropzone.querySelector('.dropzone-remove-all').style.display = "inline-block";
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function (progress) {
    const progressBars = dropzone.querySelectorAll('.progress-bar');
    progressBars.forEach(progressBar => {
        progressBar.style.width = progress + "%";
    });
});

myDropzone.on("sending", function (file, xhr, formData) {
    // Show the total progress bar when upload starts
    formData.append("_token", document.querySelector('input[name="_token"]').value);
    const progressBars = dropzone.querySelectorAll('.progress-bar');
    progressBars.forEach(progressBar => {
        progressBar.style.opacity = "1";
    });
    // And disable the start button
    file.previewElement.querySelector(id + " .dropzone-start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("complete", function (progress) {
    const progressBars = dropzone.querySelectorAll('.dz-complete');

    setTimeout(function () {
        progressBars.forEach(progressBar => {
            progressBar.querySelector('.progress-bar').style.opacity = "0";
            progressBar.querySelector('.progress').style.opacity = "0";
            progressBar.querySelector('.dropzone-start').style.opacity = "0";
        });
    }, 300);
});

// Setup the buttons for all transfers
dropzone.querySelector(".dropzone-upload").addEventListener('click', function () {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
});

// Setup the button for remove all files
dropzone.querySelector(".dropzone-remove-all").addEventListener('click', function () {
    dropzone.querySelector('.dropzone-upload').style.display = "none";
    dropzone.querySelector('.dropzone-remove-all').style.display = "none";
    myDropzone.removeAllFiles(true);
});

// On all files completed upload
myDropzone.on("queuecomplete", function (progress) {
    const uploadIcons = dropzone.querySelectorAll('.dropzone-upload');
    uploadIcons.forEach(uploadIcon => {
        uploadIcon.style.display = "none";
    });
});

// On all files removed
myDropzone.on("removedfile", function (file) {
    if (myDropzone.files.length < 1) {
        dropzone.querySelector('.dropzone-upload').style.display = "none";
        dropzone.querySelector('.dropzone-remove-all').style.display = "none";
    }
});



        // var myDropzone = new Dropzone("#import_contacts_dropzone", {
        //     autoProcessQueue: false, // Prevent automatic upload
        //     url: "/contact/import", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 1,
        //     maxFilesize: 2, // MB
        //     // addRemoveLinks: true,
        //     // accept: function(file, done) {
        //     //     if (file.name == "bulk-contacts-template.csv") {
        //     //         done("Naha, you don't.");
        //     //     } else {
        //     //         done();
        //     //     }
        //     // }

        //     init: function() {
        //         var myDropzone = this;

        //         myDropzone.on("sending", function(file, xhr, formData) {
        //             formData.append("_token", "{{ csrf_token() }}");
        //         });

        //         // Handle the submit button click event
        //         document.getElementById("import_contacts_submit").addEventListener("click", function(e) {
        //             e.preventDefault();
        //             e.stopPropagation();
        //             myDropzone.processQueue(); // Manually process the queue
        //         });

        //         // Optional: Handle successful file uploads
        //         myDropzone.on("success", function(file, response) {
        //             console.log('File successfully uploaded: ' + response.success);
        //         });

        //         // Optional: Handle errors
        //         myDropzone.on("error", function(file, response) {
        //             console.log('Error: ' + response.error);
        //         });
        //     }
        // });
    </script>
@endpush
