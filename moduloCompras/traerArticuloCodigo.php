<?php
require "../conn/conn.php";
$cod=$_GET['cod'];
$selectArticulo="SELECT * FROM `articulos` WHERE codBarra=:cod";
$articulo=$conn->prepare($selectArticulo);
$articulo->bindParam(":cod",$cod);
$articulo->execute();
$articulo=$articulo->fetch(PDO::FETCH_ASSOC);

echo json_encode($articulo);
?>