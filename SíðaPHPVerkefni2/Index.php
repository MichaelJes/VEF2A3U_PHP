<?php
$errors = [];
$missing = [];
// check if the form has been submitted
if (isset($_POST['submit'])) {
  
  /* to prevent an attacker from injecting other variables in
     the $_POST array in an attempt to overwrite your default values. By processing only those variables
     that you expect, your form is much more secure.
  */
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
                        <label for="name">Your Name</label>
                        <input name="name" id="name" type="text" placeholder="Your Name">

                        <label for="email">Your Email</label>
                        <input name="email" id="email" type="email" placeholder="Your Email">

                        <label for="password">Your Password</label>
                        <input name="password" id="password" type="password" placeholder="Your Password">

                        <button name="submit" type="submit"  class="pure-button">Sign Up</button>
                        <?php if ($missing) {
                        print("Það er villa í forminu þínu");
                        } ?>
                    </fieldset>
                </form>
            <pre>
            <?php if ($_POST) { print_r($_POST); } ?>
            </pre>
            </div>
            
            <div class="l-box-lrg pure-u-1 pure-u-md-1-2">
            <form class="pure-form pure-form-stacked">
                <fieldset>
                    <label for="Login">Please sign in here</label>
                    <input type="email" placeholder="Email">
                    <input type="password" placeholder="Password">
                    <button type="submit"  name="submit" value="Login" class="pure-button pure-button-primary">Sign in</button>
                </fieldset>
            </form>

            </div>
        </div>
    </div>
<?php require './Includes/Footer.php'; ?>
</div>
</body>
</html>
