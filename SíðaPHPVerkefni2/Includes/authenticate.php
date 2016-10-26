<?php

 // if username and password match, create session variable,
 // regenerate the session ID, and break out of the loop
 $_SESSION['authenticated'] = 'Jethro Tull';
 $_SESSION['start'] = time();
 session_regenerate_id();
 header("Location: $redirect");
 exit;


