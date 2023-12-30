<?php
include("connect.php");
if(isset($_GET['b3'])){
    $u=$_GET['user3'];
    $e=$_GET['email3'];
    $p= password_hash($_GET['password3'],PASSWORD_DEFAULT);
    $i=$_GET['id'];
    if(!empty($u)&&!empty($e)&&!empty($p)){
        
        $connecta = new Connection();
        $connecta->selectDatabase("raja");
        $sql="UPDATE clients SET username='$u',email='$e',password='$p' where id=$i";
        $res=mysqli_query($connecta->conn,$sql);
    }
}




?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kdam+Thmor+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="s1.css">
    <title>admin</title>
</head>
<body>
<div  id="ki" class="container text-center bg-dark text-light">
    ADMIN PAGE 
</div>
<div class="container-fluid">
        
           
                <div class="container my-5">
                    <h2>List of clients</h2>
                    <table class="table border">
                        <tr>
                            <th>id</th>
                            <th>user</th>
                            <th>email</th>
                            <th>Action</th>
                        </tr>
                        <?php
                        include("client.php");
                        $connect = new Connection();
                        $connect->selectDatabase("raja");
                        $rows = Client::selectAllClients('clients', $connect->conn);
                        //creation des tr
                        if ($rows) {
                            foreach ($rows as $t) {
                                echo "<tr>
                                        <td>$t[id]</td>
                                        <td>$t[username]</td>
                                        <td>$t[email]</td>
                                        <td>
                                            <a href='' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#exampleModal'>
                                                Edit
                                            </a>
                                            <a href='delete.php?id=$t[id]' class='btn btn-success'>delete</a>
                                        </td>
                                    </tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-md-2" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">REGISTER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="GET">
                        <input type="text" value="" name="user3" class="form-control my-3" id="" placeholder="ENTER USERNAME">
                        <input type="email" value="" name="email3" class="form-control my-3" id="" placeholder="ENTER EMAIL">
                        <input type="password" value="" name="password3" class="form-control my-3" id="" placeholder="ENTER PASSWORD">
                        <div class="modal-footer">
                            <button type="submit" name="b3" class="btn btn-success  mx-auto">SUBMIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>