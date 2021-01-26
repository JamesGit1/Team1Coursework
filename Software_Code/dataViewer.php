<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php 
    require_once('conn.php');
    session_start();

    $query = "SELECT * FROM questionview";
    $fetch = $pdo->prepare($query);
    $fetch->execute();
    $result = $fetch->fetchAll();
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
    <div class="table-responsive">
        <table id="dtable" class="table";>
          <thead>
            <tr>
              <th>ID</th>
              <th>Question</th>
              <th>Response</th>
              <th>Question Type</th>
            </tr>
          </thead>
          <tbody id="dataTable">
          <tr>
          <?php 
            foreach($result as $row) {
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['question']."</td>";
                echo "<td>".$row['answer']."</td>";
                echo "<td>".$row['type']."</td></tr>";
              }
          ?>
          </tbody>
        </table>
      </div>
</body>


</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

