<?php

include "partials/header.php";
include "partials/check-session.php";

// On va utiliser cURL afin de récupérer des données depuis l'API fake store API : https://fakestoreapi.com/docs

if (isset($_GET["id"])) {

    // 1 - On intialise curl 
    $ch = curl_init();

    // 2 - On définit l'url cible pour notre requete
    $url = `https://fakestoreapi.com/products/${$_GET["id"]}`;

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
} else {
    header("Location: shop.php");
    exit();
}



?>

<section>
  <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:items-center md:gap-8">
      <div>
        <div class="max-w-prose md:max-w-none">
          <h2 class="text-2xl font-semibold text-gray-900 sm:text-3xl">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
          </h2>

          <p class="mt-4 text-pretty text-gray-700">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur doloremque saepe
            architecto maiores repudiandae amet perferendis repellendus, reprehenderit voluptas
            sequi.
          </p>
        </div>
      </div>

      <div>
        <img src="https://images.unsplash.com/photo-1731690415686-e68f78e2b5bd?auto=format&amp;fit=crop&amp;q=80&amp;w=1160" class="rounded" alt="">
      </div>
    </div>
  </div>
</section>


<?php

include "partials/footer.php";

?>