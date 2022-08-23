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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="seatStyle.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://write.corbpie.com/wp-content/litespeed/localres/aHR0cHM6Ly9jZG5qcy5jbG91ZGZsYXJlLmNvbS8=ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Movie Seat Booking</title>
</head>

<body>
    <div class="movie-container">
        <br>
        <span>
            Selected seat : <p id="seat-number"></p>
        </span>
    </div>

    <ul class="showcase">
        <li>
            <div class="seat"></div>
            <small>N/A</small>
        </li>

        <li>
            <div class="seat selected"></div>
            <small>Selected</small>
        </li>

        <li>
            <div class="seat occupied"></div>
            <small>Occupied</small>
        </li>
    </ul>

    <div class="container">
        <div class="row">
            <div id="1" class="seat"></div>
            <div id="2" class="seat"></div>
            <div id="3" class="seat"></div>
            <div id="4" class="seat"></div>
            <div id="5" class="seat"></div>
            <div id="6" class="seat"></div>
            <div id="7" class="seat"></div>
            <div id="8" class="seat"></div>
        </div>
        <div class="row">
            <div id="9" class="seat"></div>
            <div id="10" class="seat"></div>
            <div id="11" class="seat"></div>
            <div id="12" class="seat"></div>
            <div id="13" class="seat"></div>
            <div id="14" class="seat"></div>
            <div id="15" class="seat"></div>
            <div id="16" class="seat"></div>
        </div>

        <div class="row">
            <div id="17" class="seat"></div>
            <div id="18" class="seat"></div>
            <div id="19" class="seat"></div>
            <div id="20" class="seat"></div>
            <div id="21" class="seat"></div>
            <div id="22" class="seat"></div>
            <div id="23" class="seat"></div>
            <div id="24" class="seat"></div>
        </div>

        <div class="row">
            <div id="25" class="seat"></div>
            <div id="26" class="seat"></div>
            <div id="27" class="seat"></div>
            <div id="28" class="seat"></div>
            <div id="29" class="seat"></div>
            <div id="30" class="seat"></div>
            <div id="31" class="seat"></div>
            <div id="32" class="seat"></div>
        </div>

        <div class="row">
            <div id="33" class="seat"></div>
            <div id="34" class="seat"></div>
            <div id="35" class="seat"></div>
            <div id="36" class="seat"></div>
            <div id="37" class="seat"></div>
            <div id="38" class="seat"></div>
            <div id="39" class="seat"></div>
            <div id="40" class="seat"></div>
        </div>

        <div class="row">
            <div id="41" class="seat"></div>
            <div id="42" class="seat"></div>
            <div id="43" class="seat"></div>
            <div id="44" class="seat"></div>
            <div id="45" class="seat"></div>
            <div id="46" class="seat"></div>
            <div id="47" class="seat"></div>
            <div id="48" class="seat"></div>
        </div>
    </div>
    <br>
    <form id="form">
        <label for="from">From: </label>
        <input id="start" class="time-element" name="start" type="number" value="<?php echo date("H", time()) ?>">

        <label for="to">To: </label>
        <input id="end" class="time-element" name="end" type="number" value="<?php echo date("H", time()) + 1 ?>">
        <button id="reserve-button">Rezervo vendin</button>
    </form>

    <!-- <p class="text">
      You have selected <span id="count">0</span> seats for a price of $<span id="total">0</span>
    </p> -->
    <script src="seatScript.js"></script>
</body>

</html>