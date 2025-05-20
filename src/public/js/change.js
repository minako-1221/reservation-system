$(function () {
    $("#reservation_date").datepicker({
        dateFormat: "yy/mm/dd",
        minDate: 0,
        showAnim: "slideDown",
    });

    $("#calendar-icon").on("click", () => $("#reservation_date").focus());

});