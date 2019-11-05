<?php
$db_servername = "localhost";
$db_username = "root";
$db_password= "";


$connect = new mysqli($db_servername,$db_username,$db_password);

if($connect->connect_error){

    die("Connection failed: {$connect->connect_error}");
}
echo "Connection estalished succsessfully";

?>