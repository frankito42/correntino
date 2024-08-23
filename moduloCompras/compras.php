<?php
session_start();
$local="";
require "../conn/conn.php";
/* require "chimichurri/trataFechas.php"; */


/* if(!isset($_SESSION['user'])){
header("location:login/login_v5/index.php");
}
 */
$sqlTodosLosArticulos="SELECT a.`articulo`, a.`nombre`, a.`costo`, a.`stockmin`, a.`cantidad`, a.`descripcion`, a.`imagen`, a.`categoria`, a.`codBarra`, a.`precioVenta`, a.`idEsta`, a.`idProveedor`,e.nombreEsta,p.nombreP FROM `articulos` =a LEFT OUTER join proveedores=p on p.idProveedor=a.idProveedor 
JOIN establecimiento =e ON a.idEsta=e.idEsta where a.idEsta=1";
$articulos=$conn->prepare($sqlTodosLosArticulos);
$articulos->execute();
$articulos=$articulos->fetchAll(PDO::FETCH_ASSOC);




$sqlEntradas="SELECT p.nombreP,entra.metodoPago,entra.estado,entra.`idEntrada`,SUM(factu.cantidad*factu.costo) as totalCosto, entra.`fecha`, entra.`nFactura`, entra.`observacion`, entra.`idProve`, entra.`keyLaboratorio`, entra.`transporte`, entra.`idEstablecimiento` FROM `entrada` as entra 
left JOIN facturaentrada as factu on factu.idEntrada=entra.`idEntrada`
left JOIN proveedores as p on p.idProveedor=entra.idProve
where MONTH(entra.`fecha`)=MONTH(NOW()) and idEstablecimiento = 1
GROUP BY `idEntrada` order by entra.idEntrada desc";
$entradas=$conn->prepare($sqlEntradas);
$entradas->execute();
$entradas=$entradas->fetchAll(PDO::FETCH_ASSOC);


$sqlProveedores="SELECT * FROM `proveedores`";
$proveedores=$conn->prepare($sqlProveedores);
$proveedores->execute();
$proveedores=$proveedores->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras</title>
    <link rel="stylesheet" type="text/css" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">

</head>
<body>
    <header>
      <section>
        <?php require "../navBar/navCarpeta.php";?>
      </section>
    </header>
    <section>
    <div class="container">
    <div class="row">
    <div class="col">
    <a class="btn btn-default btn-rounded mb-4" data-toggle="modal" data-target="#addEntradaProducto">Nueva entrada</a>
    </div>
    </div>


<div class="table-responsive">
      <table class="table table-hover">
        <thead style="background: #da70b9d1;">
          <tr>
            <th style="font-weight: bold;" scope="col">N° factura</th>
            <th style="font-weight: bold;" scope="col">Observacion</th>
            <th style="font-weight: bold;" scope="col">Costo total</th>
            <th style="font-weight: bold;" scope="col">Metodo de pago</th>
            <th style="font-weight: bold;" scope="col">Proveedor</th>
            <th style="font-weight: bold;" scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($entradas as $key):?>
          <tr style="background:<?php echo ($key['estado']==0)?"#ffb3b3":""?>;" id="entrada<?php echo $key['idEntrada']?>">
            <td>Fecha <?php echo $key['fecha']?> <br> NRO: <?php echo $key['nFactura']?></td>
            <td><?php echo $key['observacion']?></td>
            <td><?php echo $key['totalCosto']?></td>
            <td><span style="padding:5%;border-radius:5px;background:#2bbbad;color:white;"><?php echo $key['metodoPago']?></span></td>
            <td><?php echo $key['nombreP']?></td>
            <td>
              <a href="detalleCompra.php?idEntrada=<?php echo $key['idEntrada']?>" class="btn btn-blue btn-sm">VER</a> 
              <a onclick="abrirModalBorrar(<?php echo $key['idEntrada']?>,'<?php echo $key['fecha'];?>','<?php echo $key['nFactura'];?>','<?php echo $key['observacion'];?>')" class="btn btn-danger btn-sm">x</a>
              <?php if($key['estado']==0){?>
                <a class="btn btn-success btn-sm" onclick="abrirModalPagarFactura(<?php echo $key['idEntrada']?>,<?php echo $key['totalCosto']?>)"><i class="fa-brands fa-google-pay fa-3x"></i></a>
              <?php }?>
            </td>
          </tr>
          <?php endforeach?>
        </tbody>
      </table>
</div>
















    </div>
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- Modal -->
<div class="modal fade right" id="addEntradaProducto" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="background: #4285f4;" class="modal-header">
        <h5 class="modal-title text-white" id="exampleModalPreviewLabel">Entrada de productos </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row">
          <div style="margin-left: 3%;" class="col-10">
              <form id="codActForm">
                <div class="md-form">
                  <input type="text" id="codigoBAc" class="form-control">
                  <label for="codigoBAc">Codigo de barra</label>
                </div>
            </form>
          </div>
      </div>
    <form action="newFactu.php" method="post">
      <div style="padding:0px;" class="modal-body">
     <div style="padding:2%;padding-bottom: 0px;" class="row">
      <div class="col">
        <div class="md-form">
          <input required type="text" id="form1" name="factura" class="form-control">
          <label for="form1">Numero de factura</label>
        </div>
      </div>
      <div class="col">
        <div class="md-form">
          <select required name="proveedor" class="browser-default custom-select">
            <option selected disabled value="">Provedores</option>
            <?php foreach ($proveedores as $key):?>
            <option value="<?php echo $key['idProveedor']?>"><?php echo $key['nombreP']?></option>
            <?php endforeach?>
          </select>
        </div>
      </div>
      <!-- <div class="col">
        <div class="md-form">
          <select required name="laboratorio" class="browser-default custom-select">
            <option selected disabled value="">Laboratorios</option>
            <?php foreach ($laboratorios as $key):?>
            <option value="<?php echo $key['idLaboratorio']?>"><?php echo $key['nombreLaboratorio']?></option>
            <?php endforeach?>
          </select>
        </div>
      </div> -->
      <div class="col-sm">
      <a href="../moduloProvedor/provedor.php" class="btn btn-blue btn-lg">Nuevo Provedor</a>
      <!-- <a href="../moduloLaboratorios/laboratorios.php" class="btn btn-blue btn-sm">Nuevo Laboratorio</a> -->
      </div>
      </div>
      <div class="col">
        <div class="md-form">
        <textarea id="form7" name="observacion" class="md-textarea form-control" rows="1"></textarea>
        <label for="form7">Observaciones</label>
      </div>
      </div>
   
      <div class="col">
      <div class="md-form text-center">



          <select autofocus onchange="addNewProductFrom(this.value)" class="mdb-select md-form" searchable="Buscar">
          <option value="" disabled selected>Productos</option>
          <?php foreach ($articulos as $key):?>
          <option value="<?php echo $key['articulo']?>"><?php echo $key['nombre']?> (<?php echo "En stock: ".$key['cantidad']?> <?php echo ($key['nombreP']=="")?"":"Proveedor: ".$key['nombreP']?> <?php echo " Galpon: ".$key['nombreEsta']?>)</option>
          <?php endforeach?>
          </select>



      </div>
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- <div class="row">
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="transporte" name="transporte" class="form-control">
                    <label for="transporte">Transporte</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="minoritario" name="minoritario" class="form-control">
                    <label for="minoritario">Por menor%</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <input required type="number" id="mayoritario" name="mayoritario" class="form-control">
                    <label for="mayoritario">Por mayor%</label>
                  </div>
              </div>
              <div class="col">
                  <div class="md-form">
                    <a class="btn btn-success btn-sm"><i class="fas fa-circle"></i></a>
                  </div>
              </div>
            </div> -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////// -->


        <!-- Shopping Cart table -->
        <div class="table-responsive">
        <table id="tablaEscondida" style="display:none;" class="table table-hover">
        <thead style="background:#00b8ffa3;">
        <!-- <th>imagen</th> -->
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Costo</th>
        <th>Porcentaje / precio de venta</th> 
        <th>Vencimiento</th> 
        <!-- <th>Venta por mayor</th> -->
        <th></th>
        </thead>
        <tbody id="addProducto">
        </tbody>
        </table>
        </div>
    
      </div>
      <div style="position:relative;" class="modal-footer">



        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Guardar</button>
       
      </div>
    </div>
  </div>
</div>

</form>
</div>
<!-- Modal -->
    <!-- ////////////////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////////////////// -->

    <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-notify modal-success" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Header-->
      <div class="modal-header">
        <p class="heading lead">Pagar factura</p>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="white-text">&times;</span>
        </button>
      </div>

      <!--Body-->
      <div class="modal-body">
        <form id="pagarFactura">
        <div class="text-center">
          <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
          <input type="text" style="display: none;" name="idFactura" id="idFactura">
          <input type="text" style="display: none;" name="totalFactura" id="totalFactura">
          <select name="metodoPago" required class="browser-default custom-select">
            <option selected value="" >Metodos de pago</option>
            <option value="Efectivo">Efectivo</option>
            <option value="Cuenta coriente">Cuenta coriente</option>
          </select>
          <br>
          <br>
          <h4 id="TOTALaPagar"></h4>
        </div>
      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center">
        <a type="button" class="btn btn-outline-success waves-effect" data-dismiss="modal">Cerrar</a>
        <button type="submit" class="btn btn-success">Confirmar pago</button>
        </form>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!-- Central Modal Medium Success-->
  



    <!-- ////////////////////////////////////////////////////////////////////// -->
    </section>


</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="compras.js?estrella=estrella"></script>
<script src="../localstorage/localstorage.js?pancholo=pancholo"></script>
<style>
li:hover{
    background:#33b5e5ab;
    color:white;
    border-radius: 8px;
}
.select-dropdown{
    position: absolute;
    top: 24px;
    left: 0px;
    background: white;
    z-index: 1;
    box-shadow: 0 11px 20px black;
    position: initial;
    list-style-type: none; 
    padding: 3%;
    max-height: 300px !important;
    overflow-y: scroll;/*le pones scroll*/
}
.initialized{
  display:none;
}
.caret{
  display:none;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none; 
  margin: 0; 
}
input[type=text]{
    text-transform:capitalize;
}
.modal-lg, .modal-xl {
    max-width: 976px;
}
</style>
</html>
  