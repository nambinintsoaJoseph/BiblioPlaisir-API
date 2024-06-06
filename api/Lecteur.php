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
        require_once('../model/Lecteur.php'); 
        include('fonctions.php'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $lecteur = new Lecteur($connexion); 

        switch($methode) {
            case 'POST':
                // endpoint : POST localhost/BiblioPlaisir/api/Lecteur.php
                $donneesNouveauLecteur = json_decode(file_get_contents('php://input'), true); 
                $nouveauLecteur = $lecteur->creer($donneesNouveauLecteur); 

                if($nouveauLecteur) {
                    echo json_encode([
                        'message' => "Lecteur ajouté"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur d'ajout du lecteur"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
            CASE 'GET':
                // endpoint : GET localhost/BiblioPlaisir/api/Lecteur.php/{id}
                $id_lecteur = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $lecteurRecupere = $lecteur->recuperer($id_lecteur); 

                if($lecteurRecupere) {
                    echo json_encode($lecteurRecupere, JSON_PRETTY_PRINT);
                    http_response_code(200); 
                }
                else {
                    echo json_encode([
                        'message' => "Aucun lecteur trouvé"
                    ], JSON_PRETTY_PRINT); 
                    http_response_code(200); 
                }
                break;
            case 'DELETE':
                // endpoint : DELETE localhost/BiblioPlaisir/api/Lecteur.php/{id}
                $id_lecteur = recupererParametreSimple($_SERVER['REQUEST_URI']);
                $lecteurSupprime = $lecteur->supprimer($id_lecteur); 

                if($lecteurSupprime) {
                    echo json_encode([
                        'message' => "Lecteur supprimé avec succès"
                    ], JSON_PRETTY_PRINT);
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de suppression du lecteur"
                    ], JSON_PRETTY_PRINT);
                }
                break; 
        }

    }
    else {
        if($methode == 'PUT') {
            echo json_encode([
                'message' => "La méthode PUT n'est pas autorisée"
            ], JSON_PRETTY_PRINT);
        }
        else {
            echo json_encode([
                'message' => "Cette méthode ne fait pas partie du standard du REST"
            ], JSON_PRETTY_PRINT); 
        }
    }

?>