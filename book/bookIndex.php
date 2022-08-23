<?php
// session_start();
require_once "../DBconnect.php";

$stmt = $pdo->prepare("SELECT * FROM book b inner join book_category c on b.FK_book_category_id = c.category_id inner join publishing_house p on b.publishing_house_id = p.publishing_house_id inner join author a on b.author_id = a.author_id");
$stmt->execute();
$i = 0;
while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    for ($i = 0; $i < count($row); $i++) {
?>
        <tr id="<?php echo $row[$i]["ISBN"]; ?>">
            <td><?php echo $row[$i]["ISBN"]; ?></td>
            <td><?php echo $row[$i]["book_name"]; ?></td>
            <td><?php echo $row[$i]["price"]; ?></td>
            <td><?php echo $row[$i]["author_name"]. " " .$row[$i]["author_surname"]; ?></td>
            <td><?php echo $row[$i]["quantity"]; ?></td>
            <td><?php echo $row[$i]["publishing_date"]; ?></td>
            <td><?php echo $row[$i]["description"]; ?></td>
            <td><?php echo $row[$i]["category_name"]; ?></td>
            <td><?php echo $row[$i]["name"]; ?></td>
            <td class="col-4">
                <a href="../book_file/<?php echo $row[$i]["book_file"]; ?>" target="_blank">
                    <img src="../book_cover/<?php echo $row[$i]["book_cover"]; ?>" alt="<?php echo $row[$i]["book_name"]; ?>" width="200px" height="200px">
                </a>
            </td>
            <td class="col-1">
                <a href="#editBookModal" class="edit" data-toggle="modal">
                    <i class="material-icons update" data-toggle="tooltip"
                    data-id="<?php echo $row[$i]["ISBN"]; ?>"
                    data-title="<?php echo $row[$i]["book_name"]; ?>"
                    data-price="<?php echo $row[$i]["price"]; ?>"
                    data-author_fullname = "<?php echo $row[$i]["author_name"]. " " .$row[$i]["author_surname"]; ?>"
                    data-author_name = "<?php echo $row[$i]["author_name"]; ?>"
                    data-author_surname = "<?php echo $row[$i]["author_surname"]; ?>"
                    data-quantity="<?php echo $row[$i]["quantity"]; ?>"
                    data-date="<?php echo $row[$i]["publishing_date"]; ?>"
                    data-description="<?php echo $row[$i]["description"]; ?>"
                    data-publishing_house="<?php echo $row[$i]["name"]; ?>" 
                    data-category="<?php echo $row[$i]["category_name"]; ?>"
                    data-book_cover="<?php echo $row[$i]["book_cover"]; ?>"
                    data-book_file="<?php echo $row[$i]["book_file"]; ?>"
                    title="Edit"></i>
                </a>
                <a href="#deleteBookModal" class="delete" data-id="<?php echo $row[$i]["ISBN"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
            </td>
        </tr>
<?php
    }
}
?>