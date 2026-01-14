@section('styles')
<style>
/*.quill > .ql-toolbar:first-child { */
.ql-toolbar:first-child {
  display: none !important;
}
</style>
@endsection

<div class="modal fade modal-xl" tabindex="-1" id="test_email_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Test E-mail</h3>

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

                <form id="kt_inbox_compose_form"> 
                    <!--begin::Body-->
                    <div class="d-block">
                        <!--begin::To-->
                        <div class="d-flex align-items-center border-bottom px-8">
                            <!--begin::Label-->
                            <div class="text-gray-900 fw-bold w-75px">To:</div>
                            <!--end::Label-->
                            <!--begin::Input-->
                                <input type="text" class="form-control form-control-transparent border-0"
                                name="compose_to" value="" data-kt-inbox-form="tagify" tabindex="-1">
                            <!--end::Input-->
                            <!--begin::CC & BCC buttons-->
                            <div class="ms-auto w-75px text-end">
                                <span class="text-muted fs-bold cursor-pointer text-hover-primary me-2"
                                    data-kt-inbox-form="cc_button">Cc</span>
                                <span class="text-muted fs-bold cursor-pointer text-hover-primary"
                                    data-kt-inbox-form="bcc_button">Bcc</span>
                            </div>
                            <!--end::CC & BCC buttons-->
                        </div>
                        <!--end::To-->
                        <!--begin::CC-->
                        <div class="align-items-center border-bottom ps-8 pe-5 min-h-50px d-none"
                            data-kt-inbox-form="cc">
                            <!--begin::Label-->
                            <div class="text-gray-900 fw-bold w-75px">Cc:</div>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <tags
                                class="tagify form-control form-control-transparent border-0 tagify--noTags tagify--empty"
                                tabindex="-1">
                                <span contenteditable="" tabindex="0" data-placeholder="​" aria-placeholder=""
                                    class="tagify__input" role="textbox" aria-autocomplete="both"
                                    aria-multiline="false"></span>
                                ​
                            </tags><input type="text" class="form-control form-control-transparent border-0"
                                name="compose_cc" value="" data-kt-inbox-form="tagify" tabindex="-1">
                            <!--end::Input-->
                            <!--begin::Close-->
                            <span class="btn btn-clean btn-xs btn-icon" data-kt-inbox-form="cc_close">
                                <i class="ki-outline ki-cross fs-5"></i>
                            </span>
                            <!--end::Close-->
                        </div>
                        <!--end::CC-->
                        <!--begin::BCC-->
                        <div class="align-items-center border-bottom inbox-to-bcc ps-8 pe-5 min-h-50px d-none"
                            data-kt-inbox-form="bcc">
                            <!--begin::Label-->
                            <div class="text-gray-900 fw-bold w-75px">Bcc:</div>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <tags
                                class="tagify form-control form-control-transparent border-0 tagify--noTags tagify--empty"
                                tabindex="-1">
                                <span contenteditable="" tabindex="0" data-placeholder="​" aria-placeholder=""
                                    class="tagify__input" role="textbox" aria-autocomplete="both"
                                    aria-multiline="false"></span>
                                ​
                            </tags><input type="text" class="form-control form-control-transparent border-0"
                                name="compose_bcc" value="" data-kt-inbox-form="tagify" tabindex="-1">
                            <!--end::Input-->
                            <!--begin::Close-->
                            <span class="btn btn-clean btn-xs btn-icon" data-kt-inbox-form="bcc_close">
                                <i class="ki-outline ki-cross fs-5"></i>
                            </span>
                            <!--end::Close-->
                        </div>
                        <!--end::BCC-->
                        <!--begin::Subject-->
                        <div class="border-bottom">
                            <input class="form-control form-control-transparent border-0 px-8 min-h-45px"
                                name="compose_subject" placeholder="Subject">
                        </div>
                        <!--end::Subject-->
                        <!--begin::Message-->
                        
                           
                                
                        <div id="test-email-editor"
                            class="bg-transparent border-0 h-350px px-3 ql-container ql-snow">
                            <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true"
                                data-placeholder="Type your text here...">
                                <p><br></p>
                            </div>
                            <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                            <div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer"
                                    target="_blank" href="about:blank"></a><input type="text"
                                    data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a
                                    class="ql-action"></a><a class="ql-remove"></a></div>
                        </div>
                        <!--end::Message-->
                        <!--begin::Attachments-->
                        <div class="dropzone dropzone-queue px-8 py-4" id="kt_inbox_reply_attachments"
                            data-kt-inbox-form="dropzone">
                            <div class="dropzone-items">

                            </div>
                            <div class="dz-default dz-message"><button class="dz-button" type="button">Drop files
                                    here to upload</button></div>
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
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
                                id="kt_inbox_reply_attachments_select" data-kt-inbox-form="dropzone_upload">
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
                                data-toggle="tooltip" title="More actions">
                                <i class="ki-outline ki-setting-2 fs-2"></i>
                            </span>
                            <!--end::More actions-->
                            <!--begin::Dismiss reply-->
                            <span class="btn btn-icon btn-sm btn-clean btn-active-light-primary" data-inbox="dismiss"
                                data-toggle="tooltip" title="Dismiss reply">
                                <i class="ki-outline ki-trash fs-2"></i>
                            </span>
                            <!--end::Dismiss reply-->
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Footer-->
                </form>

            </div>
            <!-- End to -->
        </div>
    </div>
</div>