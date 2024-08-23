<?php
session_start();
require "../../conn/connAdmin.php";

$sqlDeleteVenta="DELETE FROM `ventas` WHERE `idVenta`=$_GET[id]";
$delete=$conn->prepare($sqlDeleteVenta);
$delete->execute();

$sqlDeleteVentasDetalle="DELETE FROM `detalleventa` WHERE `idV`=$_GET[id]";
$deleteDetalle=$conn->prepare($sqlDeleteVentasDetalle);
$deleteDetalle->execute();

echo json_encode("borrado");
?>