var video = document.querySelector("#videoElement");
var fileUpload1 = document.getElementById('fileUpload1');
var fileUpload2 = document.getElementById('fileUpload2');
var fileUpload3 = document.getElementById('fileUpload3');
var player1 = document.getElementById('player1');
var player2 = document.getElementById('player2');
var player3 = document.getElementById('player3');

// we need to find
fileUpload1.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the video file.
    player1.src = URL.createObjectURL(file);
});

// we need to find
fileUpload2.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the video file.
    player2.src = URL.createObjectURL(file);
});

// we need to find
fileUpload3.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the video file.
    player3.src = URL.createObjectURL(file);
});
