<?php
    require_once('../conn.php');
    session_start();
    require('loginStatus.php');

    if($_SESSION["role"] != "labmanager")
    {
        header("location: ../dashboard.php");
        exit;
    }

    $query = "SELECT * FROM account WHERE Role = 'researcher'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
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
        <title>Dundata</title>
        <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
    </head>

    <body>
        <nav class="navbar navbar-expand navbar-dark">
          <div class="container-fluid">
          <a class="navbar-brand" href="../dashboard.php" id="logo">
                <img src="../images/University_of_Dundee_shield_white.png" width="27" height="37" alt="Uni Logo"
                    style="margin-right: 20px;">Home
            </a>
              <form class="d-flex">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">  
                  <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" style="margin-right: 3em;">
                    Hello, <?php if(isset($name)){echo $name;}else{echo "user";}?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="accountDetails.php">Account Details</a></li>
                    <?php if ($_SESSION["role"] == "labmanager") {
                        echo '<li><a class="dropdown-item active" href="manageUsers.php">Manage Researchers</a></li>';
                    } ?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="logOut.php">Log Out</a></li>
                  </ul>
                </li>
              </ul>
              </form>
          </div>
        </nav>

        <div class="container">
            <div class="row">
                <h1><u>Manage Researchers</u></h1>
            </div>
            <div class="row" style="padding-top: 20px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Role</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($result as $row) { ?>
                        <tr>
                            <th scope="row"><?php echo $row['ID']?></th>
                            <td><?php echo $row['Role']?></td>
                            <td><?php echo $row['firstname']." ".$row['lastname'] ?></td>
                            <td><?php echo $row['Username']?></td>
                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#<?php echo $row['ID']?>">Edit</button></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>            
        </div>

        <!-- Modal -->
        <?php foreach ($result as $row) {
            ?>
        <div class="modal fade" id="<?php echo $row['ID'] ?>" tabindex="-1" aria-labelledby="<?php echo $row['ID']."label" ?>" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="<?php echo $row['ID']."label" ?>">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Body -->
                        <form class="row g-3" style="padding-top: 0px;" method="post">
                            <div class="col-md-6">
                                <label for="inputfirstname" class="form-label">First Name *</label>
                                <input type="text" class="form-control" maxlength="50" id="inputfirstname"
                                    name="firstname" required value="<?php echo $row['firstname']?>">
                            </div>
                            <div class="col-md-6">
                                <label for="inputlastname" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" maxlength="50" id="inputlastname"
                                    name="lastname" required
                                    <?php if(isset($result['firstname'])){echo "value='".$result['lastname']."'";}?>>
                            </div>
                            <div class="col-md-6">
                                <label for="inputUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" maxlength="50" id="inputUsername"
                                    name="username" 
                                    <?php if(isset($result['firstname'])){echo "value='".$result['Username']."'";}?>>
                            </div>
                            <div class="col-md-6">
                                <label for="inputRole" class="form-label">Role</label>
                                <input type="text" class="form-control" maxlength="50" id="inputRole"
                                    name="role" 
                                    <?php if(isset($result['firstname'])){echo "value='".$result['Role']."'";}?>>
                            </div>
                            <div class="col-md-6">
                                <button style="width: 100%;" type="button" class="btn btn-danger">Reset Password</button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button value="<?php echo $row['ID']?>" type="submit" name="submitDetails" method="post" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
                        <!-- Form Body End -->
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>


    </body>

</html>
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