<div class="table-responsive pt-9 pb-0 px-0">
    <table class="table table-hover align-middle w-100 services-table">
        <thead class="bg-light-primary">
            <tr>
                <th colspan="6" class="text-center text-primary fw-bold py-3 px-0">
                    <i class="{{ $services->first()->icon ?? '' }}"></i>
                    {{ Str::ucfirst($services->first()?->table_identifier ?? '') }} Services
                </th>
            </tr>
            <tr class="fw-semibold text-gray-700">
                <th>Package</th>
                <th>Speed</th>
                <th>Profile</th>
                <th>Line Tag</th>
                <th>Status</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            {{-- {{ dd($services) }} --}}
            @forelse ($services as $service)
                <tr>
                    <td class="fw-bold p-0">{{ $service->service_name }}</td>
                    <td><span class="badge-speed">{{ $service->d_speed }} / {{ $service->u_speed }}</span></td>
                    <td>{{ $service->profile }}</td>
                    <td><span class="sn-box"> {{ $service->service_id }} </span></td>
                    <td><span
                            class="badge {{ $service->status == 'active' ? 'badge-light-success' : ($service->status == 'suspended' ? 'badge-light-danger' : 'badge-light-warning') }}">
                            {{ ucfirst($service->status) }}</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-light-primary action-btn view-service"
                            data-id="{{ $service->id }}" data-servicetable="{{ $table }}"><i
                                class="bi bi-eye"></i></button>
                        <button class="btn btn-sm btn-light-warning action-btn"><i class="bi bi-pencil"></i></button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-6">
                        <i class="bi bi-lightning-charge-fill fs-2x text-muted mb-4"></i>
                        <div class="fw-semibold fs-5 text-gray-700 mb-2">No Services found</div>
                        <div class="text-gray-500 mb-6">There are no linked services on Earth!</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@include('clients.services.modals.view-fiber')

@push('scripts')
    <script>
        $('.service-attributes-submit').click(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Show confirmation first
            Swal.fire({
                text: "Are you sure you want to update attributes?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, add it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-success",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    // User confirmed → proceed with AJAX
                    var form_data = $('#add_asset_form').serialize();

                    $.ajax({
                        type: "POST",
                        url: "/client/service/update-attr",
                        data: form_data,
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
                            let responseJson = {};
                            try {
                                responseJson = JSON.parse(xhr.responseText);
                            } catch (e) {
                                responseJson.message = "Something went wrong";
                            }

                            let errorMessage = responseJson.message || "Something went wrong";

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
                                title: "Error: " + errorMessage
                            });
                        }
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User cancelled
                    Swal.fire({
                        text: "Attributes not added.",
                        icon: "info",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            });
        });
    </script>

    <script>
        $('.service-attributes-submit').click(function(e) {
            alert('olaaaaa');
            e.preventDefault(); // Prevent default form submission

            // Show confirmation first
            Swal.fire({
                text: "Are you sure you want to update attributes?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, add it!",
                cancelButtonText: "No, cancel",
                customClass: {
                    confirmButton: "btn fw-bold btn-success",
                    cancelButton: "btn fw-bold btn-active-light-primary"
                }
            }).then(function(result) {
                if (result.isConfirmed) {
                    // User confirmed → proceed with AJAX
                    var form_data = $('#add_asset_form').serialize();

                    $.ajax({
                        type: "POST",
                        url: "/client/service/update-attr",
                        data: form_data,
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
                            let responseJson = {};
                            try {
                                responseJson = JSON.parse(xhr.responseText);
                            } catch (e) {
                                responseJson.message = "Something went wrong";
                            }

                            let errorMessage = responseJson.message ||
                                "Something went wrong";

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal
                                        .resumeTimer;
                                }
                            });

                            Toast.fire({
                                icon: "error",
                                title: "Error: " + errorMessage
                            });
                        }
                    });

                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // User cancelled
                    Swal.fire({
                        text: "Attributes not added.",
                        icon: "info",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn fw-bold btn-primary"
                        }
                    });
                }
            });
        });
    </script>
@endpush
