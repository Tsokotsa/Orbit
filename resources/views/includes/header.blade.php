  <!--begin::Header-->
  <div id="kt_app_header" class="app-header d-flex">
      <!--begin::Header container-->
      <div class="app-container container-fluid d-flex align-items-center justify-content-between"
          id="kt_app_header_container">
          <!--begin::Logo-->
          <div class="app-header-logo d-flex flex-center">
              <!--begin::Logo image-->
              <a href="/land">
                  <img alt="Logo" src="assets/media/logos/Paratus_P_Only.png" class="mh-25px" />
              </a>
              <!--end::Logo image-->
              <!--begin::Sidebar toggle-->
              <button class="btn btn-icon btn-sm btn-active-color-primary d-flex d-lg-none"
                  id="kt_app_sidebar_mobile_toggle">
                  <i class="ki-outline ki-abstract-14 fs-1"></i>
              </button>
              <!--end::Sidebar toggle-->
          </div>
          <!--end::Logo-->
          <div class="d-flex flex-lg-grow-1 flex-stack" id="kt_app_header_wrapper">
              <div class="app-header-wrapper d-flex align-items-center justify-content-around justify-content-lg-between flex-wrap gap-6 gap-lg-0 mb-6 mb-lg-0"
                  data-kt-swapper="true" data-kt-swapper-mode="{default: 'prepend', lg: 'prepend'}"
                  data-kt-swapper-parent="{default: '#kt_app_content_container', lg: '#kt_app_header_wrapper'}">
                  <!--begin::Page title-->
                  <div class="d-flex flex-column justify-content-center">
                      <!--begin::Title-->
                      <h1 class="text-gray-900 fw-bold fs-6 mb-2">Client Engagement</h1>
                      <!--end::Title-->
                      <!--begin::Breadcrumb-->
                      <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-base">
                          <!--begin::Item-->
                          <li class="breadcrumb-item text-muted">
                              <a href="/land" class="text-muted text-hover-primary">Home</a>
                          </li>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <li class="breadcrumb-item text-muted">/</li>
                          <!--end::Item-->
                          <!--begin::Item-->
                          <li class="breadcrumb-item text-muted">Dashboard</li>
                          <!--end::Item-->
                      </ul>
                      <!--end::Breadcrumb-->
                  </div>
                  <!--end::Page title-->
                  <div class="d-none d-md-block h-40px border-start border-gray-200 mx-10"></div>

                  <!-- Begin Header -->
                  {{-- <div class="d-flex gap-3 gap-lg-8 flex-wrap">
                      <div class="d-flex align-items-center gap-2">
                          <div class="rounded d-flex flex-center w-40px h-40px flex-shrink-0 bg-warning">
                              <i class="ki-outline ki-abstract-13 fs-2 text-inverse-warning"></i>
                          </div>
                          <div class="d-flex flex-column">
                              <span class="fw-bold fs-base text-gray-900">Target A</span>
                              <span class="fw-semibold fs-7 text-gray-500">Uplift: 64%</span>
                          </div>
                      </div>
                      <div class="d-flex align-items-center gap-2">
                          <div class="rounded d-flex flex-center w-40px h-40px flex-shrink-0 bg-danger">
                              <i class="ki-outline ki-abstract-24 fs-2 text-inverse-danger"></i>
                          </div>
                          <div class="d-flex flex-column">
                              <span class="fw-bold fs-base text-gray-900">Target A</span>
                              <span class="fw-semibold fs-7 text-gray-500">Uplift: 64%</span>
                          </div>
                      </div>
                      <div class="d-flex align-items-center gap-2">
                          <div class="rounded d-flex flex-center w-40px h-40px flex-shrink-0 bg-primary">
                              <i class="ki-outline ki-abstract-25 fs-2 text-inverse-primary"></i>
                          </div>
                          <div class="d-flex flex-column">
                              <span class="fw-bold fs-base text-gray-900">Target A</span>
                              <span class="fw-semibold fs-7 text-gray-500">Uplift: 64%</span>
                          </div>
                      </div>
                      <a href="#"
                          class="btn btn-icon border border-200 bg-gray-100 btn-color-gray-600 btn-active-primary ms-2 ms-lg-6">
                          <i class="ki-outline ki-plus fs-3"></i>
                      </a>
                  </div> --}}
                  <!-- END HEADER TSOKOTSA -->

              </div>
              <!--begin::Navbar-->
              <div class="app-navbar flex-shrink-0 gap-2 gap-lg-4">
                  <!--begin::My apps links-->
                  <div class="app-navbar-item">
                      <!--begin::Menu wrapper-->
                      <div class="btn btn-icon border border-200 bg-gray-100 btn-color-gray-600 btn-active-color-primary w-40px h-40px"
                          data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                          data-kt-menu-placement="bottom-end">
                          <i class="ki-outline ki-element-11 fs-4"></i>
                      </div>
                      <!--begin::My apps-->

                      <!--end::My apps-->
                      <!--end::Menu wrapper-->
                  </div>
                  <!--end::My apps links-->
                  <!--begin::Notifications-->
                  <div class="app-navbar-item">
                      <!--begin::Menu- wrapper-->
                      <div class="btn btn-icon border border-200 bg-gray-100 btn-color-gray-600 btn-active-color-primary w-40px h-40px"
                          data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                          data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">
                          <i class="ki-outline ki-notification-status fs-4"></i>
                      </div>
                      <!--begin::Menu-->

                      <!--end::Menu-->
                      <!--end::Menu wrapper-->
                  </div>
                  <!--end::Notifications-->
                  <!--begin::User menu-->
                  <div class="app-navbar-item" id="kt_header_user_menu_toggle">
                      <!--begin::Menu wrapper-->
                      <div class="cursor-pointer symbol symbol-40px"
                          data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                          data-kt-menu-placement="bottom-end">
                          <img src="{{ asset($user?->avatar) }}" class="rounded-3" alt="user">
                      </div>
                      <!--begin::User account menu-->
                      <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                          data-kt-menu="true" style="">
                          <!--begin::Menu item-->
                          <div class="menu-item px-3">
                              <div class="menu-content d-flex align-items-center px-3">
                                  <!--begin::Avatar-->
                                  <div class="symbol symbol-50px me-5">
                                      <img alt="User avatar"
<img src="{{ asset($user->avatarpath ?? 'assets/media/avatars/blank.png') }}" />
                                      {{-- <img alt="Logo" src="{{ asset($user->avatar) }}"> --}}
                                  </div>
                                  <!--end::Avatar-->
                                  <!--begin::Username-->
                                  <div class="d-flex flex-column">
                                      <div class="fw-bold d-flex align-items-center fs-5">{{ $user?->name }}
                                          <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span>
                                      </div>
                                      <a href="#"
                                          class="fw-semibold text-muted text-hover-primary fs-7">{{ $user?->email }}
                                      </a>
                                  </div>
                                  <!--end::Username-->
                              </div>
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu separator-->
                          <div class="separator my-2"></div>
                          <!--end::Menu separator-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5">
                              <a href="account/overview.html" class="menu-link px-5">My Profile</a>
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5">
                              <a href="apps/projects/list.html" class="menu-link px-5">
                                  <span class="menu-text">My Projects</span>
                                  <span class="menu-badge">
                                      <span class="badge badge-light-danger badge-circle fw-bold fs-7">3</span>
                                  </span>
                              </a>
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                              data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                              <a href="#" class="menu-link px-5">
                                  <span class="menu-title">My Subscription</span>
                                  <span class="menu-arrow"></span>
                              </a>
                              <!--begin::Menu sub-->
                              <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/referrals.html" class="menu-link px-5">Referrals</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/billing.html" class="menu-link px-5">Billing</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/statements.html" class="menu-link px-5">Payments</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/statements.html"
                                          class="menu-link d-flex flex-stack px-5">Statements
                                          <span class="ms-2 lh-0" data-bs-toggle="tooltip"
                                              aria-label="View your statements"
                                              data-bs-original-title="View your statements" data-kt-initialized="1">
                                              <i class="ki-outline ki-information-5 fs-5"></i>
                                          </span></a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu separator-->
                                  <div class="separator my-2"></div>
                                  <!--end::Menu separator-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <div class="menu-content px-3">
                                          <label class="form-check form-switch form-check-custom form-check-solid">
                                              <input class="form-check-input w-30px h-20px" type="checkbox"
                                                  value="1" checked="checked" name="notifications">
                                              <span class="form-check-label text-muted fs-7">Notifications</span>
                                          </label>
                                      </div>
                                  </div>
                                  <!--end::Menu item-->
                              </div>
                              <!--end::Menu sub-->
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5">
                              <a href="account/statements.html" class="menu-link px-5">My Statements</a>
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu separator-->
                          <div class="separator my-2"></div>
                          <!--end::Menu separator-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
                              data-kt-menu-placement="left-start" data-kt-menu-offset="-15px, 0">
                              <a href="#" class="menu-link px-5">
                                  <span class="menu-title position-relative">Language
                                      <span
                                          class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                          <img class="w-15px h-15px rounded-1 ms-2"
                                              src="assets/media/flags/united-states.svg" alt=""></span></span>
                              </a>
                              <!--begin::Menu sub-->
                              <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/settings.html" class="menu-link d-flex px-5 active">
                                          <span class="symbol symbol-20px me-4">
                                              <img class="rounded-1" src="assets/media/flags/united-states.svg"
                                                  alt="">
                                          </span>English</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/settings.html" class="menu-link d-flex px-5">
                                          <span class="symbol symbol-20px me-4">
                                              <img class="rounded-1" src="assets/media/flags/spain.svg"
                                                  alt="">
                                          </span>Spanish</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/settings.html" class="menu-link d-flex px-5">
                                          <span class="symbol symbol-20px me-4">
                                              <img class="rounded-1" src="assets/media/flags/germany.svg"
                                                  alt="">
                                          </span>German</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/settings.html" class="menu-link d-flex px-5">
                                          <span class="symbol symbol-20px me-4">
                                              <img class="rounded-1" src="assets/media/flags/japan.svg"
                                                  alt="">
                                          </span>Japanese</a>
                                  </div>
                                  <!--end::Menu item-->
                                  <!--begin::Menu item-->
                                  <div class="menu-item px-3">
                                      <a href="account/settings.html" class="menu-link d-flex px-5">
                                          <span class="symbol symbol-20px me-4">
                                              <img class="rounded-1" src="assets/media/flags/france.svg"
                                                  alt="">
                                          </span>French</a>
                                  </div>
                                  <!--end::Menu item-->
                              </div>
                              <!--end::Menu sub-->
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5 my-1">
                              <a href="account/settings.html" class="menu-link px-5">Account Settings</a>
                          </div>
                          <!--end::Menu item-->
                          <!--begin::Menu item-->
                          <div class="menu-item px-5">
                              <form method="POST" action="{{ route('logout') }}">
                                  @csrf
                                  <x-dropdown-link :href="route('logout')" class="menu-link px-5"
                                      onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                      {{ __('Log Out') }}
                                  </x-dropdown-link>
                              </form>
                          </div>
                          <!--end::Menu item-->
                      </div>
                      <!--end::User account menu-->
                      <!--end::Menu wrapper-->
                  </div>
                  <!--end::User menu-->
              </div>
              <!--end::Navbar-->
          </div>
      </div>
      <!--end::Header container-->
  </div>
  <!--end::Header-->
