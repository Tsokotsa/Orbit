var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})


// Time Schedule
$("#schedule_dt").flatpickr({
  enableTime: true,
  dateFormat: "Y-m-d H:i",
});

// Test-sms Text area maximum chars
$('#sms-text').maxlength({
  warningClass: "badge badge-primary",
  limitReachedClass: "badge badge-success"
});

$('#telegram-text').maxlength({
  warningClass: "badge badge-primary",
  limitReachedClass: "badge badge-success"
});

// Input Mask Moz Cell
// Phone
Inputmask({
  //"mask" : "(8) 999 9999"
  "mask" : "258(8*{2,1}) 999 9999",
  definitions: {
    "*": {
        validator: '[2-7]',
        cardinality: 1,
        casing: "lower"
    }
}
}).mask(".moz_mask");