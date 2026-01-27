<?php 

include "partials/header.php";
include "partials/check-session.php";
include "config/cURL.php";


// Todo sur cette page : 


// 1 - Ajouter pour chaque article un bouton Ajouter au panier 
// 2 - Sur la page article limiter la description
// 3 - Sur la page de panier prendre en compte les quantités
// cad que si on a ajouté 2 fois le meme item au panier 
// -> Il ne s'affiche qu'une fois seule la quantité change  

// !! : si vous utilisez curl placez le contenu de la requete en curl 
// dans un fichier séparé (cURL.php) qui sera dans le dossier config
// On pourra faire comme avec $db et importer la réponse du cURL dans les 
// fichiers adequats 

$products = connectToAPI("https://fakestoreapi.com/products");


?>

<!-- On va afficher la liste des produits recup depuis la fake store api 
On récupère un tableau, lui meme constitué d'objets (ou tableaux associatifs en php) -->

<div class="bg-white">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900">Bienvenue sur le Shop</h2>

    <!-- Affichage du message de succès si on a ajouté un produitr dans le panier  -->
    <?php if (isset($_GET["status"])) :  ?> 

        <h3 class="text-green-700 font-bold mt-6">Votre article a bien été ajouté au panier !</h3>

    <?php endif ?>

    <!-- Si on a bien $product de défini ... -->
    <?php if (isset($products)) :  ?>

    <!-- A partir d'ici on affiche la liste des items du shop si on la reçoit bien -->
    <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

        <?php foreach($products as $product) : ?>

        <!-- Code pour un item de la liste du shop -->
        <div class="group relative flex flex-col justify-between items-center">
            <a href="shop-item.php?id=<?= $product["id"] ?>">
                <img src="<?= $product["image"] ?>" alt="Front of men&#039;s Basic Tee in black." class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
                <div class="mt-4 flex justify-between">
                    <h3 class="text-sm text-gray-700">
                        
                        <!-- <span aria-hidden="true" class="absolute inset-0"></span> -->
                        <?= $product["title"] ?>
                    </h3>
                    <div>
                        <p class="mt-1 text-sm text-gray-500"><?= substr($product["description"], 0, 100) ?> ...</p>
                    </div>
                    <p class="text-sm font-medium text-gray-900"><?= $product["price"] ?> €</p>
                </div>
            </a>
            <a href="add-to-cart.php?id=<?= $product["id"] ?>" class="mt-4 flex w-48 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ajouter au panier</a>
        </div>

        <?php endforeach ?>

    </div>

    
    <?php endif ?>

  </div>
</div>



<?php 

include "partials/footer.php";

?>