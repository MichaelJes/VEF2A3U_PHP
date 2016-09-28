<div class="header">
<?php 
 $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
?>
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Quantus Import & Export Image Service</a>

        <ul class="pure-menu-list">
            <li class="pure-menu-item pure-menu-selected"><a href="#"class="pure-menu-link"  <?php if ($currentPage == 'index.php') {
 echo 'id="here"';} ?>>Home</a></li>
            <li class="pure-menu-item"><a href="#" class="pure-menu-link"  <?php if ($currentPage == 'Sign.php') {
 echo 'id="here"';} ?>>Sign Up</a></li>
        </ul>
    </div>
</div>