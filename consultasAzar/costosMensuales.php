<?php
session_start();
require "../conn/conn.php";

$sqlCostosTotales="SELECT MONTHNAME(`fecha`) as mes ,SUM(cantidad*`costo`) as totalMes FROM facturaentrada WHERE idEsta=1 and YEAR(fecha)=YEAR(NOW()) GROUP BY MONTH(`fecha`)";
$costosMensuales=$conn->prepare($sqlCostosTotales);
$costosMensuales->execute();
$costosMensuales=$costosMensuales->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($costosMensuales);

?>