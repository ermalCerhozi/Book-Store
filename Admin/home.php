<?php
session_start();
if (isset($_SESSION['permisson'])) {
    unset($_SESSION['permisson']);
}
if (isset($_SESSION['access_token'])) {
    unset($_SESSION['access_token']);
}
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
if ($_SESSION['role'] == "user") {
    header('Location: ../User/home.php');
    exit();
}
include "../DBconnect.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Admin</title>
</head>

<body>
    <?php
    include "header.php";
    ?>
    <div style="padding-top: 25px; margin-left: 60px; margin-right: 60px ;">

        <div class="row pad-botm" style="text-align: center; color: blue;">
            <div class="col-md-12">
                <h3 class="header-line">ADMIN DASHBOARD</h3>
            </div>
        </div>
        <hr>
        <?php
        $stmt = $pdo->prepare("SELECT count(ISBN) from book");
        $stmt->execute();
        $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

        ?>
        <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-6">
                <a href="../book/Books.php">
                    <div class="alert alert-success back-widget-set text-center" style="text-decoration: none;">
                        <i class="fa fa-book fa-5x"></i>
                        <p>Number of books: <?php echo $count[0]["count(ISBN)"] ?></p>
                    </div>
                </a>
            </div>
            <?php
            $stmt = $pdo->prepare("SELECT count(person_id) from person");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <div class="col-md-3 col-sm-3 col-xs-6">
                <a href="../UsersCrud/users.php">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-users fa-5x"></i>
                        <p>
                            <?php echo $count[0]["count(person_id)"] ?>
                            users
                        </p>
                    </div>
                </a>
            </div>

            <?php
            $stmt = $pdo->prepare("SELECT count(person_id) from person where IsDeleted = 0");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>

            <div class="col-md-3 col-sm-3 col-xs-6">
                <a href="#">
                    <div class="alert alert-danger back-widget-set text-center">
                        <i class="fa fa-users fa-5x"></i>
                        <P><?php echo $count[0]["count(person_id)"] ?> Active Users</P>
                    </div>
                </a>
            </div>

            <?php
            $stmt = $pdo->prepare("SELECT count(payment_id) from payment");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <a href="#">
                    <div class="alert alert-success back-widget-set text-center">
                        <i class="fa fa-credit-card fa-5x"></i>
                        <P><?php echo $count[0]["count(payment_id)"] ?> Payments</P>
                    </div>
                </a>
            </div>
        </div>


        <div class="row">
            <?php
            $stmt = $pdo->prepare("SELECT Sum(total) from payment");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="col-md-3 col-sm-3 rscol-xs-6">
                <a href="#">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-dollar fa-5x"></i>
                        <P><?php echo $count[0]["Sum(total)"] ?> Total Sales</P>
                    </div>
                </a>
            </div>

            <?php
            $stmt = $pdo->prepare("SELECT count(subscription_id) from subscription");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="col-md-3 col-sm-3 rscol-xs-6">
                <a href="#">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-rocket fa-5x"></i>
                        <P><?php echo $count[0]["count(subscription_id)"] ?> Subscriptions</P>
                    </div>
                </a>
            </div>
            <?php
            $current_date = date('Y-m-d', time());
            $stmt = $pdo->prepare("SELECT count(subscription_id) from user_subscription where subscription_finish_date > $current_date");
            $stmt->execute();
            $count = $stmt->fetchAll(PDO::FETCH_ASSOC);

            ?>
            <div class="col-md-3 col-sm-3 rscol-xs-6">
                <a href="#">
                    <div class="alert alert-info back-widget-set text-center">
                        <i class="fa fa-rocket fa-5x"></i>
                        <P><?php echo $count[0]["count(subscription_id)"] ?> Active Subcritpions</P>
                    </div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>