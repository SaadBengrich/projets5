<?php


class Client{
public $id;
public $username;
public $email;
public $password;
public $reg_date; 
public static $errorMsg = "";
public static $successMsg="";


public function __construct($username,$email,$password){

    //initialize the attributs of the class with the parameters, and hash the password
    $this->username=$username;
    $this->email=$email;
    $this->password=$password;
    //code
}

public function insertClient($tableName,$conn){

//insert a client in the database, and give a message to $successMsg and $errorMsg
$query="insert into $tableName(username,email,password) values('$this->username','$this->email','$this->password')";
$re=mysqli_query($conn,$query);
if($re){
    self::$successMsg="inserted successfully";
}
else {
    // Check if the error is due to a duplicate email
    if (mysqli_error($conn) == 1062) { // 1062 is the MySQL error code for duplicate entry
        self::$errorMsg = "Error: Email already in use.";
    } else {
        self::$errorMsg = "Error inserting client: " . mysqli_error($conn);
    }
}

//code

}
public static function getUserByEmail($tableName, $conn, $email) {
    $query = "SELECT * FROM $tableName WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}



public static function  selectAllClients($tableName,$conn){

//select all the client from database, and inset the rows results in an array $data[]
$q="select *from $tableName";
$r=mysqli_query($conn,$q);
$data=[];
while( $row=mysqli_fetch_assoc($r)){

    $data[]=$row;
}
return $data;
//code

}

static function selectClientById($tableName,$conn,$id){
    //select a client by id, and return the row result
    $q="select *from $tableName where id=$id";
    $res=mysqli_query($conn,$q);
    $row=mysqli_fetch_assoc($res);
    return $row;
    //code

}

static function updateClient($client,$tableName,$conn,$id){
    //update a client of $id, with the values of $client in parameter
    $query = "UPDATE $tableName SET username = '" . $client->username . "', email = '" . $client->email . "', password = '" . $client->password . "' WHERE id = $id";
    $res=mysqli_query($conn,$query);
    if($res){
        self::$successMsg="updated successfully";
    }
    else{
        self::$errorMsg="not updated" . mysqli_error($conn);
    }

    //and send the user to read.php
    header("location: read.php");
    //code

}

static function deleteClient($tableName,$conn,$id){
    //delet a client by his id, and send the user to read.php
    $query="delete from $tableName where id=$id";
    $res=mysqli_query($conn,$query);
    if ($res) {
        self::$successMsg = "Client deleted successfully";
        // Redirect the user to read.php
        header("Location: read.php");
        exit();
    } else {
        self::$errorMsg = "Error deleting client: " . mysqli_error($conn);
    }
    //code
  
    }

}

?>

