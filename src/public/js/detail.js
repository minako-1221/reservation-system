$(document).ready(function() {
    $("#reservation_date").datepicker({
        dateFormat: "yy/mm/dd",
        minDate: 0,
        showAnim:"slideDown"
    });

    let today = new Date();
    let yyyy = today.getFullYear();
    let mm = String(today.getMonth() + 1).padStart(2, '0');
    let dd = String(today.getDate()).padStart(2, '0');
    $("#reservation_date").val(`${yyyy}/${mm}/${dd}`);

    $("#calendar-icon").click(function() {
        $("#reservation_date").focus();
    });
});