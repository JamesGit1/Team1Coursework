<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php 
  require('conn.php');
  if(isset($_GET["qId"])){
    $currentID = $_GET["qId"];
    $sql = "SELECT q.id as `question ID`, q.`questionnaire ID`,q.`question number`,q.`Contents`,a.`participant ID`,a.contents 
    FROM answer a 
    INNER JOIN question q ON q.id = a.`question ID` WHERE `questionnaire ID` = '$currentID';";
  }
  else{
    $currentID = "ALL";
    $sql = "SELECT q.id as `question ID`, q.`questionnaire ID`,q.`question number`,q.`Contents`,a.`participant ID`,a.contents 
    FROM answer a 
    INNER JOIN question q ON q.id = a.`question ID`;";
  }
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
  $result = $stmt->fetchAll();

  $sql = "SELECT * FROM questionnaire;";
  $stmt = $pdo->prepare($sql);
	$stmt->execute();
  $questionnaires = $stmt->fetchAll();
  //var_dump($questionnaires);
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script src="addOptionButton.js"></script>
</head>

<nav class="navbar navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Home</a>
  </div>
</nav>

<body>
  <div class="container">
      <div class="row">
          <h1><u>View Questionnaires</u></h1>
      </div>
      <div class="row" id="imageRow">
        <div class="dropdown">
          <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Questionnaire ID
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="https://dundata.azurewebsites.net/Software_Code/dataViewer.php">ALL</a>
            <?php 
            foreach($questionnaires as $row) {
              echo "<a class='dropdown-item' href='https://dundata.azurewebsites.net/Software_Code/dataViewer.php?qId=".$row['ID']."'>".$row['ID']."</a>";
            }
            ?>
            <!--<a class="dropdown-item" href="https://dundata.azurewebsites.net/Software_Code/dataViewer.php?qId=1">1</a>-->
          </div>
          <p style="margin-left:1em;">#<?php echo $currentID?></p>
        </div>

          <div class="table-responsive">
              <table id="dtable" class="table";>
                <thead>
                  <tr>
                    <th>Question Number</th>
                    <th>Participant ID</th>
                    <th>Question</th>
                    <th>Response</th>
                  </tr>
                </thead>
                <tbody id="dataTable">
                <tr>
                <?php 
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
        </div>
  </div>
</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>