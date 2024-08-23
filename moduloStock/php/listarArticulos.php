<?php
session_start();
require "../../conn/conn.php";




if(isset($_GET['id']) && !empty($_GET['id'])){
    $idEsta=$_GET['id'];
    $sqlTodosLosArticulos="SELECT modifPrecio,descuento,pro.nombreP,pro.idProveedor,a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`,mayoritario,menorCentaje FROM `articulos` as a 
    LEFT JOIN proveedores as pro on pro.idProveedor=a.`idProveedor` LEFT JOIN categoria=c on c.idCategoria=a.categoria where a.idEsta=$idEsta";
}else{
    
    $sqlTodosLosArticulos="SELECT modifPrecio,descuento,pro.nombreP,pro.idProveedor,a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`,mayoritario,menorCentaje FROM `articulos` as a 
    LEFT JOIN proveedores as pro on pro.idProveedor=a.`idProveedor` LEFT JOIN categoria=c on c.idCategoria=a.categoria where a.idEsta=$_GET[establecimiento]";
}
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($articulos);



?>