<?php
$token = "TEST-1961973597311352-110618-b5d42d656d34afe44fcca689bcc4de93-1537506757";
$url = "https://api.mercadopago.com/instore/qr/seller/collectors/12123adfasdf123u4u/pos/12123adfasdf123u4u/orders";

// Configuración de la solicitud cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $token",
    "Content-Type: application/json"
));

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar si hubo errores
if ($response === false) {
    echo "Error en la solicitud cURL: " . curl_error($ch);
} else {
    // Procesar la respuesta (puede ser un JSON)
    $responseData = json_decode($response, true);
    print_r($responseData); // Imprimir la respuesta en pantalla
}

// Cerrar la conexión cURL
curl_close($ch);
?>
