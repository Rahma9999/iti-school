<?php
require "oop.php";
require "connection.php";
if(!empty($_GET['id'])){
$dp = new DB;
$id = $_GET['id'];
$stmt = $dp->show($id);

// $sql = "SELECT * FROM student WHERE id = :id";
// $stmt = $con->prepare($sql);
// $stmt->bindParam(':id', $id);
// $stmt->execute();
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// var_dump($row);

echo "<img src='images/{$row['image']}' width=150px height=150px> <br/>";
echo "First Name: ". $row['fname'] . "<br/>";
echo "Last Name: ". $row['lname'] . "<br/>";
echo "Email: ". $row['email'] . "<br/>";
echo "Password: ". $row['password'] . "<br/>";
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
<?php }else{
    header("location:login.php");
}