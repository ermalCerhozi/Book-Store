<?php
require_once "../DBconnect.php";

if (!empty($_GET['SearchCategory']) && !empty($_GET['Search'])) {
    $searchCategory = $_GET['SearchCategory'];
    $search = $_GET['Search'];
    switch ($searchCategory) {
        case "Title":
            $stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id 
            inner join publishing_house p on b.publishing_house_id = p.publishing_house_id
             inner join author a on b.author_id = a.author_id Where `book_name` LIKE '%$search%'; ");
            break;
        case "Author":
            $stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id 
            inner join publishing_house p on b.publishing_house_id = p.publishing_house_id
             inner join author a on b.author_id = a.author_id Where author_name LIKE '%$search%' or author_surname LIKE '%$search%'; ");
            break;
        case "Publishing House":
            $stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id 
            inner join publishing_house p on b.publishing_house_id = p.publishing_house_id
            inner join author a on b.author_id = a.author_id Where `name`  LIKE '%$search%';");
            break;
        default:
            break;
    }
} else {
    $stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id inner join publishing_house p on b.publishing_house_id = p.publishing_house_id inner join author a on b.author_id = a.author_id");
}
$stmt->execute();

?>
<div style="margin-left: 10%; margin-right: 10%;">
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
                    <div class="col-md-4 col-xs-10 border-primary mb-3">
                        <div class="card mb-3" style="max-width: 540px;">
                            <div class="row g-0">
                                <div class="col-md-12">
                                    <div class="card-header text-white bg-info">
                                        <p class="card-text">
                                        <h3 class="card-title">
                                            <?php echo $row[$i]["book_name"] ?>
                                        </h3>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <img src="../book_cover/<?php echo $row[$i]["book_cover"]; ?>" alt="Image" width="100%" height="200px" />
                                </div>
                                <div class="col-md-6">
                                    <div class="card-body">
                                        <p class="card-text"><b>Price: </b><?php echo $row[$i]["price"]; ?></p>
                                        <p class="card-text">
                                            <b>Author: <?php echo $row[$i]["author_name"] . " " . $row[$i]["author_surname"]; ?>" </b>
                                        </p>
                                        <p class="card-text"><b>Category: </b><?php echo $row[$i]["category_name"]; ?></p>
                                        <p class="card-text"><b>Publishing Date: </b><?php echo $row[$i]["publishing_date"]; ?></p>
                                        <!-- <p class="card-text"><b>Publishing House: </b>@item.PublishingHouse</p> -->
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card-footer ">
                                        <div class="card-text">
                                            <p class="btn btn-outline-primary float-right details">
                                                <i class="bi bi-info-circle-fill" data-ISBN=<?php echo $row[$i]["ISBN"]; ?> ></i> Show Details
                                            </p>
                                            <p class="btn btn-outline-success float-right add">
                                                <i class="bi bi-credit-card-fill" data-ISBN=<?php echo $row[$i]["ISBN"]; ?> data-price=<?php echo $row[$i]["price"]; ?>></i> Add To Shopping Cart
                                            </p>
                                        </div>
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