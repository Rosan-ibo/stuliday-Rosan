<?php
require 'includes/header.php';
global $conn;
if (isset($_SESSION['id'])) {
    $requser = $conn->prepare('SELECT * FROM users WHERE id = ?');
    $requser->execute([$_SESSION['id']]);
    $user = $requser->fetch();
    if (isset($_POST['profile_change'])) {
        if (isset($_POST['newfullname']) && !empty($_POST['newfullname']) && $_POST['newfullname'] != $user['fullname']) {
            $newfullname = htmlspecialchars($_POST['newfullname']);
            $insertfullname = $conn->prepare('UPDATE users SET fullname = ? WHERE id = ?');
            $insertfullname->execute([$newfullname, $_SESSION['id']]);
            $_SESSION['fullname'] = $newfullname;
        }

        if (isset($_POST['newemail']) && !empty($_POST['newemail']) && $_POST['newemail'] != $user['email']) {
            $newemail = htmlspecialchars($_POST['newemail']);
            $insertemail = $conn->prepare('UPDATE users SET email = ? WHERE id = ?');
            $insertemail->execute([$newemail, $_SESSION['id']]);
            $_SESSION['email'] = $newemail;
        }

        if (isset($_POST['newpassword1']) && !empty($_POST['newpassword1']) && isset($_POST['newpassword2']) && !empty($_POST['newpassword2'])) {
            $password1 = htmlspecialchars($_POST['newpassword1']);
            $password2 = htmlspecialchars($_POST['newpassword2']);
            if ($password1 === $password2) {
                $password1 = password_hash($password1, PASSWORD_DEFAULT);
                $insertpassword = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
                $insertpassword->execute([$password1, $_SESSION['id']]);
            } else {
                $msg = '<div class="notification is-danger is-light">Passwords doesn\t match !</div>';
            }
        }
    }
}

?>
<div class="container">
    <div class='columns'>
        <div class='column'>
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">

                <label class='label'>Username</label>
                <input class='input' name='newfullname' placeholder='Your fullname' type='text'
                    value='<?php echo $user['fullname']; ?>'>

                <label class='label'>Email</label>
                <input class='input' placeholder='Your email' name='newemail' type='text'
                    value='<?php echo $user['email']; ?>'>

                <label class='label'>New password</label>
                <input class='input' placeholder='newpassword1' name='newpassword1' type='text' value='new password'>

                <label class='label'>New password</label>
                <input class='input' name='newpassword2' placeholder='newpassword2' type='text' value='new password'>

                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="change" name="profile_change" class="button is-primary">
                    </div>
                </div>
            </form>
            <?php if (isset($msg)) {
    echo $msg;
} ?>
            <?php

require 'includes/footer.php';
