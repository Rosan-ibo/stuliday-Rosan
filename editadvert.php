<?php

$title = 'Editadverts - Stuliday';
require 'includes/header.php';

$id = $_GET['id'];
$sql1 = "SELECT a.*,c.* FROM adverts AS a INNER JOIN categories AS c ON a.category_id = c.categories_id WHERE a.ad_id = {$id}";
$sql2 = 'SELECT * FROM categories';
$res1 = $conn->query($sql1);
$advert = $res1->fetch(PDO::FETCH_ASSOC);
$res2 = $conn->query($sql2);
$categories = $res2->fetchAll();
?>

<div class="container">

    <div class="column">
        <form action="process.php" method="POST">
            <div class="field">
                <label class="label">Advert name</label>
                <div class="control">
                    <input class="input" type="text"
                        value='<?php echo $advert['adverts_name']; ?>'
                        name="advert_name">
                </div>
            </div>
            <div class="field">
                <label class="label">Advert description</label>
                <div class="control">
                    <textarea class="textarea"
                        value='<?php echo $advert['content']; ?>'
                        name="advert_content"></textarea>
                </div>
            </div>
            <div class="field">
                <label class="label">Price</label>
                <div class="control">
                    <input class="input" type="number" max="999999"
                        value='<?php echo $advert['price']; ?>'
                        name="advert_price">
                </div>
            </div>
            <div class="field">
                <label class="label">City</label>
                <div class="control">
                    <input class="input" type="text"
                        value='<?php echo $advert['city']; ?>'
                        name="advert_city">
                </div>
            </div>
            <div class="field">
                <label class="label">Address</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Address"
                        value='<?php echo $advert['address']; ?>'>
                </div>
            </div>
            <div class="field">
                <label class="label">Subject</label>
                <div class="control">
                    <div class="select">
                        <select name="advert_category">
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
            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Submit" name="advert_edit" class="button is-primary">
                </div>
            </div>
        </form>
    </div>
</div>
<?php
require 'includes/footer.php';
