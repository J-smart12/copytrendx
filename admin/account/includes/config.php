<?php
    $db_user = DB_USERNAME;
    $db_name = DB_NAME;
    $db_password = DB_PASSWORD;
    $db_host = DB_HOST;

    $db = new mysqli($db_host, $db_user, $db_password, $db_name);
    
?>