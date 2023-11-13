<?php
require_once("connect.php");

$id = $_GET["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $release_date = $_POST["release_date"];
    $price = $_POST["price"];
    $author_id = $_POST["author_id"];

    $stmt = $pdo->prepare('UPDATE books SET title = :title, release_date = :release_date, price = :price WHERE id = :id');
    $stmt->execute(['title' => $title, 'release_date' => $release_date, 'price' => $price, 'id' => $id]);

    $stmt = $pdo->prepare('UPDATE book_authors SET author_id = :author_id WHERE book_id = :id');
    $stmt->execute(['author_id' => $author_id, 'id' => $id]);

    header("Location: book.php?id=$id");
    exit();
}

$stmt = $pdo->prepare('SELECT books.*, CONCAT(authors.first_name, " ", authors.last_name) as author_name FROM books JOIN book_authors ON books.id = book_authors.book_id JOIN authors ON book_authors.author_id = authors.id WHERE books.id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->query('SELECT *, CONCAT(first_name, " ", last_name) as name FROM authors');
$authors = $stmt->fetchAll();

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

        <label for="author_id">Author:</label>
        <select name="author_id">
            <?php foreach ($authors as $author): ?>
                <option value="<?= $author['id']; ?>" <?= $author['id'] == $book['author_id'] ? 'selected' : ''; ?>>
                    <?= $author['name']; ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <input type="submit" value="Save">
    </form>
    
    <a href="book.php?id=<?= $id; ?>">Go Back</a>
</body>
</html>