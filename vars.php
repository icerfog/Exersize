<?php
// Базы данных
	$sqlc=mysqli_connect("localhost","admin","12345");
	mysqli_set_charset( $sqlc,"cp1251");
	mysqli_select_db($sqlc,"test");
// Серверные переменные
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'page.php';
?>