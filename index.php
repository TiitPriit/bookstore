<?php

require_once("connect.php");


if (isset($_GET["search"])) {
   $search = $_GET["search"];
   $stmt = $pdo->prepare('SELECT * FROM books WHERE is_deleted = 0 AND title LIKE :search');
   $stmt->execute(['search' => "%$search%"]);
} else {
   $stmt = $pdo->query('SELECT * FROM books WHERE is_deleted = 0');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Bookstore</title>
</head>
<body>

   <h1>Bookstore</h1>

   <a href="create.php">Create Book</a>
   <a href="create_author.php">Create Author</a>
   <a href="deleted.php">Deleted Books</a>

   <form method="GET">
       <label for="search">Search:</label>
       <input type="text" name="search" value="<?= isset($search) ? $search : ''; ?>">
       <input type="submit" value="Search">
   </form>

   <ul>
<?php
while ($row = $stmt->fetch()){
?>
      <li><a href="./book.php?id=<?= $row['id']; ?>"><?= $row["title"]; ?></a></li>
<?php
}
?>
   </ul>

   <a href="create.php">Add Book</a>

</body>
</html>