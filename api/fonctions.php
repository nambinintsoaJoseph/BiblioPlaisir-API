<?php 
    function recupererParametreSimple($url) {
        $parts = explode('/', $url); 
        $parametre = end($parts); 
        return $parametre; 
    }
?>