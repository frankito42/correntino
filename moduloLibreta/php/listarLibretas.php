<?php
session_start();
require "../../conn/conn.php";
$sqlLibretas="SELECT l.idCliente,c.nombreCliente,c.credito, a.nombre,a.mayoritario,pL.`id`, pL.`idLibreta`, pL.`idProducto`, pL.`cantidad`, pL.`fechaHora` FROM `productoslibreta` pL
JOIN libretas l on l.idLibreta=pL.idLibreta
JOIN clientes c on c.id=l.idCliente
JOIN articulos a on a.articulo=pL.idProducto
WHERE l.idCliente=$_GET[id] and l.estado='pendiente'";
$libretas=$conn->prepare($sqlLibretas);

$libretas->execute();
$libretas=$libretas->fetchAll(PDO::FETCH_ASSOC);


$_SESSION['imprimir']=$libretas;
echo json_encode($libretas);



?>