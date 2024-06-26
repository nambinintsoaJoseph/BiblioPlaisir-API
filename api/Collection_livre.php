<?php 

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

    require '../model/JWTManagement.php'; 

    $optionAutorise = ['GET', 'POST', 'PUT', 'DELETE']; 
    $methode = $_SERVER['REQUEST_METHOD']; 

    if(in_array($methode, $optionAutorise)) {

        require_once('../model/BaseDeDonnees.php'); 
        require_once('../model/Collection_livre.php'); 
        include('fonctions.php'); 

        $token_decode = verifierToken('lecteur'); 

        $baseDeDonnees = new BaseDeDonnees(); 
        $connexion = $baseDeDonnees->recupererConnexion(); 
        $collectionLivre = new Collection_livre($connexion); 

        switch($methode) {
            case 'GET':
                $segments = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
                if($segments[4] == 'lecteur') {
                    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/lecteur/{id_lecteur}
                    $id_lecteur = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    if($id_lecteur == $token_decode->data->id_lecteur) {
                        $collectionLecteur = $collectionLivre->recupererCollectionLecteur($id_lecteur); 
                        echo json_encode($collectionLecteur, JSON_PRETTY_PRINT);
                    } 
                    else {
                       echo json_encode([
                          "message" => "Cette collection ne vous appartient pas"
                       ], JSON_PRETTY_PRINT); 
                    }
                }
                else if($segments[4] == 'stat4mois') {
                    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/stat4mois/{id_lecteur}
                    $id_lecteur = recupererParametreSimple($_SERVER['REQUEST_URI']);
                    if($id_lecteur == $token_decode->data->id_lecteur) {
                        $nbLivreLu = $collectionLivre->statistique4Mois($id_lecteur); 
                        echo json_encode($nbLivreLu, JSON_PRETTY_PRINT);
                    } 
                    else {
                       echo json_encode([
                          "message" => "Ces données ne sont pas accessibles."
                       ], JSON_PRETTY_PRINT); 
                    }
                }
                else {
                    // endpoint : GET localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}
                    $id_collection = recupererParametreSimple($_SERVER['REQUEST_URI']); 
                    $collectionRecupere = $collectionLivre->recuperer($id_collection); 

                    echo json_encode($collectionRecupere, JSON_PRETTY_PRINT); 
                }
                break; 
            case 'POST':
                
                // endpoint : POST localhost/BiblioPlaisir/api/Collection_livre.php 
                $donneesCollection = json_decode(file_get_contents('php://input'), true); 

                if($donneesCollection['id_lecteur'] == $token_decode->data->id_lecteur) {
                    $nouvelleCollection = $collectionLivre->ajouter($donneesCollection); 

                    if($nouvelleCollection) {
                        echo json_encode([
                            'message' => "Livre ajouté à la collection"
                        ], JSON_PRETTY_PRINT); 
                    }
                    else {
                        echo json_encode([
                            'message' => "Erreur d'ajour du livre à la collection"
                        ], JSON_PRETTY_PRINT); 
                    }
                    
                }
                else {
                    echo json_encode([
                        'message' => "Vous n'etes pas autorisé a ajouter ce livre a la collection"
                    ]);
                }
                break;
            case 'PUT':
                // endpoint : PUT localhost/BiblioPlaisir/api/Collection_livre.php
                $donneesCollection = json_decode(file_get_contents('php://input'), true);

                $autorisation = $donneesCollection['id_lecteur'] == $token_decode->data->id_lecteur;

                // On vérifie si la collection appartient à l'utilisateur et que l'id_lecteur  
                if($collectionLivre->possederCollection($donneesCollection['id_collection'], $donneesCollection['id_lecteur']) && $autorisation) {
                    $modificationCollection = $collectionLivre->modifier($donneesCollection); 

                    if($modificationCollection) {
                        echo json_encode([
                            'message' => "Collection à jour"
                        ], JSON_PRETTY_PRINT);
                    }
                }
                else {
                    echo json_encode([
                        'message' => "Erreur de la mise à jour de la collection"
                    ], JSON_PRETTY_PRINT);
                }
                break;
            case 'DELETE':
                // endpoint : DELETE localhost/BiblioPlaisir/api/Collection_livre.php/{id_collection}
                $id_collection = recupererParametreSimple($_SERVER['REQUEST_URI']);
                
                if($collectionLivre->possederCollection($id_collection, $token_decode->data->id_lecteur)) {
                    $collectionSupprime = $collectionLivre->supprimer($id_collection); 

                    if($collectionSupprime) {
                        echo json_encode([
                            'message' => "Livre supprimé de votre collection"
                        ], JSON_PRETTY_PRINT);
                    }
                }
                else {
                    echo json_encode([
                        'message' => "Une erreur est survenue lors de la suppression du livre de votre collection"
                    ], JSON_PRETTY_PRINT); 
                }
                break; 
        }

    }

?>