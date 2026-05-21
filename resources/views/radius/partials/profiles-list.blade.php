<div class="p-8">

    <div class="d-flex align-items-center justify-content-between mb-5">

        <div id="profiles_search"></div>

        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_profile">

            <i class="ki-outline ki-plus fs-5 me-1"></i>
            Add Profile

        </button>

    </div>

    <table class="table align-middle table-row-dashed fs-7 gy-4" id="profiles_table">

        <thead>
            <tr class="text-muted fw-bold fs-7 text-uppercase">
                <th>Profile Name</th>
                <th>Users</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>

        <tbody class="fw-semibold text-gray-700">

            @forelse($profiles as $profile)
                <tr>

                    <td>
                        <div class="fw-bold text-gray-900">
                            {{ $profile->groupname }}
                        </div>
                    </td>

                    <td>
                        <span class="badge badge-light-primary">
                            {{ $profile->users_count }}
                        </span>
                    </td>

                    <td class="text-end">

                        <button class="btn btn-sm btn-light-primary edit-profile-btn"
                            data-group="{{ $profile->groupname }}">

                            <i class="ki-outline ki-pencil fs-5 me-1"></i>
                            Edit
                        </button>

                        <button class="btn btn-sm btn-light-danger delete-profile-btn"
                            data-group="{{ $profile->groupname }}">

                            <i class="ki-outline ki-trash fs-5 me-1"></i>
                            Delete
                        </button>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="3" class="text-center text-muted py-10">
                        No profiles found
                    </td>
                </tr>
            @endforelse

        </tbody>

    </table>

</div>
