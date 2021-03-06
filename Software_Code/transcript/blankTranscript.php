<?php
    session_start();
    require_once('../conn.php');
    require('../accountSystem/loginStatus.php');

    //Get details on title and description from the database using transcript ID from session variable created on new transcript
    $query = "SELECT * FROM `transcript` WHERE transcript.id = :transcriptID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":transcriptID", $transcriptID, PDO::PARAM_STR);
    $transcriptID = $_SESSION["transcriptID"];
    $stmt->execute();
    $result = $stmt->fetch();

    // Set title and description retrieved from database
    $title = $result['Name'];
    $description = $result['Desc'];

    unset($stmt);

    //Submit the input transcript into the database
    if (isset($_POST['submitTranscript']))
    {
        $query = "UPDATE `transcript` SET `Transcript` = :transcript WHERE `ID` = :transcriptID;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":transcriptID", $id);
        $stmt->bindParam(":transcript", $transcript);

        $transcript = $_POST['transcriptText'];
        $id = $_SESSION["transcriptID"];
        $stmt->execute();
        unset($stmt);

        header("Location: quoteEditer.php");
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/questionAppearance.css">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
</head>

<div id="nav-placeholder">

</div>

<body>
    <div class="container" id="myDiv">
        <div class="row">
            <form method="post" class="newForm" id="submitQuestionnaire">
                <input type="text" readonly id="formName" style="margin-bottom: 0px;" class="card-title question-title"
                    name="formName" value="<?php echo $title; ?>" />
                <textarea readonly name="formDesc" class="card-title question-title" id="formDescription"
                    oninput="auto_grow(this)"><?php echo $description ?></textarea>
            </form>
        </div>

        <div class="row" id="videoRow">
            <input class="form-control" type="file" accept="video/*" capture="camera" id="fileUpload1"
                name="videoUpload[]" multiple="multiple" style="width: 96%;
    margin-left: auto;
    margin-right: auto;
    border-radius: 0;">
            <video width="100%" id="player1" controls></video>
        </div>
        <div class="row">
            <form method="post" class="newForm" id="submitTranscript">
                <textarea required name="transcriptText" placeholder="Enter transcript here..."
                    class="card-title question-title" id="transcriptForm" oninput="auto_grow(this)"></textarea>
                <button type="submit" class="btn btn-primary" name="submitTranscript" method="post"
                    id="submitTranscript">Submit Transcript</button>
            </form>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>


    </div>
    <div id="loader"></div>
    <script>
    var myVar;

    fileUpload1.addEventListener('change', function(e) {
        var file = e.target.files[0];
        player1.src = URL.createObjectURL(file);
    });

    function myFunction() {
        myVar = setTimeout(showPage, 300);
    }

    function showPage() {
        document.getElementById("myDiv").style.display = "none"; //change to container
        document.getElementById("loader").style.display = "block";
    }

    function auto_grow(element) {
        element.style.height = "50px";
        element.style.height = (element.scrollHeight) + "px";
    }
    </script>
</body>

</html>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script>
$(function() {
    $("#nav-placeholder").load("../navBar.php");
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    //8===D
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>