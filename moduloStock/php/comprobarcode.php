<?php
require "../../conn/conn.php";
$sqlComprobar="SELECT * FROM `articulos` where codBarra=:cod and idEsta=:esta";
$comprobacion=$conn->prepare($sqlComprobar);
$comprobacion->bindParam(":cod",$_POST['codBarraNew']);
$comprobacion->bindParam(":esta",$_POST['newArticuloEnEstablecimiento']);
$comprobacion->execute();
$comprobacion=$comprobacion->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($comprobacion);
?>