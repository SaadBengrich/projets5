<?php 
if(isset($_GET["id"])){
    $id=$_GET["id"];
    include("connect.php");
    $connect=new Connection();
    $connect->selectDatabase("raja");
    $query="DELETE FROM clients WHERE id=$id";
    mysqli_query($connect->conn,$query);
}
header("location: admin.php");
exit;




?>