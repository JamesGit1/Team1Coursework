<?php

require_once('../conn.php');
session_start();
date_default_timezone_set('Europe/London');


if (isset($_POST['submitTable'])) {

    $arrayRows = explode(",", $_POST['totalRows']); // gets each index of row of timestamps

    var_dump($arrayRows);
    var_dump($_POST);

    // TODO we need to do this for the number of videos that exist
    // we can make up some video id's
    $query = "CALL createVideoReturnID";
    $stmt = $pdo->prepare($query);
    $video = $stmt->fetchRow();
    unset($stmt);
    // TODO add the videos to an array so that we can cycle through them

    // we go through each row in the array
    foreach ($arrayRows as $id) {
        // we get the timestamp array for that row
        // these are already in order
        $arrayOfTimestamps = explode(",", $_POST['timestamp' + $id]); // gets each timestamp
        // assuming that the videos have already been added to the database, we can insert the required data into
        // the other tables
        foreach ($arrayOfTimestamps as $timestamp){
            // TODO we want another query that will add the timestamp to the timestamp table AND add the note to the comment table
            // array of 3 timestamps, each one applies to a video

        }
    }

}

if (isset($_POST['tableForm'])) {
    //alert(var_dump($_POST));
}
?>
