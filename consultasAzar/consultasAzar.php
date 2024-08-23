<?php
session_start();
require "../conn/conn.php";

$sqlSumaVentasDelDia="SELECT SUM(`totalV`) as totalDia,(SELECT SUM(monto) FROM entregalibreta WHERE date(fecha)=date(CURDATE())) as libreta FROM ventas WHERE idEstablecimiento=1 and `fechaV`=CURDATE();";
$totalDia=$conn->prepare($sqlSumaVentasDelDia);
$totalDia->execute();
$totalDia=$totalDia->fetch(PDO::FETCH_ASSOC);

$totalDia['totalDia']+=$totalDia['libreta'];

echo json_encode($totalDia);



?>