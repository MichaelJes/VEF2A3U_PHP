<?php include './includes/session_timeout.php'; ?>
<?php

// run this script only if the logout button has been clicked
if (isset($_POST['logout'])) {
 // empty the $_SESSION array
 $_SESSION = [];
 // invalidate the session cookie
 if (isset($_COOKIE[session_name()])) {
 setcookie(session_name(), '', time()-86400, '/');
 }
 // end session and redirect
 session_destroy();
 header('Location: http://tsuts.tskoli.is/2t/3108982369/PHP/index.php');
 exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>Secret menu</title>
</head>

<body>
<h1>Restricted area Only for Admins</h1>
<p><a href="secretpage.php">Another secret page</a> </p>
<form method="post" action="">
 <input name="logout" type="submit" value="Log out">
</form>
</body>
</html>
