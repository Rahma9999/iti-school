<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);  ?>">
        <div>
            <label for="email">Email</label>
            <input type="text" name="email"/>
        </div>
        <div>
            <label for="pass">Password</label>
            <input type="password" name="pass"/>
        </div>
        <button type="submit">Log In</button>
        <a href="addStd.php">register</a>
    </form>
</body>
</html>

<?php
require "connection.php";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM student WHERE email = :email AND password = :pass";
    $stmt  = $con->prepare($sql);
    $stmt->execute(array(
        ':pass' => $pass,
        ':email' => $email
    ));
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result){
        session_start();
        $_SESSION['fname'] = $result['fname'];
        $_SESSION['lname'] = $result['lname'];
        header("location: showData.php");
    }
    else{
        header("location:addStd.php");
    }
}
?>

