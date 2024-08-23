<?php
require "../conn/conn.php";


 $sqlTraerArticulo="SELECT SUM(`totalV`) as TotalVentasDelDia FROM `ventas` WHERE DATE(`fechaV`) = DATE(now());";
    $producto=$conn->prepare($sqlTraerArticulo);
    $producto->execute();
    $producto=$producto->fetch(PDO::FETCH_ASSOC);

$ganacia=formatoDecimal($producto['TotalVentasDelDia'])-formatoDecimal($producto['TotalVentasDelDia']/1.3);


function formatoDecimal($numero) {
    return number_format($numero, 0, '.', '');
}








echo "$".number_format($ganacia);



?>