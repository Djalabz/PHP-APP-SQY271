<?php

include "partials/header.php";
include "partials/check-session.php";

// COOKIES 

// Ajouter un cookie 
// setcookie("test", "ceci est un cookie", time() + 3600);

// Supprimer un cookie : on met une date d'expiration négative
// setcookie("test", "ceci est un cookie", time() - 5);

// echo $_COOKIE["test"];


?>

<h1 class="text-red-500">Bienvenue sur mon app en PHP</h1>

<h2>Bonjour <?= $_SESSION["username"] ?> comment allez vous ?</h2>

<img class="avatar" src="<?= $_SESSION["avatar"] ?>" >

<?php

include "partials/footer.php";

?>