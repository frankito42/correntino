<?php
session_start();
require "../../conn/conn.php";
$vandera="true";
$pagoCon=floatval($_POST['pagoCon']);
$idFamilia=$_POST['idFamilia'];


$sqlTraerCreditoDeEntrega="SELECT `credito` FROM `clientes` WHERE `id`=$_POST[idFamilia]";
$entregado=$conn->prepare($sqlTraerCreditoDeEntrega);
$entregado->execute();
$entregado=$entregado->fetch(PDO::FETCH_ASSOC);


$entregadoMasPagoCon=floatval($entregado['credito'])+$pagoCon;


$sqlSumaArticulosLibreta="SELECT sum(`cantidad`*(select mayoritario from articulos WHERE articulo=idProducto)) totalLibreta 
from productoslibreta WHERE idLibreta=:idLibreta;";
$sumaLibreta=$conn->prepare($sqlSumaArticulosLibreta);
$sumaLibreta->bindParam(":idLibreta",$_POST['idLibretaTabla']);
$sumaLibreta->execute();
$sumaLibreta=$sumaLibreta->fetch(PDO::FETCH_ASSOC);



if ($entregadoMasPagoCon>$sumaLibreta['totalLibreta']) {
    echo json_encode("No superar la cantidad que debe en libreta. Intentelo nuevamente con un monto menor.");
}else{



    $dateTIME=date("Y-m-d H:i:s");
    /* agrego a su historial de entrega */
    $addHistorial="INSERT INTO `entregalibreta`(`idLibreta`, `monto`, `fecha`) VALUES(:id,:m,:f)";
    $historial=$conn->prepare($addHistorial);
    $historial->bindParam(":id",$_POST['idLibretaTabla']);
    $historial->bindParam(":m",$pagoCon);
    $historial->bindParam(":f",$dateTIME);
    $historial->execute();
    
    
    if ($sumaLibreta['totalLibreta']==$entregadoMasPagoCon) {
        $sqlUpdateCredito="UPDATE `clientes` SET `credito`=0 WHERE `id`=$_POST[idFamilia]";
        $editCredito=$conn->prepare($sqlUpdateCredito);
        $editCredito->execute();

        $sqlPagarArticulo="UPDATE `libretas` SET `estado`='pagado', fechaFin=NOW() WHERE `idLibreta`=$_POST[idLibretaTabla]";
        $pagar=$conn->prepare($sqlPagarArticulo);
        $pagar->execute();

        echo json_encode("perfecto");
        
    }else{
        $sqlUpdateCredito="UPDATE `clientes` SET `credito`=$entregadoMasPagoCon WHERE `id`=$_POST[idFamilia]";
        $editCredito=$conn->prepare($sqlUpdateCredito);
        $editCredito->execute();


        echo json_encode("perfecto");

    }


    
}








/* SELECIONO LOS PRODUCTOS DE PENDIENTES DE PAGO EN LA LIBRETA */
/* SELECIONO LOS PRODUCTOS DE PENDIENTES DE PAGO EN LA LIBRETA */
/*  */

/* INSERTO EN LA TABLA VENTAS */
/* $fecha=date("Y-m-d");
$addNewVenta="INSERT INTO `ventas`(`fechaV`, `idUser`,idEstablecimiento,tipoPago) VALUES (:fecha,:idUser,:idEsta,'efectivo')";
$addVenta=$conn->prepare($addNewVenta);
$addVenta->bindParam(":fecha",$fecha);
$addVenta->bindParam(":idUser",$_POST['idUsuario']);
$addVenta->bindParam(":idEsta",$_POST['establecimiento']);
$addVenta->execute(); */

/* 
$idVenta=$conn->lastInsertId(); */






/* RECORRO LOS PRODUCTOS PENDIENTES DEL CLIENTE */
/* foreach ($productosLibretaFamilia as $key) {
    $totalProducto=floatval($key['cantidad'])*floatval($key['precio']);
    if ($pagoCon>=$totalProducto) {
        $vandera="false";
        $totalPagado+=$totalProducto;
        $sqlPagarArticulo="UPDATE `libreta` SET `estado`='pagado' WHERE `idLibreta`=$key[idLibreta]";
        $pagar=$conn->prepare($sqlPagarArticulo);
        $pagar->execute();


        $sqlInsetDetailVenta="INSERT INTO `detalleventa`(`idV`, `nombreProducto`, `cantidadV`, `precio`, `fecha`,idArticulo)
        VALUES (:idVenta,:nombre,:cantidadV,:precio,:fecha,:idArticulo)";
        $insertDetailVenta=$conn->prepare($sqlInsetDetailVenta);
        $insertDetailVenta->bindParam(":idVenta",$idVenta);
        $insertDetailVenta->bindParam(":nombre",$key['nombreArticulo']);
        $insertDetailVenta->bindParam(":cantidadV",$key['cantidad']);
        $insertDetailVenta->bindParam(":precio",$key['precio']);
        $insertDetailVenta->bindParam(":fecha",$fecha);
        $insertDetailVenta->bindParam(":idArticulo",$key['idArticulo']);
        $insertDetailVenta->execute();
        $pagoCon-=$totalProducto;
    }
}
if ($vandera=="true") {
    $deleteSql="DELETE FROM `ventas` WHERE `idVenta`=:id";
    $deleteVenta=$conn->prepare($deleteSql);
    $deleteVenta->bindParam(":id",$idVenta);
    $deleteVenta->execute();
}else{
    $updateVenta="UPDATE `ventas` SET `totalV`=:total WHERE `idVenta`=:id";
    $update=$conn->prepare($updateVenta);
    $update->bindParam(":total",$totalPagado);
    $update->bindParam(":id",$idVenta);
    $update->execute();
} */






?>