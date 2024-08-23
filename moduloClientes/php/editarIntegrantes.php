<?php
require "../../conn/conn.php";
    $sqlUpdateInte="UPDATE `integrantes` SET `nombre`='$_POST[editNameInte]' WHERE `idIntegrante`='$_POST[idInte]'";
    $editInte=$conn->prepare($sqlUpdateInte);
    if($editInte->execute()){
    echo json_encode("perfecto");
}



?>