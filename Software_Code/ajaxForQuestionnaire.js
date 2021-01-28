$("form").on("submit", function (e) {
    var dataString = $(this).serialize();

    $.ajax({
        type: "POST",
        url: "bin/process.php",
        data: dataString,
        success: function () {
            // Display message back to the user here
        }
    });

    e.preventDefault();
});