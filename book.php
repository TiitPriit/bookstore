<?php

require_once("connect.php");

$id = $_GET["id"];

$stmt = $pdo->prepare('SELECT books.*, authors.first_name, authors.last_name FROM books JOIN book_authors ON books.id = book_authors.book_id JOIN authors ON book_authors.author_id = authors.id WHERE books.id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

if (isset($_POST["delete"])) {
    $stmt = $pdo->prepare('UPDATE books SET is_deleted = 1 WHERE id = :id');
    $stmt->execute(['id' => $id]);

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $book["title"]; ?></title>
</head>
<body>
    <h1><?= $book["title"]; ?></h1>
    <span style="font-size: 24px;">Release Date:</span><br>
    <span style="font-size: 24px;"><?= $book["release_date"]; ?></span><br><br>

    <span style="font-size: 24px;">Price:</span><br>
    <span style="font-size: 24px;"><?= number_format($book["price"], 2); ?> €</span><br><br>

    <span style="font-size: 24px;">Type:</span><br>
    <span style="font-size: 24px;"><?= $book["type"]; ?></span><br><br>

    <span style="font-size: 24px;">Authors:</span>

    <p><?= $book['first_name']; ?> <?= $book['last_name']; ?></p>

    <form method="POST">
        <input type="hidden" name="delete" value="1">
        <input type="submit" value="Delete">
    </form>

    <a href="./edit.php?id=<?= $book['id']; ?>">Edit</a>
    <a href="index.php">Go Back</a>
</body>
</html>