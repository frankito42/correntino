<?php
session_start();
$local="";
$suma=0;
require "../conn/conn.php";
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>

<style>
	
* {
    font-size: 100%;
    font-family: 'Times New Roman';
}

td,
th,
tr,
table {
    border-top: 1px solid black;
    border-collapse: collapse;
        margin: 0 auto;

}

td.producto,
th.producto {
    width: 75px;
    max-width: 75px;
}

td.cantidad,
th.cantidad {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

td.precio,
th.precio {
    width: 40px;
    max-width: 40px;
    word-break: break-all;
}

.centrado {
    text-align: center;
    align-content: center;
}

.ticket {
    width: 100%;
    max-width: 100%;
}

img {
    max-width: inherit;
    width: inherit;
}
</style>

<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
        <div class="ticket">
            <!-- <img
                src="../moduloTicket/photo.jpg"
                alt="Logotipo"> -->
                <p class="centrado">------------user: <span id="hola"></span></p>
            	<p class="centrado">
            	    <span style="font-weight: bold;"><?php echo $local['nombre']?></span>
                <br>
            	<span>Drugstore</span>
                <br><span id="fecha"></span></p>
              <table>
                <thead>
                    <tr>
                        <th>C</th>
                        <th>PRODUCTO</th>
                        <th>$$</th>
                    </tr>
                </thead>
                <tbody id="pppof">
					<?php foreach ($_SESSION['imprimir'] as $key): $suma+=$key[2]*$key[3]->total?>
                    <tr>
                        <td><?php echo $key[2]?></td>
                        <td><?php echo $key[1]?></td>
                        <td><?php echo "$".(number_format($key[2]*$key[3]->total))?></td>
                    </tr>
					<?php
						endforeach
					?> 

                    <tr>
                        <td></td>
                        <td>TOTAL</td>
                        <td>$<?php echo number_format($suma)?></td>
                    </tr>
                </tbody>  
            </table>
            <p style="font-weight: bold;" class="centrado">¡GRACIAS POR SU COMPRA!
                <br><?php echo $local['nombre']?></p>
                <p class="centrado">Corrientes <br>3610 Clorinda - Formosa</p>
                <p class="centrado">Cel: (3718) 452409</p>
            <p class="centrado">-----------------------------</p>
            <p class="centrado">-----------------------------</p>
            <p class="centrado">-----------------------------</p>
            
        </div>
    </body>
    <script>
    
       function obtenerFechaHora() {
    var fechaHora = new Date();
    return fechaHora.toLocaleString();
}
function formatearNumero(numero) {
    return numero.toLocaleString('es-AR');
}



        document.getElementById("fecha").innerHTML=obtenerFechaHora()
    
    
    
    
    
        let logo=JSON.parse(localStorage.getItem("user")).user
        document.getElementById("hola").innerHTML=logo
        let productos=JSON.parse(localStorage.getItem("pof"))
        console.log(productos)
        let suma=0
        let tr=``
        productos.forEach((element) => {
            tr+=`
                <tr>
                    <td>${element[2]}</td>
                    <td>${element[1]}</td>
                    <td>$${formatearNumero(parseFloat(element[2])*parseFloat(element[3].total))}</td>
                </tr>
            `
            suma+=parseFloat(element[2])*parseFloat(element[3].total)
        });
        tr+=`
                <tr>
                    <td colspan=2><span style="font-weight: bold;">TOTAL</span></td>
                    <td><span style="font-weight: bold;">$${formatearNumero(suma)}</span></td>
                </tr>
            `
        document.getElementById("pppof").innerHTML=tr
        console.log(tr)

    </script>
</html>
 