<?php 
include './includes/session_timeout.php'; 
require_once './includes/connection.php';
$sql = 'SELECT imagename, imagetext FROM images';

require 'File/Image.php';
$dbUsers = new Image($conn);

require 'File/Upload.php';


?>
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
 
 // move the file to the upload folder and rename it
     try {
        $namo = $_FILES['image']['name'][0]; 
        // búum til upload object til notkunar.  Sendum argument eða slóðina að upload möppunni sem á að geyma skrá
        $loader = new Upload($destination);
        // köllum á og notum move() fallið sem færir skrá í upload möppu, þurfum að gera þetta strax.
        $loader->upload();
        
        // köllum á getMessage til að fá skilaboð (error or not).
        


        $result = $loader->getMessages();


        $place = substr($destination.$namo,29,40);
        $Validali = $dbUsers->newImageInfo($namo,$place,substr($namo,0,-4),1); 
        if($Validali) {
            print($place);
        }



    } catch (Exception $e) {
        echo $e->getMessage();  # ef við náum ekki að nota Upload class
    }
 }
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>The file upload Area</title>
</head>

<body>
    <?php
        $resulto = $dbUsers->imagelist();
        if ($resulto) {
            echo "Yah";
            ?>
            <pre>
            <?php
            //print_r($resulto);
            ?>
            </pre>
            <?php
        }
        else
        {
            echo "No";
        }
        if (isset($_GET['image'])) {
         $mainImage = $_GET['image'];
        } else {
         $mainImage = $resulto[3][0];
        }
        $PathwayToFile = $resulto[3][1];
        // get the dimensions of the main image
        $imageSize = getimagesize($mainImage)[3];

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

   <main>
        <h2>Images of Japan</h2>

      <p id="picCount">Displaying 1 to 6 of 8</p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
                    <!--This row needs to be repeated-->
                    <?php
                    $last = count($resulto) - 1;
                    foreach ($resulto as $i => $row)
                    {
                        $isFirst = ($i == 0);
                        $isLast = ($i == $last);
                    ?>
                    <td><a href="<?= $_SERVER['PHP_SELF']; ?>?image=<?= $resulto[$i][1]; ?>"><img src="<?= $resulto[$i][1]; ?>"" alt="<?= $resulto[$i][0]; ?>" width="80" height="54"></a></td>
                    <?php } ?>
                </tr>
                <!-- Navigation link needs to go here -->
            </table>
            <figure id="main_image">
                <img src="<?= $mainImage; ?>" alt="<?= $mainImage; ?>"<?= $imageSize; ?>>
                <figcaption><?= $mainImage; ?></figcaption>
            </figure>
        </div>
    </main>
</body>
</html>
