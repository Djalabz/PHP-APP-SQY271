<?php

include "partials/header.php";
include "partials/check-session.php";


// On va utiliser cURL afin de récupérer des données depuis l'API fake store API : https://fakestoreapi.com/docs

if (isset($_GET["id"])) {

    // 1 - On intialise curl 
    $ch = curl_init();

    // On récupère l'id du produit depuis les paramètres de l'URL avec $_GET
    $id = $_GET["id"];

    // 2 - On définit l'url cible pour notre requete
    $url = "https://fakestoreapi.com/products/$id";

    // 3 - On établit les options pour cURL : l'url cible 
    // et le fait que la réponse contiennent les données attendues et pas juste un booléen
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    //. 4 - On vient ensuite éxecuter la requete 
    $resp = curl_exec($ch);

    // Si il y a une erreur on l'affiche sinon on procède à la suite
    if ($e = curl_error($ch)) {
        // On affiche l'erreur si il y en a une 
        // var_dump($e);
    } else {
        // 5 - On décode la réponse depuis json afin de la rendre exploitable en PHP
        $product = json_decode($resp, true);
        $_SESSION["current-product"] = $product;

        // 6 - Enfin on ferme la connexion
        curl_close($ch);
    }
} else {
    header("Location: shop.php");
    exit();
}


// On vient regarder si il y a un status de précisé dans l'URL (success par exemple)
// Si oui on affiche un message de confirmation
if (isset($_GET["status"]) && $_GET["status"] == "success") {
    $message = "Votre item a été ajouté au panier avec succès !";
}


?>


<!-- On affiche un message de onfirmation si un item a bien été ajouté au panier -->
<?php if (isset($message)) : ?>
    <p class="text-center font-bold mt-4 text-pretty text-green-700"><?= $message ?></p>
<?php endif ?>


<?php if (isset($product)) : ?>

    <section>
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">

            <div>
                <div class="max-w-prose md:max-w-none">
                <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                        <?= $product["title"] ?>
                </h2>

                <p class="mt-4 text-pretty text-gray-700">
                    <?= $product["description"] ?>
                </p>

                <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                        <?= $product["price"] . "€" ?>
                </h2>

                <a href="add-to-cart.php?id=<?= $product["id"] ?>" class="mt-4 flex w-48 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ajouter au panier</a>

                </div>
            </div>

            <div>
                <img src="<?= $product["image"] ?>" class="rounded" alt="">
            </div>
            </div>
        </div>
    </section>

<?php endif ?>


<?php

include "partials/footer.php";

?>