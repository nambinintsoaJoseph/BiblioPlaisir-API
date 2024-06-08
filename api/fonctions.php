<?php 
    function recupererParametreSimple($url) {
        $parts = explode('/', $url); 
        $parametre = end($parts); 
        return $parametre; 
    }

    function definitionMot($mot) {
        $url = "https://dictionnaire.lerobert.com/definition/chaise";

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
        $nodes = $xpath->query('//span[@class="d_dfn"]');
 
        $definitions = [];

        // Parcourir tous les nœuds trouvés et ajouter leur contenu au tableau
        foreach ($nodes as $node) {
            $definitions[] = $node->textContent;
            break; 
        } 
 
        return $definitions[0]; 
    }
?>