<style>
    .fritzbox-table {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    .fritzbox-table thead th {
        vertical-align: middle;
        text-align: center;
    }

    .fritzbox-table thead tr:first-child th {
        font-size: 1.1rem;
        letter-spacing: 0.5px;
    }

    .fritzbox-table tbody tr {
        transition: all 0.2s ease-in-out;
    }

    .fritzbox-table tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.05);
        transform: scale(1.005);
    }

    .fritzbox-table td {
        vertical-align: middle;
        font-weight: 500;
    }

    .badge-speed {
        background: linear-gradient(135deg, #0d6efd, #4dabf7);
        color: #fff;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.85rem;
    }

    .sn-box {
        font-family: monospace;
        background: #f8f9fa;
        padding: 6px 10px;
        border-radius: 6px;
        display: inline-block;
    }

    .action-btn {
        border-radius: 20px;
        padding: 4px 14px;
    }
</style>

<div class="table-responsive">
    <table class="table table-hover align-middle fritzbox-table">
        <thead class="bg-light-primary">
            <tr>
                <th colspan="6" class="text-center text-primary fw-bold py-4">
                    <i class="bi bi-router me-2"></i> Services
                </th>
            </tr>
            <tr class="fw-semibold text-gray-700">
                <th>Package</th>
                <th>Speed</th>
                <th>Profile</th>
                <th>Device SN</th>
                <th>Public IP</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody class="text-center">
            @foreach ($services_fiber as $service )
            <tr>
                <td class="fw-bold p-0">{{ $service->name }}</td>
                <td>
                    <span class="badge-speed">{{ $service->d_speed }}  / {{ $service->u_speed }}</span>
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
            @endforeach
        </tbody>
    </table>
</div>
