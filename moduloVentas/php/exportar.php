<?php
session_start();
require "../../conn/conn.php";

$cajaPost=json_decode($_POST['caja']);
$caja=[];
$add=[];
foreach ($cajaPost as $valor) {
    
    $pro=json_decode($valor[3][0]->value);
    array_push($pro[0],$valor[2]);
    array_push($pro[0],$valor[0]);
   array_push($caja,$pro);
}

$_SESSION['cajaIMP']=$caja;
$_SESSION['userFinal']=json_decode($_POST['user']);
$_SESSION['pagoLibreta']=$_POST['pagoLibreta'];
$_SESSION['inicioUser']=$_POST['inicioUser'];


echo json_encode($caja);



?>
