var fileUpload1 = document.getElementById('fileUpload1');
var fileUpload2 = document.getElementById('fileUpload2');
var fileUpload3 = document.getElementById('fileUpload3');
var playButton = document.getElementById('playButton');
var totalRowsID = document.getElementById('totalRows');
var row = 1;
var play = false;
// this might change
var noOfVids = 3;
var totalRows = [];
var currentColumn = 4;
var previousColumn = 4;

// The number of rows that we have to start is 1
var noOfRows = 1;
// The current row that we want to add videos to
var currentRow = "videoRow1";

// add the event listeners for the file upload and players
addVideoEventListener(fileUpload1, player1);
addVideoEventListener(fileUpload2, player2);
addVideoEventListener(fileUpload3, player3);

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


// this needs to be changed for infinite videos
var addRow = function (timestampArray) {


    // timeStampLine is a string of timestamps that considers HTML formatting - we will append to it
    var timeStampLine = '<tr id = "row' + row + '"> <th scope="row">' + row + '</th>';

    // Go through array of timestamps and append to main variable
    for (var i = 0; i < timestampArray.length; i++) {
        timeStampLine += '<td>' + timestampArray[i] + '</td>';
    }

    // Append HTML formatting for hidden textbox
      timeStampLine += '<td> <input type="text" style ="width:100%" id="comment' + row + '"  name="comment' + row + '"></td><td><a href="#" id="' + row + '" onclick="deleteRow(this.id)" class="btn btn-primary btn-danger fas fa-trash"></a>' + '<td><input type="hidden" value="';

    //Append each timestamp to the variable so that they can be displayed in the hidden textbox
    for (var j = 0; j < timestampArray.length; j++) {
        timeStampLine += timestampArray[j];

        if (j < timestampArray.length - 1) {
            timeStampLine += ','
        }
    }

    // Finish off ID of the row
    timeStampLine += '" id="timestamp' + row + '" name="timestamp' + row + '"</td>' + ' </tr>';

    // Turn timeStampLine into a jQuery variable
    timeStampLine = $(timeStampLine);

    // Append timeStampLine to the timeStamps div in 'syncStreams.php'
    timeStampLine.appendTo('#timeStamps');

    totalRows.push(row);
    totalRowsID.value = "";
    totalRowsID.value += totalRows.toString();

    row++;
}

function deleteRow(rowID) {
    //Finds of index of array
    const index = totalRows.indexOf(parseInt(rowID));

    //Deletes index of array and adds array values to hidden textbox
    if (index > -1) {
        totalRows.splice(index, 1);
        totalRowsID.value = "";
        totalRowsID.value = totalRows.toString();
    }
    document.getElementById('row' + rowID).remove();
};

function checkFileSize(e, file) {
    //131072000
    if (file.size > 131072000) {
        e.value = "";
        return true;
    }
    ;
    return false;
}

function addVideo() {

    var videoHTML = '<div class="col-sm">' +
        '                  <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload' + (noOfVids + 1) + '" name = "videoUpload[]" multiple="multiple">' +
        '                   <video width="100%" id="player' + (noOfVids + 1) + '" controls></video>' +
        '               </div>';

    // if the number of videos is divisible by 3, that means that the end row is full and a new one should
    // be made
    if (!(noOfVids % 3)) {

        noOfRows++;
        var previousRow = currentRow;
        // changing the videoRow that we are adding the videos to.
        currentRow = "videoRow" + noOfRows;

        document.getElementById(previousRow).insertAdjacentHTML("afterend", '<div class="row" id="' + currentRow + '"> ' + videoHTML +
            '        </div>');
        // otherwise, add the video to the current column
    } else {
        document.getElementById(currentRow).innerHTML += videoHTML;
    }
    noOfVids++;

    // add the event listener to the new file upload and player
    var newPlayer = document.getElementById('player' + noOfVids);
    var fileUpload = document.getElementById('fileUpload' + noOfVids);
    addVideoEventListener(fileUpload, newPlayer);

    addColumn();
}

function addVideoEventListener(fileUpload, player) {
    fileUpload.addEventListener('change', function (e) {
        var file = e.target.files[0];

        if (checkFileSize(e, file)) {
            alert("File is too big!");
        } else {
            player.src = URL.createObjectURL(file);
        }
    });

}

function addColumn() {
    previousColumn = currentColumn;
    currentColumn++;
    var lastestColumn = document.getElementById("column" + previousColumn);
    lastestColumn.insertAdjacentHTML("afterend", '<th scope="col" id="column' + currentColumn + '">Video ' + (currentColumn - 1) + ' </th>');
}
