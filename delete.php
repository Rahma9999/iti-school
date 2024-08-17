<?php
require "oop.php";
require "connection.php";
$dp = new DB;
$id = $_GET["id"];

$dp->delete($id);

// $sql = "DELETE FROM student WHERE id = :id";
// $stmt = $con->prepare($sql);
// $stmt->bindParam(':id', $id);
// $stmt->execute();

header("location:showData.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>