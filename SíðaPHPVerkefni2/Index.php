﻿
<?php 
require_once './includes/connection.php';
require_once './includes/Users.php';
$dbUsers = new Users($conn);

$error = '';
if (isset($_POST['login'])) {
 session_start();
 $username = trim($_POST['username']);
 $password = trim($_POST['password']);

 // location of usernames and passwords
 $validate_status = $dbUsers->validateUser($username,$password);
 if ($validate_status) {
    $redirect = 'http://tsuts.tskoli.is/2t/3108982369/PHP/menu.php';
    require_once './includes/authenticate.php';
     exit();
 }

 //$userlist = './private/users.csv';
 // location to redirect on success
 //$redirect = 'http://tsuts.tskoli.is/2t/3108982369/PHP/menu.php';
 //require_once './includes/authenticate.php';
}
?>
<?php
$errors = [];
$missing = [];
// check if the form has been submitted
if (isset($_POST['register'])) {
  
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    require_once './includes/connection.php';
    require_once './includes/Users.php';
  /* to prevent an attacker from injecting other variables in
     the $_POST array in an attempt to overwrite your default values. By processing only those variables
     that you expect, your form is much more secure.
  */
    
    $status = $dbUsers->newUser($firstname,$lastname,$email,$username,$password);

    if ($status) {
        $success = "$username has been registered. You may now log in.";
    }else{
        $errors[] = "$username is already in use. Please choose another username.";
    }
    // list expected fields
    $expected = ['name', 'email', 'password'];
    $required = ['name', 'password', 'email'];
    // sækjum skrá sem vinnur með input gögnin úr formi, $_POST[]
    require './includes/process.php';
}



?>

<?php include './includes/title.php'; ?>
<?php include './includes/random_image.php'; ?>
<!doctype html>
<html lang="en">
<?php require './Includes/Head.php'; ?>
<title>Landing Page <?php if (isset($title))  echo "&#8212;{$title}"; ?></title>
<body>
<?php require './Includes/Menu.php'; ?>
<style>
.splash-container
{
    background-image: url(<?= $selectedImage; ?>);
}
</style>

<div class="splash-container">
    <div class="splash">
        <h1 class="splash-head">Juice</h1>
        <p class="splash-subhead">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>
        <p>
            <a href="http://purecss.io" class="pure-button pure-button-primary">Get Started</a>
        </p>
    </div>
</div>

<div class="content-wrapper">
    <div class="content">
        <h2 class="content-head is-center">Excepteur sint occaecat cupidatat.</h2>

        <div class="pure-g">
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">

                <h3 class="content-subhead">
                    <i class="fa fa-rocket"></i>
                    Get Started Quickly
                </h3>
                <p>
                    Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-mobile"></i>
                    Responsive Layouts
                </h3>
                <p>
                    Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-th-large"></i>
                    Modular
                </h3>
                <p>
                    Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                </p>
            </div>
            <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
                <h3 class="content-subhead">
                    <i class="fa fa-check-square-o"></i>
                    Plays Nice
                </h3>
                <p>
                    Phasellus eget enim eu lectus faucibus vestibulum. Suspendisse sodales pellentesque elementum.
                </p>
            </div>
        </div>
    </div>

    <div class="ribbon l-box-lrg pure-g">
        <div class="l-box-lrg is-center pure-u-1 pure-u-md-1-2 pure-u-lg-2-5">
            <img class="pure-img-responsive" alt="File Icons" width="300" src="img/common/file-icons.png">
        </div>
        <div class="pure-u-1 pure-u-md-1-2 pure-u-lg-3-5">

            <h2 class="content-head content-head-ribbon">Laboris nisi ut aliquip.</h2>

            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor.
            </p>
        </div>
    </div>

    <div class="content">
        <h2 class="content-head is-center">Dolore magna aliqua. Uis aute irure.</h2>

        <div class="pure-g">
            <div class="l-box-lrg pure-u-1 pure-u-md-1-2">
                <form class="pure-form pure-form-stacked" method="post" action="">
                    <fieldset>
                        <label for="username">Firstname:</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First name" required>

                        <label for="username">Lastname:</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last name" >

                        <label for="email">Email</label>
                        <input name="email" id="email" type="email" placeholder="Your Email" required>

                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" placeholder="Username" required>

                        <label for="password">Password</label>
                        <input name="password" id="password" type="password" placeholder="Your Password" required>

                        <button name="register" type="submit" id="register" value="Register"  class="pure-button">Sign Up</button>
                        <?php if ($missing) {
                        print("Það er villa í forminu þínu");
                        } ?>
                    </fieldset>
                </form>
            <pre>
            </pre>
            </div>

            
            <!--Login HERE!-->
            <div class="l-box-lrg pure-u-1 pure-u-md-1-2">
            <?php
            if ($error) {
             echo "<p>$error</p>";
            } elseif (isset($_GET['expired'])) { ?>
             <p>Your session has expired. Please log in again.</p>
            <?php } ?>
            <form class="pure-form pure-form-stacked" method="post" action="">
                <fieldset>
                    <label for="Login">Please sign in here</label>
                    <input type="text" name="username" id="username" placeholder="Username">
                    <input type="password" name="password" id="password" placeholder="Password">
                    <button type="submit"  name="login" value="Log in" class="pure-button pure-button-primary">Sign in</button>
                </fieldset>
            </form>

            </div>
        </div>
    </div>
<?php require './Includes/Footer.php'; ?>
</div>
</body>
</html>
