<?php

require 'includes/config.php';

// SIGN UP FUNCTION
function signup($email, $pass, $repass, $fullname)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $res = $conn->query($sql);
        $count = $res->fetchColumn();
        if (!$count) {
            if ($pass === $repass) {
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sth = $conn->prepare('INSERT INTO users (email, password, fullname) VALUES (:email, :password, :fullname)');
                $sth->bindValue(':email', $email);
                $sth->bindValue(':password', $pass);
                $sth->bindValue(':fullname', $fullname);
                $sth->execute();
                echo '<div class="notification is-success is-light">User has been registered !</div>';
            } else {
                echo '<div class="notification is-danger is-light">Passwords doesn\t match !</div>';
            }
        } elseif ($count > 0) {
            echo '<div class="notification is-danger is-light">This email already exists !</div>';
        }
    } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }
}

// LOGIN FUNCTION
function login($email, $password)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email}'";
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $db_password = $user['password'];
            if (password_verify($password, $db_password)) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['fullname'] = $user['fullname'];
                echo '<div class="notification is-success is-light">You\'re logged !</div>';
                header('Location:index.php');
            } else {
                echo '<div class="notification is-danger is-light">Wrong password !</div>';
                unset($_POST);
            }
        } else {
            echo '<div class="notification is-danger is-light">Unknown email !</div>';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error : '.$e->getMessage();
    }
}

function adAdverts($adverts_name, $content, $price, $city, $address, $category, $author)
{
    global $conn;
    if (is_int($price) && $price > 0 && $price < 1000000) {
        try {
            $sth = $conn->prepare('INSERT INTO adverts (adverts_name,content,price,city,category_id,address,author) VALUES (:adverts_name, :content, :price, :city, :category_id, :address,:author)');
            $sth->bindValue(':adverts_name', $adverts_name, PDO::PARAM_STR);
            $sth->bindValue(':content', $content, PDO::PARAM_STR);
            $sth->bindValue(':price', $price, PDO::PARAM_INT);
            $sth->bindValue(':city', $city, PDO::PARAM_STR);
            $sth->bindValue(':category_id', $category, PDO::PARAM_INT);
            $sth->bindValue(':address', $address, PDO::PARAM_STR);
            $sth->bindValue(':author', $author, PDO::PARAM_INT);
            if ($sth->execute()) {
                echo "<div class='alert alert-success'> Votre article a été ajouté à la base de données </div>";
                header('Location: advert.php?id='.$conn->lastInsertId());
            }
        } catch (PDOException $e) {
            echo 'Error: '.$e->getMessage();
        }
    }
}

function displayAds()
{
    global $conn;
    $sth = $conn->prepare('SELECT a.*,c.categories_name,u.fullname FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id LEFT JOIN users AS u ON a.author = u.id');
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>

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
}

function displayAd($id)
{
    global $conn;
    $sth = $conn->prepare("SELECT a.*,c.categories_name,u.fullname FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id LEFT JOIN users AS u ON a.author = u.id WHERE a.ad_id = {$id}");
    $sth->execute();

    $advert = $sth->fetch(PDO::FETCH_ASSOC); ?>
<div class="container">
    <div class="box">
        <div class="media">
            <div class="media-content">
                <h1 class="title is-4"><?php echo $advert['adverts_name']; ?>
                </h1>
                <p>Description: <?php echo $advert['content']; ?>
                </p>
                <p>City: <?php echo $advert['city']; ?>
                </p>
                <button class="button is-link">Price: <?php echo $advert['price']; ?> €
                </button>
            </div>
            <div class="media-right">
                <figure class="image is-128x128">
                    <img src="assets/img/exemple-img" alt="Image">
                </figure>
            </div>
        </div>
    </div>
</div>
<?php
}

function displayAdsByUser($userId)
{
    global $conn;
    $sth = $conn->prepare("SELECT a.*,c.categories_name FROM adverts AS a LEFT JOIN categories AS c ON a.category_id = c.categories_id WHERE a.author = {$userId}");
    $sth->execute();

    $adverts = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($adverts as $advert) {
        ?>
<tr>
    <td><?php echo $advert['adverts_name']; ?>
    </td>
    <td><?php echo $advert['content']; ?>
    </td>
    <td><?php echo $advert['price']; ?> €
    </td>
    <td><?php echo $advert['city']; ?>
    </td>
    <td><?php echo $advert['categories_name']; ?>
    </td>
    <td> <a href="advert.php?id=<?php echo $advert['ad_id']; ?>"
            class=""><i class="fas fa-eye"></i></a>
    </td>
    <td> <a href="editadvert.php?id=<?php echo $advert['ad_id']; ?>"
            class=""><i class="fas fa-pen"></i></a>
    </td>
    <td>
        <form action="process.php" method="post">
            <input type="hidden" name="advert_id"
                value="<?php echo $advert['ad_id']; ?>">
            <input type="submit" name="advert_delete" value=""></input>
        </form>
    </td>
</tr>
<?php
    }
}
function suppProduits($user_id, $advert)
{
    global $conn;

    try {
        $sth = $conn->prepare('DELETE FROM adverts WHERE ad_id = :advert AND author =:user_id');
        $sth->bindValue(':advert', $advert);
        $sth->bindValue(':user_id', $user_id);
        if ($sth->execute()) {
            header('Location:profile.php?s');
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}
