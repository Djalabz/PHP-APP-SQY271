<?php

include "partials/header.php";

?>

<h1>Page de login</h1>

<!-- 
1 - Coder d'abord le form en question avec la method (post) et en ne précisant pas l'action dans les attributs. 
    On aura besoin de pseudo / email et mot de passe

2 - Une fois le form ajouté assurez vous de bien recevoir les données transmises en haut de la page entre les balises php 
    avec la superglobale $_POST - Rappellez vous que $_POST est un tableau associatif et chaque clé de ce tableau provient 
    des différents "name" précisés en attributs dans chacun de nos inputs

3 - On procède ensuite au traitement des données : 

    - Si le form a bien été soumis 
    - Alors on vérifie que les champs soient tous remplis (sinon message d'erreur)
    - Si tout est remplis on procède à la requete préparée avec $db (qui devra etre inclus plus haut)
    - Il faudra donc écrire la requete SQL permettant de vérifier si le user existe bien dans la bdd et que le mdp correspond 
    - On vérifiera les mdp (la version reçue en post et celle hashée en bdd) avec password_verify
    - On créera des erreurs pour chaque situation adéquate

4 - Si tout est bon est que le user est login -> trouver un moyen de rediriger vers la homepage (index.php)  
-->

<?php

include "partials/footer.php";

?>