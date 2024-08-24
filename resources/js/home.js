$(document).ready(function () {
    console.log("Document is ready");

    $.ajax({
        url: "/students",
        method: "GET",
        success: function (data) {
            console.log("AJAX Data:", data); // Check if data is received
        },
        error: function (xhr) {
            console.error("AJAX Error:", xhr);
        },
    });
});
