<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');
require "../../conn/connAdmin.php";

session_start();

$sqlStock="SELECT `nombre`, `costo`, `stockmin`, `cantidad`, `precioVenta`, `mayoritario` FROM `articulos`";
$stock=$conn->prepare($sqlStock);
$stock->execute();
$stock=$stock->fetchAll(PDO::FETCH_ASSOC);

$htmlContent = "<h2>Fecha ".date("d-m-Y H:i:s")."</h2>".'<table border=1>';

$tr="<tr>
<th>Articulo</th>
<th>Cantidad</th>
<th>Costo</th>
<th>Subtotal</th>
</tr>";
$total=0;
foreach ($stock as $row) {
    $td="";
    $cantidad=($row['cantidad']<0)?0:$row['cantidad'];
    $tr.='<tr>';
    $td.="<td>".$row['nombre']."</td>";
    $td.="<td>".$row['cantidad']."</td>";
    $td.="<td>$".$row['costo']."</td>";
    $td.="<td>$".($cantidad*$row['costo'])."</td>";

    
    
    
    $tr.="$td</tr>";
    $total+=($cantidad*$row['costo']);
}


$tr .= "<tr>
<td colspan='3'>TOTAL</td>
<td>$$total</td>
</tr>";
$htmlContent .= "$tr</table>";


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename="."Stock ".date("d-m-Y H:i").".xls");
header("Pragma: no-cache");
header("Expires: 0");

echo $htmlContent;
?>