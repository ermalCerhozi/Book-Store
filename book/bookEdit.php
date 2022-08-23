<?php
session_start();
require_once "../DBconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $isbn = (int)$_POST["id"];
    if ($isbn != (int)$_POST["First_ISBN"]) {
        try {
            $stmt = $pdo->query("Select ISBN from book WHERE ISBN LIKE '$isbn'");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result != null) {
                echo json_encode(["Return" => false, "Message" => "Libri me kete ISBN ekziston ne database"]);
                exit;
            }
        } catch (PDOException $e) {
            echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
            exit;
        }
    }

    $book_name = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    if (isset($_POST["date"])) {
        $publishing_date = date('Y-m-d', strtotime($_POST["date"]));
    }

    $description = $_POST["description"];
    $publishing_house = $_POST["publishing_house"];
    $category = $_POST["category"];
    $author_fullname = $_POST["author_fullname"];
    $pdo->beginTransaction();

    $stmt = $pdo->query("Select category_id from book_category where category_name = '$category'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $category_id = $result[0]['category_id'];
    } else {
        echo json_encode(["Return" => false, "Message" => 'Kategoria nuk ekziston ka gabim']);
        exit;
    }
    $stmt = $pdo->query("Select publishing_house_id from publishing_house where name = '$publishing_house'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $publishing_house_id = $result[0]['publishing_house_id'];
    } else {
        echo json_encode(["Return" => false, "Message" => 'Shtepia bouteuse nuk ekzisotn ka gabime ne forme']);
        exit;
    }
    //select * from author where concat(author_name, ' ', author_surname) = "Ismail Kadare";
    $stmt = $pdo->query("Select author_id from author where concat(author_name, ' ', author_surname) = '$author_fullname'");
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result != null) {
        $author_id = $result[0]['author_id'];
    } else {
        echo json_encode(["Return" => false, "Message" => 'Shtepia bouteuse nuk ekzisotn ka gabime ne forme']);
        exit;
    }
    try {
        // $sql = $pdo->prepare("Update `book` SET `ISBN` = $isbn,
        // `book_name` = $book_name,
        // `publishing_house_id` = $publishing_house_id,
        // `price` = $price,
        // `quantity` = $quantity,
        // `description` = $description,
        // `FK_book_category_id` = $category_id,
        // `author_id` = $author_id
        // where `book`.`ISBN` = $isbn");
        $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
                `description` = ?,`FK_book_category_id` = ?, `author_id` = ? where `book`.`ISBN` = ? ");
        $sql->execute(array($isbn, $book_name, $publishing_house_id, $price, $quantity, $description, $category_id,$author_id,(int)$_POST["First_ISBN"]));
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
    if (!empty($_FILES["book_cover"]["name"])) {
        $book_cover_filename = $_FILES['book_cover']['name'];
        $book_cover_destination = '../book_cover/' . $book_cover_filename;
        $book_cover_extension = pathinfo($book_cover_filename, PATHINFO_EXTENSION);
        $book_cover_file = $_FILES['book_cover']['tmp_name'];
        $book_cover_size = $_FILES['book_cover']['size'];
        if (!in_array(strtolower($book_cover_extension), ['jpeg', 'jpg', 'png'])) {
            echo json_encode(["Return" => false, "Message" => "You file extension must be .jpeg, .jpg or .png"]);
            $pdo->rollBack();
            exit;
        }
        if ($book_cover_size > 50000000) { // file shouldn't be larger than 5Megabyte
            echo json_encode(["Return" => false, "Message" => "Book cover image too large!"]);
            $pdo->rollBack();
            exit;
        }
        if (file_exists('../book_cover/' . $_POST["First_book_cover"])) {
            chmod('../book_cover/' . $_POST["First_book_cover"], 0755);
            unlink('../book_cover/' . $_POST["First_book_cover"]);
        }
        if (file_exists($book_cover_destination)) {
            chmod($book_cover_destination, 0755);
            unlink($book_cover_destination);
            if (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
                echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
                exit;
            }
        } elseif (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
            echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
            exit;
        }
        $sql = $pdo->prepare("Update `book` SET `book_cover` =  ? where  `ISBN` = ?");
        $sql->execute(array($book_cover_filename, $isbn));
    }
    if (!empty($_FILES["book_file"]["name"])) {
        $book_file_filename = $_FILES['book_file']['name'];
        $book_file_destination = '../book_file/' . $book_file_filename;
        $book_file_extension = pathinfo($book_file_filename, PATHINFO_EXTENSION);
        $book_file_file = $_FILES['book_file']['tmp_name'];
        $book_file_size = $_FILES['book_file']['size'];
        if (!in_array(strtolower($book_file_extension), ['pdf'])) {
            echo json_encode(["Return" => false, "Message" => "You file extension must be .pdf"]);
            $pdo->rollBack();
            exit;
        }
        if ($book_file_size > 500000000) { // file shouldn't be larger than 50 Megabyte
            echo json_encode(["Return" => false, "Message" => "Book file image too large!"]);
            $pdo->rollBack();
            exit;
        }
        if (file_exists('../book_file/' . $_POST["First_book_file"])) {
            chmod('../book_file/' . $_POST["First_book_file"], 0755);
            unlink('../book_file/' . $_POST["First_book_file"]);
        }
        if (file_exists('../book_file/' . $_POST["First_book_file"])) {
            chmod('../book_file/' . $_POST["First_book_file"], 0755);
            unlink('../book_file/' . $_POST["First_book_file"]);
            if (!move_uploaded_file($book_file_file, $book_file_destination)) {
                echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
                exit;
            }
        } elseif (!move_uploaded_file($book_file_file, $book_file_destination)) {
            echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
            exit;
        }
        $sql = $pdo->prepare("Update `book` SET `book_file` =  ? where  `ISBN` = ?");
        $sql->execute(array($book_file_filename, $isbn));
    }
    $pdo->commit();
    echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    exit;

    // $book_cover_filename = $_FILES['book_cover']['name'];
    // $book_file_filename = $_FILES['book_file']['name'];

    // // destination of the file on the server
    // $book_cover_destination = '../book_cover/' . $book_cover_filename;
    // $book_file_destination = '../book_file/' . $book_file_filename;

    // // get the file extension
    // $book_cover_extension = pathinfo($book_cover_filename, PATHINFO_EXTENSION);
    // $book_file_extension = pathinfo($book_file_filename, PATHINFO_EXTENSION);

    // // the physical file on a temporary uploads directory on the server
    // $book_cover_file = $_FILES['book_cover']['tmp_name'];
    // $book_cover_size = $_FILES['book_cover']['size'];

    // $book_file_file = $_FILES['book_file']['tmp_name'];
    // $book_file_size = $_FILES['book_file']['size'];
    // if(empty($_FILES["book_cover"]["name"])){
    //     if (empty($_FILES["book_file"]["name"])) {
    //         try {
    //             $pdo->beginTransaction();
    //             $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
    //                     `description = ?`,`FK_book_category_id = ?`");
    //             $sql->execute(array($isbn, $book_name, 1, $price, $quantity, $description, 1));
    //             $pdo->commit();
    //             echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    //             exit;
    //         } catch (PDOException $e) {
    //             $pdo->rollBack();
    //             echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    //             exit;
    //         }
    //     }
    //     else{
    //         try {
    //             $pdo->beginTransaction();
    //             $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
    //                     `description = ?`,`FK_book_category_id = ?`, `book_file` = ?");
    //             $sql->execute(array($isbn, $book_name, 1, $price, $quantity, $description, 1,$book_file_filename));
    //             $pdo->commit();
    //             echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    //             exit;
    //         } catch (PDOException $e) {
    //             $pdo->rollBack();
    //             echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    //             exit;
    //         }
    //     }

    // }elseif(empty($_FILES["book_file"]["name"])){
    //     try {
    //         $pdo->beginTransaction();
    //         $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
    //                 `description = ?`,`FK_book_category_id = ?`, `book_file` = ?");
    //         $sql->execute(array($isbn, $book_name, 1, $price, $quantity, $description, 1,$book_file_filename));
    //         $pdo->commit();
    //         echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    //         exit;
    //     } catch (PDOException $e) {
    //         $pdo->rollBack();
    //         echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    //         exit;
    //     }
    // }
    // else{
    // if (!in_array(strtolower($book_file_extension), ['pdf'])) {
    //     echo json_encode(["Return" => false, "Message" => "You file extension must be .pdf"]);
    //     exit;
    // }
    // if ($book_file_size > 50000000) { // file shouldn't be larger than 50Megabyte
    //     echo json_encode(["Return" => false, "Message" => "Book too large!"]);
    //     exit;
    // }
    // if (!in_array(strtolower($book_cover_extension), ['jpeg', 'jpg', 'png'])) {
    //     echo json_encode(["Return" => false, "Message" => "You file extension must be .jpeg, .jpg or .png"]);
    //     exit;
    // }
    // if ($book_cover_size > 50000000) { // file shouldn't be larger than 5Megabyte
    //     echo json_encode(["Return" => false, "Message" => "Book cover image too large!"]);
    //     exit;
    // }
    // if (file_exists($book_cover_destination)) {
    //     chmod($book_cover_destination, 0755);
    //     unlink($book_cover_destination);
    //     if (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
    //         echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
    //         exit;
    //     }
    // } elseif (!move_uploaded_file($book_cover_file, $book_cover_destination)) {
    //     echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book cover ne folderin e ri"]);
    //     exit;
    // }
    // if (file_exists($book_file_destination)) {
    //     chmod($book_file_destination, 0755);
    //     unlink($book_file_destination);
    //     if (!move_uploaded_file($book_file_file, $book_file_destination)) {
    //         echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
    //         exit;
    //     }
    // } elseif (!move_uploaded_file($book_file_file, $book_file_destination)) {
    //     echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
    //     exit;
    // }
    // try {
    //     $pdo->beginTransaction();
    //     $sql = $pdo->prepare("Update `book` SET `ISBN` = ?, `book_name` = ?, `publishing_house_id` = ? ,`price` = ? ,`quantity` = ?,
    //             `description = ?`,`FK_book_category_id = ?`, `book_file` = ?, `book_file` = ?");
    //     $sql->execute(array($isbn, $book_name, 1, $price, $quantity, $description, 1,$book_cover_filename,$book_file_filename));
    //     $pdo->commit();
    //     echo json_encode(["Return" => true, "Message" => "Me sukses"]);
    //     exit;
    // } catch (PDOException $e) {
    //     $pdo->rollBack();
    //     echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
    //     exit;
    // }
    //}
} else {
    echo json_encode(["Return" => false, "Message" => "nje nga filet eshte bosh ose forma nuk ka ardhur me post"]);
}
