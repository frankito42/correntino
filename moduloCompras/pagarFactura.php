<?php 
session_start();
require "../conn/conn.php";

$id=$_POST['idFactura'];
$estado=1;
$mPago=$_POST['metodoPago'];
$sqlUpdate="UPDATE `entrada` SET `estado`=:estado, `metodoPago`=:p WHERE `idEntrada`=:id";
$update=$conn->prepare($sqlUpdate);
$update->bindParam(":estado",$estado);
$update->bindParam(":p",$mPago);
$update->bindParam(":id",$id);
$update->execute();

echo json_encode("ok");


?>