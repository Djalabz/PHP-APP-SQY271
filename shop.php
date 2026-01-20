<?php 

include "partials/header.php";
include "partials/check-session.php";

// On va utiliser cURL afin de récupérer des données depuis l'API fake store API : https://fakestoreapi.com/docs

// 1 - On intialise curl 
$ch = curl_init();

// 2 - On définit l'url cible pour notre requete
$url = 'https://fakestoreapi.com/products';

// 3 - On établit les options pour cURL : l'url cible 
// et le fait que la réponse contiennent les données attendues et pas juste un booléen
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//. 4 - On vient ensuite éxecuter la requete 
$resp = curl_exec($ch);

// Si il y a une erreur on l'affiche sinon on procède à la suite
if ($e = curl_error($ch)) {
    // On affiche l'erreur si il y en a une 
    var_dump($e);
} else {
    // 5 - On décode la réponse depuis json afin de la rendre exploitable en PHP
    $products = json_decode($resp, true);
    // var_dump($products);

    // 6 - Enfin on ferme la connexion
    curl_close($ch);
}

?>

<h1>Mon eShop</h1>

<!-- On va afficher la liste des produits recup depuis la fake store api 
On récupère un tableau, lui meme constitué d'objets (ou tableaux associatifs en php) -->

<!-- Si on a bien $product de défini ... -->
<?php if (isset($products)) :  ?>

    <div class="products-grid">

        <!-- ... alors on vient boucler dans ce tableau pour afficher chaque produit -->
        <?php foreach($products as $product) : ?>
            <div class="product-card">
                <h2><?= $product["title"] ?></h2>
                <img src="<?= $product["image"] ?>">
                <h4><?= $product["description"] ?></h4>
                <h2><?= $product["price"] ?> €</h2>
            </div>

        <?php endforeach ?>

    </div>

<?php endif ?>

<?php 

include "partials/footer.php";

?>