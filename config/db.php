<?php

// Fichier de connexion de la BDD 

try {

    // On tente de se connecter à la BDD avec PDO 
    // Le data source name, une string qui contient certaines infos de connexion 
    $dsn = "mysql:dbname=app-sqy271;host=localhost";

    // On va préciser les options pour PDO, ici récupérer comme réponse de la BDD sous forme de tableau associatif
    $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

    // On vient finalement se connecter à la BDD 
    $db = new PDO($dsn, "root", "root", $options);    

    // On affiche un message de confirmation si succès
    // echo "La connexion à la BDD a réussie";

} catch(PDOException $error) {
    // En cas d'erreur on stop le script et on l'affiche
    die("erreur lors de la connexion : " . $error->getMessage());
}