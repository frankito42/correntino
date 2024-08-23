<?php
session_start();
require "../../conn/conn.php";

if (isset($_POST['fecha'])) {
    $fecha=$_POST['fecha'];
    /* echo $fecha."<br>"; */
  }else{
    $fecha =date("Y-m-d");

    /* echo $fecha."<br>"; */
  }
  if (isset($_POST['fecha2'])) {
    $fecha2=$_POST['fecha2'];
    /* echo $fecha2."<br>"; */
  }else{
    $fecha2 =date("Y-m-d");

    /* echo $fecha2."<br>"; */
  }
$sqlGastos="SELECT * FROM `gastos` WHERE DATE(`fecha`) BETWEEN '$fecha' AND '$fecha2' order by fecha desc;";
$gastos=$conn->prepare($sqlGastos);
$gastos->execute();
$gastos=$gastos->fetchAll(PDO::FETCH_ASSOC);

$_SESSION['imprimir']=$gastos;
$_SESSION['fecha11']=$fecha;
$_SESSION['fecha12']=$fecha2;



echo json_encode($gastos);



?>