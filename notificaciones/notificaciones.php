<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
require "conn.php";



    if($_GET["verificar"]=="verificar"){
        $sql="SELECT * FROM `qr` WHERE `pago`=$_GET[pago] and estado='payment'";
        $exec=$conn->prepare($sql);
        $exec->execute();
        $res=$exec->fetch(PDO::FETCH_ASSOC);
        if($res){
            echo "pagado";
        }else{
            echo "esperando";
        }
    }else{
        if($_GET['type']=="payment" || $_GET['topic']=="merchant_order"){
            $data =$_GET;
            $json = json_encode($data, true);
            $sql="INSERT INTO `qr`( `json`,estado, f,pago) VALUES ('$json','$_GET[topic]$_GET[type]',now(),$_GET[pago])";
            $exec=$conn->prepare($sql);
            $exec->execute();
        }
        
    }
// Procesa los datos
// ...


?>
