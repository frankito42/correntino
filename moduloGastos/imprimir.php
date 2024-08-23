<?php
session_start();
ob_start();
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
    if (isset($_SESSION['imprimir'])) {
      
    }else{
      header("location: gastos.php");
    }
?>
<?php
 
?>

<html>
  <head>
    <title>Impreciones info</title>
  </head>
<body>  

  <!--  <img src="<?php echo $imagenBase64?>" style="width: 100%;" alt=""> -->
  <h4 style="text-align: right;">FECHA <?php echo date("d-m-Y")?></h4>
  <div>
           <h2 style="text-align: center;"><?php echo "Gastos de ".$_SESSION['fecha11']." hasta ".$_SESSION['fecha12']?></h2>
         </div>
    <div>
      <hr>
     
     

    </div>
    <div>
      <table style="width:100%;" border="1" CELLPADDING=10 CELLSPACING=0>
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Detalle</th>
            <th>Monto</th>
          </tr>
        </thead>
        <tbody>
        <?php $suma=0; foreach ($_SESSION['imprimir'] as $key):$suma+=$key['monto'];?>
          <tr>
            <td><?php echo $key['fecha']?></td>
            <td><?php echo $key['detalle']?></td>
            <td><?php echo number_format($key['monto'],2)?></td>
          </tr>
          <?php endforeach?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2">TOTAL</td>
            <td><?php echo "$".(number_format($suma,2));?></td>
          </tr>
        </tfoot>
      </table>
    </div>
          
</body>
</html>
<?php
$dompdf = new Dompdf();
$dompdf->loadHtml(ob_get_clean());
$dompdf->setPaper('A4', 'portrait'); // (Opcional) Configurar papel y orientaci車n
$dompdf->render(); // Generar el PDF desde contenido HTML
$pdf = $dompdf->output();// Obtener el PDF generado
$date="control de patentes ".date("d-m-Y");
$dompdf->stream($date,array("Attachment" => false));
?>
