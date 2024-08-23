<?php
require "../../conn/conn.php";

$porcentaje=$_GET['porcentaje'];

if(isset($_GET['idPro'])){
    $sqlTodosLosArticulos="SELECT * FROM `articulos` where idProveedor=:id";
    $articulos=$conn->prepare($sqlTodosLosArticulos);
    $articulos->bindParam(":id",$_GET['idPro']);
    $articulos->execute();
    $articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);
}else{
    $sqlTodosLosArticulos="SELECT * FROM `articulos`";
    $articulos=$conn->prepare($sqlTodosLosArticulos);
    $articulos->execute();
    $articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);
}


foreach ($articulos as $key) {
    
    $costo=round(($key['costo']*$porcentaje/100)+$key['costo'], 0, PHP_ROUND_HALF_UP);
    $valor2 = intval($costo);
    $n2 = round($valor2, -1);
    $n2=$n2 < $valor2 ? $n2 + 10 : $n2;
    
    $porentajePredefinido=(empty($key['menorCentaje'])||is_null($key['menorCentaje']))?30:$key['menorCentaje'];
    $aumento2=round(($n2*$porentajePredefinido/100)+$n2, 0, PHP_ROUND_HALF_UP);
    
    
    $valor = intval($aumento2);
 

    // Redondeamos al múltiplo de 10 más cercano
    
    
    
    $n = round($valor, -1);
    $n=$n < $valor ? $n + 10 : $n;
    
    $sqlUpdateArticulo="UPDATE `articulos` SET `costo`=:costo, `mayoritario`=:ma,menorCentaje=:menor
                                                 WHERE `articulo`=:articulo";
    $editProducto=$conn->prepare($sqlUpdateArticulo);
    $editProducto->bindParam(":costo",$n2);
    $editProducto->bindParam(":ma",$n);
    $editProducto->bindParam(":menor",$porentajePredefinido);
    $editProducto->bindParam(":articulo",$key['articulo']);
    
    $editProducto->execute();

}




?>