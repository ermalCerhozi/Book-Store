<?php
require_once "../DBconnect.php";


$stmt = $pdo->prepare("SELECT * FROM `subscription`");

$stmt->execute();

?>
<div style="margin-left: 100px; margin-right: 100px;">
    <div class="container-fluid">
        <?php
        while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
            for ($i = 0; $i < count($row); $i++) {

                if ($i % 3 == 0) {
        ?>
                    <div class="row">
                    <?php
                }
                    ?>

                    <div class="col-md-4 col-xs-12 border-primary mb-3">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-header text-white bg-info">
                                        <p class="card-text">
                                        <h3 class="card-title">
                                            <?php echo $row[$i]["subscription_name"] ?>
                                        </h3>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="card-text"><b>Type: </b><?php echo $row[$i]["type"] ?></p>
                                        <p class="card-text"><b>Price: </b><?php echo $row[$i]["price"] ?>$</p>
                                        <p class="card-text"><b>Amount of Sale: </b><?php echo $row[$i]["amount_of_sale"] ?>%</p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-footer ">
                                        <p class="btn btn-outline-success float-right buySubscription">
                                            <i class="bi bi-credit-card-fill" data-id=<?php echo $row[$i]["subscription_id"]; ?> data-price=<?php echo $row[$i]["price"]; ?> data-subscription-type=<?php echo $row[$i]["type"]; ?> data-sale=<?php echo $row[$i]["amount_of_sale"]; ?>> Buy</i> 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
            if ($i % 3 == 2) {
                ?>
                    </div>
                <?php

            } elseif ($i = count($row) - 1) {
                ?>
            <?php
            }
        }
            ?>
    </div>
</div>