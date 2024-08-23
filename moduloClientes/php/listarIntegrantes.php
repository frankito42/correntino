<?php
session_start();
require "../../conn/conn.php";

$sqlIntegrantesFamilia="SELECT * FROM `integrantes` WHERE idFamilia=$_GET[id]";
$integrantes=$conn->prepare($sqlIntegrantesFamilia);
$integrantes->execute();
$integrantes=$integrantes->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($integrantes);



?>