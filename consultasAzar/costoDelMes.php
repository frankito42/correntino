<?php
session_start();
require "../conn/conn.php";

$sqlCostosTotales="SELECT SUM(cantidad*`costo`) costo FROM `facturaentrada` WHERE idEsta=1 and MONTH(`fecha`)=MONTH(NOW())";
$costosMensuales=$conn->prepare($sqlCostosTotales);
$costosMensuales->execute();
$costosMensuales=$costosMensuales->fetch(PDO::FETCH_ASSOC);

echo json_encode($costosMensuales);

?>