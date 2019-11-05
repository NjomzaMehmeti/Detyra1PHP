<?php
$db_servername="localhost";
$db_username="root";
$db_password="";



$connect = new mysqli($db_servername,$db_username,$db_password);

if($connect->connect_error){

    die("Connection failed: {$connect->connect_error}");
}
echo "Connection estalished succsessfully";

$connect->select_db("MyDatabase");

 $create_db = "CREATE DATABASE MyDatabase";

 if($connect->query($create_db) === TRUE){

    printf("Database 'MyDatabase' is successfully created %s",$create_db);

 }
 else{

     printf("Error : Database 'MyDatabase' is not created %s",$connect->error);
 }

//  $connect->close();

?>