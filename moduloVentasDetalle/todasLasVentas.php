<?php 
session_start();
$local="";
require "../conn/conn.php";
$fecha=date("Y-m-d");
?>
<script>
let fechaaaa="<?php echo $fecha;?>"
localStorage.setItem("fechaHoy",fechaaaa)
</script>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../lib/toastr.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
    <title>Inicio</title>
</head>
<body>
    <section>
        <?php require "../navBar/navCarpeta.php";?>
    </section>
    <div class="container">
    <!-- Section: Block Content -->
    

    <div style="margin-top: 1%;
    margin-bottom: 1%;" class="row">
        <div class="col">
        <span style="background: #22a226;
    color: white;
    font-weight: bold;
    border-radius: 5px;
    padding: 1%;">GANANCIA BRUTA: <span id="ganBru"></span></span>
        </div>
    </div>





    <section>

    
        <style>
            .footer-hover {
            background-color: rgba(0, 0, 0, 0.1);
            -webkit-transition: all .3s ease-in-out;
            transition: all .3s ease-in-out
            }

            .footer-hover:hover {
            background-color: rgba(0, 0, 0, 0.2)
            }

            .text-black-40 {
            color: rgba(0, 0, 0, 0.4)
            }
            .noselect {
                -webkit-touch-callout: none; /* iOS Safari */
                -webkit-user-select: none; /* Safari */
                -khtml-user-select: none; /* Konqueror HTML */
                -moz-user-select: none; /* Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
                user-select: none; 
            }
        </style>

    <!-- Grid row -->
    <div class="row justify-content-center">

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card primary-color white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p id="masVendido" class="h2-responsive font-weight-bold mt-n2 mb-0"></p>
                    <p class="mb-0">El mas vendido</p>
                </div>
            <div>
                <i class="fas fa-shopping-bag fa-4x text-black-40"></i>
            </div>
            </div>
                <a id="modalMasVendi" class="card-footer footer-hover small text-center white-text border-0 p-2">Mas informacion<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card warning-color white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p id="ventasDelDia" class="h2-responsive font-weight-bold mt-n2 mb-0"></p>
                <p class="mb-0">Ventas del dia</p>
            </div>
            <div>
                <!-- <i class="fas fa-chart-bar fa-4x text-black-40"></i> -->
                <i class="fas fa-dollar-sign fa-4x text-black-40"></i>
            </div>
            </div>
            <a class="card-footer footer-hover small text-center white-text border-0 p-2">Mas informacion<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card pink lighten-3 white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p id="costo" class="h2-responsive font-weight-bold mt-n2 mb-0">$0</p>
                <p class="mb-0">Costo mensual</p>
            </div>
            <div>
                <!-- <i class="fas fa-user-plus fa-4x text-black-40"></i> -->
                <i class="fas fa-dollar-sign fa-4x text-black-40"></i>
            </div>
            </div>
            <a id="abarirModalCostos" class="card-footer footer-hover small text-center white-text border-0 p-2">Mas informacion<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-6 col-lg-3 mb-4">

        <!-- Card -->
        <div class="card light-blue lighten-1 white-text">
            <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <p id="ventasDelMes" class="h2-responsive font-weight-bold mt-n2 mb-0"></p>
                <p class="mb-0">Ventas del mes</p>
            </div>
            <div>
                <!-- <i class="fas fa-user-plus fa-4x text-black-40"></i> -->
                <i class="fas fa-dollar-sign fa-4x text-black-40"></i>
            </div>
            </div>
            <a id="modalMesVendi" class="card-footer footer-hover small text-center white-text border-0 p-2">Mas informacion<i class="fas fa-arrow-circle-right pl-2"></i></a>
        </div>
        <!-- Card -->

        </div>
        <!-- Grid column -->
        

    </div>
    <!-- Grid row -->
    <div class="card">
      <div class="card-body">
        <div class="row">
                <div class="col">
                    <h5 style="background: #00b2de;
    color: white;
    border-radius: 5px;
    padding: 1%;" id="cambiarPorElFiltro" class="text-center font-weight-bold mb-4">Ventas del dia <?php echo date("d-m-Y l")?></h5>
                </div>
        </div>
        <div class="row">
                <div class="col">
                    <input type="date" id="fechaI" value="<?php echo date("Y-m-d")?>" placeholder="Fecha Inicio" class="form-control">
                </div>
                <div class="col">
                    <input type="date" id="fechaF" value="<?php echo date("Y-m-d")?>" placeholder="Fecha Fin" class="form-control">
                </div>
        </div>

        <hr>

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div id="listaVentas" class="col-12 mb-3 mx-auto">
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- /////////////////////////lista de ventas js js////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
            <!-- //////////////////////////////////////////////////////////////////////////// -->
          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

        <hr>

        <p class="text-center mt-4 mb-1"><a href="#!">Wiew All Products</a></p>

      </div>
    </div>


    </section>
    <!-- Section: Block Content -->
        </div>
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->

    <!-- To change the direction of the modal animation change .right class -->
<div class="modal fade left" id="totalMesesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-left (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side" role="document">


    <div class="modal-content">
      <div style="background: #1ab51a;color: white;" class="modal-header">
        <h4 class="modal-title w-100" id="myModalLabel">Ventas de todos los meses</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="totalMeses" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <div class="modal fade left" id="modalTotalMesesCostos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">

  <!-- Add class .modal-side and then add class .modal-top-left (or other classes from list above) to set a position to the modal -->
  <div class="modal-dialog modal-side" role="document">


    <div class="modal-content">
      <div style="color: white;" class="modal-header pink lighten-3">
        <h4 class="modal-title w-100" id="myModalLabel">Costos de todos los meses</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="totalMesesCostos" class="modal-body">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
    <!-- //////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////// -->
    
    <h4 style="background: #33b5e5;position: fixed;bottom: 0%;color: white;padding: 1%;box-shadow: 0px 0px 20px 10px #00000040;border-radius: 0px 5px 5px 0px;">Total ventas <span id="totalVentNumerando">...</span></h4>
</body>
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="../lib/toastr.min.js"></script>
<script src="js/todasLasVentas.js?aurora=aurora"></script>
<script src="../localstorage/localstorage.js?aurora=aurora"></script>

</html>