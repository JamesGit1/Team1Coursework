<?php
require_once('conn.php');
session_start();
$id = $_SESSION['id'];

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
                <?php
                echo $title;
                echo $description;
                $questionArray = array();
                foreach ($questions

                as $row) {
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
                            <input type="radio" name="<?php echo $row['Contents']; ?>"
                                   value=<?php echo $option['option']; ?>/>
                            <?php
                        }
                        }
                        array_push($questionArray, $row['ID']);
                        }
                        $_SESSION['questionArray'] = $questionArray;
                        ?>
                        <button type="submit" name="submitQuestion" class="btn btn-primary"></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
