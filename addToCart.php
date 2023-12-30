
  
  <?php 
  session_start();
  
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
              <a class="nav-link active" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-3" href="#">History</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-3" href="shop.php">Raja Store</a>
            </li>
            <li class="nav-item">
              <a class="nav-link mx-3" href="#">Contact</a>
            </li>
           
          </ul>
         
        </div>
      </div>
      <?php   if(isset($_SESSION['submit']) && $_SESSION['submit']==true){  echo "<!-- Example split danger button -->
<div class='btn-group mx-5' >
  <button type='button' class='btn btn-success'><i class='fa-solid fa-user p-2'></i>".$_SESSION['name']."</button>
  <button type='button' class='btn btn-dark dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' aria-expanded='false'>
    <span class='visually-hidden'>Toggle Dropdown</span>
  </button>
  <ul class='dropdown-menu'>
    <li ><a class='dropdown-item' href='logout.php'>LOGOUT</a></li>
    <li ><a class='dropdown-item' href='mycart.php'>MYCART</a></li>

  </ul>
</div>";}  
      else{
        echo '<a href="login.php" class="btn btn-success btn-md rounded-pill me-1" id="b1">Login</a>';
      } ?>
      
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </nav>
      <div class="container">
        <?php
        include("CRUD/connect.php");
        $connect = new Connection();
        $connect->selectDatabase("raja");
        include("CRUD/product.php");
        $id=$_GET["product_id"];
        $pr=Produit::getProductById($connect->conn,"produit",$id);
        $imageData = Produit::getImageData($connect->conn, $pr['id']);
        $base64ImageData = base64_encode($imageData);
        if ($pr) {
            echo ' <form action="" method="post">
            <div class="row py-5 border m-2">
                <div class="col">
                    <img class="img-fluid" src="data:image/jpeg;base64,' . $base64ImageData . '" alt="' . $pr['nom_p'] . '">
                </div>
                <div class="col">
                    <div class="card-body cc">
                        <h5 class="card-title">' . $pr['nom_p'] . '</h5>
                        <p class="card-text"><small class="text-body-secondary">Price: $' . $pr['prix'] . '</small></p>
                        
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" name="quantity" min="1" value="1">
                        <br>
                        
                
                        <button name="saad"  type="submit" class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </div> </form>';
    } else {
        echo "Product not found";
    }
    if(isset($_POST["saad"])){
      include("CRUD/commande.php");
      include("acheter.php");
      $quantity=$_POST['quantity'];
      $order = new Commande($_SESSION['id']);
      $orderId = $order->addc("commande",$connect->conn);
      $productId = $pr['id'];
      $productName = $pr['nom_p'];
      $productPrice = $pr['prix'];

  
      if ($orderId !== -1) {
        // Debugging output
        echo "Order ID: $orderId<br>";
        echo "Product ID: $productId<br>";
        echo "Product Name: $productName<br>";
        echo "Quantity: $quantity<br>";
        echo "Product Price: $productPrice<br>";

        // Create a new purchase (Acheter) instance and insert into the database
        $purchase = new Acheter($productId, $orderId, $quantity * $productPrice, $quantity);
        $result = $purchase->insertAchat($connect->conn);

        if ($result) {
            // Optionally, you can display order details
            echo '<h2>Order Details</h2>';
            echo '<p>Order ID: ' . $orderId . '</p>';
            echo '<p>Product Name: ' . $productName . '</p>';
            echo '<p>Quantity: ' . $quantity . '</p>';
            echo '<p>Total Amount: $' . ($quantity * $productPrice) . '</p>';
        } else {
            echo "Failed to create purchase.";
        }
    } else {
        echo "Failed to create order.";
    }

  }





        
    









        ?>



      





      </div>





      <footer class="container-fluid bg-dark text-white">
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
