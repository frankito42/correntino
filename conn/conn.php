<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'correntino';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
    $conn->exec("set names utf8");
    /* echo "conexion exitosa"; */
    if(isset($local)){
        $sql="SELECT * FROM `local` WHERE id=1";
        $local=$conn->prepare($sql);
        $local->execute();
        $local=$local->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    die('Conexion fallida: lo sentimos mucho.'.$e->getMessage());
}
date_default_timezone_set('America/Argentina/Buenos_Aires');


?>