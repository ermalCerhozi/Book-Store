<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: ../Authentification/login.php');
    exit();
} else if ($_SESSION['role'] == 'user') {
    header('Location: ../User/home.php');
    exit();
}
include '../DBconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User Data</title>
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
    <link rel="stylesheet" href="bookStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="bookCrudScript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
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
        }

        /* table tr ul.actions {margin: 0; white-space:nowrap;} */
    </style>
</head>

<body>
    <?php
    include "../Admin/header.php";
    ?>

    <div class="container" id="data-div" style="margin-top: 70px;width: 100%;">
        <p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Manage <b>Books</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <!-- <button type="button" id="tmp" class="btn btn-primary" data-toggle="modal">
                            <i class="material-icons"></i> <span>Add New Book</span>
                        </button> -->
                        <a href="#addBookModal" id="add-book-button" class="btn btn-success" data-toggle="modal" data-target="#addBookModal"><i class="material-icons"></i> <span style="color: white;">Add New Book</span></a>
                        <!-- <a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a> -->
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover" id="index-table">
                <thead>
                    <tr style="font-size: large;">
                        <th>ISBN</th>
                        <th>TITULLI</th>
                        <th>PRICE</th>
                        <th>AUTHOR NAME</th>
                        <th>QUANTITY</th>
                        <th>PUBLISHING DATE</th>
                        <th>DESCRIPTION</th>
                        <th>CATEGORY</th>
                        <th>PUBLISHING HOUSE</th>
                        <th>BOOK</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    require_once "bookIndex.php";
                    ?>
                </tbody>
            </table>
            <!-- 
                    </div>
                </div> -->
            <!-- Add Modal HTML -->
            <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true" aria-labelledby="exampleModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add Book</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <form id="user_form" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="number" id="id" name="id" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>BOOK NAME</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>AUTHOR FULLNAME</label>
                                    <select name="author_fullname" id="author_fullname" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from author");
                                        $stmt->execute();
                                        $i = 0;
                                        //vendos id direkte tek option jo emri
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["author_id"] ?>"> <?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <br>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="author_fullname" name="author_fullname" class="form-control" placeholder="Author Fullname" required> -->
                                </div>
                                <div class="form-group">
                                    <label>PRICE</label>
                                    <input type="number" id="price" name="price" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>QUNATITY</label>
                                    <input type="number" id="quantity" name="quantity" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>PUBLISHING DATE</label>
                                    <input type="number" id="date" name="date" class="form-control" placeholder="yyyy" step="1" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>DESCRIPTION</label>
                                    <input type="text" id="description" name="description" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>PUBLISHING HOUSE</label>
                                    <select name="publishing_house" id="publishing_house" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from publishing_house");
                                        $stmt->execute();
                                        $i = 0;
                                        //vendos id direkte tek option jo emri
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["publishing_house_id"] ?>"> <?php echo $row[$i]["name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
                                </div>
                                <div class="form-group">
                                    <label>CATEGORY</label>
                                    <select name="category" id="category" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from book_category");
                                        $stmt->execute();
                                        $i = 0;
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["category_id"] ?>"> <?php echo $row[$i]["category_name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="category" name="category" class="form-control" required> -->
                                </div>
                                <div class="form-group">
                                    <label> BOOK COVER</label>
                                    <input type="file" id="book_cover" name="book_cover" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>BOOK FILE</label>
                                    <input type="file" id="book_file" name="book_file" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
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
            <div id="editBookModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="update_form">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="number" id="id_e" name="id" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>BOOK NAME</label>
                                    <input type="text" id="title_e" name="title" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>PRICE</label>
                                    <input type="number" id="price_e" name="price" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>AUTHOR FULLNAME</label>
                                    <select name="author_fullname" id="author_fullname_e" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from author");
                                        $stmt->execute();
                                        $i = 0;
                                        //vendos id direkte tek option jo emri
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"] ?>"> <?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="author_fullname" name="author_fullname" class="form-control" placeholder="Author Fullname" required> -->
                                </div>
                                <div class="form-group">
                                    <label>QUNATITY</label>
                                    <input type="number" id="quantity_e" name="quantity" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>PUBLISHING DATE</label>
                                    <input type="number" id="date_e" name="date" class="form-control" step="1" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>DESCRIPTION</label>
                                    <input type="text" id="description_e" name="description" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>

                                <div class="form-group">
                                    <label>PUBLISHING HOUSE</label>
                                    <select name="publishing_house" id="publishing_house_e" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from publishing_house");
                                        $stmt->execute();
                                        $i = 0;
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                                // if ($row[$i]["name"] == $("tr #")) {
                                                //     # code...
                                                // }
                                        ?>
                                                <option value="<?php echo $row[$i]["name"] ?>"> <?php echo $row[$i]["name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="publishing_house_e" name="publishing_house" class="form-control" required> -->
                                </div>
                                <div class="form-group">
                                    <label>CATEGORY</label>
                                    <select name="category" id="category_e" class="form-select form-select-md" required>
                                        <?php

                                        $stmt = $pdo->prepare("Select * from book_category");
                                        $stmt->execute();
                                        $i = 0;
                                        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                                            for ($i = 0; $i < count($row); $i++) {
                                        ?>
                                                <option value="<?php echo $row[$i]["category_name"] ?>"> <?php echo $row[$i]["category_name"] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                    <!-- <input type="text" id="category_e" name="category" class="form-control" required> -->
                                </div>
                                <div class="form-group">
                                    <label> BOOK COVER</label>
                                    <input type="file" id="book_cover_e" name="book_cover" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
                                </div>
                                <div class="form-group">
                                    <label>BOOK FILE</label>
                                    <input type="file" id="book_file_e" name="book_file" class="form-control" required>
                                    <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
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
            <div id="deleteBookModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form id="delete-form">

                            <div class="modal-header">
                                <h4 class="modal-title">Delete User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="id_d" name="id_d" class="form-control">
                                <p>Are you sure you want to delete these book?</p>
                                <p class="text-warning"><small>This action cannot be undone.</small></p>
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