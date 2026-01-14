<div class="modal fade" tabindex="-1" id="compose-settings">
    <div class="modal-dialog mw-600px">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Campaign <span class="badge badge-success">{{ $campaign->name }}</span></h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body">
                <div class="notice d-flex bg-light-success rounded border-success border border-dashed p-6 mb-8">
                    <!--begin::Icon-->
                    <i class="ki-outline ki-setting-2 fs-2tx text-dark me-4"></i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">Pay attention!</h4>
                            <div class="fs-8 text-gray-700">This will affect send behaviour. 
                                <a class="fw-bold" href="#">Proceed with caution</a>.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!-- Begin Form -->
                <form id="email_settings_form" class="form">
                    @csrf
                    <input type="text" name="campaign_id" value="{{ $campaign->id }}" hidden>
                    <!-- Bigin Row -->
                    <div class="row">
                        <!-- Begin Item -->
                        <div class="col-sm-6">
                            <div class="d-flex flex-stack">
                                <div class="d-flex">
                                    <div class="d-flex flex-column">
                                        <div class="fs-6 fw-semibold text-gray-500">Notify all contacts
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="form-check form-check-solid form-check-custom form-switch">
                                        <input class="form-check-input w-45px h-30px" type="checkbox" id="googleswitch"
                                            name="all_contacts" checked>
                                        <label class="form-check-label" for="googleswitch"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END Item -->
                        <!-- Bigin Item -->
                        <div class="col-sm-6">
                            <div class="d-flex flex-stack">
                                <div class="d-flex">
                                    <div class="d-flex flex-column">
                                        <div class="fs-6 fw-semibold text-gray-500">Distribute internaly
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="form-check form-check-solid form-check-custom form-switch">
                                        <input class="form-check-input w-45px h-30px" type="checkbox" id="googleswitch"
                                            name="internal_copy">
                                        <label class="form-check-label" for="googleswitch"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Item -->
                    </div>
                    <!-- End Row -->
                    <!-- Begin Separator -->
                    <div class="separator separator-dashed my-5"></div>
                    <!-- End Separator -->
                    <!-- Bigin Item -->
                    <div class="d-flex flex-stack">
                        <div class="d-flex">
                            <div class="d-flex flex-column">
                                <div class="fs-6 fw-semibold text-gray-500">Schedule for later
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="form-check form-check-solid form-check-custom form-switch">
                                <input class="form-check-input w-45px h-30px" type="checkbox" id="schedule_email_later"
                                    name="later">
                                <label class="form-check-label" for="schedule_email_later"></label>
                            </div>
                        </div>
                    </div>
                    <!-- End Item -->
                    <!-- Begin date for late schedule -->
                    <div class="input-group mt-6 pb-10" style="display: none" id="email_settings_schedule_date"
                        data-td-target-input="nearest" data-td-target-toggle="nearest">
                        <input id="kt_td_picker_modal_input" type="text" class="form-control"
                            data-td-target="#email_settings_schedule_date" name="schedule_dt" />
                        <span class="input-group-text" data-td-target="#email_settings_schedule_date"
                            data-td-toggle="datetimepicker">
                            <i class="ki-duotone ki-calendar fs-2"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </span>
                    </div>
                    <!-- End Date Schedule -->
                    <!-- Begin Separator -->
                    <div class="separator separator-dashed my-5"></div>
                    <!-- End Separator -->
                    <!-- Begin File Upload -->
                    <!--begin::Input group-->
                    <div class="form-group row">
                        <!--begin::Col-->
                        <div class="col-lg-10">
                            <!--begin::Attach File-->
                            <input name="email_attach" class="form-control form-control-lg" id="email_attach"
                                type="file">
                            <!--end::Attach Cile-->

                            <!--begin::Hint-->
                            <span class="form-text text-muted">Max file size is 1MB</span>
                            <!--end::Hint-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <div class="form-check form-check-solid fv-row fv-plugins-icon-container mt-10">
                        <input name="ack" class="form-check-input" type="checkbox" value="y" id="ack">
                        <label class="form-check-label fw-semibold ps-2 fs-6" for="ack"><b class="bold text-danger">I confirm</b> that all information is correct and email is ready to be send!</label>
                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div></div>
                </form>
                <!--end::Form-->
                <!-- End File Uploads -->
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save_settings">Save changes</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Submit Form 
        $('.save_settings').click(function(e) {
            //alert('olaaaaa');
            e.preventDefault();

            // //Disable button to avoid multiple click 
            // formSubmitButton.disabled = true;

            // // Show loading indication
            // formSubmitButton.setAttribute('data-kt-indicator', 'on');
            var form = $('#email_settings_form')[0];                                                                                                                                                         
            var form_data = new FormData(form);  

            $.ajax({
                type: "POST",
                url: "/email/set-settings",
                data: form_data, 
                processData: false, // Important: prevent jQuery from processing the data
                contentType: false, 
                success: function(response) {
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Hide loading indication
                    formSubmitButton.removeAttribute('data-kt-indicator');

                    // Enable button
                    formSubmitButton.disabled = false;

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

        });
    </script>


    <script>
        // Date Picker for email settings 
        new tempusDominus.TempusDominus(document.getElementById("email_settings_schedule_date"), {
            localization: {
                locale: "de",
                startOfTheWeek: 1,
                format: "yyyy-MM-dd HH:mm"
            }
        });

        // Hide or show schedule 

        $('#schedule_email_later').on('change', function() {
            if ($(this).is(':checked')) {
                // Show the input field if the checkbox is checked
                $('#email_settings_schedule_date').fadeIn();
            } else {
                // Hide the input field if the checkbox is unchecked
                $('#email_settings_schedule_date').fadeOut();
            }
        });

        // END Schedule hide 

        // BEGIN Submit settings
    </script>
@endpush
