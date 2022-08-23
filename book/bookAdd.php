<?php
session_start();
require_once "../DBconnect.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_FILES["book_cover"]["name"]) && !empty($_FILES["book_file"]["name"])) {

    $isbn = $_POST["id"];
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
    $book_name = $_POST["title"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $publishing_date = $_POST["date"];
    $description = $_POST["description"];
    $publishing_house = $_POST["publishing_house"];
    if ($publishing_house == 0) {
        echo json_encode(["Return" => false, "Message" => 'Shtepia botuese nuk ndodhet ne databaze.Pati nje problem']);
        exit;
    }
    $category = $_POST["category"];
    if ($category == 0) {
        echo json_encode(["Return" => false, "Message" => 'Kategoria nuk ndodhet ne databaze.Pati nje problem']);
        exit;
    }
    $author = $_POST["author_fullname"];
    if ($author == 0) {
        echo json_encode(["Return" => false, "Message" => 'Autori nuk ndodhet ne databaze.Pati nje problem']);
        exit;
    }

    $book_cover_filename = $_FILES['book_cover']['name'];
    $book_file_filename = $_FILES['book_file']['name'];

    // destination of the file on the server
    $book_cover_destination = '../book_cover/' . $book_cover_filename;
    $book_file_destination = '../book_file/' . $book_file_filename;

    // get the file extension
    $book_cover_extension = pathinfo($book_cover_filename, PATHINFO_EXTENSION);
    $book_file_extension = pathinfo($book_file_filename, PATHINFO_EXTENSION);

    // the physical file on a temporary uploads directory on the server
    $book_cover_file = $_FILES['book_cover']['tmp_name'];
    $book_cover_size = $_FILES['book_cover']['size'];

    $book_file_file = $_FILES['book_file']['tmp_name'];
    $book_file_size = $_FILES['book_file']['size'];

    if (!in_array(strtolower($book_file_extension), ['pdf'])) {
        echo json_encode(["Return" => false, "Message" => "You file extension must be .pdf"]);
        exit;
    }
    if ($book_file_size > 50000000) { // file shouldn't be larger than 50Megabyte
        echo json_encode(["Return" => false, "Message" => "Book too large!"]);
        exit;
    }
    if (!in_array(strtolower($book_cover_extension), ['jpeg', 'jpg', 'png'])) {
        echo json_encode(["Return" => false, "Message" => "You file extension must be .jpeg, .jpg or .png"]);
        exit;
    }
    if ($book_cover_size > 50000000) { // file shouldn't be larger than 5Megabyte
        echo json_encode(["Return" => false, "Message" => "Book cover image too large!"]);
        exit;
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
    if (file_exists($book_file_destination)) {
        chmod($book_file_destination, 0755);
        unlink($book_file_destination);
        if (!move_uploaded_file($book_file_file, $book_file_destination)) {
            echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
            exit;
        }
    } elseif (!move_uploaded_file($book_file_file, $book_file_destination)) {
        echo json_encode(["Return" => false, "Message" => "Ka problem me kalimin e book file ne folderin e ri"]);
        exit;
    }
    try {
        $pdo->beginTransaction();
        $sql = $pdo->prepare("INSERT INTO `book` (`ISBN`, `book_name`, `publishing_house_id`,`price`,`publishing_date`,`quantity`,
                `description`,`FK_book_category_id`,`book_cover`,`book_file`,`author_id` ) VALUES (?,?,?,?,?,?,?,?,?,?,?);");
        $sql->execute(array($isbn, $book_name, $publishing_house, $price, $publishing_date, $quantity, $description, $category, $book_cover_filename, $book_file_filename,$author));
        $pdo->commit();
        echo json_encode(["Return" => true, "Message" => "Me sukses"]);
        exit;
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo json_encode(["Return" => false, "Message" => $e->getMessage()]);
        exit;
    }
} else {
    echo json_encode(["Return" => false, "Message" => "nje nga filet eshte bosh ose forma nuk ka ardhur me post"]);
}
