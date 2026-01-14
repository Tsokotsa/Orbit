@extends('layouts.master')

@section('content')
    <div id="kt_app_content" class="app-content flex-column-fluid">

        <div id="kt_app_content_container" class="app-container container-fluid">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i>
                            <input type="text" data-kt-user-table-filter="search"
                                class="form-control form-control-solid w-250px ps-13" placeholder="Search user">
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">

                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body py-4">
                    <!--begin::Table-->
                    <table id="list_emails_dt" class="table align-middle table-row-dashed fs-6 gy-5 dataTable">
                        {{-- <th>
                        <td>Title</td>
                        <td>Type</td>
                        <td>Preview Before</td>
                        <td>Status</td>
                        <td>Created Date</td>
                    </th> --}}
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0" role="row">
                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="1" rowspan="1"
                                    colspan="1" aria-label="User: Activate to sort" tabindex="0">
                                    <span class="dt-column-title" role="button">Title</span>
                                    <span class="dt-column-order"></span>
                                </th>
                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="2" rowspan="1"
                                    colspan="1" aria-label="Role: Activate to sort" tabindex="0">
                                    <span class="dt-column-title" role="button">Type</span>
                                    <span class="dt-column-order"></span>
                                </th>
                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="3" rowspan="1"
                                    colspan="1" aria-label="Last login: Activate to sort" tabindex="0">
                                    <span class="dt-column-title" role="button">Settings</span><span
                                        class="dt-column-order"></span>
                                </th>
                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="4" rowspan="1"
                                    colspan="1" aria-label="Two-step: Activate to sort" tabindex="0">
                                    <span class="dt-column-title" role="button">Status</span>
                                    <span class="dt-column-order"></span>
                                </th>
                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="5" rowspan="1"
                                    colspan="1" aria-label="Joined Date: Activate to sort" tabindex="0">
                                    <span lass="dt-column-title" role="button">Created Date</span>
                                    <span class="dt-column-order"></span>
                                </th>
                                <th class="text-end min-w-100px dt-orderable-none" data-dt-column="6" rowspan="1"
                                    colspan="1" aria-label="Actions"><span class="dt-column-title">Actions</span>
                                    <span class="dt-column-order"></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campaigns as $campaign)
                                <tr>
                                    <td>
                                        {{ $campaign->name }}
                                    </td>
                                    <td>
                                        <?php if ($campaign->type_id == 1) {
                                            echo 'E-Mail';
                                        } ?>
                                    </td>
                                    <td>
                                        <span class="badge badge-dark">Send all</span>
                                        <span class="badge badge-info">Internal Users</span>
                                        <span class="badge badge-success">Preview</span>
                                    </td>
                                    <td>
                                        <span class="badge <?php switch ($campaign->status) {
                                            case 'Canceled':
                                                echo 'badge-danger';
                                                break;
                                            case 'Processed':
                                                echo 'badge-warning';
                                                break;
                                        
                                            default:
                                                echo 'badge-info';
                                                break;
                                        } ?>">{{ $campaign->status }}</span>
                                    </td>
                                    <td>
                                        {{ $campaign->created_at }}
                                    </td>
                                    <td>
                                        <div class="actions float-end">
                                            <meta name="csrf-token" content="{{ csrf_token() }}">
                                            <a href="/email/1/compose-email"><i class="fa-regular fa-eye fs-4 text-dark"
                                                    style="cursor: pointer;"></i></a>
                                            <i class="fa fa-gear fs-4 text-dark" style="cursor: pointer;"
                                                data-bs-toggle="modal" data-bs-target="#compose-settings"></i>
                                            <i class="fa fa-square-xmark text-danger fs-4 cancel-email"
                                                id={{ $campaign->id }} style="cursor: pointer;"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>

    </div>
    @isset($campaign)
        @include('email.modals.compose-settings')
    @endisset
@endsection

@push('scripts')
    <script>
        $("#list_emails_dt").DataTable();

        // Cancell Email Campaign
        $(".cancel-email").click(function(e) {
            const cid = document.querySelector('.cancel-email').id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to cancel Campaign?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, cancel it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-light"
                }
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        processData: false, // Important!
                        url: "/campaign/cancel",
                        //data: form_data + '&user-avatar=' + avatar, // serializes the form's elements.
                        headers: {
                            'X-CSRF-TOKEN': csrfToken // Pass the CSRF token in the headers
                        },
                        contentType: 'application/json', // Specify that you're sending JSON
                        data: JSON.stringify({
                            campaign_id: cid // Send the key-value pair as a JSON string
                        }),
                        cache: false,
                        success: function(response) {
                            Swal.fire({
                                title: "Wooohooo!",
                                text: response.message,
                                icon: "success",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            submitButton.removeAttribute('data-kt-indicator');
                            submitButton.disabled = false;
                            modal.hide();
                            form.reset();
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
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Campaign was not canceled.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, I know!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
        });
    </script>
@endpush
