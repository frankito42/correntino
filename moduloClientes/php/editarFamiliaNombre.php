<?php
require "../../conn/conn.php";
    $sqlUpCliente="UPDATE `clientes` SET `nombreCliente`='$_POST[editName]' WHERE `id`=$_POST[editNameFamiId]";
    $editNombre=$conn->prepare($sqlUpCliente);
    if($editNombre->execute()){
    echo json_encode("perfecto");
}



?>