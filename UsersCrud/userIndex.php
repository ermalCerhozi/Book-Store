<?php
// session_start();
require_once "../DBconnect.php";

$stmt = $pdo->prepare("SELECT * FROM person p inner join address a on p.address_id = a.address_id inner join city c on a.city = c.city_id");
$stmt->execute();
$i = 0;
while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
    for ($i = 0; $i < count($row); $i++) {
?>
        <tr id="<?php echo $row[$i]["person_id"]; ?>">
            <td style="width: auto;"><?php echo $row[$i]["name"]; ?></td>
            <td><?php echo $row[$i]["surname"]; ?></td>
            <td><?php echo $row[$i]["email"]; ?></td>
            <td><?php echo $row[$i]["birthday"]; ?></td>
            <td><?php echo $row[$i]["city_name"]; ?></td>
            <td><?php echo $row[$i]["street_name"]; ?></td>
            <td><?php echo $row[$i]["postal_code"]; ?></td>
            <td><?php echo $row[$i]["role"]; ?></td>
            <td><?php
                if ($row[$i]["IsDeleted"]) {
                    echo "Deleted";
                } else {
                    echo "Active";
                }
                ?></td>

            <td class="col-1">
                <a href="#editUserModal" class="edit" data-toggle="modal">
                    <i class="material-icons update" data-toggle="tooltip" data-name="<?php echo $row[$i]["name"]; ?>" data-surname="<?php echo $row[$i]["surname"]; ?>" data-email="<?php echo $row[$i]["email"]; ?>" data-birthday="<?php echo $row[$i]["birthday"]; ?>" data-role="<?php echo $row[$i]["role"]; ?>" data-streetName="<?php echo $row[$i]["street_name"]; ?>" data-postalCode="<?php echo $row[$i]["postal_code"]; ?>" data-cityName="<?php echo $row[$i]["city_name"]; ?>" title="Edit"></i>
                </a>
                <?php
                if ($row[$i]["IsDeleted"]) {
                ?>
                    <a href="#deleteUserModal" class="delete" data-id="<?php echo $row[$i]["person_id"]; ?>" data-type = "Activate" data-toggle="modal"><i style="color:green"  class="material-icons" data-toggle="tooltip" title="Activte">toggle_on</i></a>

                <?php 
                }else{
                    ?>
                    <a href="#deleteUserModal" class="delete" data-id="<?php echo $row[$i]["person_id"]; ?>" data-type = "Delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">toggle_off</i></a>
                    <?php
                }
                ?>
                <!-- <a href="#deleteUserModal" class="delete" data-id="<?php echo $row[$i]["person_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                <a href="#activateUserModal" class="delete" data-id="<?php echo $row[$i]["person_id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">toggle_on</i></a> -->
            </td>
        </tr>
<?php
    }
}
?>