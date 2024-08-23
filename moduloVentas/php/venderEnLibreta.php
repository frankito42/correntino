<?php
session_start();
require "../../conn/conn.php";
$productos=json_decode($_POST['productos']);
$_SESSION['imprimir']=$productos;
$fecha=date("Y-m-d H:i:s");


$comprobarLibreta="SELECT `idLibreta` FROM `libretas` WHERE `idCliente`=:id and `estado`='pendiente'";
$comprobarL=$conn->prepare($comprobarLibreta);
$comprobarL->bindParam(":id",$_POST['cliente']);
$comprobarL->execute();
$comprobarL=$comprobarL->fetch(PDO::FETCH_ASSOC);

if($comprobarL){


    foreach ($productos as $key) {
        $sqlTraerArticulo="UPDATE `articulos` SET `cantidad`=cantidad-:canti WHERE `articulo`=:id";
        $producto=$conn->prepare($sqlTraerArticulo);
        $cantidad=$key[2];
        $producto->bindParam(":canti",$cantidad);
        $producto->bindParam(":id",$key[0]);
        $producto->execute();
    
        $sqlInsertLibreta="INSERT INTO `productoslibreta`(`idLibreta`, `idProducto`, `cantidad`, `fechaHora`) 
        VALUES (:idLibreta,:idProducto,:cantidad,:fecha)";
        $insertEnLibreta=$conn->prepare($sqlInsertLibreta);
        $insertEnLibreta->bindParam(":idLibreta",$comprobarL['idLibreta']);
        $insertEnLibreta->bindParam(":idProducto",$key[0]);
        $insertEnLibreta->bindParam(":cantidad",$cantidad);
        $insertEnLibreta->bindParam(":fecha",$fecha);
        $insertEnLibreta->execute();
    }

    
}else{
    $insertLibreta="INSERT INTO `libretas`(`fecha`, `idCliente`) 
    VALUES (NOW(),:id)";
    $addLibreta=$conn->prepare($insertLibreta);
    $addLibreta->bindParam(":id",$_POST['cliente']);
    $addLibreta->execute();
    $idL=$conn->lastInsertId();

    foreach ($productos as $key) {
        $sqlTraerArticulo="UPDATE `articulos` SET `cantidad`=cantidad-:canti WHERE `articulo`=:id";
        $producto=$conn->prepare($sqlTraerArticulo);
        $cantidad=$key[2];
        $producto->bindParam(":canti",$cantidad);
        $producto->bindParam(":id",$key[0]);
        $producto->execute();
    
        $sqlInsertLibreta="INSERT INTO `productoslibreta`(`idLibreta`, `idProducto`, `cantidad`, `fechaHora`) 
        VALUES (:idLibreta,:idProducto,:cantidad,:fecha)";
        $insertEnLibreta=$conn->prepare($sqlInsertLibreta);
        $insertEnLibreta->bindParam(":idLibreta",$idL);
        $insertEnLibreta->bindParam(":idProducto",$key[0]);
        $insertEnLibreta->bindParam(":cantidad",$cantidad);
        $insertEnLibreta->bindParam(":fecha",$fecha);
        $insertEnLibreta->execute();
    }
}








echo json_encode("perfecto");
?>