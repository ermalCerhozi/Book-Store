<?php
session_start();
if (isset($_SESSION['permisson'])) {
    unset($_SESSION['permisson']);
}
if (isset($_SESSION['role'])) {
    header('Location: home.php');
    exit();
}
require_once "config.php";
//check if user is logged in with google or from normal user


// if (!empty($_SESSION["locked"])) {
//     $difference = (time() - $_SESSION["locked"]) / 60;
//     if ($difference > 2) {
//         unset($_SESSION["locked"]);
//         unset($_SESSION["login_attempts"]);
//         echo '<script>$("#LogInsubmitButton").show();</script>';
//     } else {
//         echo '<script>alert("Prisni akoma");$("#LogInsubmitButton").hide();</script>';
//     }
// } else {
//     if (!isset($_SESSION["login_attempts"])) {
//         $_SESSION["login_attempts"] = 0;
//     } else {
//         $_SESSION["login_attempts"] += 1;
//         if ($_SESSION["login_attempts"] > 2) {
//             $_SESSION["locked"] = time();
//             echo '<script>alert("Prisni 2 minuta");$("#LogInsubmitButton").hide();</script>';

//         }
//     }
// }


// if (!empty($_SESSION["locked"])) {
//     $difference = time() - $_SESSION["locked"];
//     if ($difference > 30) {
//         unset($_SESSION["locked"]);
//         unset($_SESSION["login_attempts"]);
//     }
// }
// // In sign-in form submit button
// if (!empty($_SESSION["login_attempts"])) {
//     if ($_SESSION["login_attempts"] > 2) {
//         $_SESSION["locked"] = time();
//         echo "Please wait for 30 seconds";
//     }
// }
$loginURL = $gClient->createAuthUrl();
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
        <form id="formLogIn">
            <h1 style="color: white;">Log in</h1>
            <br>
            <div class="form-group">
                <input type="email" class="form-control" id="Email" name="Email" placeholder="Enter email">
                <span class="invalid-feedback" style="color: white;"></span>
            </div>
            <br>
            <div class="form-group">
                <input type="password" class="form-control" id="Password" name="Password" placeholder="Password">
                <span class="invalid-feedback" style="color: white;"></span>
            </div>
            <!-- <div id="imgId" class="form-group col-md-6 col-xs-12 row">
                <label>Captcha Code</label>
                <img id="img" src="captcha.php" alt="PHP Captcha">
                <input class="form-control" type="text" name="Captcha" id="Captcha">
            </div> -->
            <br>
            <div>
            </div>
            <button type="submit" id="LogInsubmitButton" class="btn btn-primary col-md-6 col-xs-12">Continue</button>
            <br>
            <br>
            <input type="button" onclick="window.location = '<?php echo $loginURL ?>';" value="Log In With Google" class="btn btn-danger  col-md-6 col-xs-12">
            <p class="form_text">
                <a class="form_link" href="emailForReset.php" id="linkResetPassword">Forgot your password?</a>
            </p>
            <p class="form_text">
                <a class="form_link" href="Register.php" id="linkCreateAccount">Don't have an account? Create account</a>
            </p>
        </form>
    </div>
    <script src="script1.js"></script>
    <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        swal("Hello world!");
    </script> -->
</body>
<?php
if (isset($_SESSION['access_token']) || isset($_SESSION['role'])) {
    header('Location: home.php');
    exit();
}

if (!empty($_SESSION["locked"])) {
    $difference = (time() - $_SESSION["locked"]) / 60;
    if ($difference > 2) {
        unset($_SESSION["locked"]);
        unset($_SESSION["login_attempts"]);
        echo '<script>$("#LogInsubmitButton").prop("disabled", false);</script>';
    } else {
        echo '<script>alert("Prisni akoma");$("#LogInsubmitButton").prop("disabled", true);</script>';
    }
} else {
    if (!isset($_SESSION["login_attempts"])) {
        $_SESSION["login_attempts"] = 0;
    } else {
        $_SESSION["login_attempts"] += 1;
        if ($_SESSION["login_attempts"] > 5) {
            $_SESSION["locked"] = time();
            echo '<script>alert("Prisni 2 minuta");$("#LogInsubmitButton").prop("disabled", true);</script>';
        }
    }
}
?>

</html>