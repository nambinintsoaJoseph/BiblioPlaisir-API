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

        }

    }

?>