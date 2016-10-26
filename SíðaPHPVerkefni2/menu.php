<?php include './includes/session_timeout.php'; ?>
<?php
use File\Upload;

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
 require_once 'File/Upload.php';
 // move the file to the upload folder and rename it
     try {
        // búum til upload object til notkunar.  Sendum argument eða slóðina að upload möppunni sem á að geyma skrá
        $loader = new Upload($destination);
        // köllum á og notum move() fallið sem færir skrá í upload möppu, þurfum að gera þetta strax.
        $loader->upload();
        // köllum á getMessage til að fá skilaboð (error or not).
        $result = $loader->getMessages();

    } catch (Exception $e) {
        echo $e->getMessage();  # ef við náum ekki að nota Upload class
    }
 }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>The file upload area</title>
</head>

<body>
    <?php
        // Keyrir bara ef það er búið að smella á submit 
        if (isset($result)) {
            echo '<ul>';
            //  Birta skilboðin úr messages array (Upload class).
            foreach ($result as $message) {
                echo "<li>$message</li>";
            }
            echo '</ul>';
        }
    ?>
<h1>Please Upload your files here!</h1>
<form action="" method="POST" enctype="multipart/form-data" id="uploadImage">
	 <p>
	 <label for="image">Upload image:</label>
	 <input type="file" name="image[]" id="image" multiple>
	 </p>
	 <p>
	 <input type="submit" name="upload" id="upload" value="Upload">
	 </p>
</form>

<p><a href="secretpage.php">Another secret page</a> </p>

<form method="post" action="">
	 	<input name="logout" type="submit" value="Log out">
</form>
<pre>
<?php
if (isset($_POST['upload'])) {
  print_r($_FILES);
}
?>
</pre>
</body>
</html>
