<?php 
include("CRUD/connect.php");
$connect=new Connection();
$connect->selectDatabase("raja");
include("acheter.php");
$id=$_GET['id'];
Acheter::deleteAchatById($id,$connect->conn);
header("location: mycart.php");
exit;





?>