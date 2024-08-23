<?php
session_start();
require "../conn/conn.php";
$factura=$_POST['factura'];
$menorCentaje=$_POST['meno'];
/* $mayorCentaje=$_POST['mayo']; */
/* $provedor=$_POST['provedor']; */
$observacion=$_POST['observacion'];
$vence=$_POST['vence'];
$idArticulo=$_POST['idArticulo'];
$cantidad=$_POST['cantidad'];
$precioVenta=$_POST['precioventa']; 
$fecha=date('Y-m-d');
$idProve=$_POST['proveedor'];
/* $keyLaboratorio=$_POST['laboratorio']; */
/* %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%% */
/* $transporte=$_POST['transporr'];  */
$costo=$_POST['costo'];
/* $preciomayor=$_POST['preciomayor'];  */
/* $minoritario=$_POST['minoritario']; 
$mayoritario=$_POST['mayoritario'];  */
/* print_r($_POST); */
$esta=1;
/* INSERTO UNA ENTRADA O FACTURA DE PRUDUSCTOS A INGRESAR */
$entradaSql="INSERT INTO `entrada`(`fecha`, `nFactura`, `observacion`,`idProve`,idEstablecimiento)VALUES 
                                                                    (:fecha,
                                                                     :nFactura,
                                                                     :observacion,
                                                                     :idProve,
                                                                     :idEstablecimiento)";
/* $entradaSql="INSERT INTO `entrada`(`fecha`, `nFactura`, `observacion`,`idProve`,`KeyLaboratorio`,`transporte`) VALUES 
                                                                    (:fecha,
                                                                     :nFactura,
                                                                     :observacion,
                                                                     :idProve,
                                                                     :laboratorio,
                                                                     :tranport)"; */
$entrada=$conn->prepare($entradaSql);
$entrada->bindParam(":fecha",$fecha);
$entrada->bindParam(":nFactura",$factura);
$entrada->bindParam(":observacion",$observacion);
$entrada->bindParam(":idProve",$idProve);
$entrada->bindParam(":idEstablecimiento",$esta);
/* $entrada->bindParam(":laboratorio",$keyLaboratorio); */
/* $entrada->bindParam(":tranport",$transporte); */
$entrada->execute();
/* TRAIGO EL ID INGRESADO "EL ULTIMO" */
$elIdEntrada=$conn->lastInsertId();
/* CUENTO CUANTOS ARTICULOS SE VAN A INGRESAR AL STOCK */
for ($i=0; $i < count($idArticulo) ; $i++) {
    /* SELEECCIONO EL ARTICULO */ 
    $sqlSelectArticulo="SELECT * FROM `articulos` WHERE `articulo`=:id";
    $sellArticulo=$conn->prepare($sqlSelectArticulo);
    $sellArticulo->bindParam(":id",$idArticulo[$i]);
    $sellArticulo->execute();
    $sellArticulo=$sellArticulo->fetch(PDO::FETCH_ASSOC);
 /*    $costo[$i]+=$transporte[$i]; */
    $sumaStock=$sellArticulo['cantidad']+$cantidad[$i];

    $sqlUpdateStock="UPDATE `articulos` SET `costo`=:costo, `cantidad`=:cantidad, `idProveedor`=:idProveedor, mayoritario=:may, menorCentaje=:menorPorcentaje, fechaVence=:vence WHERE `articulo`=:id";
    $upCantidad=$conn->prepare($sqlUpdateStock);
    $upCantidad->bindParam(":id",$idArticulo[$i]);
    $upCantidad->bindParam(":cantidad",$sumaStock);
    $upCantidad->bindParam(":costo",$costo[$i]);
    $upCantidad->bindParam(":vence",$vence[$i]);
    $upCantidad->bindParam(":idProveedor",$idProve);
    $caracteres = Array(",");
    $resultado1 = str_replace($caracteres,"",$precioVenta[$i]);

    $upCantidad->bindParam(":may",$resultado1);
 /*    $upCantidad->bindParam(":labor",$keyLaboratorio); */
   /*  $upCantidad->bindParam(":mayo",$preciomayor[$i]); */
    $upCantidad->bindParam(":menorPorcentaje",$menorCentaje[$i]);
    /* $upCantidad->bindParam(":mayorPorcentaje",$mayorCentaje[$i]); */
    $upCantidad->execute();
    
    /* INSERTO EN FACTURA ENTRADA LOS PRODUCTOS QUE INGRESARON */
    $sql="INSERT INTO `facturaentrada`(`idEntrada`, `idArticulo`, `cantidad`, `fecha`, `costo`,idEsta) 
            VALUES 
            (:idEntrada,
             :idArticulo,
             :cantidad,
             :fecha,
             :costo,
             :idEsta)";
    $facturaentrada=$conn->prepare($sql);
    $facturaentrada->bindParam(":idEntrada",$elIdEntrada);
    $facturaentrada->bindParam(":idArticulo",$idArticulo[$i]);
    $facturaentrada->bindParam(":cantidad",$cantidad[$i]);
    $facturaentrada->bindParam(":costo",$costo[$i]);
    $facturaentrada->bindParam(":fecha",$fecha);
    $facturaentrada->bindParam(":idEsta",$esta);
    $facturaentrada->execute();
}


header("location:compras.php");


?>