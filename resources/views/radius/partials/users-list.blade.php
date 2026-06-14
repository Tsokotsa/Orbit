<div class="p-8">

    {{-- TOP BAR: SEARCH LEFT + ADD BUTTON RIGHT --}}
    <div class="d-flex justify-content-between align-items-center mb-5">

        {{-- SEARCH (LEFT) --}}
        <div id="radius_users_search"></div>

        {{-- ADD BUTTON (RIGHT) --}}
        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">

            <i class="ki-outline ki-plus fs-5 me-1"></i>
            Add User

        </button>

    </div>

    {{-- TABLE --}}
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_radius_users_table">

        <thead>
            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">

                <th>Username</th>
                <th>Profile</th>
                <th>Session</th>
                <th class="text-end">Actions</th>

            </tr>
        </thead>

        <tbody class="text-gray-700 fw-semibold">

            @forelse($users as $radiusUser)
                <tr>

                    {{-- USERNAME --}}
                    <td class="min-w-250px">

                        <div class="d-flex flex-column">

                            <span class="text-gray-900 fw-bold fs-7">
                                {{ $radiusUser->username }}
                            </span>

                            <div class="d-flex align-items-center mt-1">

                                @if ($radiusUser->status == 'online')
                                    <span class="bullet bullet-dot bg-success me-2 h-8px w-8px"></span>
                                    <span class="text-success fs-8">Online</span>
                                @else
                                    <span class="bullet bullet-dot bg-danger me-2 h-8px w-8px"></span>
                                    <span class="text-danger fs-8">Offline</span>
                                @endif

                            </div>

                        </div>

                    </td>

                    {{-- PROFILE --}}
                    <td>
                        <span class="badge badge-light-primary fs-9 fw-semibold">
                            {{ $radiusUser->profile ?? 'N/A' }}
                        </span>
                    </td>

                    {{-- SESSION --}}
                    <td class="min-w-250px">
                        @if ($radiusUser->status == 'online')
                            <div class="bg-light-success rounded px-3 py-2">
                                <div class="text-success fw-bold fs-8 mb-1">
                                    Online
                                </div>

                                <div class="fs-8 text-gray-700">
                                    {{ $radiusUser->framedipaddress ?? '-' }}
                                    <span class="mx-2 text-muted">|</span>
                                    {{ $radiusUser->callingstationid ?? '-' }}
                                </div>
                            </div>
                        @else
                            <span class="badge badge-light-secondary">
                                No Active Session
                            </span>
                        @endif
                    </td>
                    {{-- ACTION --}}
                    <td class="text-end">

                        <button type="button" class="btn btn-sm btn-light-primary edit-user-btn"
                            data-username="{{ $radiusUser->username }}">
                            Edit
                        </button>

                        <button type="button" class="btn btn-sm btn-light-danger delete-user-btn"
                            data-username="{{ $radiusUser->username }}">
                            Delete
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
@push('scripts')
    <script>
        function initRadiusUsersDatatable() {

            /*
            |--------------------------------------------------------------------------
            | DESTROY IF EXISTS
            |--------------------------------------------------------------------------
            */
            if ($.fn.DataTable.isDataTable('#kt_radius_users_table')) {

                $('#kt_radius_users_table').DataTable().destroy();

            }

            /*
            |--------------------------------------------------------------------------
            | INIT
            |--------------------------------------------------------------------------
            */
            let table = $('#kt_radius_users_table').DataTable({

                pageLength: 5,

                lengthChange: false,

                info: true,

                ordering: false,

                responsive: true,

                dom: "<'table-responsive'tr>" +
                    "<'d-flex justify-content-between align-items-center mt-5'ip>",

                language: {

                    emptyTable: "No Radius users found",

                    paginate: {
                        previous: "Prev",
                        next: "Next"
                    }

                }

            });

            /*
            |--------------------------------------------------------------------------
            | SEARCH
            |--------------------------------------------------------------------------
            */
            $('#kt_radius_users_search').off('keyup').on('keyup', function() {

                table.search(this.value).draw();

            });

            /*
            |--------------------------------------------------------------------------
            | LENGTH
            |--------------------------------------------------------------------------
            */
            $('#kt_radius_users_length').off('change').on('change', function() {

                table.page.len($(this).val()).draw();

            });

        }

        /*
        |--------------------------------------------------------------------------
        | INITIAL LOAD
        |--------------------------------------------------------------------------
        */
        $(document).ready(function() {

            initRadiusUsersDatatable();

        });
    </script>
@endpush
