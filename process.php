<?php

    $title = 'Processing - Le Chouette Coin';
    require 'includes/header.php';

    if ('POST' != $_SERVER['REQUEST_METHOD']) {
        echo "<div class='alert alert-danger'> La page à laquelle vous tentez d'accéder n'existe pas </div>";
    } elseif (isset($_POST['adverts_submit'])) {
        if (!empty($_POST['adverts_name']) && !empty($_POST['adverts_content']) && !empty($_POST['adverts_price']) && !empty($_POST['adverts_city']) && !empty(['adverts_address']) && !empty(['adverts_category'])) {
            $adverts_name = strip_tags($_POST['adverts_name']);
            $content = strip_tags($_POST['adverts_content']);
            $price = intval(strip_tags($_POST['adverts_price']));
            $city = strip_tags($_POST['adverts_city']);
            $category = strip_tags($_POST['adverts_category']);
            $address = strip_tags($_POST['adverts_address']);
            $author = $_SESSION['id'];
            adAdverts($adverts_name, $content, $price, $city, $address, $category, $author);
        }
    } elseif (isset($_POST['advert_edit'])) {
        // Vérification back-end du formulaire d'édition
        if (!empty($_POST['advert_name']) && !empty($_POST['advert_description']) && !empty($_POST['advert_price']) && !empty($_POST['advert_city']) && !empty(['advert_category'])) {
            // Définition des variables
            $name = strip_tags($_POST['advert_name']);
            $description = strip_tags($_POST['advert_description']);
            $price = intval(strip_tags($_POST['advert_price']));
            $city = strip_tags($_POST['advert_city']);
            $category = strip_tags($_POST['advert_category']);
            // Assigne la variable user_id à partir du token de session
            $user_id = $_SESSION['id'];
            $id = strip_tags($_POST['ad_id']);

            modifProduits($name, $description, $price, $city, $category, $id, $user_id);
        }
    } elseif (isset($_POST['advert_delete'])) {
        $advert = $_POST['advert_id'];
        $user_id = $_SESSION['id'];

        suppProduits($user_id, $advert);
    }

    require 'includes/footer.php';
