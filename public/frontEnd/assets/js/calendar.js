$(document).ready(function () {
  var calenderWrapper = document.querySelector('.calendar--wrapper');
  if(calenderWrapper){
    $.bsCalendar.setDefaults({
      locale: "en",
      showEventEditButton: true,
      showEventRemoveButton: true,
    });
    // $.bsCalendar.setDefault('width', 5000);
  
    $("#calendar_dropdown").bsCalendar({ width: 300 });
    $("#calendar_inline").bsCalendar({ width: "450px" });
  
    $("#calendar_offcanvas").bsCalendar({ width: "80%" });
    $("#calendar_navbar").bsCalendar({ width: 300 });
  
    $("#floatingSelect").on("change", function () {
      $("#calendar_inline").bsCalendar("updateOptions", {
        locale: $(this).val(),
      });
    });
  
    $("#flexSwitchTheme").on("change", function (e) {
      const theme = $(e.currentTarget).is(":checked") ? "dark" : "light";
      $("html").attr("data-bs-theme", theme);
      $("#calendar_inline").bsCalendar("refresh");
    });
  }
});
