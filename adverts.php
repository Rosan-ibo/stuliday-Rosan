<?php

$title = 'Adverts - Styliday';
require 'includes/header.php';

$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();

if (isset($_POST['search_form'])) {
    $category = intval(strip_tags($_POST['adverts_category']));
    $search_text = strip_tags($_POST['search_text']);

    $sql2 = "SELECT * FROM adverts WHERE category_id LIKE '%{$category}%' AND adverts_name LIKE '%{$search_text}%'";
    $res2 = $conn->query($sql2);
    $search = $res2->fetchAll();
}
?>
<form action="adverts.php" method="post">
    <div class="container ">
        <div class="columns  ">
            <div class="column is-half">
                <div class="field">
                    <br>
                    <div class="control ">
                        <input class="input" type="text" placeholder="search" name="search_text">
                    </div>
                </div>
                <div class="field">
                    <div class="control">
                        <div class="select">
                            <select name="adverts_category">
                                <?php foreach ($categories as $category) { ?>
                                <option
                                    value="<?php echo $category['categories_id']; ?>">
                                    <?php echo $category['categories_name']; ?>
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <input type="submit" value="search" name="search_form" class="button is-primary">
                <?php if (isset($search)) {
    echo '<a href="adverts.php" class="btn btn-danger mx-2 mb-2">Reset</a>';
} ?>
            </div>
        </div>
    </div>
</form>



<div class="container is-flex-direction-row	">
    <?php
        if (isset($search)) {
            foreach ($search as $advert) {?>
    <div class="box ">
        <div class="media">
            <div class="media-content">
                <p class="title is-4"><?php echo $advert['adverts_name']; ?>
                </p>
                <p class="subtitle is-6">City: <?php echo $advert['city']; ?>
                </p>

                <p><?php echo $advert['content']; ?>
                </p>

                <ul>
                    <li class="subtitle is-6">Price: <?php echo $advert['price']; ?>€
                    </li>
                    <li class="subtitle is-6">Address: <?php echo $advert['address']; ?>
                    </li>
                </ul>
                <a href="advert.php?id=<?php echo $advert['ad_id']; ?>"
                    class="card-link btn btn-primary">Adverts</a>

            </div>
            <div class="media-right">
                <figure class="image is-128x128">
                    <img src="assets/img/exemple-img" alt="Image">
                </figure>
            </div>
        </div>
    </div>
    <?php
            }
        } else {
            displayAds();
        }
        ?>


</div>

<?php
require 'includes/footer.php';
