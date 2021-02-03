<?php
    require_once('../conn.php');
    session_start();
    require('loginStatus.php');
    if (isset($_POST['submitDetails'])) {
        $id = $_SESSION['UserID'];
        $query = "SELECT * FROM account WHERE `ID` = $id";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $passcheck = $stmt->fetch();
        unset($stmt);

        $oldpassword = $_POST['oldpassword'];
        $oldpassword = hash('sha256', $oldpassword);

        if($oldpassword==$passcheck["Password"]){
            $query = "UPDATE account SET `firstname` = :firstName, `Password` = :password, `lastname` = :lastName WHERE `ID` = $id;";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":firstName", $firstname);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":lastName", $lastname);
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];

            $newpassword = $_POST['newpassword'];
            if(empty($newpassword)){
                $password = $_POST['oldpassword'];
            }
            else{
                $password = $newpassword;
                $password = hash('sha256', $password);
            }
            $stmt->execute();
            unset($stmt);
            echo "<div class='alert alert-warning' role='alert' style='margin-bottom: 0px;padding-bottom: 5px;padding-top: 5px;'>";
            echo "Details Updated!";
            echo "</div>";
        }
        else{
            echo "<div class='alert alert-danger' role='alert' style='margin-bottom: 0px;padding-bottom: 5px;padding-top: 5px;'>";
            echo "Details failed to update, Password incorrect?";
            echo "</div>";
        }
        unset($passcheck);
    }
        
    if(isset($_SESSION['name'])){
        $name = $_SESSION['name'];
        $id = $_SESSION['UserID'];
    }

    $query = "SELECT * FROM account WHERE `ID` = $id";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
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
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            style="margin-right: 3em;">
                            Hello, <?php if(isset($name)){echo $name;}else{echo "user";}?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="../accountSystem/accountDetails.php">Account Details</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../accountSystem/logOut.php">Log Out</a></li>
                        </ul>
                    </li>
                </ul>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <h1><u>Account Details</u></h1>
        </div>
        <div class="row" style="padding-top: 20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Details</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Role</th>
                        <td><?php echo ucfirst($result['Role'])?></td>
                    </tr>
                    <tr>
                        <th scope="row">Name</th>
                        <td><?php echo $result['firstname']." ".$result['lastname']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Username</th>
                        <td><?php echo $result['Username']; ?></td>
                    </tr>
                    <tr>
                        <th scope="row">Password</th>
                        <td colspan="2"><em>hidden</em></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row justify-content-end">
            <!-- Button trigger modal -->
            <div class="button-holder" style="justify-content:flex-end;display:flex;">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal">
                    Edit
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form Body -->
                        <form class="row g-3" style="padding-top: 0px;" method="post">
                            <div class="col-md-6">
                                <label for="inputfirstname" class="form-label">First Name *</label>
                                <input type="text" class="form-control" maxlength="50" id="inputfirstname"
                                    name="firstname" required
                                    <?php if(isset($result['firstname'])){echo "value='".$result['firstname']."'";}?>>
                            </div>
                            <div class="col-md-6">
                                <label for="inputlastname" class="form-label">Last Name *</label>
                                <input type="text" class="form-control" maxlength="50" id="inputlastname"
                                    name="lastname" required
                                    <?php if(isset($result['firstname'])){echo "value='".$result['lastname']."'";}?>>
                            </div>
                            <div class="col-12">
                                <label for="inputUsername" class="form-label">Username (Please get in contact to
                                    change)</label>
                                <input type="text" class="form-control" maxlength="50" id="inputUsername"
                                    name="username" readonly
                                    <?php if(isset($result['firstname'])){echo "value='".$result['Username']."'";}?>>
                            </div>
                            <div class="col-md-6">
                                <label for="inputoldpass" class="form-label">Old Password *</label>
                                <input type="password" class="form-control" maxlength="20" id="inputoldpass"
                                    name="oldpassword" required>
                            </div>
                            <div class="col-md-6">
                                <label for="inputnewpass" class="form-label">New Password</label>
                                <input type="password" class="form-control" maxlength="20" id="inputnewpass"
                                    name="newpassword">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="submitDetails" method="post" class="btn btn-primary">Save
                                    changes</button>
                            </div>
                        </form>
                        <!-- Form Body End -->
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
</body>

</html>