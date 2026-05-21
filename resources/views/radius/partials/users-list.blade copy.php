<div class="card card-flush shadow-sm">

    <div class="card-header pt-7">

        <div class="card-title">

            <h2>
                Radius Users
            </h2>

        </div>

    </div>

    <div class="card-body pt-0">

        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_radius_users_table">

            <thead>

                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                    <th>Username</th>

                    <th>Profile</th>

                    <th>Session</th>

                    <th class="text-end">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody class="text-gray-600 fw-semibold">

                @forelse($users as $radiusUser)
                    <tr>

                        <!-- USERNAME -->
                        <td class="min-w-250px">

                            <div class="d-flex flex-column">

                                <span class="text-gray-900 fw-bold fs-8">

                                    {{ $radiusUser->username }}

                                </span>

                                @if ($radiusUser->status == 'online')
                                    <div class="d-flex align-items-center mt-1">

                                        <span class="bullet bullet-dot bg-success me-2 h-8px w-8px"></span>

                                        <span class="text-success fs-8 fw-semibold">

                                            Online

                                        </span>

                                    </div>
                                @else
                                    <div class="d-flex align-items-center mt-1">

                                        <span class="bullet bullet-dot bg-danger me-2 h-8px w-8px"></span>

                                        <span class="text-danger fs-8 fw-semibold">

                                            Offline

                                        </span>

                                    </div>
                                @endif

                            </div>

                        </td>

                        <!-- PROFILE -->
                        <td>

                            <span class="badge badge-light-primary fs-9 fw-medium px-2 py-2">

                                {{ $radiusUser->profile ?? 'N/A' }}

                            </span>

                        </td>
                        <!-- SESSION -->
                        <td class="min-w-300px">

                            @if ($radiusUser->status == 'online')
                                <div class="bg-light-success rounded p-3">

                                    <div class="fs-7 fw-bold text-success mb-2">

                                        Active Session

                                    </div>

                                    <div class="fs-8 text-gray-700">

                                        IP:
                                        {{ $radiusUser->framedipaddress ?? '-' }}

                                    </div>

                                    <div class="fs-8 text-gray-700">

                                        MAC:
                                        {{ $radiusUser->callingstationid ?? '-' }}

                                    </div>

                                    <div class="fs-8 text-gray-700">

                                        NAS:
                                        {{ $radiusUser->nasipaddress ?? '-' }}

                                    </div>

                                </div>
                            @else
                                <div class="bg-light-danger rounded p-3">

                                    <span class="text-danger fs-8 fw-semibold">

                                        No Active Session

                                    </span>

                                </div>
                            @endif

                        </td>

                        <!-- ACTION -->
                        <td class="text-end">

                            <button class="btn btn-sm btn-light device-action edit-user-btn"
                                data-username="{{ $radiusUser->username }}" data-profile="{{ $radiusUser->profile }}"
                                data-framedip="{{ $radiusUser->framed_ip }}"
                                data-suspended="{{ $radiusUser->auth_type === 'Reject' ? 1 : 0 }}">

                                Edit
                            </button>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center text-muted py-15">

                            No Radius users found

                        </td>

                    </tr>
                @endforelse

            </tbody>

        </table>

    </div>

</div>
