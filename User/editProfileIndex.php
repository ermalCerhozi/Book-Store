<?php
session_start();
if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit();
}
include "../DBconnect.php";

$id = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT * FROM person p inner join address a on p.address_id = a.address_id inner join city c on a.city = c.city_id where p.person_id = ?");
$stmt->execute(array($id));
$row = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="heading">
    <h1>My Profile</h1>
</div>
<div class="container centered ">
    <form id="editForm">
        <h1 style="color: black;">Edit </h1>
        <div class="form-group col-12">
            <input type="text" class="form-control" name="Name" id="Name" placeholder="Name" minlength="5" required value="<?php echo $row[0]["name"] ?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" name="Surname" id="Surname" placeholder="Surename" required value="<?php echo $row[0]["surname"] ?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="form-group col-12">
            <input type="email" class="form-control" name="Email" id="Email" placeholder="Enter email" required readonly value="<?php echo $row[0]["email"] ?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="form-group col-12">
            <input type="date" class="form-control" name="Birthday" id="Birthday" placeholder="mm/dd/yyyy" required value="<?php echo $row[0]["birthday"] ?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="form-group">
            <select name="City" id="City" class="form-select form-select-md" required>
                <?php

                $stmt = $pdo->prepare("Select city_name from city");
                $stmt->execute();
                $i = 0;
                //vendos id direkte tek option jo emri
                while ($rez = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    for ($i = 0; $i < count($rez); $i++) {
                        if ($rez[$i]["city_name"] == $row[0]["city_name"]) {
                ?>
                            <option value="<?php echo $rez[$i]["city_name"] ?>" selecetd> <?php echo $rez[$i]["city_name"] ?></option>
                        <?php
                        } else {
                        ?><option value="<?php echo $rez[$i]["city_name"] ?>"> <?php echo $rez[$i]["city_name"] ?></option>
                        <?php
                        }
                        ?>
                <?php
                    }
                }
                ?>
            </select>
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
            <!-- <input type="text" id="publishing_house" name="publishing_house" class="form-control" required> -->
        </div>
        <div class="form-group col-12">
            <input type="text" class="form-control" name="Street" id="Street" placeholder="Street" value="<?php echo $row[0]["street_name"]?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="form-group col-12">
            <input type="number" class="form-control" name="PostalCode" id="PostalCode" placeholder="PostalCode" value="<?php echo $row[0]["postal_code"]?>">
            <span class="invalid-feedback" style="color: red;">Emri eshte gabim</span>
        </div>
        <div class="btn-group col-12">
            <button id="EditSubmitButton" class="btn btn-primary active">Edit</button>
        </div>
    </form>
</div>

<?php

?>