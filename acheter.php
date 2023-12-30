<?php  class Acheter {
    public $id_p;
    public $id_c;
    public $montant;
    public $qte;

    public function __construct($id_p, $id_c, $montant, $qte) {
        $this->id_p = $id_p;
        $this->id_c = $id_c;
        $this->montant = $montant;
        $this->qte = $qte;
    }

    public function afficherDetails() {
        echo "ID Produit: " . $this->id_p . "<br>";
        echo "ID Client: " . $this->id_c . "<br>";
        echo "Montant: " . $this->montant . "<br>";
        echo "Quantité: " . $this->qte . "<br>";
    }

    // Function to insert an achat
    public function insertAchat($con) {
        $query = "INSERT INTO acheter (id_p, id_c, qte, montant) VALUES ($this->id_p, $this->id_c,$this->qte, $this->montant )";
        $result = mysqli_query($con, $query);
        return $result;
    }

    // Function to delete an achat by ID
    public static function deleteAchatById($idAchat, $con) {
        $query = "DELETE FROM acheter WHERE id_p = $idAchat";
        $result = mysqli_query($con, $query);
        return $result;
    }

    // Function to select all achats
    public static function selectAllAchats($con) {
        $query = "SELECT * FROM acheter";
        $result = mysqli_query($con, $query);
        $achats = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $achats[] = $row;
        }

        return $achats;
    }

    // Function to get an achat by ID
    public static function getachatbycid($cmd, $con) {
        $query = "SELECT *FROM acheter WHERE id_c = $cmd";
        $result = mysqli_query($con, $query);
    
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            return (int)$row['id'];
        } else {
            return null;
        }
    }
    
    
    
    
    
}

 ?>