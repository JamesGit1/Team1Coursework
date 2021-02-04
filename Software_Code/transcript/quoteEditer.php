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

$query = "SELECT * FROM theme";
$stmt = $pdo->prepare($query);
$stmt->execute();
$themes = $stmt->fetchAll();

$title = $result['Name'];
$description = $result['Desc'];
$transcript = $result['Transcript'];

if(isset($_POST['submitTheme']))
{
    $query = "INSERT INTO theme (`Name`,`Description`,`Colour`) VALUES (:name,:description,:colour);";
    
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":description", $description, PDO::PARAM_STR);
    $stmt->bindParam(":colour", $colour, PDO::PARAM_STR);

    $name = $_POST['themeName'];
    $description = $_POST['themeDescription'];
    $colour = $_POST['themeColourpicker'];
    
    $stmt->execute();
    header("Refresh:0");
}

if(isset($_POST['submitQuote']))
{
    $query = "CALL `createQuoteReturnID` (:text,:transcriptID,:comment)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":text", $text, PDO::PARAM_STR);
    $stmt->bindParam(":transcriptID", $transcriptID, PDO::PARAM_STR);
    $stmt->bindParam(":comment", $comment, PDO::PARAM_STR);

    $text = $_POST['highlightedText'];
    $comment = $_POST['comment'];

    $stmt->execute();
    $quoteID = $stmt->fetchColumn();
    unset($stmt);

    $themesList = $_POST['themeSelect'];

    foreach($themesList as $theme)
    {
        $query = "INSERT INTO `themequotemap` (`quoteID`,`themeID`) VALUES (:quoteID,:themeID)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":quoteID", $quoteID, PDO::PARAM_STR);
        $stmt->bindParam(":themeID", $themeID, PDO::PARAM_STR);

        $themeID = $theme;
        $stmt->execute();
        unset($stmt);
    }
}

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
        <div class="row">
            <textarea readonly id="note"><?php echo $transcript;?></textarea>
        </div>
        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>
        <br><br><br><br><br><br><br><br>
        <div class="row card-footer" id="stickyFooter">
            <form class="row" method="POST">
                <div class="col-8">
                    <h4>Comment</h4>
                    <textarea name="comment" rows="3" cols="50" placeholder="Comment goes here"></textarea>
                </div>
                <div class="col-4">

                </div>
                <div class="col">
                    <select name="themeSelect[]" class="selectpicker" multiple="multiple" data-live-search="true">
                        <option disabled value="" selected>Select a theme</option>
                        <?php 
                        foreach ($themes as $theme) 
                        {
                        ?>
                            <option value="<?php echo $theme['ID']; ?>"><?php echo $theme['Name']; ?></option>
                        <?php 
                        } 
                        ?>
                    </select>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                        Add New
                    </button>
                </div>
                <h4>Selected text</h4>
                <textarea name="highlightedText" readonly id="sel" rows="3" cols="50"></textarea>
                <button type="submit" name="submitQuote">Submit</button>
            </form>

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
                            <input type="text" class="form-control" maxlength="256" id="inputfirstname" name="themeDescription">
                        </div>
                        <div class="col-md-12">
                            <label for="colourpicker">Select the colour of this theme:</label>
                            <input type="color" id="colourpicker" name="themeColourpicker" value="#ffff00"><br><br>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" name="submitTheme" method="post" class="btn btn-primary">Add Theme</button>
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

<script src="selectionText.js"></script>

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