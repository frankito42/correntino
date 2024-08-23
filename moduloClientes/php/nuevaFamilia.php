<?php
require "../../conn/conn.php";
    $sqlNewFamily="INSERT INTO `clientes`(`nombreCliente`) VALUES (:n)";
    $familia=$conn->prepare($sqlNewFamily);
    $familia->bindParam(":n",$_POST['nombreCliente']);
    if($familia->execute()){
    echo json_encode("perfecto");
}



?>