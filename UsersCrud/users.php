<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../Authentification/login.php');
    exit();
} else if ($_SESSION['role'] != 'admin' && $_SESSION['role'] == 'worker' ) {
    header('Location: ../Admin/home.php');
    exit();
}
else if(['role'] == 'user'){
    header('Location: ../User/home.php');
    exit();
}
include '../DBconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Data</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <link rel="stylesheet" href="ready.css"> -->
    <link rel="stylesheet" href="../book/bookStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="userCrudScript.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <style>
        table,
        th,
        td {
            width: 100%;

        }

        table th,
        td,
        tr {
            font-size: 10px;
            text-align: center;
        }
        /* table tr ul.actions {margin: 0; red-space:nowrap;} */
    </style>
</head>

<body>
    <?php
    include "../Admin/header.php";

    ?>
    <div class="table-responsive container" id="data-div" style="margin-top: 70px;width: 100%;">
        <p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Users</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- <button type="button" id="tmp" class="btn btn-primary" data-toggle="modal">
                            <i class="material-icons"></i> <span>Add New Book</span>
                        </button> -->
                        <a href="#addUserModal" style="color: white;" id="add-user-button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal"><i class="material-icons"></i> <span style="color: white;">Add New User</span></a>
                        <!-- <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a> -->
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="index-table"">
                <thead>
                    <tr style=" font-size: large;">
                <th>Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Datelindja</th>
                <th>Qyteti</th>
                <th>Rruga</th>
                <th>Kodi Postar</th>
                <th>Roli</th>
                <th>Status</th>
                <th>Action</th>
                </tr>
                </thead>
                <tbody>

                    <?php
                    require_once "userIndex.php";
                    ?>
                </tbody>
            </table>
            <!-- 
                    </div>
                </div> -->
            <!-- Add Modal HTML -->
            <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add User</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form id="registraionForm" method="POST" enctype="multipart/form-data">
                                <div class="form-group col-12">
                                    <label>NAME</label>
                                    <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" minlength="5" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>SURNAME</label>
                                    <input type="text" class="form-control" name="Surname" id="Surname" placeholder="Surename" required>
                                    <span class="invalid-feedback">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>EMAIL</label>
                                    <input type="email" class="form-control" name="Email" id="Email" placeholder="Enter email" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>ROLE</label>
                                    <select name="Role" id="Role" class="form-select form-select-md" required>
                                        <option value="Admin">Admin</option>
                                        <option value="User" selected>User</option>
                                        <option value="Worker"> Worker</option>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
                                </div>

                                <div class="form-group col-12">
                                    <label>PASSWORD</label>
                                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Password" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>

                                <div class="form-group col-12">
                                    <label>CONFIRM PASSWORD</label>
                                    <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
                                    <span class="invalid-feedback" style="color: red;">Passwordi duhet te jete i njejti</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>BIRTHDAY</label>
                                    <input type="date" class="form-control" name="Birthday" id="Birthday" placeholder="mm/dd/yyyy" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>STREET</label>
                                    <input type="text" class="form-control" name="Street" id="Street" placeholder="Street">
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>POSTAL CODE</label>
                                    <input type="number" class="form-control" name="PostalCode" id="PostalCode" placeholder="PostalCode">
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>

                                <div class="form-group">
                                    <label>CITY</label>
                                    <select name="City" id="City" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select city_name from city");
                                        $stmt->execute();
                                        $i = 0;
                                        //vendos id direkte tek option jo emri
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["city_name"] ?>"> <?php echo $row[$i]["city_name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="1" name="type">
                            <input type="button" class="btn btn-default" id="cancel-button" data-dismiss="modal" value="Cancel">
                            <button type="button" class="btn btn-success" id="btn-add">Add</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- </div>
                </div> -->





            <!-- Edit Modal HTML -->
            <div id="editUserModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="update_form">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-12">
                                    <label>NAME</label>
                                    <input type="text" class="form-control" name="name_e" id="name_e" placeholder="Name" minlength="5" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>SURNAME</label>
                                    <input type="text" class="form-control" name="surname_e" id="surname_e" placeholder="Surename" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>EMAIL</label>
                                    <input type="email" class="form-control" name="email_e" id="email_e" placeholder="Enter email" required readonly>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>Role</label>
                                    <select name="role_e" id="role_e" class="form-select form-select-md" required>
                                        <option value="admin">Admin</option>
                                        <option value="user" selected>User</option>
                                        <option value="worker"> Worker</option>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
                                </div>
                                <div class="form-group col-12">
                                    <label>BIRTHDAY</label>
                                    <input type="date" class="form-control" name="birthday_e" id="birthday_e" placeholder="mm/dd/yyyy" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>STREET</label>
                                    <input type="text" class="form-control" name="streetName_e" id="streetName_e" placeholder="Street">
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group col-12">
                                    <label>POSTAL CODE</label>
                                    <input type="number" class="form-control" name="postalCode_e" id="postalCode_e" placeholder="PostalCode">
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>CITY</label>
                                    <select name="city_e" id="city_e" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select city_name from city");
                                        $stmt->execute();
                                        $i = 0;
                                        //vendos id direkte tek option jo emri
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["city_name"] ?>"> <?php echo $row[$i]["city_name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden" value="2" name="type">
                                <input type="button" id="cancel-button-e" class="btn btn-default" data-dismiss="modal" value="Cancel">
                                <button type="button" class="btn btn-info" id="update">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Delete Modal HTML -->
            <div id="deleteUserModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="delete-form">

                            <div class="modal-header">
                                <h4 id="modal-title" class="modal-title">Delete User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_d" name="id_d" class="form-control">
                                <input type="hidden" id="type_d" name="type_d" class="form-control">
                                <p id="first-warning-message">Are you sure you want to delete these user?</p>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-default" id="cancel-button-d" data-dismiss="modal" value="Cancel">
                                <button type="button" class="btn btn-danger" id="button-delete">Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <footer class="footer">
            <div class="container-fluid">
                <div class="copyright ml-auto">
                    2022, made with <i class="la la-heart heart text-danger"></i> by 4E Solution</a>
                </div>
            </div>
        </footer> -->
</body>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</html>