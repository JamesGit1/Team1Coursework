<?php
require_once('../conn.php');
session_start();
require('loginStatus.php');

// if the researcher is not logged in as a lab manager, redirect them to the dashboard as they do not have access to the page
if ($_SESSION["role"] != "labmanager") {
    header("location: ../dashboard.php");
    exit;
}

// when the form has been filled out for the lab manager filling out the new details for the client,
// change the details of the researcher
if (isset($_POST['submitDetails'])) {
    $userID = $_POST['inputID'];

    // find the researcher that is meant to be being edited and change their details
    $query = "UPDATE account SET `firstname` = :firstname, `lastname` = :lastname, `Role` = :role, `Username` = :username WHERE `ID` = $userID;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":firstname", $firstname);
    $stmt->bindParam(":lastname", $lastname);
    $stmt->bindParam(":role", $role);
    $stmt->bindParam(":username", $username);

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $username = $_POST['username'];

    $stmt->execute();
    unset($stmt);

    // tell the researcher that the details were successfully edited
    echo "<div class='alert alert-warning' role='alert' style='margin-bottom: 0px;padding-bottom: 5px;padding-top: 5px;'>";
    echo "Details Updated!";
    echo "</div>";
}

// if the form has been filled out so that the lab manager wants to edit the password of the researcher
if (isset($_POST['resetPassword'])) {
    $userID = $_POST['inputID'];

    // find the researcher that is being edited and set their password to the new password
    $query = "UPDATE account SET `Password` = :password WHERE `ID` = $userID;";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":password", $password);

    // hash the new password before sending it off
    $password = hash('sha256', "password");

    $stmt->execute();
    unset($stmt);

    echo "<div class='alert alert-warning' role='alert' style='margin-bottom: 0px;padding-bottom: 5px;padding-top: 5px;'>";
    echo "<strong>[" . $_POST['inputID'] . "]" . "</strong> " . $_POST['firstname'] . " " . $_POST['lastname'] . " - User account password changed to `<strong>password</strong>`";
    echo "</div>";
}

// if the lab manager wants to delete a researcher's account
if (isset($_POST['deleteAccount'])) {
    $userID = $_POST['inputID'];

    // find the account that the lab manager wants to delete and fetch their details
    $query = "SELECT * FROM account WHERE `ID` = $userID;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $details = $stmt->fetch();
    unset($stmt);

    // delete the researcher from the table
    $query = "DELETE FROM account WHERE `ID` = $userID;";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    unset($stmt);

    // allow this action to be undone as it could have been done by accident
    echo "<div class='alert alert-warning' role='alert' style='margin-bottom: 0px;padding-bottom: 5px;padding-top: 5px;'>";
    echo "<strong>[" . $_POST['inputID'] . "]" . "</strong> " . $_POST['firstname'] . " " . $_POST['lastname'] . " - User account DELETED";
    echo "<form method='post' style='display: inline;'><button type='submit' style='padding-top: 2px;' name='undoDelete' method='post' class='btn btn-link'>Undo</button></form>";
    echo "</div>";

    // this is the code to add the deleted researcher's details to an array
    $_SESSION["Restore"] = array(
        "ID" => $details["ID"],
        "firstname" => $details["firstname"],
        "lastname" => $details["lastname"],
        "Username" => $details["Username"],
        "Password" => $details["Password"],
        "Role" => $details["Role"],
    );
}

// if the lab manager has chosen to restore a researcher's details,
if (isset($_POST['undoDelete'])) {
    $query = "INSERT INTO account (`ID`,`firstname`,`Username`,`Password`,`Role`, `lastname`) VALUES (:id,:name,:username,:password,:role,:lastname)";

    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":id", $id, PDO::PARAM_STR);
    $stmt->bindParam(":name", $name, PDO::PARAM_STR);
    $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
    $stmt->bindParam(":username", $username, PDO::PARAM_STR);
    $stmt->bindParam(":password", $hashedpassword, PDO::PARAM_STR);
    $stmt->bindParam(":role", $role, PDO::PARAM_STR);

    // get the researcher's details and send them to the database.
    $id = $_SESSION["Restore"]["ID"];
    $name = $_SESSION["Restore"]["firstname"];
    $username = $_SESSION["Restore"]["Username"];
    $hashedpassword = $_SESSION["Restore"]["Password"];
    $lastname = $_SESSION["Restore"]["lastname"];
    $role = $_SESSION["Restore"]["Role"];

    // send all their details back to the database to reinstate them as a researcher
    $stmt->execute();
    unset($stmt);
}

// get all the details of the researchers
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
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico"/>


</head>

<body>
<div id="nav-placeholder">

</div>
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
            <!-- display all the details of the researchers in a table and add their details to the button
                this way it means that when the modal appears it can read all the data from the button and display
                it in the modal. -->
            <?php foreach ($result as $row) { ?>
                <tr>
                    <th scope="row"><?php echo $row['ID'] ?></th>
                    <td><?php echo ucfirst($row['Role']) ?></td>
                    <td><?php echo $row['firstname'] . " " . $row['lastname'] ?></td>
                    <td><?php echo $row['Username'] ?></td>
                    <td>
                        <button type="button" data-identity="<?php echo $row['ID']; ?>"
                                data-firstname="<?php echo $row['firstname'] ?>"
                                data-lastname="<?php echo $row['lastname'] ?>"
                                data-username="<?php echo $row['Username'] ?>" data-role="<?php echo $row['Role'] ?>"
                                id="<?php echo $row['ID']; ?>" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModalCenter">Edit
                        </button>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- This is the modal that appears when the lab manager wants to edit someone's details -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="modallabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modallabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form body for the form to edit someone's details -->
                <form class="row g-3" style="padding-top: 0px;" method="post">
                    <div class="col-md-2" style="padding-top: 7px;width: 36px;">
                        <label for="inputID" class="form-label">ID</label>
                    </div>
                    <div class="col-md-10">
                        <input style="width:45px" readonly type="text" class="form-control" maxlength="50"
                               id="inputID" name="inputID">
                    </div>
                    <div class="col-md-6">
                        <label for="inputfirstname" class="form-label">First Name *</label>
                        <input type="text" class="form-control" maxlength="50" id="inputfirstname" name="firstname"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputlastname" class="form-label">Last Name *</label>
                        <input type="text" class="form-control" maxlength="50" id="inputlastname" name="lastname"
                               required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputUsername" class="form-label">Username *</label>
                        <input type="text" class="form-control" maxlength="50" id="inputUsername" name="username"
                               required>
                    </div>
                    <div class="col-md-6" style="margin-bottom: 30px;">
                        <label for="inputRole" class="form-label">Role *</label>
                        <select class="form-control" aria-label="select" id="inputRole" name="role">
                            <option value="researcher" selected>Researcher</option>
                            <option value="labmanager">Lab Manager</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <button style="width: 100%;" type="submit" name="resetPassword" method="post"
                                class="btn btn-danger" id="resetButton"><strong>Reset
                                Password</strong></button>
                    </div>
                    <div class="col-md-6">
                        <button style="width: 100%;" type="submit" name="deleteAccount" method="post"
                                class="btn btn-danger" id="deleteButton"><strong>Delete Account</strong></button>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="submitDetails" method="post" class="btn btn-primary">Save
                            changes
                        </button>
                    </div>
                </form>
                <!-- Form Body End -->
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

<!-- script to add the navbar to the page -->
<script>
    $(function () {
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
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- this is the script to get the details from the button and insert them into the modal -->
<script>
    // from: https://getbootstrap.com/docs/4.0/components/modal/#events
    $('#exampleModalCenter').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget) // button that triggered the modal
        var id = button.data('identity') // Extract info from data-* attributes
        var firstname = button.data('firstname')
        var lastname = button.data('lastname')
        var username = button.data('username')
        var role = button.data('role')

        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-header #modallabel').text("Editing: " + firstname + " " + lastname)
        $('#inputID').val(id);
        $('#inputfirstname').val(firstname);
        $('#inputlastname').val(lastname);
        $('#inputUsername').val(username);
        $('#inputRole').val(role);
    })
</script>