<?php

include "partials/header.php";

?>


<h1>Sondage avec la méthode POST</h1>

<!-- h2+input*2+(h3+(input*3))*2+(h3+input*2)*2+input -->

<form action="" method="">

    <input placeholder="Votre prénom ..." type="text" name="prenom">
    <input placeholder="Votre nom ..." type="text" name="nom">

    <h3>Quel est votre language favori ?</h3>

    <input value="html" name="language" type="radio">HTML
    <input value="css" name="language" type="radio">CSS
    <input value="php" name="language" type="radio">PHP

    <h3>Quel est votre GAFA favori ?</h3>

    <input value="facebook" name="gafa" type="radio">Facebook/Meta
    <input value="apple" name="gafa" type="radio">Apple
    <input value="amazon" name="gafa" type="radio">Amazon
    <input value="google" name="gafa" type="radio">Google

    <h3>Plutot front ou backend ?</h3>

    <input value="frontend" name="front" type="radio">Frontend
    <input value="backend" name="front" type="radio" >Backend

    <h3>L'IA vous fait elle peur ?</h3>

    <input name="ia" value="yes" type="radio">Oui
    <input name="ia" value="no" type="radio">Non

    <input value="Soumettre" type="submit">

</form>

<div class="results">

    <h3>Vous etes ...</h3>
    <h3>Votre language favori est ...</h3>
    <h3>Votre GAFA favori est ...</h3>
    <h3>Plutot ...</h3>
    <h3>Peur de l'IA ?</h3>

</div>


<?php

include "partials/footer.php";

?>