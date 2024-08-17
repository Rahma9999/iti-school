<?php
session_start();
require "connection.php";
if(! isset($_SESSION['fname'])){
    header("location:addStd.php");
}
echo "Welcome " . $_SESSION['fname'] . " " . $_SESSION['lname'];

$sql = "SELECT * FROM student";
$stmt = $con->prepare($sql);
$stmt->execute();
$row = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Actions</th>
        </tr>
        <?php
        foreach($row as $std){
            echo "<tr>";
            echo "<td>{$std['id']}</td>";
            echo "<td><img src='images/{$std['image']}' width='50' height='50'></td>";
            echo "<td>{$std['fname']}</td>";
            echo "<td>{$std['lname']}</td>";
            echo "<td>{$std['email']}</td>";
            echo "<td>{$std['password']}</td>";
            echo "<td><a href='update.php?id={$std['id']}'>Update</a></td>";
            echo "<td><a href='delete.php?id={$std['id']}'>Delete</a></td>";
            echo "<td><a href='show.php?id={$std['id']}'>Show</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>