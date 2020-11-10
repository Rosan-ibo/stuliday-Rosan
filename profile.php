<?php
$title = 'Profile - Stuliday';
require 'includes/header.php';

    $userId = $_SESSION['id'];
    $requser = $conn->prepare('SELECT * from users WHERE id = ?');
    $requser->execute([$userId]);
    $userInfo = $requser->fetch();

    if (!empty($userId)) {
        ?>


<section class="hero">
    <div class="hero-body">
        <div class="container " align="center">
            <h2 class="title is-size-2">
                Profile
            </h2>
            <h2 class="subtitle is-size-4">
                Your account information:
            </h2>
        </div>
    </div>
</section>

<div class="content">
    <h4>Pseudo = <?php echo $userInfo['fullname']; ?>
    </h4>
    <br>
    <h4>Mail = <?php echo $userInfo['email']; ?>
    </h4>
    <h4> <a href="change_profile.php">Editer mon profil</a> </h4>
</div>

<div class="container" align="center">
    <h2 class="title is-size-2">
        Your ads:
    </h2>
    <table class="table ">
        <thead>
            <tr>
                <th scope="col">Nom du produit</th>
                <th scope="col">Description</th>
                <th scope="col">Prix</th>
                <th scope="col">Ville</th>
                <th scope="col">Categorie</th>
                <th scope="col" colspan=3>Fonctions</th>
            </tr>
        </thead>
        <tbody>
            <?php
        displayAdsByUser($userId); ?>
        </tbody>
    </table>
</div>
<?php
    }

require 'includes/footer.php';
