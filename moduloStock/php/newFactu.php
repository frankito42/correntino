<?php
session_start();
require "../../conn/conn.php";
$menorCentaje=$_POST['meno'];
$idArticulo=$_POST['idArticulo'];
$prove=$_POST['prove'];
$precioVenta=$_POST['precioventa']; 
/* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
$costo=$_POST['costo'];

/* CUENTO CUANTOS ARTICULOS SE VAN A INGRESAR AL STOCK */
for ($i=0; $i < count($idArticulo) ; $i++) {



    $sqlUpdateStock="UPDATE `articulos` SET `costo`=:costo, idProveedor=:idProveedor ,mayoritario=:may, menorCentaje=:menorPorcentaje WHERE `articulo`=:id";
    $upCantidad=$conn->prepare($sqlUpdateStock);
    $upCantidad->bindParam(":id",$idArticulo[$i]);
    $upCantidad->bindParam(":costo",$costo[$i]);
    $upCantidad->bindParam(":idProveedor",$prove[$i]);
    $caracteres = Array(",");
    $resultado1 = str_replace($caracteres,"",$precioVenta[$i]);

    $upCantidad->bindParam(":may",$resultado1);
    $upCantidad->bindParam(":menorPorcentaje",$menorCentaje[$i]);
    $upCantidad->execute();
    
    

}


header("location:../stock.php");


?>