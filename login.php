<?php
$emailValue = "";
$userValue = "";
$passwordValue = "";
$errorMesage = "";
$successMesage = "";
$error="";


// Register
if(isset($_POST['b1'])){  
    $userValue = $_POST['user2'];
    $emailValue = $_POST['email2'];
    $passwordValue = $_POST['password2'];

    if(empty($emailValue) || empty($userValue) || empty($passwordValue)){
        $errorMesage = "All fields must be filled";
    }else{

    
    if(strlen($passwordValue) < 8){
        $errorMesage = "Password must be at least 8 characters long";
    } else if(!preg_match("/[A-Z]/", $passwordValue)){
        $errorMesage = "Password must contain at least 1 capital letter";
    } else{

    
        // Hash the password
        //$hashedPassword = password_hash($passwordValue, PASSWORD_DEFAULT);

        // Your database connection and insertion logic
        $passwordValue=password_hash($passwordValue,PASSWORD_DEFAULT);
        include("CRUD/connect.php");
        $connect = new Connection();
        $connect->selectDatabase("raja");
        include("CRUD/client.php");
        $client = new Client($userValue,$emailValue,$passwordValue);
        $client->insertClient("clients", $connect->conn);
        $successMesage = "Registration successful";}
    } }
  
    if (isset($_POST['submit'])) {
      $em = $_POST['email1'];
      $pw = $_POST['password1'];
  
      include("CRUD/connect.php");
      $connect = new Connection();
      $connect->selectDatabase("raja");
  
      include("CRUD/client.php");
  
      // Retrieve user data from the database
      $userData = Client::getUserByEmail("clients", $connect->conn, $em);
  
      if ($userData) {
          // Check if the entered password matches the stored hash
          if (password_verify($pw,$userData['password'])) {
              // Login successful
              session_start();

            // Set session variables
            $_SESSION['id'] = $userData['id'];
            $_SESSION['name'] = $userData['username'];
            $_SESSION['email'] = $userData['email'];
            $_SESSION['submit']=true;

              header("location: home.php");
              exit();
          } else {
              // Debug information
              $errorMesage= "Password verification failed";
          }
      } else {
          // Debug information
          $errorMesage="user not found";
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
    <title>login</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg border-bottom border-2 ">
        <div class="container-fluid">
          <a class="navbar-brand me-auto" href="#"><img src="img/rajan.png" alt="">CLUB OF THE CENTURY</a>
          
          <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel"><img src="img/rajan.png" alt=""></h5>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item mx-3">
                  <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-3" href="#">History</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-3" href="#">Raja Store</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link mx-3" href="#">Contact</a>
                </li>
               
              </ul>
             
            </div>
          </div>
          <a href="login.php" class="btn btn-success btn-md rounded-pill me-1" id="b1"> Login</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </nav>
      <?php
                        if (!empty($error)) {
                          echo "<div class='alert alert-warning alert-dismissible text-center fade show' role='alert'>
                                  <strong>$error</strong>
                                  <button type='button' class='btn-close' data-bs-dismiss='alert'
                                      aria-label='Close'></button>
                                </div>";
                      } 
                        if (!empty($errorMesage)) {
                            echo "<div class='alert alert-warning alert-dismissible text-center fade show' role='alert'>
                                    <strong>$errorMesage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'
                                        aria-label='Close'></button>
                                  </div>";
                        }

                        if (!empty($successMesage)) {
                            echo "<div class='alert alert-success alert-dismissible text-center fade show' role='alert'>
                                    <strong>$successMesage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert'
                                        aria-label='Close'></button>
                                  </div>";
                        }
                        ?>
      <div class="container " >
        <div class="row py-5 my-5">
            <div class="col-12 col-sm-8 col-md-6 m-auto">
    
                <div class="card " id="car">
                    <div class="card-body bg-dark py-4 rounded" >
                        <form action="" method="POST">
              

                            <div class="text-center"><i class="fa-solid fa-user fa-bounce fa-2xl" style="color: #ffffff;"></i></div>          
                            <input type="email" name="email1" class="form-control my-3" id="exampleInputEmail1" placeholder="ENTER  EMAIL">
                            <input type="password" name="password1" class="form-control my-3" id="exampleInputPassword1" placeholder="ENTER PASSWORD">
                        <div class="text-center"><button type="submit" name="submit" class="btn btn-success mx-auto">LOGIN</button></div>
                        <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal"class="nav-link text-center py-3" id="idk" >I dont have an account</a>
                        </form>
                    </div>

                </div>
            </div>




        </div>
      </div>
  
      <!-- Button trigger modal -->

<!-- Modal -->
<!-- Modal content -->
<div class="modal fade modal-md-2 rounded" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3" id="exampleModalLabel">REGISTER</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form inside the modal -->
                    <form action="" method="POST">
                        <input type="text" value="<?php echo"$userValue"?>" name="user2" class="form-control my-3" placeholder="ENTER USERNAME" required>
                        <input type="email" value="<?php echo"$emailValue"?>"name="email2" class="form-control my-3" placeholder="ENTER EMAIL" required>
                        <input type="password" name="password2" class="form-control my-3" placeholder="ENTER PASSWORD"
                            required>
                        <div class="modal-footer">
                            <button type="submit" name="b1" class="btn btn-success mx-auto">SUBMIT</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>




      <footer class="container-fluid bg-success text-white">
        <div class="container text-center">
          <div class="row align-items-center">
            <div class="col py-5">
              <h5></h5>
              <ul>
                <li>
                  <i class="fa-brands fa-facebook fa-2xl" style="color: #ffffff;"></i>
                  
                </li>
                <li> 
                  <i class="fa-brands fa-youtube fa-2xl" style="color: #ffffff;"></i></li>
                <li>
                  <i class="fa-brands fa-twitter fa-2xl "  style="color: #ffffff;"></i>
                  </li>
              </ul>
            </div>
            <div class="col">
              <ul>
                <li><i class="fa-brands fa-cc-visa fa-2xl"></i></li>
                <li><i class="fa-brands fa-paypal fa-2xl"></i></li>
                <li><i class="fa-regular fa-credit-card fa-2xl"></i></li>
              </ul>
            </div>
            <div class="col">
              All rights reserved <i class="fa-regular fa-copyright fa-md"></i>
            </div>
          </div>
        </div>
        
      </footer>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>


</html>
