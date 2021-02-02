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

  if (checkFileSize(e, file)) {
      alert("File is too big!");
  } else {
    player1.src = URL.createObjectURL(file);
  }
});

// we need to find
fileUpload2.addEventListener('change', function(e) {
  var file = e.target.files[0];

    if (checkFileSize(e, file)) {
        alert("File is too big!");
    } else {
      player2.src = URL.createObjectURL(file);
    }
});

// we need to find
fileUpload3.addEventListener('change', function(e) {
  var file = e.target.files[0];

    if (checkFileSize(e, file)) {
        alert("File is too big!");
    } else {
      player3.src = URL.createObjectURL(file);
    }
});

function playAll() {
  if (play == false) {
    for (i = 1; i <= noOfVids; i++) {
      document.getElementById('player' + i).play();
    }
    playButton.classList.add('fa-pause');
    playButton.classList.remove('fa-play');
    play = true;
  } else {
    pause();
  }
}

function pause() {

  for (i = 1; i <= noOfVids; i++) {
    document.getElementById('player' + i).pause();
  }
  playButton.classList.add('fa-play');
  playButton.classList.remove('fa-pause');
  play = false;

}

function flag() {
  var timestampArray = [];
  for (i = 1; i <= noOfVids; i++) {
    timestampArray.push(document.getElementById('player' + i).currentTime);
  }
  pause();
  addRow(timestampArray);
}

var addRow = function(timestampArray) {

  var myRow = $('<tr id = "row' + row + '"> <th scope="row">' + row + '</th><td>' + timestampArray[0] + '</td><td>' + timestampArray[1] + '</td> <td>' + timestampArray[2] + '</td><td> <input type="text" style ="width:100%" id="comment' + row + '"  name="comment' + row + '"></td><td><a href="#" id="' + row + '" onclick="deleteRow(this.id)" class="btn btn-primary btn-danger fas fa-trash"></a></td> </tr>')
  myRow.appendTo('#timeStamps');
  row++;
}

function deleteRow(rowID) {
  document.getElementById('row' + rowID).remove();
};

function checkFileSize(e, file) {
  //131072000
  if (file.size > 8027578) {
    e.value = "";
    return true;
  };
  return false;
}
