<?php
session_start();
require "../../conn/conn.php";

$sqlListarTodasLasVentas="SELECT v.`idVenta`, v.`fechaV`, v.`totalV`, v.`idUser`,u.user,v.tipoPago,(SELECT SUM(`monto`) FROM `entregalibreta` WHERE date(`fecha`)=date(NOW()))as cobradoLibreta FROM `ventas` = v JOIN users = u on u.id=v.`idUser` WHERE v.fechaV= CURDATE() and idEstablecimiento=1;";
$listaDeVentas=$conn->prepare($sqlListarTodasLasVentas);
$listaDeVentas->execute();
$listaDeVentas=$listaDeVentas->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($listaDeVentas);



?>