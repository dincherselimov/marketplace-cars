<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'marketplace');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
