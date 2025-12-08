<?php
$servername="localhost";
$name="root";
$password="";
$db_name="pollpulse_db";

$conn=new mysqli($servername,$name,$password,$db_name);
if(!$conn){
        die("connection error".mysqli_connect_error());
}
else{
    // echo "success";
}




?>