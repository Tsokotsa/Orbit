<div class="table-responsive">
    <table class="table table-hover align-middle services-table">
        <thead class="bg-light-primary">
            <tr>
                <th colspan="6" class="text-center text-primary fw-bold py-4">
                    <i class="{{ $services->first()->icon ?? '' }}"></i>
                   {{ Str::ucfirst($services->first()?->table_identifier ?? '') }}
                    Services
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
                    <td>
                        <span class="badge-speed">{{ $service->d_speed }} / {{ $service->u_speed }}</span>
                    </td>
                    <td>{{ $service->profile }}</td>
                    <td>
                        <span class="sn-box">2220010101</span>
                    </td>
                    <td>
                        <span class="badge badge-light-danger">No</span>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-light-primary action-btn">
                            <i class="bi bi-eye"></i>
                        </button>
                        <button class="btn btn-sm btn-light-warning action-btn">
                            <i class="bi bi-pencil"></i>
                        </button>
                    </td>
                </tr>
            @empty
        <tfoot>
            <tr>
                <th colspan="6" class="text-center">
                    <div class="text-muted">No services found on planet earth ...</div>

                    <div class="m-6">
                        <a href="#" class="btn btn-primary er fs-6 px-8 py-1" data-bs-toggle="modal"
                            data-bs-target="#add_services_modal">Add Service</a>
                    </div>
                </th>
            </tr>
        </tfoot>
        @endforelse
        </tbody>
    </table>
</div>
