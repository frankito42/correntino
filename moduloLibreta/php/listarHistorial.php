<?php
require "../../conn/conn.php";
$sqlHistorial="SELECT c.nombreCliente,l.`idLibreta`, l.`fecha`, l.`idCliente`, l.`estado`, l.`fechaFin` FROM `libretas` l JOIN clientes c on c.id=l.idCliente WHERE c.id=$_GET[id] ORDER by idLibreta DESC;";
$historial=$conn->prepare($sqlHistorial);
$historial->execute();
$historial=$historial->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($historial);
?>