<?php

require_once("connect.php");

$id = $_GET["id"];

$stmt = $pdo->prepare('SELECT * FROM books WHERE id = :id');
$stmt->execute(['id' => $id]);
$book = $stmt->fetch();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Muuda</h1> <?= $id; ?>
    <h1><?= $book["title"]; ?></h1>

</body>
</html>
