var fileUpload1 = document.getElementById('fileUpload1');
var fileUpload2 = document.getElementById('fileUpload2');
var fileUpload3 = document.getElementById('fileUpload3');
var player1 = document.getElementById('player1');
var player2 = document.getElementById('player2');
var player3 = document.getElementById('player3');
var playerArray = [player1,player2,player3];
var fileUploadArray = [fileUpload1,fileUpload2,fileUpload3];
var playButton = document.getElementById('playButton');
var play = false;
// this might change
var noOfVids = 3;

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

function playAll() {
    if (play == false){
        for (i = 0; i < noOfVids; i++){
            playerArray[i].play();
        }
        playButton.classList.add('fa-pause');
        playButton.classList.remove('fa-play');
        play = true;
    }
    else{
        for (i = 0; i < noOfVids; i++){
            playerArray[i].pause();
        }
        playButton.classList.add('fa-play');
        playButton.classList.remove('fa-pause');
        play = false;
    }
}

function flag(){
    var timestampArray = [];
    for(i = 0; i < noOfVids; i++)
        timestampArray.push(playerArray[i].currentTime);
}
