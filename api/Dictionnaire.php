<?php

    header("Access-Control-Allow-Origin: *"); 
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); 

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        // endpoint : GET localhost/BiblioPlaisir/Dictionnaire.php/{mot}

        require_once('fonctions.php'); 

        $mot = recupererParametreSimple($_SERVER['REQUEST_URI']); 
        $url = "lien-secret" . $mot; // lien secret

        // Charger le contenu de la page HTML
        $html = file_get_contents($url);

        // Créer un nouvel objet DOMDocument
        $dom = new DOMDocument();

        // Suppression des erreurs de chargement HTML
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        // Créer un nouvel objet DOMXPath
        $xpath = new DOMXPath($dom);

        // Rechercher tous les éléments <span> avec la classe 'd_dfn'
        $nodes = $xpath->query('//span[@class="definition"]');

        $definitions = [];
        // Parcourir tous les nœuds trouvés et ajouter leur contenu au tableau
        foreach ($nodes as $cle => $valeur) {
            $definitions['definition' . ($cle+1)] = $valeur->textContent; 
        }

        echo json_encode([
            'mot' => $mot, 
            'definition' => $definitions
        ], JSON_PRETTY_PRINT); 
    }
    else {
        echo json_encode([
            'message' => "La méthode n'est pas autorisé"
        ], JSON_PRETTY_PRINT); 
    }

?>