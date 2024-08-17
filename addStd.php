<?php
require "connection.php";
if($_SERVER['REQUEST_METHOD'] == "POST"){
    function valid($input){
        $input = trim($input);
        $input = addslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }
    $fname = valid($_POST['fname']);
    $lname = valid($_POST['lname']);
    $email = valid($_POST['email']);
    $pass = valid($_POST['pass']);
    if(! empty($_FILES)){
        $img = $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $img);
    }
        $err = [];

    if(strlen($fname) < 2){
        $err['fnameErr'] = "Please Enter Correct Name";
    }

    if(strlen($lname) < 2){
        $err['lnameErr'] = "Please Enter Correct Name";
    }

    if(! filter_var($email, FILTER_VALIDATE_EMAIL)){
        $err['emailErr'] = "Please Enter Validated Email";
    }

    if(strlen($pass) < 6){
        $err["pasErr"] = "Your password Must be More Than 6 char";
    }
    elseif(! preg_match("#[a-z]+#", $pass)){
        $err["pasErr"] = "Your Password Must be Contain at Least Small Letter";
    }
    elseif(! preg_match("#[A-Z]+#", $pass)){
        $err["pasErr"] = "Your Password Must be Contain at Least Capital Letter";
    }
    elseif(! preg_match("#[0-9]+#", $pass)){
        $err["pasErr"] = "Your Password Must be Contain at Least One Number";
    }

    if(!isset($_FILES['image'])){
        $err["imgErr"] = "You Must Upload Image";
    }
    //var_dump($err);
    if(empty($err)){
        $img_path = $_FILES['image']['tmp_name'];
        $img_name = $_FILES['image']['name'];
        $img_up = "images/" . $img_name;
        move_uploaded_file($img_path, $img_up);
        $sql = "INSERT INTO student (fname, lname, email, password, image) VALUES (:fname, :lname, :email, :pass, :img)";
        $stmt = $con->prepare($sql);
        $stmt->execute(array(
            ':fname' => $fname,
            ':lname' => $lname,
            ':email' => $email,
            ':pass' => $pass, 
            ':img' => $img_up,
        ));
        session_start();
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;

        header("location:showData.php");
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Students</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" enctype="multipart/form-data" action='<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>'>
    <div>
        <label for="fname">First Name</label>
        <input type="text" name="fname"/>
    </div>
    <?php
        if(isset($err["fnameErr"])){
            echo "<span>" . $err["fnameErr"] . "</span>";
        }
        ?>
    <div>
        <label for="lname">Last Name</label>
        <input type="text" name="lname"/>
    </div>
    <?php
        if(isset($err["lnameErr"])){
            echo "<span>" . $err["lnameErr"] . "</span>";
        }
        ?>
    <div>
        <label for="email">Email</label>
        <input type="text" name="email"/>
    </div>
    <?php
        if(isset($err["emailErr"])){
            echo "<span>" . $err["emailErr"] . "</span>";
        }
        ?>
    <div>
        <label for="pass">Password</label>
        <input type="password" name="pass"/>
    </div>
    <?php
        if(isset($err["pasErr"])){
            echo "<span>" . $err["pasErr"] . "</span>";
        }
        ?>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <?php
        if(isset($err["imgErr"])){
            echo "<span>" . $err["imgErr"] . "</span>";
        }
        ?>
    <button type="submit">Submit</button>
    </form>
    <h2>Password Hints</h2>
    <h3>*Your password Must be More Than 6 char</h3>
    <h3>*Your Password Must be Contain at Least Small Letter</h3>
    <h3>*Your Password Must be Contain at Least Capital Letter</h3>
    <h3>*Your Password Must be Contain at Least One Number</h3>
</body>
</html>
