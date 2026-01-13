<?php 

include "partials/header.php";
include "config/db.php";

// Application de todos avec la BDD 

// On déclare $todos qui vient éxecuter la requete sur $db 
// fetchAll() nous  retourne l'ensemble des résultats (!= fetch qui n'en retourne qu'un seul le premier)
$sql = "SELECT * FROM todos";
$todos = $db->query($sql)->fetchAll();

// Pour ajouter une todo en BDD 
if (isset($_POST["submit"])) {
    if (!empty($_POST["todo"])) {

        $content = $_POST["todo"];

        // On vient se prémunir des injections SQL avec des requetes préparées
        // Cad on remplace les données en provenance du user par ?
        $sqlInsert = "INSERT INTO todos(content) VALUES(?)";

        // On vient préparer la requete 
        $stmt = $db->prepare($sqlInsert);

        // On vient ensuite éxecuter la requete et lier les paramètres 3
        $stmt->execute([$content]);  

    } else {
        $error = "Veuillez écrire une todo";
    }
}



?>

<h1>Ma todo en PHP</h1>

<form action="" method="POST">

    <input name="todo" type="text" placeholder="Votre todo ici ...">
    <input name="submit" type="submit" value="Ajouter">

</form>

<div class="display-todos">

    <?php if (isset($todos)) : ?> 
        <!-- On utilise un foreach pour parcourir le tableau des todos  -->
        <?php foreach($todos as $todo) : ?>
            
            <div class="todo">
                <p><?= $todo["content"] ?></p>
                <button>x</button>
            </div>

        <?php endforeach ?>
    <?php endif ?>

</div>


<?php

include "partials/footer.php";

?>


