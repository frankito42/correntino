<?php
session_start();
require "../../conn/conn.php";
// Datos de la solicitud
$url = "https://api.mercadopago.com/instore/qr/seller/collectors/93730757/stores/SUC1/pos/SUC1POS11/orders";
$token = "APP_USR-2409806567402404-122812-81689239ddc29141e497f5809b547f61-93730757";


$sql="INSERT INTO `qr`(f) VALUES (now())";
$exec=$conn->prepare($sql);
$exec->execute();

$idQr=$conn->lastInsertId();
// Procesa los datos
$_SESSION['idQr']=$idQr;
$total=floatval($_GET['total']);
$data = array(
    "external_reference" => "$idQr",
    "title" => "Product order",
    "notification_url" => "https://salvatoreminishop.com/notificaciones/notificaciones.php?pago=$idQr",
    "total_amount" => $total,
    "description" => "Salvatore",
    "items" => array(
        array(
            "sku_number" => "$idQr",
            "category" => "Salvatore",
            "title" => "Salvatore",
            "description" => "Compras En Salvatore",
            "unit_price" => $total,
            "quantity" => 1,
            "unit_measure" => "unit",
            "total_amount" => $total
        )
    ),
    "sponsor" => array(
        "id" => 140913968
    )
); 

// Configuración de la solicitud cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $token",
    "Content-Type: application/json"
));

// Ejecutar la solicitud
$response = curl_exec($ch);
if ($response === false) {
    echo "error";
} else {
    $responseData = json_decode($response, true);
    if($responseData==[]){
        echo $idQr;
    }else{
        echo "error";
    }
}

// Cerrar la conexión cURL
/* curl_close($ch); */
?>
