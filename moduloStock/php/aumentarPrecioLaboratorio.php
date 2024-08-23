<?php
require "../../conn/conn.php";

$porcentaje=$_GET['porcentaje'];

    $sqlTodosLosArticulos="SELECT * FROM `articulos` where categoria=:id";
    $articulos=$conn->prepare($sqlTodosLosArticulos);
    $articulos->bindParam(":id",$_GET['idLab']);
    $articulos->execute();
    $articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);



foreach ($articulos as $key) {
    $aumento=($key['mayoritario']*$porcentaje/100)+$key['mayoritario'];
    $valor = intval($aumento);

    // Redondeamos al múltiplo de 10 más cercano
    $n = round($valor, -1);
    $n=$n < $valor ? $n + 10 : $n;
    /* $aumento2=($key['mayoritario']*$porcentaje/100)+$key['mayoritario']; */
    $sqlUpdateArticulo="UPDATE `articulos` SET `mayoritario`=:mayoritario
                                                 WHERE `articulo`=:articulo";
    $editProducto=$conn->prepare($sqlUpdateArticulo);
    $editProducto->bindParam(":mayoritario",$n);
    $editProducto->bindParam(":articulo",$key['articulo']);
    
    $editProducto->execute();

}




?>