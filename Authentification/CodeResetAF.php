<?php
session_start();
if ($_SESSION['permisson'] != "code") {
    header("Location: login.php");
}
if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
}
if (isset($_SESSION['role'])) {
    header('Location: home.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container centered">
        <form id="CodeResetAF">
            <h6 style="color: white;">Please enter your 6 digit code we sent you via email.</h6>
            <div class="form-group">
                <input type="number" class="form-control" name="Code" id="Code" placeholder="------" style="text-align: center;">
                <span class="invalid-feedback" style="color: red;"></span>
            </div>
            <div class="btn-group">
                <button id="codeResetButton" class="btn btn-primary active">Submit</button>
            </div>
        </form>

        <script src="script1.js"></script>
</body>

</html>