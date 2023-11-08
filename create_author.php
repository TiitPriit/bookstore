<?php

require_once("connect.php");

if (isset($_POST["submit"])) {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    $stmt = $pdo->prepare('INSERT INTO authors (first_name, last_name) VALUES (:first_name, :last_name)');
    $stmt->execute(['first_name' => $first_name, 'last_name' => $last_name]);

    $author_id = $pdo->lastInsertId();

    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Author</title>
</head>
<body>
    <h1>Create Author</h1>

    <form method="POST">
        <label for="first_name">First Name:</label><br>
        <input type="text" name="first_name"><br><br>

        <label for="last_name">Last Name:</label><br>
        <input type="text" name="last_name"><br><br>

        <input type="submit" name="submit" value="Create">
    </form>

    <a href="index.php">Go Back</a>
</body>
</html>