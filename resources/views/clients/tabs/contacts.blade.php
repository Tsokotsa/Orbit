<div class="row g-5">

    @forelse ($contacts as $contact)
        <div class="col-md-4">

            <div class="card card-bordered h-100">
                <div class="card-header ribbon ribbon-start ribbon-clip">
                    <div class="ribbon-label">
                        {{ $contact->name ?? 'Contact' }}
                        <span class="ribbon-inner bg-primary"></span>
                    </div>

                    <div class="card-title">

                    </div>
                </div>

                <div class="card-body d-flex flex-column gap-3">

                    <!-- Cell -->
                    <div class="d-flex align-items-center">
                        <i class="bi bi-telephone-fill text-primary fs-5 me-3"></i>
                        <span class="fw-semibold text-gray-700 me-1">Cell:</span>
                        <span class="text-gray-600">
                            {{ $contact->mobile ?? '—' }}
                        </span>
                    </div>

                    <!-- Email -->
                    <div class="d-flex align-items-center">
                        <i class="bi bi-envelope-fill text-primary fs-5 me-3"></i>
                        <span class="fw-semibold text-gray-700 me-1">Email:</span>
                        <span class="text-gray-600 text-break">
                            {{ $contact->email ?? '—' }}
                        </span>
                    </div>

                    <!-- Address -->
                    <div class="d-flex align-items-start">
                        <i class="bi bi-geo-alt-fill text-primary fs-5 me-3 mt-1"></i>
                        <div>
                            <span class="fw-semibold text-gray-700">Address:</span>
                            <span class="text-gray-600 text-break">
                                {{ $contact->street ?? '—' }} - {{ $contact->city ?? '' }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    @empty

        <div class="col-12">
            <div class="card card-bordered">
                <div class="card-body text-center py-10">
                    <i class="bi bi-person-plus fs-2x text-muted mb-4"></i>

                    <div class="fw-semibold fs-5 text-gray-700 mb-2">
                        No contacts found
                    </div>

                    <div class="text-gray-500 mb-6">
                        This account does not have any contacts yet.
                    </div>

                    <a href="/client/contact" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Contact
                    </a>
                </div>
            </div>
        </div>
    @endforelse

</div>
