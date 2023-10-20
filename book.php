<?php
require_once("connect.php");

$id = $_GET["id"];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();

$stmt = $pdo->prepare('SELECT * FROM book_authors ba LEFT JOIN authors a ON ba.author_id=a.id WHERE book_id = :id');
$stmt->execute(['id' => $id]);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1><?= $book["title"]; ?></h1>
    <span style="font-size: 24px;" >Aasta</span>  <br><span style="font-size: 24px;"><?=$book["release_date"];?></span>
    <br><br>
    <span style="font-size: 24px;">Autorid</span>


    <?php
while ($row = $stmt->fetch()){

?>
    <p> 
      <?= $row['first_name'];?>
      <?= $row['last_name'];?>
      </a> 
</p>


<?php
}
?>

        <a href="./edit.php?id=<?= $book['id'];?>">Muuda</a>
</body>
</html>