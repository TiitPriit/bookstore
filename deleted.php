<?php

require_once("connect.php");

if (isset($_POST["restore"])) {
    $id = $_POST["id"];

    $stmt = $pdo->prepare('UPDATE books SET is_deleted = 0 WHERE id = :id');
    $stmt->execute(['id' => $id]);

    header("Location: deleted.php");
    exit();
}

$stmt = $pdo->query('SELECT * FROM books WHERE is_deleted = 1');

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Deleted Books</title>
</head>
<body>

   <h1>Deleted Books</h1>

   <ul>
<?php
while ($row = $stmt->fetch()){
?>
      <li><?= $row["title"]; ?> <form method="POST" style="display: inline-block;"><input type="hidden" name="id" value="<?= $row["id"]; ?>"><input type="submit" name="restore" value="Restore"></form></li>
<?php
}
?>
   </ul>

   <a href="index.php">Go Back</a>

</body>
</html>