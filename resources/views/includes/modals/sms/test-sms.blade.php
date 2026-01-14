<div class="modal fade" tabindex="-1" id="test_sms_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Test SMS</h3>

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
                            <h4 class="text-gray-900 fw-bold">Pay attention!</h4>
                            <div class="fs-8 text-gray-700">This is for testing only
                                <a class="fw-bold" href="/land">Take me to schedule</a>.
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--begin::Input group-->
                <form class="form" id="test_sms_form" method="POST" action="/test-sms">
                    @csrf
                    <div class="input-group mb-5">
                        <span class="input-group-text" id="basic-addon1">+258</span>
                        <input type="text" class="form-control moz_mask" placeholder="Mobile" aria-label="Mobile"
                            aria-describedby="basic-addon1" name="sms-test-number" id="test-sms1" value="{{ $user->tel1 ?? "-" }}"/>
                    </div>

                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" name="sms-test-text" id="sms-text" maxlength="160"
                            style="min-height: 150px !important; max-height: 150px !important"></textarea>
                        <label for="floatingTextarea2">Type your text here ...</label>
                    </div>
                </form>
            </div>
            <!-- End to -->

            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary send-test-sms">Send</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('.send-test-sms').click(function(e) {
            //alert('olaaaaa');
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form_data = $('#test_sms_form').serialize();
            $.ajax({
                type: "POST",
                url: "send-test-sms",
                data: form_data, // serializes the form's elements.
                success: function(response) {
                    Swal.fire({
                        title: "Good job!",
                        text: response.message,
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500
                    });
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
@endpush
