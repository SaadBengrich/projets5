<?php

class Produit
{
    public $id;
    public $nom_p;
    public $prix;
    public $id_cat;
    public $image; // Added image attribute
    public static $errmsg;
    public static $succmsg;

    // Constructor
    public function __construct($nom_p, $prix, $id_cat, $image)
    {
        $this->nom_p = $nom_p;
        $this->prix = $prix;
        $this->id_cat = $id_cat;
        $this->image = $image;
    }

    // Insert product into the database
    public function insertProduct($conn, $tableName)
    {
        $imageData = addslashes(file_get_contents($this->image)); // Convert image to binary data

        $sql = "INSERT INTO $tableName (nom_p, prix, id_cat, image) VALUES ('$this->nom_p', $this->prix, $this->id_cat, '$imageData')";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Product inserted successfully.";
            return true;
        } else {
            self::$errmsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }

    // Get product by ID
    public static function getProductById($conn, $tableName, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    // Delete product by ID
    public static function deleteProduct($conn, $tableName, $id)
    {
        $sql = "DELETE FROM $tableName WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Product deleted successfully.";
            return true;
        } else {
            self::$errmsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }

    // Select all products
    public static function selectAllProducts($conn, $tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Update product by ID
    public function updateProduct($conn, $tableName)
    {
        $imageData = addslashes(file_get_contents($this->image)); // Convert image to binary data

        $sql = "UPDATE $tableName SET nom_p='$this->nom_p', prix=$this->prix, id_cat=$this->id_cat, image='$imageData' WHERE id=$this->id";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Product updated successfully.";
            return true;
        } else {
            self::$errmsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }
    public static function getProductsByCategoryId($conn, $tableName, $categoryId)
    {
        $sql = "SELECT * FROM $tableName WHERE id_cat = $categoryId";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public static function getImageData($conn, $productId) {
        $query = "SELECT image FROM produit WHERE id = $productId";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            return $row['image'];
        } else {
            // Handle the error
            echo "Error executing query: " . mysqli_error($conn);
            return null;
        }
    }
    
}

?>
