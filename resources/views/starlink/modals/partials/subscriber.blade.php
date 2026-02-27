  <style>
      .form-disabled {
          opacity: 0.5;
          pointer-events: none;
      }

      /* Improve tab visibility */
      .nav-line-tabs .nav-link {
          padding: 0.75rem 1.25rem;
          color: #5e6278;
          font-weight: 600;
      }

      .nav-line-tabs .nav-link.active {
          color: #009ef7;
          /* Metronic primary */
          border-bottom-width: 3px;
      }

      .nav-line-tabs .nav-link:not(.active):hover {
          color: #009ef7;
      }
  </style>


  <!-- 🔽 TAB CARD STARTS HERE -->
  <div class="card border-0">

      <!--begin::Card header-->
      <div class="card-header border-0 pt-4 d-flex justify-content-end">
          <ul class="nav nav-tabs nav-line-tabs fs-6 fw-bold border-0">
              <li class="nav-item">
                  <a class="nav-link active" data-bs-toggle="tab" href="#tab-details">
                      Details
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-usage">
                      Usage
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" data-bs-toggle="tab" href="#tab-ipv4">
                      IPv4
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link disabled">
                      More coming…
                  </a>
              </li>
          </ul>
      </div>

      <!--end::Card header-->

      <!--begin::Card body-->
      <div class="card-body pt-6">
          <div class="tab-content">

              <!-- DETAILS -->
              <div class="tab-pane fade show active" id="tab-details">

                  <!--begin::Form-->
                  <form id="starlink-subscriber-form"
                      class="form fv-plugins-bootstrap5 fv-plugins-framework form-disabled" action="#">
                      @csrf
                      <!--begin::Input group-->
                      <div class="row">
                          <div class="fv-row mb-4 fv-plugins-icon-container">
                              <!--begin::Label-->
                              <label class="fs-6 fw-semibold form-label mb-2">
                                  <span class="required">Nickname</span>
                              </label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <div class="input-group mb-5">
                                  <span class="input-group-text" id="basic-addon1">
                                      <i class="ki-duotone ki-profile-circle fs-1"><span class="path1"></span><span
                                              class="path2"></span><span class="path3"></span></i>
                                  </span>
                                  <input type="text" class="form-control" placeholder="nickname"
                                      aria-label="nickname" aria-describedby="basic-addon1" id="nickname"
                                      name="nickname" value="{{ $subscriber['content']['nickname'] }}" />
                              </div>
                              <!--end::Input-->
                              <div
                                  class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                              </div>
                          </div>
                      </div>
                      <!--end::Input group-->

                      <!--begin::Input group-->
                      <div class="row">
                          <!-- IP Policy -->
                          <div class="fv-row mb-7 col-md-6">
                              <label class="fs-6 fw-semibold form-label mb-2">
                                  <span class="required">IP Policy</span>
                              </label>

                              <select id="ip_policy" class="form-select" data-control="select2">
                                  <option value="">Select an option</option>

                                  <option value="50"
                                      {{ empty($sub['content']['publicIp']) || $sub['content']['publicIp'] === false ? 'selected' : '' }}>
                                      Default
                                  </option>

                                  <option value="2"
                                      {{ isset($sub['content']['publicIp']) && $sub['content']['publicIp'] === true ? 'selected' : '' }}>
                                      Public IP
                                  </option>
                              </select>

                          </div>
                          <div class="fv-row mb-4 fv-plugins-icon-container col-md-6">
                              <!--begin::Label-->
                              <label class="fs-6 fw-semibold form-label mb-2">
                                  <span class="required">Service Plan</span>
                              </label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <select class="form-select" data-control="select2" data-placeholder="Select an option">
                                  <option></option>
                                  <optgroup label="Local Priority">
                                      <option value="l50">50 GB</option>
                                      <option value="l500">500 GB</option>
                                      <option value="l1000" class="text-muted" disabled>1TB - Comming soon
                                      </option>
                                  </optgroup>
                                  <optgroup label="Global Priority">
                                      <option value="g50">50 GB</option>
                                      <option value="g500">500 GB</option>
                                      <option value="g1000" class="text-muted" disabled>1TB - Comming soon
                                      </option>
                                  </optgroup>
                              </select>
                              <!--end::Input-->
                              <div
                                  class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                              </div>
                          </div>

                      </div>

                      <div class="row">
                          <div class="col-md-6">
                              <label class="fs-6 fw-semibold form-label mb-2">
                                  <span class="required">Auto Top Up</span>
                              </label>

                              <div class="form-check form-switch form-check-custom form-check-solid">
                                  <input class="form-check-input h-20px w-30px" type="checkbox" value="1">
                              </div>
                          </div>
                          <div class="col-md-6">
                              <label class="fs-6 fw-semibold form-label mb-2">
                                  <span class="required">Force Suspension</span>
                              </label>

                              <div class="form-check form-switch form-check-custom form-check-solid">
                                  <input class="form-check-input h-20px w-30px" type="checkbox" value="1">
                              </div>
                          </div>
                      </div>
                      <!--end::Input group-->

                      <!--begin::Actions-->
                      <div class="text-center pt-15">
                          <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">Discard</button>
                          <button type="submit" class="btn btn-primary" data-kt-users-modal-action="submit">
                              <span class="indicator-label">Submit</span>
                              <span class="indicator-progress">Please wait...
                                  <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                          </button>
                      </div>
                      <!--end::Actions-->
                  </form>
                  <!--end::Form-->

              </div>

              <!-- STATS -->
              <div class="tab-pane fade" id="tab-usage">
                  <div class="text-muted fs-8">
                      <div class="card card-bordered">
                          <div class="card-body">
                              <div class="d-flex justify-content-between align-items-center mb-4">
                                  <div>
                                      <button class="btn btn-sm btn-primary" onclick="loadChart('current')">Current
                                          Month</button>
                                      <button class="btn btn-sm btn-light" onclick="loadChart('last')">Last
                                          Month</button>
                                  </div>

                                  <div>
                                      <strong>Total Download:</strong> <span id="totalDownload">0 GB</span> |
                                      <strong>Total Upload:</strong> <span id="totalUpload">0 GB</span>
                                  </div>
                              </div>

                              <div id="tsokotsa_chart"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- IPV4 -->
          <div class="tab-pane fade" id="tab-ipv4">
              <div class="text-muted fs-8">
                  IPv4 details will go here
              </div>
          </div>

      </div>
  </div>
  <!--end::Card body-->

  </div>
  <!-- 🔼 TAB CARD ENDS HERE -->

  @push('scripts')
      <script>
          var element = document.getElementById('kt_apexcharts_3');

          var height = parseInt(KTUtil.css(element, 'height'));
          var labelColor = KTUtil.getCssVariableValue('--kt-gray-500');
          var borderColor = KTUtil.getCssVariableValue('--kt-gray-200');
          var baseColor = KTUtil.getCssVariableValue('--kt-info');
          var lightColor = KTUtil.getCssVariableValue('--kt-info-light');

          if (!element) {
              return;
          }

          var options = {
              series: [{
                  name: 'Net Profit',
                  data: [30, 40, 40, 90, 90, 70, 70]
              }],
              chart: {
                  fontFamily: 'inherit',
                  type: 'area',
                  height: height,
                  toolbar: {
                      show: false
                  }
              },
              plotOptions: {

              },
              legend: {
                  show: false
              },
              dataLabels: {
                  enabled: false
              },
              fill: {
                  type: 'solid',
                  opacity: 1
              },
              stroke: {
                  curve: 'smooth',
                  show: true,
                  width: 3,
                  colors: [baseColor]
              },
              xaxis: {
                  categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                  axisBorder: {
                      show: false,
                  },
                  axisTicks: {
                      show: false
                  },
                  labels: {
                      style: {
                          colors: labelColor,
                          fontSize: '12px'
                      }
                  },
                  crosshairs: {
                      position: 'front',
                      stroke: {
                          color: baseColor,
                          width: 1,
                          dashArray: 3
                      }
                  },
                  tooltip: {
                      enabled: true,
                      formatter: undefined,
                      offsetY: 0,
                      style: {
                          fontSize: '12px'
                      }
                  }
              },
              yaxis: {
                  labels: {
                      style: {
                          colors: labelColor,
                          fontSize: '12px'
                      }
                  }
              },
              states: {
                  normal: {
                      filter: {
                          type: 'none',
                          value: 0
                      }
                  },
                  hover: {
                      filter: {
                          type: 'none',
                          value: 0
                      }
                  },
                  active: {
                      allowMultipleDataPointsSelection: false,
                      filter: {
                          type: 'none',
                          value: 0
                      }
                  }
              },
              tooltip: {
                  style: {
                      fontSize: '12px'
                  },
                  y: {
                      formatter: function(val) {
                          return '$' + val + ' thousands'
                      }
                  }
              },
              colors: [lightColor],
              grid: {
                  borderColor: borderColor,
                  strokeDashArray: 4,
                  yaxis: {
                      lines: {
                          show: true
                      }
                  }
              },
              markers: {
                  strokeColor: baseColor,
                  strokeWidth: 3
              }
          };

          var chart = new ApexCharts(element, options);
          chart.render();
      </script>
  @endpush
