<?php
require_once('conn.php');
session_start();
$id = $_GET['id'];

// we want to find the questionnaire that we need to read from
$query = "SELECT * FROM Questionnaire WHERE Questionnaire.id = :questionnaireID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":questionnaireID", $questionnaireID, PDO::PARAM_STR);
$questionnaireID = $id;
$stmt->execute();
$result = $stmt->fetchAll();
foreach ($result as $row) {
    $title = $row['name'];
    $description = $row['description'];
}
unset($stmt);

// then we need to read out all the questions that is in the questionnaire
$query = "SELECT * FROM question q where q.`questionnaire id` = :questionnaireID";
$stmt = $pdo->prepare($query);
$stmt->bindParam(":questionnaireID", $id, PDO::PARAM_STR);
$stmt->execute();
$questions = $stmt->fetchAll();

unset($stmt);
?>
<link rel="stylesheet" href="questionAppearance.css">
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<!--Navigation bar -->
<nav class="navbar navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">Home</a>
    </div>
</nav>

<body>
<div class="container" id="myDiv">
    <div class="row">
        <form name="quiz" method="POST" action="submitAnswers.php">
            <div id="questionPanel">
                <h1><?php echo $title; ?></h1>
                <h3><?php echo $description; ?></h3>
                <?php
                $questionArray = array();
                foreach ($questions as $row) {
                if ($row['Type'] == 'text') {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <p><?php echo $row['Contents'];
                                if ($row['required'] == 1) {
                                    echo "*";
                                } ?></p>
                            <!-- do we need ID here or question number? -->
                            <input class="card-text" placeholder="Participant will answer here..."
                                   name="<?php echo $row['ID'] ?>"/>
                        </div>
                    </div>
                    <?php
                } else if ($row['Type'] == 'radio') {
                ?>
                <div class="card">
                    <div class="card-body">
                        <p>
                            <?php echo $row['Contents'];
                            if ($row['required'] == 1) {
                                echo "*";
                            } ?></p>
                        <?php
                        // then we need to read out all the options that is in the questionnaire
                        $query = "SELECT * FROM options o where o.`question ID` = :questionID";
                        $stmt = $pdo->prepare($query);
                        $stmt->bindParam(":questionID", $row['ID'], PDO::PARAM_STR);
                        $stmt->execute();
                        $options = $stmt->fetchAll();
                        unset($stmt);
                        foreach ($options as $option) {
                            ?>
                            <input type="radio" value="<?php echo $option['option']; ?>" name="<?php echo $row['ID']; ?>"/>
                            <label for="<?php echo $option['option']; ?>"><?php echo $option['option']; ?></label><br>
                            <?php
                        }?>
                    </div>
                </div>
                <?php
                        }
                        array_push($questionArray, $row['ID']);
                        }
                        $_SESSION['questionArray'] = $questionArray;
                        $_SESSION['questionnaireID'] = $id;
                        ?>
                        <button type="submit" name="submitQuestion" class="btn btn-primary fas fa-check"
                                style="float: right;"></button>
                    
            </div>
        </form>
    </div>
</div>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/8741ca18b0.js" crossorigin="anonymous"></script>

