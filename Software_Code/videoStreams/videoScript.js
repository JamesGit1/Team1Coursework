var video = document.querySelector("#videoElement");
var recorder = document.getElementById('recorder');
var player = document.getElementById('player');

// we need to find the user media
if (navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (err0r) {
            console.log("Something went wrong!");
        });
}

// we need to find
recorder.addEventListener('change', function(e) {
    var file = e.target.files[0];
    // Do something with the video file.
    player.src = URL.createObjectURL(file);
});