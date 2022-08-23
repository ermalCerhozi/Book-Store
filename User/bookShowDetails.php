<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
include "../DBconnect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie details - My ASP.NET Application</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="userScript.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        body {
            padding-top: 100px;
        }

        p.card-text,
        li {
            font-size: 20px;
        }

        h5 {
            font-size: 30px;
        }
    </style>
</head>

<body>

    <?php
    include "../userHeader.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['isbn'])) {
        $isbn = $_GET['isbn'];

        $stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id 
    inner join publishing_house p on b.publishing_house_id = p.publishing_house_id
     inner join author a on b.author_id = a.author_id where ISBN = ? ");
        $stmt->execute(array($isbn));
        $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($rez) == 0) {
            echo json_encode(["Return" => false, "Message" => "Nuk ekziston libri me kete id"]);
        } else {
    ?>

            <div class="container body-content" style="width: 100%;">
                <div class="row" style="width: 100%;">
                    <div class="col-md-12">
                        <div class="card mb-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-header text-white bg-info">
                                        <p class="card-text">
                                        <h5 class="card-title">
                                            <b>Title: </b> <?php echo $rez[0]["book_name"] ?>
                                        </h5>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <img src="../book_cover/<?php echo $rez[0]["book_cover"]; ?>" alt="Image" width="100%" height="500px" />
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body">
                                        <p class="card-text"><b>Description: </b><?php echo $rez[0]["description"] ?></p>
                                        <p class="card-text">
                                            <b>Publishing House: </b>
                                            <?php echo $rez[0]["book_name"] ?>
                                        </p>
                                        <p class="card-text">
                                            <b>Authors: </b>
                                            <?php echo $rez[0]["author_name"] . " " . $rez[0]["author_surname"]; ?>
                                        </p>
                                        <p class="card-text"><b>Category: </b><?php echo $rez[0]["category_name"]; ?></p>
                                        <p class="card-text"><b>Publishing Date: </b><?php echo $rez[0]["publishing_date"]; ?></p>
                                        <p class="card-text"><b>Description: </b><?php echo $rez[0]["description"]; ?></p>
                                        <p class="card-text"><b>Price: </b><?php echo $rez[0]["price"]; ?>$</p>
                                        <div class="row">
                                            <p class="card-text col-md-2">
                                                <a class="btn btn-primary" href="javascript:history.back()">Back</a>
                                                <!-- <a class="btn btn-success" href="/ShoppingCart/Add/389210938129">Add To Cart (Price $80.00 )</a> -->
                                            </p>     
                                            <p class="btn btn-outline-success float-right add col-md-8" style="margin-left:2% ;">
                                                <i class="bi bi-credit-card-fill" data-ISBN=<?php echo $rez[0]["ISBN"]; ?> data-price=<?php echo $rez[0]["price"]; ?>></i> Add To Shopping Cart
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <hr />
            </div>
</body>

</html>
<?php
        }
    } else {
    }






?>