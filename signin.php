<?php
$title = 'Login - Stuliday';
require 'includes/header.php';

 // SIGN UP
if (isset($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['password1_signup'])) {
    $pass_su = htmlspecialchars($_POST['password1_signup']);
    $repass_su = htmlspecialchars($_POST['password2_signup']);
    $email_su = htmlspecialchars($_POST['email_signup']);
    $fullname_su = htmlspecialchars($_POST['fullname_signup']);
    signup($email_su, $pass_su, $repass_su, $fullname_su); //SIGN UP function
 //LOGIN
} elseif (isset($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) { //have all the fields been completed ?
    $pass_login = htmlspecialchars($_POST['password_login']);
    $email_login = htmlspecialchars($_POST['email_login']);
    login($email_login, $pass_login); // LOGIN function
 //MISS YOUR CHANCE !
} else {
    if (isset($_POST)) {
        unset($_POST);
    }
}
?>
​
<div class="container">
    <div class="columns">

        <!-- SIGN UP FORM -->
        <div class="column">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">

                <div class="field">
                    <label class="label">Fullname</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input " type="text" placeholder="Your fullname" name="fullname_signup">
                        <span class="icon is-small is-left">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                </div>


                <!-- EMAIL FIELD -->
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Type your e-mail" value="" name="email_signup">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Choose a password" value=""
                            name="password1_signup">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <!-- RE PASSWORD FIELD -->
                <div class="field">
                    <label class="label">Re-enter your password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Re-enter your password" value=""
                            name="password2_signup">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <!-- CHECKBOX FIELD -->
                <div class="field">
                    <div class="control">
                        <label class="checkbox">
                            <input type="checkbox">
                            I agree to the <a href="#">terms and conditions</a>
                        </label>
                    </div>
                </div>

                <!-- SUBMIT BUTTON FIELD​ -->
                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Sign up !" name="submit_signup" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>

        <!-- SIGN IN FORM -->
        <div class="column">
            <form
                action="<?php $_SERVER['REQUEST_URI']; ?>"
                method="post">



                <!-- EMAIL FIELD -->
                <div class="field">
                    <label class="label">Email</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="email" placeholder="Type your e-mail" value="" name="email_login">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <!-- PASSWORD FIELD -->
                <div class="field">
                    <label class="label">Password</label>
                    <div class="control has-icons-left has-icons-right">
                        <input class="input" type="password" placeholder="Choose a password" value=""
                            name="password_login">
                        <span class="icon is-small is-left">
                            <i class="fas fa-envelope"></i>
                        </span>
                    </div>
                </div>

                <!-- SUBMIT BUTTON FIELD​ -->
                <div class="field is-grouped">
                    <div class="control">
                        <input type="submit" value="Sign in !" name="submit_login" class="button is-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require 'includes/footer.php';
