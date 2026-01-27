<?php 

include "partials/header.php";
include "partials/check-session.php";


// Todo sur cette page : 


// 1 -  Ajouter pour chaque article un bouton Ajouter au panier 
// 2 - Sur la page article limiter la description
// 3 - Sur la page de panier prendre en compte les quantités
// cad que si on a ajouté 2 fois le meme item au panier 
// -> Il ne s'affiche qu'une fois seule la quantité change  



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

<!-- On va afficher la liste des produits recup depuis la fake store api 
On récupère un tableau, lui meme constitué d'objets (ou tableaux associatifs en php) -->

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenue sur le Shop</h2>

    <!-- Si on a bien $product de défini ... -->
    <?php if (isset($products)) :  ?>

    <!-- A partir d'ici on affiche la liste des items du shop si on la reçoit bien -->
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

        <?php foreach($products as $product) : ?>

        <!-- Code pour un item de la liste du shop -->
        <div class="group relative">
            <img src="<?= $product["image"] ?>" alt="Front of men&#039;s Basic Tee in black." class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
            <div class="mt-4 flex justify-between">
                <div>
                <h3 class="text-sm text-gray-700">
                    <a href="shop-item.php?id=<?= $product["id"] ?>">
                    <span aria-hidden="true" class="absolute inset-0"></span>
                    <?= $product["title"] ?>
                    </a>
                </h3>
                <p class="mt-1 text-sm text-gray-500"><?= substr($product["description"], 0, 100) ?> ...</p>
                </div>
                <p class="text-sm font-medium text-gray-900"><?= $product["price"] ?> €</p>
            </div>
        </div>

        <?php endforeach ?>

    </div>

    
    <?php endif ?>

  </div>
</div>



<?php 

include "partials/footer.php";

?>