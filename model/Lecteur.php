<?php 

class Lecteur {

    private $conn; 

    public function __construct($conn) {
        $this->conn = $conn; 
    }

    // endpoint : POST localhost/BiblioPlaisir/api/Lecteur.php
    public function creer($donnees) {
        $sql = "INSERT INTO Lecteur(id_compte) VALUES(:id_compte);"; 

        $requetePreparee = $this->conn->prepare($sql);
        $requetePreparee->bindParam(':id_compte', $donnees['id_compte']);  

        $etat = $requetePreparee->execute(); 

        if($etat) {
            return true; 
        }
        else {
            return false; 
        }
    }

}

?>