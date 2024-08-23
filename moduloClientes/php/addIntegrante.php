<?php
require "../../conn/conn.php";

    $sqlAddIntegranteFamilia="INSERT INTO `integrantes`(`nombre`, `idFamilia`) VALUES (:n,:idFamilia)";
    $insertIntegrante=$conn->prepare($sqlAddIntegranteFamilia);
    $insertIntegrante->bindParam(":n",$_POST['n']);
    $insertIntegrante->bindParam(":idFamilia",$_POST['idFami']);
  
    if($insertIntegrante->execute()){
    echo json_encode($_POST['idFami']);
}



?>