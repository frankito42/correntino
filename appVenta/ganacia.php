<?php
require "../conn/conn.php";


 $sqlTraerArticulo="SELECT SUM(`totalV`) as totalMes FROM `ventas` WHERE MONTH(`fechaV`) = MONTH(NOW()) and YEAR(`fechaV`)=YEAR(NOW());";
    $producto=$conn->prepare($sqlTraerArticulo);
    $producto->execute();
    $producto=$producto->fetch(PDO::FETCH_ASSOC);

$ganacia=formatoDecimal($producto['totalMes'])-formatoDecimal($producto['totalMes']/1.3);


function formatoDecimal($numero) {
    return number_format($numero, 0, '.', '');
}








echo "$".number_format($ganacia);



?>