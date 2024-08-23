<?php
require "../../conn/conn.php";
$sqlClientes="SELECT * FROM `clientes`";
$clientes=$conn->prepare($sqlClientes);
$clientes->execute();
$clientes=$clientes->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($clientes);
?>