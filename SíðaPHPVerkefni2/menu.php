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
if (isset($_POST['upload'])) {
	// define the path to the upload folder
 $destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/3108982369/PHP/userImg/";
 // move the file to the upload folder and rename it
 move_uploaded_file($_FILES['image']['tmp_name'], $destination . $_FILES['image']['name']);
 }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>The file upload area</title>
</head>

<body>
<h1>Please Upload your files here!</h1>
<form action="" method="post" enctype="multipart/form-data" id="uploadImage">
	 <p>
	 <label for="image">Upload image:</label>
	 <input type="file" name="image" id="image">
	 </p>
	 <p>
	 <input type="submit" name="upload" id="upload" value="Upload">
	 </p>
</form>

<p><a href="secretpage.php">Another secret page</a> </p>
<form method="post" action="">
 <input name="logout" type="submit" value="Log out">
</form>
</body>
</html>
