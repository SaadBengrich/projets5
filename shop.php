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
      <div class="container d-flex justify-content-start  my-5">
        <div class="row d-flex justify-content-center align-items-center">
 <div class="col">
    <div class="card h-100 " style="width: 40rem;">
     <img src="img/one.jpg" class="card-img-top" alt="...">
     
</div>
</div>
       
        <div class="col m-5">
            <img class="um" src="img/ad.jpg" alt="">

        </div>
  
 </div>
      </div>

      <div class="container-lg mx-auto border" id="ho">
    <div class="row d-flex text-center justify-content-center ms-5 p-3 gy-5">   <style>
    .cat {
        width: 200px; /* Set your desired width here */
    }
</style>
<?php
include("CRUD/connect.php");
$connect = new Connection();
$connect->selectDatabase("raja");

include("CRUD/categorie.php");
include("CRUD/product.php");

// Fetch products from the "produit" table
if (isset($_POST['category'])) {
    $selectedCategoryId = $_POST['category'];
} else {
    $selectedCategoryId = 0;
}

if ($selectedCategoryId > 0) {
    $products = Produit::getProductsByCategoryId($connect->conn, "produit", $selectedCategoryId);
} else {
    $products = Produit::selectAllProducts($connect->conn, "produit");
}

// Display category dropdown
$cat = Categorie::selectAllCategories($connect->conn, "cat");

echo '<form method="post" action="">
        <select class="cat m-3 text-center" name="category" onchange="this.form.submit()">
            <option selected value="0">Select category</option>';
foreach ($cat as $category) {
    $selected = ($selectedCategoryId == $category['id']) ? 'selected' : '';
    echo '<option value="' . $category['id'] . '" ' . $selected . '>' . $category['nom'] . '</option>';
}
echo '</select>
    </form>';

// Display products in rows with three columns each
$productsChunks = array_chunk($products, 4);

foreach ($productsChunks as $chunk) {
    echo '<div class="row py-2">';
    foreach ($chunk as $product) {
        $imageData = Produit::getImageData($connect->conn, $product['id']);
        $base64ImageData = base64_encode($imageData);

        echo '<div class="col">
        <div class="card h-100" style="width: 12rem;">
            <img class="img-pro" src="data:image/jpeg;base64,' . $base64ImageData . '" class="card-img-top" alt="...">
            <div class="card-body">
                <h4>' . $product['nom_p'] . '</h4>
                <p class="card-text"><b>' . $product['prix'] . 'DH</b></p>
                <a href="addToCart.php?product_id=' . $product['id'] . '" class="btn btn-dark" id="b">Add To Cart</a>
            </div>
        </div>
    </div>';

    }
    echo '</div>';
}
?>


</div>
</div>

    </div>
</div>
<div class="logp">
  <div class="logc">
    <img src="img/logo1.jpg" alt="">
    <img src="img/logo2.png" alt="">
    <img src="img/logo5.jpg" alt="">
  </div>
</div>
<div class="container d-flex justify-content-center py-5 text-success">
<nav aria-label="Page navigation example" class="PG">
  <ul class="pagination">
    <li class="page-item"><a class="page-link text-success" href="#">Previous</a></li>
    <li class="page-item"><a class="page-link text-success " href="#">1</a></li>
    <li class="page-item"><a class="page-link text-success" href="#">2</a></li>
    <li class="page-item"><a class="page-link text-success" href="#">3</a></li>
    <li class="page-item"><a class="page-link text-success" href="#">Next</a></li>
  </ul>
</nav></div>
    











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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script></body>

</body>
</html>
