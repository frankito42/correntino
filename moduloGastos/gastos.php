<?php 
session_start();
$local="";
require "../conn/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos</title>
    <link rel="stylesheet" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
    <link rel="stylesheet" href="../moduloCompras/datedropper/datedropper.css">
</head>
<body>
<section>
        <?php require "../navBar/navCarpeta.php"?>
    </section>
    <div class="container">
        <form id="filtroForm">
        <div class="row">
            <div class="col">
                <a data-toggle="modal" data-target="#modalGasto" class="btn btn-blue btn-lg">Nuevo gasto</a>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="formGroupExampleInput1">Fecha de inicio</label>
                    <input type="text" name="fecha" class="form-control" id="formGroupExampleInput1">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="formGroupExampleInput2">Fecha de fin</label>
                    <input type="text" name="fecha2" class="form-control" id="formGroupExampleInput2">
                </div>
            </div>
            <div class="col">
                <button class="btn btn-blue">Buscar</button>
            </div>
        </div>
        </form>
        <div  class="row text-center">
            <div class="col">
                <h3><span style="background: #33b5e5;border-radius: 5px;padding: 0.5%;box-shadow: 0px 0px 14px 1px #00000073;color: white;">Fecha de inicio <span id="fecha1"></span> hasta <span id="fecha2"></span> <a class="btn btn-blue btn-sm" href="imprimir.php" target="_blank">Imprimir</a></span></h3>
            </div>
        </div>
    <table class="table">
        <thead style="background: #1976d2;color: white;">
            <tr>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Monto</th>
            </tr>
        </thead>
        <tbody id="tebody"></tbody>
    </table>
    </div>
    
</body>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- <div class="modal fade right" id="addnew" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form id="newClient">
                <div style="background: #ea5aaa;" class="modal-header">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Ingresa los datos del Cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div style="background: white;" class="modal-body animated">
                        <div class="md-form">
                            <input type="text" id="nombre" name="nombre" class="form-control validate">
                            <label for="nombre">Nombre</label>
                        </div>
                        <div class="md-form">
                            <input type="number" id="dni" name="dni" class="form-control validate">
                            <label for="dni">DNI</label>
                        </div>
                        <div class="md-form">
                            <input type="number" id="celular" name="celular" class="form-control validate">
                            <label for="celular">Celular</label>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" style="background:#ea5aaa !important;" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Guardar</button>            
                </div>
                </form>
            </div>
        </div>
    </div>
 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<div class="modal fade right" id="modalGasto" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form id="newGasto">
                <div style="background: #ea5aaa;" class="modal-header">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Ingese los detalle del gasto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div style="background: white;" class="modal-body animated">
                        <div class="md-form">
                            <textarea id="detalle" name="detalle" class="md-textarea form-control" rows="3"></textarea>
                            <label for="detalle">Detalle</label>
                        </div>
                        <div class="md-form">
                            <input type="text" required id="monto" name="monto" class="form-control validate">
                            <label for="monto">Monto</label>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" style="background:#ea5aaa !important;" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>            
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->
    <!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="../moduloCompras/datedropper/datedropper.js"></script>
<script src="js/gastos.js"></script>
<script src="../localstorage/localstorage.js"></script>
</html>






    
  


