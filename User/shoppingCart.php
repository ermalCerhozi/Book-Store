<?php
require_once "../DBconnect.php";
?>


<?php
if (isset($_SESSION["user_email"])) {
    $user_email = $_SESSION["user_email"];
    $stmt = $pdo->prepare("SELECT person_id FROM `person` WHERE email = '$user_email';");
    $stmt->execute();
    $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($row) == 0) {
        header("Location: ../Authentification/login.php");
        exit;
    } else {
        $user_id = $row[0]['person_id'];
    }
    $stmt = $pdo->prepare("SELECT * FROM `shopping_cart_book` s inner join `book` b on s.ISBN_shoppingCart = b.ISBN where User_id = $user_id and IsBought = 0;");
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (count($data) == 0) {
?>
        <br>
        <br>
        <div class="alert alert-info" role="alert">
            <h3 style="text-align: center; ">
                Nuk keni blerje aktive
            </h3>
        </div>
    <?php
        exit;
    } else {
    ?>
        <button id="continue-shopping" class="btn btn-success" style="margin-top: 30px;">Continue Shopping</button>
        <br>
        <br>
        <table class="table table-striped table-hover ">
            <tr align="center">
                <th style="width: 30%;">Book</th>
                <th>Title</th>
                <th>Price</th>
                <th>Option</th>
            </tr>
            <?php
            $total = 0;
            foreach ($data as $row) {
            ?>



                <tr align="center">
                    <td> <img src="../book_cover/<?php echo $row["book_cover"]; ?>" alt="<?php echo $row["book_name"]; ?>" width="200px" height="200px"></td>
                    <td><?php echo $row["book_name"]; ?></td>
                    <td><?php echo $row["price"]; ?></td>
                    <td class="col-1">
                        <p class="btn btn-outline-danger float-right delete">
                            <i class="material-icons" data-toggle="tooltip" data-id="<?php echo $row["ShopingCartBookId"]; ?>" title="Delete"></i>
                        </p>
                    </td>

                </tr>
            <?php
                $total += $row["price"];
            }
            ?>
            <tr style>
                <td colspan="4" style="text-align: right;"> Total = <?php echo $total ?>$</td>
            </tr>
            <?php
            $current_time = date('Y-m-d', time());
            $stmt = $pdo->prepare("SELECT * FROM `user_subscription` WHERE person_id = $user_id and subscription_finish_date > '$current_time' ;");
            $stmt->execute();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($row) != 0) {
                $sale =  $total * $row[0]["amount_of_sale_at_purchase"] / 100;
                $total = $total - $sale;
                $tax = $total * 0.2;
            ?>
                <tr>
                    <td colspan="4" style="text-align: right;"> Subscription Sale = <?php echo $sale ?>$</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"> Final Price = <?php echo $total ?>$</td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: right;"> Tax = <?php echo $tax ?>$</td>
                </tr>
            <?php
            }
            // $tax = $total * 0.2;
            ?>
            <!-- <tr>
                <td colspan="4" style="text-align: right;"> Tax = <?php echo $tax ?>$</td>
            </tr> -->
        </table>
        <br>
        <button id="finish-payment" class="btn btn-danger" style="float: right; margin-top: 20px; margin-bottom: 20px;">Finish Payment</button>

<?php
    }
} else {
    header("Location: ../Authentification/login.php");
}
?>