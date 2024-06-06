<?php 

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

    $optionAutorise = ['GET', 'POST', 'DELETE']; 
    $methode = $_SERVER['REQUEST_METHOD']; 

    if(in_array($methode, $optionAutorise)) {

        require_once('../model/BaseDeDonnees.php'); 
        require_once('../model/Vocabulaire.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $vocabulaire = new Vocabulaire($connexion); 

        switch($methode) {
            CASE 'GET':
                $segments = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
                if($segments[4] == 'lecteur') {
                    // endpoint : localhost/BiblioPlaisir/api/Vocabulaire.php/lecteur/{id_lecteur}
                    $id_lecteur = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    $vocabulaireLecteur = $vocabulaire->recupererVocabulairesLecteur($id_lecteur); 

                    echo json_encode($vocabulaireLecteur, JSON_PRETTY_PRINT); 
                }
                else {
                    // endpoint : localhost/BiblioPlaisir/api/Vocabulaire.php/{id_vocabulaire}
                    $id_vocabulaire = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    $vocabulaireRecupere = $vocabulaire->recuperer($id_vocabulaire); 

                    echo json_encode($vocabulaireRecupere, JSON_PRETTY_PRINT); 
                }
                break; 
            case 'POST':
                $donneesVocabulaire = json_decode(file_get_contents('php://input'), true); 
                $nouveauVocabulaire = $vocabulaire->ajouter($donneesVocabulaire); 

                if($nouveauVocabulaire) {
                    echo json_encode([
                        'message' => "Nouveau vocabulaire ajouté"
                    ], JSON_PRETTY_PRINT); 
                }
                else {
                    echo json_encode([
                        'message' => "Erreur d'ajout du vocabulaire" 
                    ], JSON_PRETTY_PRINT); 
                }
                break;
            case 'DELETE':
                $id_vocabulaire = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                $vocabulaireSupprime = $vocabulaire->supprimer($id_vocabulaire); 
                
                if($vocabulaireSupprime) {
                    echo json_encode([
                        'message' => "Vocabulaire supprimé"
                    ], JSON_PRETTY_PRINT); 
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de suppression du vocabulaire"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
        }
    }
?>