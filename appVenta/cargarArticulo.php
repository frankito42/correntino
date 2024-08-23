<?php
session_start();
require "../conn/conn.php";


    $sqlTraerArticulo="SELECT `articulo`, `nombre`, `costo`, `stockmin`,
                     `cantidad`, `descripcion`, `imagen`, `categoria`,
                     `codBarra`, `precioVenta`, `idEsta`, `idProveedor`,mayoritario
                      FROM `articulos` WHERE `codBarra`=:codigo";
    $producto=$conn->prepare($sqlTraerArticulo);
    $producto->bindParam(":codigo",$_GET['codigo']);
    $producto->execute();
    $producto=$producto->fetch(PDO::FETCH_ASSOC);


echo "PRODUCTO".$producto['nombre'].";".$producto['mayoritario'];
?>