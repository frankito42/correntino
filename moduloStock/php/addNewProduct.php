<?php
require "../../conn/conn.php";
$articulo = $_POST;

    $sqlAddNewProduct="INSERT INTO `articulos`(`nombre`, `costo`, `stockmin`,
    `descripcion`, `categoria`, `codBarra`, `precioVenta`,
    `idEsta`, `mayoritario`,keyTwoLabor) VALUES 
    (:nombre,:costo,:stockmin,
    :desc,:cat,:cod,
    :precio,:idEsta,:mayo,:labor)";
    $addNewProduct=$conn->prepare($sqlAddNewProduct);
    $addNewProduct->bindParam(":nombre",$articulo['newNombreA']);
    $caracteres = Array(".",",");
    $resultado1 = str_replace($caracteres,"",$articulo['costoArticulo']);
    $resultado2 = str_replace($caracteres,"",$articulo['precioArticulo']);
    $resultado3 = str_replace($caracteres,"",$articulo['precioArticulo2']);
    $addNewProduct->bindParam(":costo",$resultado1);
    $addNewProduct->bindParam(":stockmin",$articulo['stockMinA']);
    $addNewProduct->bindParam(":desc",$articulo['descripcionNewA']);
    $addNewProduct->bindParam(":cat",$articulo['categoriaNew']);
    $addNewProduct->bindParam(":cod",$articulo['codBarraNew']);
    $addNewProduct->bindParam(":precio",$resultado2);
    $esta=1;
    $addNewProduct->bindParam(":idEsta",$esta);
    $addNewProduct->bindParam(":mayo",$resultado3);
    $addNewProduct->bindParam(":labor",$articulo['laboratoriosSearch']);
    if($addNewProduct->execute()){
    echo json_encode("perfecto");
}



?>