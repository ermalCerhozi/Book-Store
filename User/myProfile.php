<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
include "../DBconnect.php";
?>

<div class="heading">
    <h1>My Profile</h1>
</div>
<div>
    <h1>Bio</h1>
    <hr>
    <?php
    try {
        $id = $_SESSION["user_id"];
        $stmt = $pdo->prepare("SELECT * FROM person p inner join address a on p.address_id = a.address_id inner join city c on a.city = c.city_id where person_id = ?");
        $stmt->execute(array($id));
        $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($rez != null) {
    ?>
            <div class="row">
                <div class="bio-row col">
                    <p><b>Name</b> </span>: <?php echo $rez[0]["name"] ?></p>
                </div>
                <div class="bio-row col">
                    <p><b>Surnname</b> </span>: <?php echo $rez[0]["surname"] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="bio-row col">
                    <p><b>Email</b> </span>: <?php echo $rez[0]["email"] ?></p>
                </div>
                <div class="bio-row col">
                    <p><b>Birthday</b></span>: <?php echo $rez[0]["birthday"] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="bio-row col">
                    <p><b>City</b> </span>: <?php echo $rez[0]["city_name"] ?></p>
                </div>
                <div class="bio-row col">
                    <p><b>Street</b> </span>: <?php echo $rez[0]["street_name"] ?></p>
                </div>
            </div>
            <div class="row">
                <div class="bio-row col">
                    <p><b>Postal Code</b></span>: <?php echo $rez[0]["postal_code"] ?></p>
                </div>
            </div>
            <div class="row">
                <h1>Subscription</h1>
                <hr>

                <?php
                $current_date = date("Y-m-d", time());
                $stmt = $pdo->prepare("SELECT * from `user_subscription` where person_id = ? and subscription_finish_date > ? ");
                $stmt->execute(array($id, $current_date));
                $rez = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (count($rez) > 0) {
                ?>
                    <div class="bio-row col">
                        <p><b>START</b> </span>: <?php echo date("j-F-Y", strtotime($rez[0]["subscription_start_date"])) ?></p>
                    </div>
                    <div class="bio-row col">
                        <p><b>END</b> </span>: <?php echo date("j-F-Y", strtotime($rez[0]["subscription_finish_date"])) ?></p>
                    </div>
                    <div class="bio-row col">
                        <p><b>PRICE</b> </span>: <?php echo $rez[0]["purchase_price"] ?>$</p>
                    </div>
                    <div class="bio-row col">
                        <p><b>AMOUNT OF SALE</b> </span>: <?php echo $rez[0]["amount_of_sale_at_purchase"] ?>%</p>
                    </div>
                <?php
                } else {
                ?>
                    <div class="alert alert-info" role="alert">
                        <h3 style="text-align: center; ">
                            Nuk keni blerje aktive
                        </h3>
                    </div>


                <?php
                }
                ?>
            </div>


    <?php
        }
    } catch (\Throwable $th) {
    }


    ?>
</div>