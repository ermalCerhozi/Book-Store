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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>

<body>
    <?php
    include "../userHeader.php";
    ?>
    <section class="bg-dark text-light p-5 p-lg-0 pt-lg-5 text-center text-sm-start" style="margin-top: 5%;">
        <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between">
                <div>
                    <h1>“Reading is essential for those who seek to rise above the ordinary.” <span class="text-warning"> - Jim Rohn </span></h1>
                    <p class="lead my-4">
                        We focus on bringing you the latest
                        and greatest books at the lowest price.
                    </p>
                    <button class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#enroll" href="">
                        Check our books!
                    </button>
                </div>
                <img class="img-fluid w-50 d-none d-sm-block" src="logo.png" />
            </div>
        </div>
    </section>


    <!-- Boxes -->
    <section class="p-5">
        <div class="container">
            <div class="row text-center g-4">
                <div class="col-md">
                    <div class="card bg-dark text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-laptop"></i>
                            </div>
                            <h3 class="card-title mb-3">Virtual</h3>
                            <p class="card-text">
                                You can keep up with your reading using our online platform.
                            </p>
                            <a href="../User/books.php" class="btn btn-primary">Read books</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-dark text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-person-square"></i>
                            </div>
                            <h3 class="card-title mb-3">Subscription</h3>
                            <p class="card-text">
                                Become a subscriber by buying our monthly deals to receive lower prices and the latest deals.
                            </p>
                            <a href="../User/subscriptionIndex.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
                <div class="col-md">
                    <div class="card bg-dark text-light">
                        <div class="card-body text-center">
                            <div class="h1 mb-3">
                                <i class="bi bi-people"></i>
                            </div>
                            <h3 class="card-title mb-3">In Person</h3>
                            <p class="card-text">
                                You can come and read quietly in our physical bookstore reading section at Zogu I Boulevard, Tirana.
                            </p>
                            <a href="../User/seatIndex.php" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Contact & Map -->
    <section class="p-5">
        <div class="container" style="text-align: center;">
            <div class="row g-4">
                <div class="col-md">
                    <h2 class="text-center mb-4">Contact Info</h2>
                    <ul class="list-group list-group-flush lead">
                        <li class="list-group-item">
                            <span class="fw-bold">Main Location:</span>Zogu I Boulevard, Tirana
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Student Phone:</span> (+355) 68 521 1111
                        </li>
                        <li class="list-group-item">
                            <span class="fw-bold">Email:</span> no.reply.1library@gmail.com
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="p-3 bg-dark text-white text-center position-relative">
        <div class="container">
            <p class="lead">Copyright &copy; 4E Solution</p>
            <a href="#" class="position-absolute bottom-0 end-0 p-3">
                <i class="bi bi-arrow-up-circle h1"></i>
            </a>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v2.1.1/mapbox-gl.js"></script>

    <script>
        mapboxgl.accessToken =
            'pk.eyJ1IjoiYnRyYXZlcnN5IiwiYSI6ImNrbmh0dXF1NzBtbnMyb3MzcTBpaG10eXcifQ.h5ZyYCglnMdOLAGGiL1Auw'
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v11',
            center: [-71.060982, 42.35725],
            zoom: 18,
        })
    </script>
</body>

</html>