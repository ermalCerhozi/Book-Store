<?php
include "../DBconnect.php";


if (isset($_GET["start"]) && isset($_GET["end"])) {


    $pdo->beginTransaction();
    try {
        $stmt = $pdo->prepare("Select * from chair_user where termination_time between ? and ? ");
        $start = $_GET["start"];
        $end = $_GET["end"];
        $stmt->execute(array($start,$end));
        $row = $stmt->fetchAll(PDO::FETCH_ASSOC);

        for ($i = 1; $i <= 40; $i++) {
            if ($i % 8 == 1) {
?>
                <div class="row">
                    <?php
                }
                if (count($row) > 0) {

                    for ($j = 0; $j < count($row); $j++) {
                        if ($row[$j]["chair_number"] == $i) {
                            $current_time  = date('Y-m-d', time());
                            if ($row[$j]["termination_date"] < $current_time) {
                    ?>
                                <div id="<?php $i ?>" class="seat"></div>
                            <?php
                            } else {
                            ?>
                                <div id="<?php $i ?>" class="seat occupied"></div>
                            <?php
                            $sql = $pdo->prepare("Delete from chair_user where chair_number = ?");
                            $sql->execute(array($i));
                            }
                        } else {
                            ?>
                            <div id="<?php $i ?>" class="seat"></div>
                    <?php
                        }
                    }
                } else {
                    ?>
                    <div id="<?php $i ?>" class="seat"></div>
                <?php
                }
                if ($i % 8 == 0) {
                ?>
                </div>
<?php
                }
            }
        } catch (PDOException $e) {
            $pdo->rollBack();
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        }
    }
?>