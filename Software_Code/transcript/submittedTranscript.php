<?php
session_start();
require_once('../conn.php');
require('../accountSystem/loginStatus.php');

$query = "SELECT * FROM `transcript` WHERE transcript.id = :transcriptID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":transcriptID", $transcriptID, PDO::PARAM_STR);
$transcriptID = $_SESSION["transcriptID"];
$stmt->execute();
$result = $stmt->fetch();
unset($stmt);

$query = "SELECT * FROM theme";
$stmt = $pdo->prepare($query);
$stmt->execute();
$themes = $stmt->fetchAll();
unset($stmt);

$title = $result['Name'];
$description = $result['Desc'];
$transcript = $result['Transcript'];


$query = "SELECT * FROM themequotemap tqm INNER JOIN quote q ON q.ID = tqm.quoteID INNER JOIN theme t ON t.ID = tqm.themeID WHERE q.TranscriptID = $transcriptID";
//var_dump($transcriptID);
$stmt = $pdo->prepare($query);
$stmt->execute();
$Quotesarray = $stmt->fetchAll();
unset($stmt);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <title>Dundata Transcript Tool</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
</head>

<body>

    <div id="nav-placeholder">

    </div>

    <div class="container" id="myDiv">
        <div class="row">
            <input type="text" readonly id="formName" style="margin-bottom: 0px;" class="card-title question-title"
                name="formName" value="<?php echo $title; ?>" />
            <h4><?php echo $description;?></h4>
        </div>
        <div class="row" id="transcriptRow">
            <div class="col-md-6">
                <div class="row" id="transRow">
                    <h4>Transcript</h4>
                    <p readonly class="transcriptTextarea" id="note" style="white-space: pre-line;">
                        <?php echo $transcript;?></p>
                </div>
            </div>
            <div class="col-md-6" style="border-left: solid #5674e4 .2em;">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Quote</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Theme Name</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach($Quotesarray as $row){
                        echo "<td>".$row['Text']."</td>";
                        echo "<td>".$row['Comment']."</td>";
                        echo "<td style='color:".$row['Colour'].";'>".$row['Name']."</td></tr>";
                        
                    }
                    ?>

                    </tbody>
                </table>
            </div>

        </div>
        <div class="row justify-content-end" id="transRow">
            <img src="../images/logo.png" class="fix">
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Theme</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form Body -->
                    <form class="row g-3" style="padding-top: 0px;" method="post">
                        <div class="col-md-6">
                            <label for="inputfirstname" class="form-label">Theme Name *</label>
                            <input type="text" class="form-control" maxlength="100" id="inputfirstname" name="themeName"
                                required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputfirstname" class="form-label">Description</label>
                            <input type="text" class="form-control" maxlength="256" id="inputfirstname"
                                name="themeDescription">
                        </div>
                        <div class="col-md-12">
                            <label for="colourpicker">Select the colour of this theme:</label>
                            <input type="color" id="colourpicker" name="themeColourpicker" value="#ffff00"><br><br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submitTheme" method="post" class="btn btn-primary">Add
                                Theme</button>
                        </div>
                    </form>
                    <!-- Form Body End -->
                </div>
            </div>
        </div>
    </div>

</body>


</html>
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<script>
$(function() {
    $("#nav-placeholder").load("../navBar.php");
});
autosize(document.getElementById("note"));
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>