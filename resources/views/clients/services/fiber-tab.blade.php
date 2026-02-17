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
                <th>Public IP</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @forelse ($services as $service)
                <tr>
                    <td class="fw-bold p-0">{{ $service->name }}</td>
                    <td><span class="badge-speed">{{ $service->d_speed }} / {{ $service->u_speed }}</span></td>
                    <td>{{ $service->profile }}</td>
                    <td><span class="sn-box">2220010101</span></td>
                    <td><span class="badge badge-light-danger">No</span></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-light-primary action-btn"><i class="bi bi-eye"></i></button>
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
