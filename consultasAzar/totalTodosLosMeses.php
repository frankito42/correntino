<?php
require "../conn/conn.php";

$sqlSumaTodosLosMeses="SELECT MONTHNAME(`fechaV`) as mes ,SUM(`totalV`) as totalMes,(SELECT SUM(monto) FROM entregalibreta WHERE YEAR(fecha)=YEAR(NOW()) AND MONTH(fecha)=MONTH(`fechaV`) ) as libreta FROM ventas WHERE YEAR(fechaV)=YEAR(NOW()) GROUP BY MONTH(`fechaV`);";
$sumaMeses=$conn->prepare($sqlSumaTodosLosMeses);
$sumaMeses->execute();
$sumaMeses=$sumaMeses->fetchAll(PDO::FETCH_ASSOC);


foreach ($sumaMeses as $key => $value) {
    $sumaMeses[$key]['totalMes']=$sumaMeses[$key]['totalMes']+$sumaMeses[$key]['libreta'];
}


echo json_encode($sumaMeses);

?>