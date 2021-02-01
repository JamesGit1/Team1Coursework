var fileUpload1 = document.getElementById('fileUpload1');
var fileUpload2 = document.getElementById('fileUpload2');
var fileUpload3 = document.getElementById('fileUpload3');
var playButton = document.getElementById('playButton');
var row = 1;
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
        for (i = 1; i <= noOfVids; i++){
            document.getElementById('player'+i).play();
        }
        playButton.classList.add('fa-pause');
        playButton.classList.remove('fa-play');
        play = true;
    }
    else{
        pause();
    }
}

function pause(){

  for (i = 1; i <= noOfVids; i++){
      document.getElementById('player'+i).pause();
  }
  playButton.classList.add('fa-play');
  playButton.classList.remove('fa-pause');
  play = false;

}

function flag(){
    var timestampArray = [];
    for(i = 1; i <= noOfVids; i++){
        timestampArray.push(document.getElementById('player'+i).currentTime);
      }
    pause();
    addRow(timestampArray);
}

var addRow = function(timestampArray) {

  var myRow = $('<tr><th scope="row">'+ row +'</th><td>'+timestampArray[0]+'</td><td>'+timestampArray[1]+'</td><td>'+timestampArray[2]+'</td> </tr>')
  myRow.appendTo('#timeStamps');
  row++;
}
