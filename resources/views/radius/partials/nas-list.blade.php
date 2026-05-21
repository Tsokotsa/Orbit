<div class="p-8">

    <div class="d-flex align-items-center justify-content-between mb-5">

        <div id="radius_users_search"></div>

        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_nas">

            <i class="ki-outline ki-plus fs-5 me-1"></i>

            Add NAS

        </button>

    </div>

    <table class="table align-middle table-row-dashed fs-7 gy-4">

        <thead>

            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                <th>Name</th>

                <th>Short Name</th>

                <th>IP Address</th>

                <th>Type</th>

                <th>Secret</th>

                <th class="text-end">Actions</th>

            </tr>

        </thead>

        <tbody class="text-gray-600 fw-semibold">

            @forelse($nas as $device)
                <tr>

                    {{-- NAME --}}
                    <td>

                        <div class="d-flex flex-column">

                            <span class="text-gray-800 fw-bold fs-7">
                                {{ $device->description }}
                            </span>

                            <span class="text-muted fs-8">
                                NAS Device
                            </span>

                        </div>

                    </td>

                    {{-- SHORTNAME --}}
                    <td>

                        <span class="badge badge-light-primary fs-8">
                            {{ $device->shortname }}
                        </span>

                    </td>

                    {{-- IP --}}
                    <td class="fw-semibold fs-7">

                        {{ $device->nasname }}

                    </td>

                    {{-- TYPE --}}
                    <td>

                        <span class="badge badge-light-info fs-8">
                            {{ $device->type }}
                        </span>

                    </td>

                    {{-- SECRET --}}
                    <td>

                        <span class="text-muted fs-8">
                            ********
                        </span>

                    </td>

                    {{-- ACTIONS --}}
                    <td class="text-end">

                        <button class="btn btn-sm btn-light-primary edit-nas-btn" data-id="{{ $device->id }}"
                            data-name="{{ $device->description }}" data-shortname="{{ $device->shortname }}"
                            data-ip="{{ $device->nasname }}" data-type="{{ $device->type }}"
                            data-secret="{{ $device->secret }}">

                            <i class="ki-outline ki-pencil fs-5 me-1"></i>
                            Edit

                        </button>

                        <button class="btn btn-sm btn-light-danger delete-nas-btn" data-id="{{ $device->id }}">

                            <i class="ki-outline ki-trash fs-5 me-1"></i>
                            Delete

                        </button>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center text-muted py-10">

                        No NAS devices found

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

</div>
