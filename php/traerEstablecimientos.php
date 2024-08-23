<?php
session_start();
require "../conn/conn.php";

$sqlEstablecimientos="SELECT `idEsta`, `nombreEsta` FROM `establecimiento`";
$establecimientos=$conn->prepare($sqlEstablecimientos);
$establecimientos->execute();
$establecimientos=$establecimientos->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($establecimientos);



?>