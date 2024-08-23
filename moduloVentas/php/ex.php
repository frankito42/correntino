<?php
date_default_timezone_set('America/Argentina/Buenos_Aires');

session_start();

$htmlContent = "<h2>Fecha ".date("d-m-Y H:i:s")."</h2><h2>Usuario ".$_SESSION['userFinal']->user.'</h2>
<h3>hora de inicio '.$_SESSION['inicioUser'].'</h3>
<h3>hora de cierre '.date("d-m-Y H:i:s").'</h3>
<table border=1>';

$tr="<tr>
<th>Nro ticket</th>
<th>Detalle</th>
<th>Total</th>
</tr>";
$sum=0;
$total=0;
$efectivo=0;
$mp=0;

foreach ($_SESSION['cajaIMP'] as $row) {
    $sum=0;
    $td="";
    $tr.='<tr>';
    $td.="<td>".$row[0][6]."</td>";
    $td.="<td>".$row[0][5]."</td>";

    foreach ($row as $pow){
        $sum+=floatval($pow[2])*floatval($pow[3]->total);    
    }
    
    if($row[0][5]=="efectivo"){
       $efectivo +=$sum;
    }else{
       $mp +=$sum;
    }
    
    
    
    $td.="<td>$$sum</td>";
    
    
    $tr.="$td</tr>";
    $total+=$sum;
    
}

$tr .= "<tr>
<td colspan='2'>Efectivo</td>
<td>$$efectivo</td>
</tr>";
$tr .= "<tr>
<td colspan='2'>Mercado pago</td>
<td>$$mp</td>
</tr>";
$tr .= "<tr>
<td colspan='2'>TOTAL</td>
<td>$$total</td>
</tr>";
$htmlContent .= "$tr</table>";

$htmlContent.="
<br>
<table border='1'>
    <thead>
        <tr>
            <th><h3>Total cobrado en libreta</h3></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td style='text-align:center;'>$$_SESSION[pagoLibreta]</td>
        </tr>
    </tbody>
</table>
";

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=".$_SESSION['userFinal']->user.date("d-m-Y H:i").".xls");
header("Pragma: no-cache");
header("Expires: 0"); 

echo $htmlContent;
?>