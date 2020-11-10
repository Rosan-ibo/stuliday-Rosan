<?php
require 'includes/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="description" content="">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?>
    </title>
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/lib/all.css">
</head>

<body>
    <header>
        <nav class="navbar has-background-link " role="navigation" aria-label="main navigation">
            <div class="navbar-brand">
                <a class="navbar-item" href="index.php">
                    <img src="assets/img/stuliday-logo-dark.png" width=50 height=50>
                </a>

                <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                    data-target="navbarBasicExample">
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                    <span aria-hidden="true"></span>
                </a>
            </div>

            <div id="navbarBasicExample" class="navbar-menu">
                <div class="navbar-start">
                    <a class="navbar-item is-size-4" href="index.php">
                        Home
                    </a>

                    <a class="navbar-item is-size-4" href="adverts.php">
                        Places to stay
                    </a>

                    <!-- USELESS -->

                </div>

                <div class="navbar-end">
                    <?php
                if (!empty($_SESSION)) {
                    ?>

                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link">
                            <?php
                        echo $_SESSION['fullname']; ?>
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="profile.php">
                                Profile page
                            </a>
                            <a class="navbar-item" href="addadverts.php">
                                Create a new ad
                            </a>
                            <hr class="navbar-divider">
                            <a class="navbar-item" href="?logout">
                                Disconnect
                            </a>
                        </div>
                    </div>

                    <?php
                } else {
                    ?>

                    <div class="navbar-item">
                        <div class="buttons">
                            <a class="button " href="signin.php">
                                <strong>Sign in</strong>
                            </a>
                        </div>
                    </div>

                    <?php
                }
            ?>
                </div>
            </div>
        </nav>
    </header>