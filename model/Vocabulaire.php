<?php 
    class Vocabulaire {

        private $conn; 

        public function __construct($conn) {
            $this->conn = $conn; 
        }

        // endpoint : GET localhost/BiblioPlaisir/api/Vocabulaire.php/{id}
        public function recuperer($id_vocabulaire) {
            $sql = "SELECT * FROM Vocabulaire WHERE id_vocabulaire = :id_vocabulaire;"; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_vocabulaire', $id_vocabulaire); 
            $requetePreparee->execute(); 

            $infoVocabulaire = $requetePreparee->fetch(PDO::FETCH_ASSOC); 
            return $infoVocabulaire; 
        }

        // endpoint : GET localhost/BiblioPlaisir/api/Vocabulaire.php/lecteur/{id_lecteur}
        public function recupererVocabulairesLecteur($id_lecteur) {
            $sql = "SELECT * FROM Vocabulaire WHERE id_lecteur = :id_lecteur;"; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_lecteur', $id_lecteur); 
            $requetePreparee->execute(); 

            $listeVocabulaire = []; 
            while($vocabulaire = $requetePreparee->fetch(PDO::FETCH_ASSOC)) {
                $listeVocabulaire[] = $vocabulaire; 
            }

            return $listeVocabulaire; 
        }

    }
?>