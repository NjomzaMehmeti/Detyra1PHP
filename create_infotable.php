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


$create_UserInfo ="CREATE TABLE IF NOT EXISTS UserInfo(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(100) NOT NULL,
    surname varchar(100) NOT NULL,
    email varchar(50) NOT NULL,
    telnumber int NOT NULL,
    mesazhi text,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";


if($connect->query($create_UserInfo) === TRUE){

  printf("Query executed successfully %s",$create_UserInfo);

}

else {

    printf("Error on executing query %s",$connect->error);
}
?>