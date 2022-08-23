<?php
session_start();
if (isset($_SESSION['permisson'])) {
    unset($_SESSION['permisson']);
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .centered {
            width: 50%;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>

<body>
    <div class="container centered ">
        <form id="registraionForm">
            <h1 style="color: #ffffff;">Register</h1>
            <div class="form-group col-12">
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" minlength="5" required>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="text" class="form-control" name="Surname" id="Surname" placeholder="Surename" required>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="email" class="form-control" name="Email" id="Email" placeholder="Enter email" required>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="password" class="form-control" name="Password" id="Password" placeholder="Password"required>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="password" class="form-control" name="ConfirmPassword" id="ConfirmPassword" placeholder="Confirm Password">
                <span class="invalid-feedback" style="color: white;">Passwordi duhet te jete i njejti</span>
            </div>
            <div class="form-group col-12">
                <input type="date" class="form-control" name="Birthday" id="Birthday"  placeholder="mm/dd/yyyy" required>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <select class="form-select h-150 w-100" aria-label="Default select example" name="City" id="City">
                    <option value="Tirane" selected>Tirane</option>
                    <option value="Durres">Durres</option>
                    <option value="Elbasan">Elbasan</option>
                    <option value="Shkoder">Shkoder</option>
                    <option value="Vlore">Vlore</option>
                    <option value="Korce">Korce</option>
                    <option value="Diber">Diber</option>
                    <option value="Kukes">Kukes</option>
                    <option value="Kruje">Kruje</option>
                    <option value="Lezhe">Lezhe</option>
                    <option value="Sarande">Sarande</option>
                    <option value="Gjirokaster">Gjirokaster</option>
                </select>
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="text" class="form-control" name="Street" id="Street" placeholder="Street">
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="form-group col-12">
                <input type="number" class="form-control" name="PostalCode" id="PostalCode" placeholder="PostalCode">
                <span class="invalid-feedback" style="color: white;">Emri eshte gabim</span>
            </div>
            <div class="btn-group col-12">
                <<button id="RegisterSubmitButton" class="btn btn-primary active">Submit</button>
            </div>
            <p class="form_text">
                <a class="form_link" href="login.php" id="linklogin">Already have an account? Click here.</a>
            </p>
        </form>
    </div>
    <script src="script1.js"></script>
</body>

</html>