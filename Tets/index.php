<?php
$errors = [];
$missing = [];
// check if the form has been submitted
if (isset($_POST['send'])) {
  
  /* to prevent an attacker from injecting other variables in
     the $_POST array in an attempt to overwrite your default values. By processing only those variables
     that you expect, your form is much more secure.
  */
    // list expected fields
    $expected = ['name', 'email', 'comments'];
    $required = ['name', 'comments', 'email'];
    // sækjum skrá sem vinnur með input gögnin úr formi, $_POST[]
    require './process.php';
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Sýnidæmi</title>
</head>

<body>
<div id="wrapper">
    <main>
        <h2>PHP SOLUTION 5-2</h2>
        
        <?php if ($missing || $errors) { ?>
            <p class="warning">Please fix the item(s) indicated.</p>
        <?php } ?>
        <form method="post" action="">
            <p>
                <label for="name">Name:
                    <?php if ($missing && in_array('name', $missing)) { ?>
                        <span class="warning">Please enter your name</span>
                    <?php } ?>
                </label>
                <input name="name" id="name" type="text" required>
            </p>
            <p>
                <label for="email">Email:
                    <?php if ($missing && in_array('email', $missing)) { ?>
                        <span class="warning">Please enter your email address</span>
                    <?php } ?>
                </label>
                <input name="email" id="email" type="email">
            </p>
            <p>
                <label for="comments">Comments:
                    <?php if ($missing && in_array('comments', $missing)) { ?>
                        <span class="warning">Please enter your comments</span>
                    <?php } ?>
                </label>
                <textarea name="comments" id="comments"></textarea>
            </p>
            <p>
                <input name="send" type="submit" value="Send message">
            </p>
        </form>
        <pre>
        <?php if ($_POST) { print_r($_POST); } ?>
        </pre>
    </main>

</div>
</body>
</html>
