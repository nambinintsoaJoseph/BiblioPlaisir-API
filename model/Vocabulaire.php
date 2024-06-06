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

        // endpoint : POST localhost/BiblioPlaisir/api/Vocabulaire.php/
        public function ajouter($donnees) {
            $sql = "INSERT INTO Vocabulaire(id_lecteur, mot, definition_mot) VALUES(:id_lecteur, :mot, :definition_mot);"; 

            $requetePreparee = $this->conn->prepare($sql); 

            $requetePreparee->bindParam(':id_lecteur', $donnees['id_lecteur']); 
            $requetePreparee->bindParam(':mot', $donnees['mot']); 
            $requetePreparee->bindParam(':definition_mot', $donnees['definition_mot']); 

            $etat = $requetePreparee->execute(); 

            if($etat) {
                return true; 
            }
            else {
                return false; 
            }
        }

        // endpoint : DELETE localhost/BiblioPlaisir/api/Vocabulaire.php/{id_vocabulaire}
        public function supprimer($id_vocabulaire) {
            $sql = "DELETE FROM Vocabulaire WHERE id_vocabulaire = :id_vocabulaire;"; 

            $requetePreparee = $this->conn->prepare($sql); 
            $requetePreparee->bindParam(':id_vocabulaire', $id_vocabulaire); 
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