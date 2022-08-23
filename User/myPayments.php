<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
include "../DBconnect.php";

$id = $_SESSION["user_id"];
$stmt = $pdo->prepare("Select * from payment p  inner join shopping_cart_book s on p.payment_id = s.Payment_id inner join book b on b.ISBN = s.ISBN_shoppingCart where p.User_id = ?");
$stmt->execute(array($id));
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="heading">
    <h1>My Payments</h1>
</div>
<?php
if (count($row) > 0) {
?>
    <table class="table table-striped table-hover" id="index-table">
        <thead>
            <tr style="font-size: large;">
                <th>BOOK</th>
                <th>TITLE</th>
                <th>PRICE</th>
                <th>DATE OF PAYMENT</th>
            </tr>
        </thead>
        <tbody>
            <?php
            for ($i = 0; $i < count($row); $i++) {
            ?>
                <tr>
                    <td class="col-4">
                        <a href="../book_file/<?php echo $row[$i]["book_file"]; ?>" target="_blank">
                            <img src="../book_cover/<?php echo $row[$i]["book_cover"]; ?>" alt="<?php echo $row[$i]["book_name"]; ?>" width="200px" height="200px">
                        </a>
                    </td>
                    <td><?php echo $row[$i]["book_name"]; ?></td>
                    <td><?php echo $row[$i]["actual_price"]; ?></td>
                    <td><?php echo $row[$i]["date"]; ?></td>
                </tr>

            <?php
            }
        } else {
            ?>
            <br>
            <br>
            <div class="alert alert-info" role="alert">
                <h3 style="text-align: center; ">
                    Nuk keni blerje aktive
                </h3>
            </div>
        <?php

        }


        ?>
        </tbody>
    </table>

    <?php

    ?>