<?php
session_start();
require "../../conn/conn.php";
$fechaInicial=$_GET['fechaI'];
$fechaFin=$_GET['fechaF'];

/* $sqlVentasPorFecha="SELECT v.`idVenta`, v.`fechaV`, v.`totalV`, v.`idUser`,u.user,v.tipoPago FROM `ventas` = v
JOIN users = u on u.id=v.`idUser` WHERE idEstablecimiento=1 and v.`fechaV` BETWEEN :fechaI AND :fechaF"; */
$sqlVentasPorFecha="SELECT v.`idVenta`, v.`fechaV`, v.`totalV`, v.`idUser`,u.user,v.tipoPago,
(SELECT SUM(`monto`) FROM `entregalibreta` WHERE date(`fecha`) BETWEEN date('$fechaInicial') and date('$fechaFin')) as cobradoLibreta 

FROM `ventas` = v
JOIN users = u on u.id=v.`idUser` WHERE idEstablecimiento=1 and v.`fechaV` BETWEEN :fechaI AND :fechaF;";
$ventasFecha=$conn->prepare($sqlVentasPorFecha);
$ventasFecha->bindParam(":fechaI",$fechaInicial);
$ventasFecha->bindParam(":fechaF",$fechaFin);
$ventasFecha->execute();
$ventasFecha=$ventasFecha->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($ventasFecha);



?>

