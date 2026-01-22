<?php 

    include "config/db.php";
    //include "partials/check-session.php";

    session_start();


    if (isset($_GET["id"])) {
        // On récupère l'id du produit à ajouter dans le panier
        $productId = $_SESSION["current-product"]["id"];

        // Vérifier si notre user possède déjà un panier en BDD dans la table cart...
        $sql = "SELECT * FROM cart WHERE id_user = ?";

        $stmt = $db->prepare($sql);
        $stmt->execute([$_SESSION["id"]]);  
        $res = $stmt->fetch();

        if ($res) {
            // Cas ou il y a déjà un cart d'enregistré 


        } else {
            // Cas ou il faut aussi créer le cart dans la BDD 
            // Requete pour créer un panier dans la table cart
            $sqlCreate = "INSERT INTO cart(content, id_user) VALUES(?, ?)";

            // On ajoute au tableau vide $content les infos du produiit désiré 
            $content = json_encode([$_SESSION["current-product"]]);

            $stmtCreate = $db->prepare($sqlCreate);
            $stmtCreate->execute([$content, $_SESSION["id"]]);  
            $resCreate = $stmtCreate->fetch();


            header("Location: shop-item.php?id=$productId&status=success");
        }


    } else {
        header("Location: shop.php");
        exit();
    }

?>