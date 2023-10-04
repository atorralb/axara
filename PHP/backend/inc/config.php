<?php

$host = '127.0.0.1';
$dbname = 'inventario';
$username = 'root';
$password = '';
 
$mysqli = new mysqli($host,$username,$password,$dbname);
//mysqli_select_db($mysqli, 'inventario') or die(mysqli_error($mysqli));