<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
require_once('../conn.php'); // initilise conneciton to the database
  if(isset($_GET["qId"])){  //Need a different sql statement if ALL is selected
    $currentID = $_GET["qId"];
    $currentQuestionnaire = $_GET["name"];
    // Statement to select the relevant questinnaire to display a table of the questions and answers to them
    $sql = "SELECT q.id as `question ID`, q.`questionnaire ID`,q.`question number`,q.`Contents`,a.`participant ID`,a.contents 
    FROM answer a 
    INNER JOIN question q ON q.id = a.`question ID` WHERE `questionnaire ID` = '$currentID';";
  }
  else{
    $currentID = "ALL";
    // Statement to select all questionnaires when all is selected in dropdown
    $sql = "SELECT q.id as `question ID`, q.`questionnaire ID`,q.`question number`,q.`Contents`,a.`participant ID`,a.contents 
    FROM answer a 
    INNER JOIN question q ON q.id = a.`question ID`;";
  }

  //PREPARE AND RUN STATEMENTS
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $result = $stmt->fetchAll();

  $sql = "SELECT * FROM questionnaire;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $questionnaires = $stmt->fetchAll();

  // Statement to find number of questions
  $sql = "SELECT qr.`id` as `Questionnaire ID`,count(*) as `Number of Questions` FROM question q
  INNER JOIN questionnaire qr on q.`questionnaire ID` = qr.id
  group by qr.`id`;";
  $stmt = $pdo->prepare($sql);
  $stmt->execute();
  $questionnairescount = $stmt->fetchAll();

  //var_dump($questionnaires);
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script>
    <title>Dundata</title>
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>
</head>

<!-- Cheeky navbar -->
<nav class="navbar navbar-dark">
    <a class="navbar-brand" href="../index.html">
        <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo" style="margin-right: 20px;">Home
    </a>
</nav>

<body>
    <div class="container">
        <div class="row">
            <h1><u>View Questionnaires</u></h1>
        </div>
        <div class="row" id="imageRow">
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Questionnaires
                </button>
                <div class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item"
                        href="https://dundata.azurewebsites.net/Software_Code/dataViewing/dataViewer.php">ALL</a>
                    <?php //Fill the bootstrap dropdown with links to the questionnaire table listing
                        foreach($questionnaires as $row) {
                            echo "<a class='dropdown-item' href='https://dundata.azurewebsites.net/Software_Code/dataViewing/dataViewer.php?qId=".$row['ID']."&name=".$row['name']."'><strong>(".$row['ID'].") </strong>".$row['name']."</a>";
                        }
                    ?>
                    <!--<a class="dropdown-item" href="https://dundata.azurewebsites.net/Software_Code/dataViewing/dataViewer.php?qId=1">1</a>-->
                </div>
                <b>
                    <p style="margin-left:1em;">
                    <?php 
                    if(isset($currentID) && isset($currentQuestionnaire)){
                        echo "#".$currentID." ".$currentQuestionnaire;
                    }
                    else{
                        echo "All Questionnaire Questions!";
                    }
                    ?></p> <!-- Print the table we are currently on -->
                </b>
            </div>

            <div class="table-responsive">
                <table id="dtable" class="table" ;>
                    <thead>
                        <tr> <!-- Table Titles -->
                            <th>Question Number</th>
                            <th>Participant ID</th>
                            <th>Question</th>
                            <th>Response</th>
                        </tr>
                    </thead>
                    <tbody id="dataTable">
                        <tr>
                        <?php // Fill table with the relevant data from sql request
                            foreach($result as $row) {
                                echo "<td>".$row['question number']."</td>";
                                echo "<td>".$row['participant ID']."</td>";
                                echo "<td>".$row['Contents']."</td>";
                                echo "<td>".$row['contents']."</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin-left: 0px;">
                <h2><u>Analytics</u></h2>
            </div>

            <div class="row" style="padding-top: 30px;">
                <canvas id="myChart">
            </div>

        </div>

        <div class="row justify-content-end" id="imageRow">
            <img src="../images/logo.png" class="fix">
        </div>
    </div>

</body>

</html>

<script>
var ctx = document.getElementById('myChart');
// Global options
Chart.defaults.global.defaultFontFamily = 'Lato';
//  Chart.defaults.global.defaultFontSize = '5';
Chart.defaults.global.defaultFontColor = '#777';

var myChart = new Chart(ctx, {
    type: 'horizontalBar', //bar  , horizontalBar ,pie, line, doughnut, radar , polararea
    data: {
        labels: [<?php 
                  foreach($questionnaires as $row) {
                    $id = "#".$row["ID"];
                    echo "'$id',";
                  }
                  ?>],
        datasets: [{
            //label: 'Number of Votes',
            data: [<?php 
            foreach($questionnaires as $row) {
              $id = $row["ID"];
              foreach($questionnairescount as $rowrow) {
                if($id==$rowrow["Questionnaire ID"]){
                  echo $rowrow["Number of Questions"].",";
                }
              }
            }?>, 0],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
            ],
            borderWidth: 1,
            borderColor: '#777',
            hoverBorderWidth: 4,
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Volume of quesitons'
            //fontsize
        },
        scales: {
            yAxes: [{
                scaleLabel: {
                    display: true,
                    labelString: 'Question ID'
                }
            }]
        },
        legend: {
            display: false,
            position: 'right',
            labels: {
                fontColor: '#000'
            }
        },
        layout: {
            padding: {
                left: 0,
                right: 0,
                bottom: 0,
                top: 0
            }
        },
        tooltips: {
            enabled: true
        }
    },
});
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>