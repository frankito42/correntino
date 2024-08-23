<?php
session_start();
require "../conn/conn.php";

$sqlSumaVentasMes="SELECT SUM(`totalV`) as totalMes,(SELECT SUM(monto) FROM entregalibreta WHERE YEAR(fecha)=YEAR(NOW()) AND MONTH(fecha)=MONTH(`fechaV`) ) as libreta FROM ventas WHERE idEstablecimiento=1 and YEAR(fechaV)=YEAR(NOW()) AND MONTH(`fechaV`) = MONTH(NOW());";
$sumaMes=$conn->prepare($sqlSumaVentasMes);
$sumaMes->execute();
$sumaMes=$sumaMes->fetch(PDO::FETCH_ASSOC);


$sumaMes['totalMes']+=$sumaMes['libreta'];
echo json_encode($sumaMes);



?>