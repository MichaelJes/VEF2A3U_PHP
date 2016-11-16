<?php 
include './includes/session_timeout.php'; 
define('COLS', 2);
// initialize variables for the horizontal looper
$pos = 0;
$firstRow = true;
// set maximum number of records
define('SHOWMAX', 6);
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
    <?php require './Includes/Head.php'; ?>
    <link rel="stylesheet" type="text/css" href="./css/Zeal.css">
    <title>Upload Page <?php if (isset($title))  echo "&#8212;{$title}"; ?></title>
</head>

<body>
<div class="pure-g">
    <div class="l-box pure-u-1 pure-u-md-1 pure-u-lg-1">
        <?php require './Includes/Menu.php'; ?>
    </div>
</div>
    <?php
        $resulto = $dbUsers->imagelist();
        $mainImage= 0;
        if (isset($_GET['image'])) {
         $mainImage = $_GET['image'];

        } else {
         $mainImage = $resulto[1][1];
        }
        $PathwayToFile = $resulto[1][1];
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
        if (isset($_POST['delete'])) {
            //fclose($mainImage);
            try {
            $Van = $dbUsers->deleteImageInfo($mainImage);
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    ?>
<div class="pure-g">
    <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
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
        <form method="post" action="">
                <input name="delete" type="submit" value="Delete">
        </form>
    </div>

    
   <main>
        <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-2-4">
        <h2>Some Imgs</h2>

      <p id="picCount">Displaying All</p>
        <div id="gallery">
            <table id="thumbs">
                <tr>
                    <!--This row needs to be repeated-->
                    <?php
                    $captionz = substr($mainImage,8,40);
                    $last = count($resulto) - 1;
                    foreach ($resulto as $i => $row)
                    {
                        $isFirst = ($i == 0);
                        $isLast = ($i == $last);
                        if ($pos++ % COLS === 0 && !$firstRow) {
                            echo '</tr><tr>';
                        }
                        // once loop begins, this is no longer true
                        $firstRow = false;
                    ?>
                    <td><a href="<?= $_SERVER['PHP_SELF']; ?>?image=<?= $resulto[$i][1]; ?>"><img src="<?= $resulto[$i][1]; ?>"" alt="<?= $resulto[$i][0]; ?>" width="80" height="54"></a></td>
                    <?php }
                    while ($pos++ % COLS) {
                     echo '<td>&nbsp;</td>';
                    } 
                    ?>
                </tr>
                <!-- Navigation link needs to go here -->
            </table>
        </div>
     </div>
    <div class="l-box pure-u-1 pure-u-md-1-2 pure-u-lg-1-4">
            <figure id="main_image">
                <img src="<?= $mainImage; ?>" alt="<?= $mainImage; ?>"<?= $imageSize; ?>>
                <figcaption><?= $captionz; ?></figcaption>
            </figure>
    </div>
    </main>
    
</div>
<?php require './Includes/Footer.php'; ?>
</body>
</html>
