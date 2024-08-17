<?php
$lh = "localhost";
$dbname = "iti-school";
$user = "root";
try{
$con =new PDO("mysql:host=$lh; dbname=$dbname;", $user, "");
$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//echo "successfully";
}
catch(PDOException $e){
    echo "Faild" . $e->getMessage();
}

?>