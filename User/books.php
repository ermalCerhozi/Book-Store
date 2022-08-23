<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="userScript.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <?php
    include "../userHeader.php";
    ?>
    <br>
    <br>
    <div class="row" style="margin-left: 10%; margin-top:5%;">
        <form class="" id="search-form">
            <label for="SearchCategory">Search by</label>
            <select class="col-md-1" data-live-search="true" aria-label="Default select example" name="SearchCategory" id="SearchCategory" style="margin-left: 10px;">
                <?php
                $tmp;
                if ($tmp == "Title") {
                ?><option value="Title" selected>Title</option>
                <?php
                } else {
                ?><option value="Title">Title</option>

                <?php
                }
                if ($tmp == "Author") {
                ?><option value="Author" selected>Author</option>

                <?php
                } else {
                ?><option value="Title">Author</option>
                <?php
                }
                if ($tmp == "PubishingHouse") {
                ?><option value="PubishingHouse" selected>Pubishing House</option>
                <?php
                } else {
                ?><option value="Title">Publishing House</option>
                <?php
                }
                ?>
            </select>
            <input type="text" class="col-md-2" id="Search" name="Search" />
        </form>
    </div>
    <hr>

    <div id="display-div">
        <?php
        include("bokIndex.php");
        ?>
    </div>

</body>

</html>