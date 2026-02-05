<?php

include "partials/header.php";
include "partials/check-session.php";
include "config/cURL.php";
include "config/db.php";


// On va utiliser cURL afin de récupérer des données depuis l'API fake store API : https://fakestoreapi.com/docs
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $product = connectToAPI("https://fakestoreapi.com/products/$id");
} else {
    header("Location: shop.php");
    exit();
}

// On vient regarder si il y a un status de précisé dans l'URL (success par exemple)
// Si oui on affiche un message de confirmation
if (isset($_GET["status"]) && $_GET["status"] == "success") {
    $message = "Votre item a été ajouté au panier avec succès !";
}

//// FONCTIONNALITE DES NOTES

// Vérification du fait qu'une note ait déjà été enregistré en BDD
$sqlCheck = "SELECT * FROM notes WHERE id_user = ? AND id_product = ?";
$stmt = $db->prepare($sqlCheck);
$stmt->execute([$_SESSION["id"], $product["id"]]);
$result = $stmt->fetch();

// Ajout des notes en BDD 
if (isset($_GET["note"])) {
    // Si on a dèjà une note pour le produit alors on vient écraser celle-ci
    if ($result) {
        // Update
        $sql = "UPDATE notes SET points = ? WHERE id_user = ? AND id_product = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_GET["note"], $_SESSION["id"], $product["id"]]);
    // Si on a pas dfe notes pour le produit on en insère une 
    } else {
        // Insert
        $sql = "INSERT INTO notes(points, id_user, id_product) VALUES(?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$_GET["note"], $_SESSION["id"], $product["id"]]);
    }
// Si aucune note n'est précisée dans l'URL on redirige vers la page du produit en affichant la note depuis la BDD
} else {
    if ($result) {
        header("Location: shop-item.php?id=" . $product["id"] . "&note=" . $result["points"]);
        exit();
    }
}

// Affichage de la moyenne des notes
$sqlAvg = "SELECT AVG(points) FROM notes WHERE id_product = ?"; 
$stmt = $db->prepare($sqlAvg);
$stmt->execute([$product["id"]]);
$avg = $stmt->fetch();


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

                    <!-- Container afin d'appliquer du flex pour nos étoiles  -->
                    <div class="flex mt-4">
                        <!-- Boucle for afin d'afficher les boutons étoiles  -->
                        <?php for ($i=1; $i <= 5; $i++) : ?>

                            <!-- Condition : si notre variable i de la boucle est inf ou égale à la note transmise alors on affiche l'étoile en jaune -->
                            <?php if (isset($_GET["note"]) && ($i <= $_GET["note"]) ) : ?>

                                <a href="shop-item.php?id=<?= $product["id"] ?>&note=<?= $i ?>">
                                    <svg class="w-5 h-5 fill-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/></svg>
                                </a>

                            <?php else : ?>

                                <a href="shop-item.php?id=<?= $product["id"] ?>&note=<?= $i ?>">
                                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"/></svg>
                                </a>

                            <?php endif ?>

                        <?php endfor ?>

                    </div>

                    <div class="mt-4">
                       <h2>Note moyenne des utilisateurs : <?= round(floatval($avg["AVG(points)"]), 2) ?> / 5</h2> 
                    </div>

                    <p class="mt-4 text-pretty text-gray-700">
                        <?= $product["description"] ?>
                    </p>

                    <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
                            <?= $product["price"] . "€" ?>
                    </h2>

                    <a href="add-to-cart.php?id=<?= $product["id"] ?>" class="mt-4 flex w-48 justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Ajouter au panier
                    </a>

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