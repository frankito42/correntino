<?php
require "../../conn/conn.php";
$fecha=date("Y-m-d H:i:s");
    $sqlNewGasto="INSERT INTO `gastos`(`detalle`, `monto`, `fecha`) 
    VALUES (:d,:m,:f)";
    $gasto=$conn->prepare($sqlNewGasto);
    $gasto->bindParam(":d",$_POST['detalle']);
    $caracteres = Array(",");
    $monto= str_replace($caracteres,"",$_POST['monto']);
    $gasto->bindParam(":m",$monto);
    $gasto->bindParam(":f",$fecha);
    if($gasto->execute()){
    echo json_encode("perfecto");
}



?>