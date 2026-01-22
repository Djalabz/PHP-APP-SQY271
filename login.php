<?php

include "partials/header.php";
include "config/db.php";

// Traitement des infos reçues en POST
// Vérification que le form ait été soumis 
// Puis vérification que les champs ne soient pas vides etc 

// On vérifie que le form ait été soumis
if (isset($_POST["submit"])) {
    // On vérifie qu'aucun chalmp ne soit laissé vide
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {

        // Requete afin de vérifier que le user existe bien (via email ou username)
        $sql = "SELECT * FROM users WHERE username = ? OR email = ?";

        // On prépare puis on éxecute la requete SQL 
        $stmt = $db->prepare($sql);
        $stmt->execute([$_POST["username"], $_POST["username"]]);

        // Avec fetch on vient recup la réponse > Si oui ou non un user existe bvien avec le pseudo donné ou le mail
        $res = $stmt->fetch(); 

        // Prise en compte du cas ou le user n'existe pas 
        // $res seul dans les parenthèses équivaut à ($res === true)
        if ($res) {
            // Ici on vérifie avec password verify que le mdp correspond bien au hash en BDD
            if (password_verify($_POST["password"], $res["password"])) {

                // Tout est bon, on démarre donc une session -> à partir de cette ligne
                // le cookie de session qui contient l'id de la session est automatiquement créee 
                session_start();

                // On alimente avec les bonnes infos reçues de la BDD 
                // notre superglobale $_SESSION - nom, email et date de création
                $_SESSION["username"] = $res["username"]; 
                $_SESSION["email"] = $res["email"];
                $_SESSION["timestamp"] = $res["timestamp"]; 
                $_SESSION["avatar"] = $res["avatar"]; 

                // Ici tout a été normalement vérifié -> on redirige vers la homepage
                header("Location: index.php");
                exit();

            } else {
                $error = "Le mot de passe n'est pas bon ...";
            }
        } else {
            $error = "Aucun utilisateur trouvé avec le pseudo / email donné";
        }
    } else {
        $error = "Veuillez remplir tous les champs";
    }
}


?>

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

<h1 class="text-red-500">Page de login</h1>

<form action="" method="POST">

    <input type="text" name="username" placeholder="Votre pseudo ...">
    <input type="password" name="password" placeholder="Votre mot de passe ...">
    <input type="submit" name="submit" value="Se connecter">

</form>

<?php if (isset($error)) : ?> 

    <h3><?= $error ?></h3>

<?php endif ?>


<?php

include "partials/footer.php";

?>