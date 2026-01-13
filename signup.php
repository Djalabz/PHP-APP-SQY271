<?php

include "partials/header.php";
include "config/db.php";

// Véerifier les données: Est ce que le form a été soumis ? 
if (isset($_POST["submit"])) {
    // On vérifie que chaque champ du formulaire soit bien rempli
    if (!empty($_POST["username"]) 
    && !empty($_POST["email"]) 
    && !empty($_POST["password"]) 
    && !empty($_POST["confirm-password"])) {

        // On vérifie que le user ait bien mis 2 fois le meme mot de passe
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $confirm = $_POST["confirm-password"];

        // Idéalement on devrait vérifier en plus que : 
            // le username ne contienne pas de caractères spéciaux (<, >, ; etc)
            // L'email est au bon format 
            // Il faudrait aussi théoriquement vérifier la longueur et le contenu du mdp .
            // (12 car mnimum, min, maj, chiffre et carcatère spécial)

        if ($password !== $confirm) {

            $error = "Le mot de passe et la confirmation sont différents...";

        } else {

            // Si les mdp sont bien identiques -> hasher le mdp
            // On peut hasher grace à la fonction integrée password_hash
            $hash = password_hash($password, PASSWORD_DEFAULT); 

            // On écrit notre requete SQL pour insérer un nouveau user dans la table users
            $sql = "INSERT INTO users(username, email, password) VALUES(?, ?, ?)";

            // On vient préparer la requete 
            $stmt = $db->prepare($sql);
            
            // On vbient éxecuter la requete en remplacant les ? par les bonnes variables.
            $stmt->execute([$username, $email, $hash]);

        }

    } else {
        $error = "Veuillez renseigner tous les champs";
    }
}

?>

<!-- 
1 - Coder le form de signup : username, email, mot de passe et confirmation du mot de passe
2 - Il faut transmettre les données via POST et vérifier que les mdp soient équivalents
3 - Créer une table users dans phpmyadmin qui contiendra les infos de chaque user
4 - Si le username, le mail et le mdp sont bien remplis on les enregistre en BDD 
-->

<h1>Page de Signup</h1>

<form action="" method="POST">

    <input name="username" placeholder="Votre pseudo..." type="text">
    <input name="email" placeholder="Votre email..." type="text">
    <input name="password" placeholder="Votre mot de passe..." type="password">
    <input name="confirm-password" placeholder="Confirmer votre mot de passe ..." type="password">

    <input name="submit" type="submit" value="S'inscrire">

</form>

<?php if (isset($error)) : ?> 

    <h3><?= $error ?></h3>

<?php endif ?>

<?php

include "partials/footer.php";

?>