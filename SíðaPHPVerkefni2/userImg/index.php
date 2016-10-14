<?php
// MAX_FILE_SIZE virkar ekki enn (vafrar styðja ekki)
// $max = 5120;   // 50KB

if (isset($_POST['upload'])) {

    # Skoðum hvað er að sjá í $_FILES 
    echo "<pre>";
        #  $_FILES[] er multidimensional array sem geymir skráarupplýsingar frá upload.
        #  fylki með einu item (name heiti úr input type="file") sem geymir svo 5 undirfylki:
            #  [name]       Upprunalegt heiti á skrá
            #  [type]       MIME type, td. .jpg, .pdf .mpg
            #  [tmp_name]   Staðsetning á skrá eftir upload (á miðlara).
            #  [error]      int sem gefur stöðuna á upload (error codes)
                            # 0:    Upload successful
                            # 1:    File exceeds maximum upload size specified in php.ini
                            # 2:    File exceeds size specified by MAX_FILE_SIZE
                            # 3:    File only partially uploaded 
                            # 4:    Form submitted with no file specified (no file) 
                            # 6:    No temporary folder
                            # 7:    Cannot write file to disk
                            # 8:    Upload stopped by an unspecified PHP extension
            #  [size]       Stærð á skrá í bytes
        #   The $_FILES array still exists when no file is uploaded
        print_r($_FILES); 
    echo "</pre>";

    // define the path to the upload folder on server
    // echo $_SERVER['DOCUMENT_ROOT']; 
    // Úttak: E:\utsdata  (fyrir tsuts.tskoli.is) 

    $destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/kennitala/VEF2A3U/userImg/";
    // Hvað ef fleiri en einn notandi, á hver notandi að hafa sína eigin möppu á miðlara? 
    // Pæling, er þetta góð lausn?
    // $destination = $_SERVER['DOCUMENT_ROOT'] . "/2t/kennitala/VEF2A3U/userImg/" . $_SESSION['user']['email'] . '/';
    
    // move the file to the upload folder and rename it
    // tmp_name er default upload destination á miðlara (upload_tmp_dir)
    // Þarf að breyta strax og færa skrá á miðlara sem og gefa skráarheiti.
    // Síðari parameter þarf að vera full pathname /absolute path (getum hér breytt nafni skráar í leiðinni)
    move_uploaded_file($_FILES['image']['tmp_name'], $destination . $_FILES['image']['name']);
    # Varast að nota copy() can expose your website to serious security risks.
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>PHP Solution 6-1</title>
</head>

<body>
    <!--  
    form til að geta framkvæmt upload á skrá
    Stillum max upload gildi.
    Við þurfum að hafa enctype="multipart/form-data" þegar við notum type="file" og viljum senda skrár via POST (consider that a file is a descriptor for some data for a specific operating system)
    Skrár eru uploadaðar í temporary möppu, sem þarf svo að færa strax með move_uploaded_file() annars er hætta á að henni verði eytt. Þetta er gert
    svo að hægt sé að gera security check á skrá áður en haldið er lengra. 
    Ef notaður er remote server þá þarf að stilla möppu heimildir á 700,770 eða 777 (least secure).

    enctype: Specifies the content type used to encode the form data set for submission to the server
    enctype="multipart/form-data": No encoding, use with type set to 'file', allows entire files to be included in the data
    -->
    <form action="" method="post" enctype="multipart/form-data">
        <p>
            <label for="image">Upload image:</label>
            <!-- Við þurfum að vísa í superglobal array $_FILES til að nálgast skráarupplýsingar og skrá -->
            <input type="file" name="image" id="image">
        </p>
        <p>
            <input type="submit" name="upload" id="upload" value="Upload">
        </p>
    </form>

<!-- 
Ítarefni:
enctype:specifies the content type used to encode the form data set for submission to the server
        enctype="application/x-www-form-urlencoded:  default value if missing), encodes special chars in the URL to ASCII HEX values and spaces to '+' 
        enctype="text/plain":                        HTML5, Converts only spaces to +, leaves other characters as is. (never use, not reliably interpretable by compute)
        enctype="multipart/form-data":               No encoding, use with type set to 'file', allows entire files to be included in the data

        Nánar um encode: 
        http://www.diogogmt.com/temp-slug-108/
        http://stackoverflow.com/questions/4526273/what-does-enctype-multipart-form-data-mean

POST method uploads:
http://php.net/manual/en/features.file-upload.post-method.php

Common Pitfalls with fileupload: 
http:php.net/manual/en/features.file-upload.common-pitfalls.php
-->
</body>
</html>