<?php 

session_start();

?>

<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site en PHP</title>
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>

<header>
    <nav>
        <?php if (isset($_SESSION["username"])) : ?>

            <a href="index.php">Home</a>
            <a href="#">About</a>
            <a href="#">Contact</a>
            <a href="logout.php">Logout</a>

        <?php else : ?>

            <a href="login.php">Login</a>
            <a href="signup.php">Signup</a>

        <?php endif ?>
    </nav>
</header>
    
<!-- 1 - Faire un menu de navigation -> Home / About / Contact / Signout

2 - !! Si jamais la personne ,n'est pas connectée (cad que la session n'est pas créee) 
alors on affiche juste Signup / Login dans le menu

3 - Rajouter en BDD dans users une colonne avatar qui contiendra le chemin vers un avatar par défaut
Le user pourra le changer ultérieurement mais en attendant l'avatar par défaut doit s'afficher sur la homes -->