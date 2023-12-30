<?php 
include("connect.php");
//create an instance of Connection class
//code
$connect= new Connection; 

//call the createDatabase methods to create database "raja"
//code
$connect->createDatabase('raja');

$query = "
CREATE TABLE Clients (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(30) NOT NULL,
email VARCHAR(50) ,
password VARCHAR(80),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
";


//call the selectDatabase method to select the chap4Db
//code
$connect->selectDatabase('raja');

//call the createTable method to create table with the $query
//code
$connect->createTable($query);


?>




?>