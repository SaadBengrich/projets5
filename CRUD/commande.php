<?php

class Commande{
public $id;
public $date;
public $id_c;
public static $errmsg;
public static $successMesage;

public function __construct($id_c) {
    $this->date = "";
    $this->id_c = $id_c;
}
public function commande_details(){
    echo "ID: " . $this->id . "<br>";
    echo "Date: " . $this->date . "<br>";
    echo "ID Client: " . $this->id_c . "<br>";
}
public function addc($tableName, $con) {
    $formattedDate = date('Y-m-d H:i:s');
    $query = "INSERT INTO `$tableName` (date_cmd, id_client) VALUES ('$formattedDate', $this->id_c)";
    
    $r = mysqli_query($con, $query);

    if ($r) {
        self::$successMesage = "Added successfully";
        // Return the last inserted ID
        return mysqli_insert_id($con);
    } else {
        self::$errmsg = "Not added";
        // Return some value to indicate failure
        return -1; // or any other value that makes sense in your context
    }
}
public static function getcbyclientid($id,$tableName,$con){
$sql="select id_cmd from $tableName where id_client=$id";
$res=mysqli_query($con,$sql);
if($res){
    return $res;
}
else{
    return null;
}




}


public  static function getCbyid($id,$tableName,$con){
    $query="select *from $tableName where id_cmd=$id";
    $r=mysqli_query($con,$query);
    if($r&&mysqli_num_rows($r)>0 ){
        return mysqli_fetch_assoc($r);

    }
    else {
        return null;
    }

} 
public static function selectallcmd($tableName,$con){
    $query="select *from $tableName";
    $r=mysqli_query($con,$query);
    $res=[];
    if($r){
        while($row=mysqli_fetch_assoc($r)) {
            $res[]=$row;
        }
        return $res;
    }
    else{
        return null;
    }

}
static function deletecmd($tableName,$conn,$id){
    //delet a client by his id, and send the user to read.php
    $query="delete from $tableName where id_cmd=$id";
    $res=mysqli_query($conn,$query);
    if ($res) {
        self::$successMesage = "cmd deleted successfully";
        // Redirect the user to read.php
        exit();
    } else {
        self::$errmsg = "Error deleting cmd: " . mysqli_error($conn);
    }
    //code
  
    }

}












?>