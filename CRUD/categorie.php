<?php

class Categorie
{
    public $id;
    public $nom;
    public static $errorMsg;
    public static $succmsg;

    // Constructor
    public function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    // Insert category into the database
    public function insertCategory($conn, $tableName)
    {
        $sql = "INSERT INTO $tableName (nom) VALUES ('$this->nom')";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Category inserted successfully.";
            return true;
        } else {
            self::$errorMsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }

    // Get category by ID
    public static function getCategoryById($conn, $tableName, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        } else {
            return null;
        }
    }

    // Delete category by ID
    public static function deleteCategory($conn, $tableName, $id)
    {
        $sql = "DELETE FROM $tableName WHERE id = $id";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Category deleted successfully.";
            return true;
        } else {
            self::$errorMsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }

    // Select all categories
    public static function selectAllCategories($conn, $tableName)
    {
        $sql = "SELECT * FROM $tableName";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_all($result, MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // Update category by ID
    public function updateCategory($conn, $tableName)
    {
        $sql = "UPDATE $tableName SET nom='$this->nom' WHERE id=$this->id";

        if (mysqli_query($conn, $sql)) {
            self::$succmsg = "Category updated successfully.";
            return true;
        } else {
            self::$errorMsg = "Error: " . mysqli_error($conn);
            return false;
        }
    }
}

// Example of using the Categorie class:

// $conn = mysqli_connect("your_host", "your_username", "your_password", "your_database");
// $categorie = new Categorie(1, "Category 1");

// Insert category
// $categorie->insertCategory($conn, "categories");

// Get category by ID
// $category = Categorie::getCategoryById($conn, "categories", 1);
// print_r($category);

// Delete category by ID
// Categorie::deleteCategory($conn, "categories", 1);

// Select all categories
// $categories = Categorie::selectAllCategories($conn, "categories");
// print_r($categories);

// Update category by ID
// $categorie->updateCategory($conn, "categories");

// mysqli_close($conn);

?>
