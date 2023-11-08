<?php
require_once("connect.php");

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $release_date = $_POST["release_date"];
    $price = $_POST["price"];

    $stmt = $pdo->prepare('UPDATE books SET title = :title, release_date = :release_date, price = :price WHERE id = :id');
    $stmt->execute(['title' => $title, 'release_date' => $release_date, 'price' => $price, 'id' => $id]);

    header("Location: book.php?id=$id");
    exit();
}

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>
    <form method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?= $book["title"]; ?>"><br><br>
        <label for="release_date">Release Date:</label>
        <input type="text" name="release_date" value="<?= $book["release_date"]; ?>"><br><br>

        <label for="price">Price:</label>
        <input type="text" name="price" value="<?= number_format($book["price"], 2); ?>"><br><br>

        <input type="submit" value="Save">
    </form>
    
    <a href="book.php?id=<?= $id; ?>">Go Back</a>
</body>
</html>