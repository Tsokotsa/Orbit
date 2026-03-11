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


<div class="modal fade" id="serviceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Service Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body" id="serviceModalBody">
                <div class="text-center p-5">
                    Loading in Earth ...
                </div>
            </div>

        </div>
    </div>
</div>
