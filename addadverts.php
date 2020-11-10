<?php

$title = 'Addadverts - Stuliday';
require 'includes/header.php';

$sql = 'SELECT * FROM categories';
$res = $conn->query($sql);
$categories = $res->fetchAll();
?>


<div class="container">

    <div class="column">
        <form action="process.php" method="POST">
            <div class="field">
                <label class="label">Advert name</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Adverts name" name="adverts_name">
                </div>
            </div>
            <div class="field">
                <label class="label">Advert description</label>
                <div class="control">
                    <textarea class="textarea" placeholder="Advert description" name="adverts_content"></textarea>
                </div>
            </div>
            <div class="field">
                <label class="label">Price</label>
                <div class="control">
                    <input class="input" type="number" max="999999" placeholder="Price" name="adverts_price">
                </div>
            </div>
            <div class="field">
                <label class="label">City</label>
                <div class="control">
                    <input class="input" type="text" placeholder="City" name="adverts_city">
                </div>
            </div>
            <div class="field">
                <label class="label">Address</label>
                <div class="control">
                    <input class="input" type="text" placeholder="Address" name="adverts_address">
                </div>
            </div>
            <div class="field">
                <label class="label">Subject</label>
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
            <div class="field is-grouped">
                <div class="control">
                    <input type="submit" value="Submit" name="adverts_submit" class="button is-primary">
                </div>
            </div>
        </form>
    </div>
</div>


<?php
require 'includes/footer.php';
