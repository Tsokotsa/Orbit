@extends('layouts.master')

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Layout-->
                    <div class="d-flex flex-column flex-lg-row">
                        <!--begin::Sidebar-->
                        <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
                            <!--begin::Card-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Card body-->
                                <div class="card-body">
                                    <!--begin::Summary-->
                                    <!--begin::User Info-->
                                    <div class="d-flex flex-center flex-column py-5">
                                        <!--begin::Avatar-->
                                        <div class="symbol symbol-100px symbol-circle mb-7">
                                            <img @if ($user?->avatarpath) { src="{{ asset($user?->avatarpath['file_path'] . '/' . $user?->avatarpath['file_name']) }}" } @else { src="{{ asset('assets/media/avatars/blank.png') }}" } @endif
                                                alt="avatar">
                                        </div>
                                        <!--end::Avatar-->
                                        <!--begin::Name-->
                                        <a href="#"
                                            class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3">{{ $user->full_name }}</a>
                                        <!--end::Name-->
                                        <!--begin::Position-->
                                        <div class="mb-9">
                                            <!--begin::Badge-->
                                            <div class="badge badge-lg badge-light-primary d-inline">
                                                {{ $user->roles[0]['name'] ?? 'Role not defined' }}</div>
                                            <!--begin::Badge-->
                                        </div>
                                        <!--end::Position-->
                                        <!--begin::Info-->
                                        <!--begin::Info heading-->
                                        <div class="fw-bold mb-3">Created Campaigns
                                            <span class="ms-2" ddata-bs-toggle="popover" data-bs-trigger="hover"
                                                data-bs-html="true"
                                                data-bs-content="Number of support tickets assigned, closed and pending this week.">
                                                <i class="ki-outline ki-information fs-7"></i>
                                            </span>
                                        </div>
                                        <!--end::Info heading-->
                                        <div class="d-flex flex-wrap flex-center">
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-75px">243</span>
                                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Sms</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mx-4 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-50px">56</span>
                                                    <i class="ki-outline ki-arrow-down fs-3 text-danger"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Telegram</div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div class="border border-gray-300 border-dashed rounded py-3 px-3 mb-3">
                                                <div class="fs-4 fw-bold text-gray-700">
                                                    <span class="w-50px">188</span>
                                                    <i class="ki-outline ki-arrow-up fs-3 text-success"></i>
                                                </div>
                                                <div class="fw-semibold text-muted">Email</div>
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User Info-->
                                    <!--end::Summary-->
                                    <!--begin::Details toggle-->
                                    <div class="d-flex flex-stack fs-4 py-3">
                                        <div class="fw-bold rotate collapsible collapsed" data-bs-toggle="collapse"
                                            href="#kt_user_view_details" role="button" aria-expanded="false"
                                            aria-controls="kt_user_view_details">Details
                                            <span class="ms-2 rotate-180">
                                                <i class="ki-outline ki-down fs-3"></i>
                                            </span>
                                        </div>
                                        <span data-bs-toggle="tooltip" data-bs-trigger="hover"
                                            data-bs-original-title="Edit customer details" data-kt-initialized="1">
                                            <a href="#" class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_update_details">Edit</a>
                                        </span>
                                    </div>
                                    <!--end::Details toggle-->
                                    <div class="separator"></div>
                                    <!--begin::Details content-->
                                    <div id="kt_user_view_details" class="collapse" style="">
                                        <div class="pb-5 fs-6">
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Account ID</div>
                                            <div class="text-gray-600">ID-{{ $user->id }}</div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Email</div>
                                            <div class="text-gray-600">
                                                <a href="#"
                                                    class="text-gray-600 text-hover-primary">{{ $user->email }}</a>
                                            </div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Address</div>
                                            <div class="text-gray-600">{{ $user->address }}
                                                {{-- <br> --}}
                                                <br>Mozambique
                                            </div>
                                            <!--begin::Details item-->
                                            <!--begin::Details item-->
                                            <div class="fw-bold mt-5">Last Login</div>
                                            <div class="text-gray-600">{{ $user->updated_at }}</div>
                                            <!--begin::Details item-->
                                        </div>
                                    </div>
                                    <!--end::Details content-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card-->
                            <!--begin::Connected Accounts-->
                            <div class="card mb-5 mb-xl-8">
                                <!--begin::Card header-->
                                <div class="card-header border-0">
                                    <div class="card-title">
                                        <h3 class="fw-bold m-0">Pending Tasks</h3>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-2">
                                    <!--begin::Notice-->
                                    <div
                                        class="notice d-flex bg-light-primary rounded border-primary border border-dashed mb-9 p-6">
                                        <!--begin::Icon-->
                                        <i class="ki-outline ki-design-1 fs-2tx text-primary me-4"></i>
                                        <!--end::Icon-->
                                        <!--begin::Wrapper-->
                                        <div class="d-flex flex-stack flex-grow-1">
                                            <!--begin::Content-->
                                            <div class="fw-semibold">
                                                <div class="fs-6 text-gray-700">Review and complete your tasks
                                                    <a href="#" class="me-1">emails</a>or
                                                    <a href="#">telegram</a>.
                                                </div>
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Wrapper-->
                                    </div>
                                    <!--end::Notice-->
                                    <!--begin::Items-->
                                    {{-- <div class="py-2">
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <img src="assets/media/svg/brand-logos/google-icon.svg" class="w-30px me-6" alt="">
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Google</a>
                                                <div class="fs-6 fw-semibold text-muted">Plan properly your workflow</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input" name="google" type="checkbox" value="1" id="kt_modal_connected_accounts_google" checked="checked">
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_google"></span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <img src="assets/media/svg/brand-logos/github.svg" class="w-30px me-6" alt="">
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Github</a>
                                                <div class="fs-6 fw-semibold text-muted">Keep eye on on your Repositories</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input" name="github" type="checkbox" value="1" id="kt_modal_connected_accounts_github" checked="checked">
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_github"></span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                    <div class="separator separator-dashed my-5"></div>
                                    <!--begin::Item-->
                                    <div class="d-flex flex-stack">
                                        <div class="d-flex">
                                            <img src="assets/media/svg/brand-logos/slack-icon.svg" class="w-30px me-6" alt="">
                                            <div class="d-flex flex-column">
                                                <a href="#" class="fs-5 text-gray-900 text-hover-primary fw-bold">Slack</a>
                                                <div class="fs-6 fw-semibold text-muted">Integrate Projects Discussions</div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <!--begin::Switch-->
                                            <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                <!--begin::Input-->
                                                <input class="form-check-input" name="slack" type="checkbox" value="1" id="kt_modal_connected_accounts_slack">
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label fw-semibold text-muted" for="kt_modal_connected_accounts_slack"></span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Switch-->
                                        </div>
                                    </div>
                                    <!--end::Item-->
                                </div> --}}
                                    <!--end::Items-->
                                </div>
                                <!--end::Card body-->
                                <!--begin::Card footer-->
                                <div class="card-footer border-0 d-flex justify-content-center pt-0">
                                    <button class="btn btn-sm btn-light-primary">Save Changes</button>
                                </div>
                                <!--end::Card footer-->
                            </div>
                            <!--end::Connected Accounts-->
                        </div>
                        <!--end::Sidebar-->
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid ms-lg-15">
                            <!--begin:::Tabs-->
                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8"
                                role="tablist">
                                <!--begin:::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4 active" data-kt-countup-tabs="true"
                                        data-bs-toggle="tab" href="#kt_user_view_overview_security" data-kt-initialized="1"
                                        aria-selected="false" tabindex="-1" role="tab">Security</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab"
                                        href="#kt_user_view_overview_events_and_logs_tab" aria-selected="false"
                                        tabindex="-1" role="tab">Events &amp; Logs</a>
                                </li>
                                <!--end:::Tab item-->
                                <!--begin:::Tab item-->
                                <li class="nav-item ms-auto">
                                    <!--begin::Action menu-->
                                    <a href="#" class="btn btn-primary ps-7" data-kt-menu-trigger="click"
                                        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">Actions
                                        <i class="ki-outline ki-down fs-2 me-0"></i></a>
                                    <!--begin::Menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold py-4 w-250px fs-6"
                                        data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Payments
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="#" class="menu-link px-5">Create invoice</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="#" class="menu-link flex-stack px-5">Create payments
                                                <span class="ms-2" data-bs-toggle="tooltip"
                                                    aria-label="Specify a target name for future usage and reference"
                                                    data-bs-original-title="Specify a target name for future usage and reference"
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span></a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                            data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title">Subscription</span>
                                                <span class="menu-arrow"></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-5">Apps</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-5">Billing</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-5">Statements</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu separator-->
                                                <div class="separator my-2"></div>
                                                <!--end::Menu separator-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <div class="menu-content px-3">
                                                        <label
                                                            class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input w-30px h-20px" type="checkbox"
                                                                value="" name="notifications" checked="checked"
                                                                id="kt_user_menu_notifications">
                                                            <span class="form-check-label text-muted fs-6"
                                                                for="kt_user_menu_notifications">Notifications</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-3"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <div class="menu-content text-muted pb-2 px-5 fs-7 text-uppercase">Account
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="#" class="menu-link px-5">Reports</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 my-1">
                                            <a href="#" class="menu-link px-5">Account Settings</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="#" class="menu-link text-danger px-5">Delete customer</a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu-->
                                    <!--end::Menu-->
                                </li>
                                <!--end:::Tab item-->
                            </ul>
                            <!--end:::Tabs-->
                            <!--begin:::Tab content-->
                            <div class="tab-content" id="myTabContent">
                                <!--begin:::Tab pane-->
                                <div class="tab-pane fade show active" id="kt_user_view_overview_security"
                                    role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>Profile</h2>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 pb-5">
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed gy-5"
                                                    id="kt_table_users_login_session">
                                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>{{ $user->email }}</td>
                                                            <td class="text-end">
                                                                <button type="button"
                                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_update_email">
                                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Password</td>
                                                            <td>******</td>
                                                            <td class="text-end">
                                                                <button type="button"
                                                                    class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#kt_modal_update_password">
                                                                    <i class="ki-outline ki-pencil fs-3"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Role</td>
                                                            <td>{{ $user->roles[0]['name'] ?? 'Role not defined' }}</td>
                                                            @if ($user->hasRole('Admin'))
                                                                <td class="text-end">
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#kt_modal_update_role">
                                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                                    </button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title flex-column">
                                                <h2 class="mb-1">Two Step Authentication</h2>
                                                <div class="fs-6 fw-semibold text-muted">Keep your account extra secure
                                                    with a second authentication step.</div>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Add-->
                                                <button type="button" class="btn btn-light-primary btn-sm"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    <i class="ki-outline ki-fingerprint-scanning fs-3"></i>Add
                                                    Authentication Step</button>
                                                <!--begin::Menu-->
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-6 w-200px py-4"
                                                    data-kt-menu="true">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_add_auth_app">Use authenticator
                                                            app</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_add_one_time_password">Enable
                                                            one-time password</a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </div>
                                                <!--end::Menu-->
                                                <!--end::Add-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pb-5">
                                            <!--begin::Item-->
                                            <div class="d-flex flex-stack">
                                                <!--begin::Content-->
                                                <div class="d-flex flex-column">
                                                    <span>SMS</span>
                                                    <span class="text-muted fs-6">{{ $user->tel1 }}</span>
                                                </div>
                                                <!--end::Content-->
                                                <!--begin::Action-->
                                                <div class="d-flex justify-content-end align-items-center">
                                                    <!--begin::Button-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto me-5"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_add_one_time_password">
                                                        <i class="ki-outline ki-pencil fs-3"></i>
                                                    </button>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <button type="button"
                                                        class="btn btn-icon btn-active-light-primary w-30px h-30px ms-auto"
                                                        id="kt_users_delete_two_step">
                                                        <i class="ki-outline ki-trash fs-3"></i>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                                <!--end::Action-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin:Separator-->
                                            <div class="separator separator-dashed my-5"></div>
                                            <!--end:Separator-->
                                            <!--begin::Disclaimer-->
                                            <div class="text-gray-600">If you lose your mobile device or security key, you
                                                can
                                                <a href="#" class="me-1">generate a backup code</a>to sign in to
                                                your account.
                                            </div>
                                            <!--end::Disclaimer-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title flex-column">
                                                <h2>Email Notifications</h2>
                                                <div class="fs-6 fw-semibold text-muted">Choose what messages you’d like to
                                                    receive for each of your accounts.</div>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body">
                                            <!--begin::Form-->
                                            <form class="form" id="kt_users_email_notification_form">
                                                <!--begin::Item-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input me-3" name="email_notification_0"
                                                            type="checkbox" value="0"
                                                            id="kt_modal_update_email_notification_0" checked="checked">
                                                        <!--end::Input-->
                                                        <!--begin::Label-->
                                                        <label class="form-check-label"
                                                            for="kt_modal_update_email_notification_0">
                                                            <div class="fw-bold">New Campaigns</div>
                                                            <div class="text-gray-600">Receive notification for any new
                                                                campaign created.</div>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <!--end::Item-->
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--begin::Item-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input me-3" name="email_notification_1"
                                                            type="checkbox" value="1"
                                                            id="kt_modal_update_email_notification_1">
                                                        <!--end::Input-->
                                                        <!--begin::Label-->
                                                        <label class="form-check-label"
                                                            for="kt_modal_update_email_notification_1">
                                                            <div class="fw-bold">New account</div>
                                                            <div class="text-gray-600">If new account is added on the
                                                                system.</div>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <!--end::Item-->
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--begin::Item-->
                                                <div class="d-flex">
                                                    <!--begin::Checkbox-->
                                                    <div class="form-check form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input me-3" name="email_notification_2"
                                                            type="checkbox" value="2"
                                                            id="kt_modal_update_email_notification_2">
                                                        <!--end::Input-->
                                                        <!--begin::Label-->
                                                        <label class="form-check-label"
                                                            for="kt_modal_update_email_notification_2">
                                                            <div class="fw-bold">System notifications</div>
                                                            <div class="text-gray-600">Autommated notifications generated
                                                                by the system.</div>
                                                        </label>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Checkbox-->
                                                </div>
                                                <!--end::Item-->
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--begin::Action buttons-->
                                                <div class="d-flex justify-content-end align-items-center mt-12">
                                                    <!--begin::Button-->
                                                    <button type="button" class="btn btn-light me-5"
                                                        id="kt_users_email_notification_cancel">Cancel</button>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <button type="button" class="btn btn-primary"
                                                        id="kt_users_email_notification_submit">
                                                        <span class="indicator-label">Save</span>
                                                        <span class="indicator-progress">Please wait...
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                                <!--begin::Action buttons-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <!--end::Card footer-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end:::Tab pane-->
                                <!--begin:::Tab pane-->
                                <div class="tab-pane fade" id="kt_user_view_overview_events_and_logs_tab"
                                    role="tabpanel">
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>Login Sessions</h2>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Filter-->
                                                <button type="button" class="btn btn-sm btn-flex btn-light-primary"
                                                    id="kt_modal_sign_out_sesions">
                                                    <i class="ki-outline ki-entrance-right fs-3"></i>Sign out all
                                                    sessions</button>
                                                <!--end::Filter-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0 pb-5">
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed gy-5"
                                                    id="kt_table_users_login_session">
                                                    <thead class="border-bottom border-gray-200 fs-7 fw-bold">
                                                        <tr class="text-start text-muted text-uppercase gs-0">
                                                            <th class="min-w-100px">Location</th>
                                                            <th>Device</th>
                                                            <th>IP Address</th>
                                                            <th class="min-w-125px">Time</th>
                                                            <th class="min-w-70px">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="fs-6 fw-semibold text-gray-600">
                                                        <tr>
                                                            <td>Australia</td>
                                                            <td>Chome - Windows</td>
                                                            <td>207.25.37.19</td>
                                                            <td>23 seconds ago</td>
                                                            <td>Current session</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Australia</td>
                                                            <td>Safari - iOS</td>
                                                            <td>207.50.11.238</td>
                                                            <td>3 days ago</td>
                                                            <td>
                                                                <a href="#"
                                                                    data-kt-users-sign-out="single_user">Sign out</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Australia</td>
                                                            <td>Chrome - Windows</td>
                                                            <td>207.10.15.150</td>
                                                            <td>last week</td>
                                                            <td>Expired</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>Logs</h2>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Button-->
                                                <button type="button" class="btn btn-sm btn-light-primary">
                                                    <i class="ki-outline ki-cloud-download fs-3"></i>Download
                                                    Report</button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body py-0">
                                            <!--begin::Table wrapper-->
                                            <div class="table-responsive">
                                                <!--begin::Table-->
                                                <table
                                                    class="table align-middle table-row-dashed fw-semibold text-gray-600 fs-6 gy-5"
                                                    id="kt_table_users_logs">
                                                    <tbody>
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div class="badge badge-light-success">200 OK</div>
                                                            </td>
                                                            <td>POST /v1/invoices/in_8351_4339/payment</td>
                                                            <td class="pe-0 text-end min-w-200px">10 Nov 2024, 11:30 am
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div class="badge badge-light-success">200 OK</div>
                                                            </td>
                                                            <td>POST /v1/invoices/in_2306_6548/payment</td>
                                                            <td class="pe-0 text-end min-w-200px">10 Nov 2024, 5:30 pm</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div class="badge badge-light-success">200 OK</div>
                                                            </td>
                                                            <td>POST /v1/invoices/in_8351_4339/payment</td>
                                                            <td class="pe-0 text-end min-w-200px">25 Jul 2024, 10:30 am
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div class="badge badge-light-warning">404 WRN</div>
                                                            </td>
                                                            <td>POST /v1/customer/c_66066b6ded385/not_found</td>
                                                            <td class="pe-0 text-end min-w-200px">22 Sep 2024, 10:30 am
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="min-w-70px">
                                                                <div class="badge badge-light-success">200 OK</div>
                                                            </td>
                                                            <td>POST /v1/invoices/in_9241_5864/payment</td>
                                                            <td class="pe-0 text-end min-w-200px">19 Aug 2024, 5:30 pm</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Table wrapper-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                    <!--begin::Card-->
                                    <div class="card pt-4 mb-6 mb-xl-9">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <h2>Events</h2>
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar">
                                                <!--begin::Button-->
                                                <button type="button" class="btn btn-sm btn-light-primary">
                                                    <i class="ki-outline ki-cloud-download fs-3"></i>Download
                                                    Report</button>
                                                <!--end::Button-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body py-0">
                                            <!--begin::Table-->
                                            <table
                                                class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5"
                                                id="kt_table_customers_events">
                                                <tbody>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Brian
                                                                Cox</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#OLP-45690</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2024,
                                                            8:43 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Sean
                                                                Bean</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">25 Jul 2024,
                                                            2:40 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">Invoice
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>status
                                                            has changed from
                                                            <span class="badge badge-light-info me-1">In Progress</span>to
                                                            <span class="badge badge-light-primary">In Transit</span>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">22 Sep 2024,
                                                            2:40 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Sean
                                                                Bean</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2024,
                                                            11:30 am</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">Invoice
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary me-1">#SEP-45656</a>status
                                                            has changed from
                                                            <span class="badge badge-light-warning me-1">Pending</span>to
                                                            <span class="badge badge-light-info">In Progress</span>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">10 Nov 2024,
                                                            5:20 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Max
                                                                Smith</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">24 Jun 2024,
                                                            6:05 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Sean
                                                                Bean</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#XRS-45670</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">21 Feb 2024,
                                                            5:20 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">
                                                            <a href="#"
                                                                class="text-gray-600 text-hover-primary me-1">Max
                                                                Smith</a>has made payment to
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary">#SDK-45670</a>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">21 Feb 2024,
                                                            8:43 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">Invoice
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary me-1">#LOP-45640</a>has
                                                            been
                                                            <span class="badge badge-light-danger">Declined</span>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">20 Jun 2024,
                                                            5:30 pm</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="min-w-400px">Invoice
                                                            <a href="#"
                                                                class="fw-bold text-gray-900 text-hover-primary me-1">#DER-45645</a>status
                                                            has changed from
                                                            <span class="badge badge-light-info me-1">In Progress</span>to
                                                            <span class="badge badge-light-primary">In Transit</span>
                                                        </td>
                                                        <td class="pe-0 text-gray-600 text-end min-w-200px">20 Dec 2024,
                                                            6:05 pm</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end:::Tab pane-->
                            </div>
                            <!--end:::Tab content-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Layout-->
                    <!--begin::Modals-->
                    <!--begin::Modal - Add schedule-->
                    <div class="modal fade" id="kt_modal_add_schedule" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add an Event</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Form-->
                                    <form id="kt_modal_add_schedule_form"
                                        class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold form-label mb-2">Event Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="event_name" value="">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Date &amp; Time</span>
                                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                    data-bs-html="true" data-bs-content="Select a date &amp; time."
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid flatpickr-input"
                                                placeholder="Pick date &amp; time" name="event_datetime"
                                                id="kt_modal_add_schedule_datepicker" type="text" readonly="readonly">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold form-label mb-2">Event
                                                Organiser</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="event_org" value="">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold form-label mb-2">Send Event Details
                                                To</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <tags class="tagify  form-control form-control-solid" tabindex="-1">
                                                <tag title="smith@kpmg.com" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag tagify--noAnim"
                                                    value="smith@kpmg.com">
                                                    <x title="" tabindex="-1" class="tagify__tag__removeBtn"
                                                        role="button" aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">smith@kpmg.com</span></div>
                                                </tag>
                                                <tag title="melody@altbox.com" contenteditable="false" spellcheck="false"
                                                    tabindex="-1" class="tagify__tag tagify--noAnim"
                                                    value="melody@altbox.com">
                                                    <x title="" tabindex="-1" class="tagify__tag__removeBtn"
                                                        role="button" aria-label="remove tag"></x>
                                                    <div><span class="tagify__tag-text">melody@altbox.com</span></div>
                                                </tag><span contenteditable="" tabindex="0" data-placeholder="​"
                                                    aria-placeholder="" class="tagify__input" role="textbox"
                                                    aria-autocomplete="both" aria-multiline="false"></span>
                                                ​
                                            </tags><input id="kt_modal_add_schedule_tagify" type="text"
                                                class="form-control form-control-solid" name="event_invitees"
                                                value="smith@kpmg.com, melody@altbox.com" tabindex="-1">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-kt-users-modal-action="cancel">Discard</button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-users-modal-action="submit">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - Add schedule-->
                    <!--begin::Modal - Add task-->
                    <div class="modal fade" id="kt_modal_add_task" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add a Task</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Form-->
                                    <form id="kt_modal_add_task_form"
                                        class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="required fs-6 fw-semibold form-label mb-2">Task Name</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="task_name" value="">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Task Due Date</span>
                                                <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover"
                                                    data-bs-html="true" data-bs-content="Select a due date."
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input class="form-control form-control-solid flatpickr-input"
                                                placeholder="Pick date" name="task_duedate"
                                                id="kt_modal_add_task_datepicker" type="text" readonly="readonly">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">Task Description</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <textarea class="form-control form-control-solid rounded-3"></textarea>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-kt-users-modal-action="cancel">Discard</button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-users-modal-action="submit">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - Add task-->

                    <!-- MOdals Included -->
                    @include('user.modals.update-email')
                    @include('user.modals.update-password')
                    @include('user.modals.update-role')
                    @include('user.modals.update-user-details')
                    <!-- End of Modal Includes -->
                    <!--begin::Modal - Add task-->
                    <div class="modal fade" id="kt_modal_add_auth_app" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Add Authenticator App</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Content-->
                                    <div class="fw-bold d-flex flex-column justify-content-center mb-5">
                                        <!--begin::Label-->
                                        <div class="text-center mb-5" data-kt-add-auth-action="qr-code-label">Download the
                                            <a href="#">Authenticator app</a>, add a new account, then scan this
                                            barcode to set up your account.
                                        </div>
                                        <div class="text-center mb-5 d-none" data-kt-add-auth-action="text-code-label">
                                            Download the
                                            <a href="#">Authenticator app</a>, add a new account, then enter this
                                            code to set up your account.
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::QR code-->
                                        <div class="d-flex flex-center" data-kt-add-auth-action="qr-code">
                                            <img src="assets/media/misc/qr.png" alt="Scan this QR code">
                                        </div>
                                        <!--end::QR code-->
                                        <!--begin::Text code-->
                                        <div class="border rounded p-5 d-flex flex-center d-none"
                                            data-kt-add-auth-action="text-code">
                                            <div class="fs-1">gi2kdnb54is709j</div>
                                        </div>
                                        <!--end::Text code-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Action-->
                                    <div class="d-flex flex-center">
                                        <div class="btn btn-light-primary" data-kt-add-auth-action="text-code-button">
                                            Enter code manually</div>
                                        <div class="btn btn-light-primary d-none"
                                            data-kt-add-auth-action="qr-code-button">Scan barcode instead</div>
                                    </div>
                                    <!--end::Action-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - Add task-->
                    <!--begin::Modal - Add task-->
                    <div class="modal fade" id="kt_modal_add_one_time_password" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content">
                                <!--begin::Modal header-->
                                <div class="modal-header">
                                    <!--begin::Modal title-->
                                    <h2 class="fw-bold">Enable One Time Password</h2>
                                    <!--end::Modal title-->
                                    <!--begin::Close-->
                                    <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                        data-kt-users-modal-action="close">
                                        <i class="ki-outline ki-cross fs-1"></i>
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Modal header-->
                                <!--begin::Modal body-->
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <!--begin::Form-->
                                    <form class="form fv-plugins-bootstrap5 fv-plugins-framework"
                                        id="kt_modal_add_one_time_password_form">
                                        <!--begin::Label-->
                                        <div class="fw-bold mb-9">Enter the new phone number to receive an SMS to when you
                                            log in.</div>
                                        <!--end::Label-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Mobile number</span>
                                                <span class="ms-2" data-bs-toggle="tooltip"
                                                    aria-label="A valid mobile number is required to receive the one-time password to validate your account login."
                                                    data-bs-original-title="A valid mobile number is required to receive the one-time password to validate your account login."
                                                    data-kt-initialized="1">
                                                    <i class="ki-outline ki-information fs-7"></i>
                                                </span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control form-control-solid"
                                                name="otp_mobile_number" placeholder="+6123 456 789" value="">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Separator-->
                                        <div class="separator saperator-dashed my-5"></div>
                                        <!--end::Separator-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Email</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" class="form-control form-control-solid"
                                                name="otp_email" value="smith@kpmg.com" readonly="readonly">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="fv-row mb-7 fv-plugins-icon-container">
                                            <!--begin::Label-->
                                            <label class="fs-6 fw-semibold form-label mb-2">
                                                <span class="required">Confirm password</span>
                                            </label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" class="form-control form-control-solid"
                                                name="otp_confirm_password" value="">
                                            <!--end::Input-->
                                            <div
                                                class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                            </div>
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Actions-->
                                        <div class="text-center pt-15">
                                            <button type="reset" class="btn btn-light me-3"
                                                data-kt-users-modal-action="cancel">Cancel</button>
                                            <button type="submit" class="btn btn-primary"
                                                data-kt-users-modal-action="submit">
                                                <span class="indicator-label">Submit</span>
                                                <span class="indicator-progress">Please wait...
                                                    <span
                                                        class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                    <!--end::Modal - Add task-->
                    <!--end::Modals-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
    </div>
@endsection
