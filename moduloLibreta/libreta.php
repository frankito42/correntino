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
    <link rel="stylesheet" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
    <link rel="stylesheet" href="../lib/toastr.min.css">
    <title>Inicio</title>
</head>
<body>
  <style>
    .pagado{
      display: flex;
      background: #defdca;
      padding: 1%;
      border-radius: 5px;
      font-weight: bold;
      color: #34af16;
      text-align: center;
      justify-content: space-between;
      margin: 1%;
      box-shadow: 1px 1px 1px 1px #41b523;
    }
    .pendiente{
      display: flex;
      background: #fdcaca;
      padding: 1%;
      border-radius: 5px;
      font-weight: bold;
      color: #af1616;
      text-align: center;
      justify-content: space-between;
      margin: 1%;
      box-shadow: 1px 1px 1px 1px #b52323;
    }
  </style>
    <section>
        <?php require "../navBar/navCarpeta.php";?>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 amber-border" type="text" placeholder="Buscar familia" id="tableSearch" aria-label="Search">
                        <div class="input-group-append">
                            <span class="input-group-text amber lighten-3" id="basic-text1"><i class="fas fa-search text-grey"
                                aria-hidden="true"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table id="myTable" class="table">
                        <thead style="background: #467baf;
    color: white;">
                            <tr>
                                <th>Nombre de la familia</th>
                                <th>Accion</th>
                            </tr>
                        </thead>
                        <tbody id="listarFamiliasAllTabla">

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- <div id="" class="row">
            
            </div> -->
        </div>
    </section>

    
</body>
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
input[type="text"]{
    text-transform:capitalize;
}
.card.card-cascade .view.view-cascade.gradient-card-header {
    padding: 1.6rem 1rem;
    color: #fff;
    text-align: center;
}
.card.card-cascade .view.view-cascade {
    border-radius: 0.25rem;
    -webkit-box-shadow: 0 5px 11px 0 rgb(0 0 0 / 18%), 0 4px 15px 0 rgb(0 0 0 / 15%);
    box-shadow: 0 5px 11px 0 rgb(0 0 0 / 18%), 0 4px 15px 0 rgb(0 0 0 / 15%);
}
.peach-gradient {
    background: linear-gradient(40deg,#ffd86f,#fc6262) !important;
}
.card.card-cascade.wider .card-body.card-body-cascade {
    z-index: 1;
    margin-right: 4%;
    margin-left: 4%;
    background: #fff;
    border-radius: 0 0 0.25rem 0.25rem;
    -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}
.card-body {
    padding-top: 1.5rem;
    padding-bottom: 1.5rem;
    border-radius: 0 !important;
}
.card-body {
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1.25rem;
    
}
.card.card-cascade.wider {
    background-color: transparent;
    -webkit-box-shadow: none;
    box-shadow: none;
    border:none;
}
.card {
    font-weight: 400;
    border: 0;
    -webkit-box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
    box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}
.card.card-cascade.wider .view.view-cascade {
    z-index: 2;
}
.view {
    position: relative;
    overflow: hidden;
    cursor: default;
}
.card {
    position: relative;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 1px solid rgba(0,0,0,0.125);
    border-radius: 0.25rem;
}
.bold{
    font-weight: bold !important;
    text-decoration: underline;
}
</style>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->
<!-- Modal -->
<div class="modal fade" style="z-index:9999999999;" id="pagarLibreta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formPagarLibreta">
    <div class="modal-content">
      <div style="color: white;background: #4285f4;" class="modal-header">
        <h5 class="modal-title" id="titulo"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12 text-center">
                <h3>Total pendiente $<span id="total"></span></h3> 
            </div>
            <div class="col-12">
                <div class="md-form">
                    <input style="display:none;" type="number" id="idFamiliaLibreta" name="idFamilia" class="form-control text-center">
                    <input style="display:none;" type="number" id="idLibretaTabla" name="idLibretaTabla" class="form-control text-center">
                    <input type="number" step="any" id="pagoCon" name="pagoCon" class="form-control text-center">
                    <label for="pagoCon">Monto</label>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <a type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</a>
        <button type="submit" id="pagarLibre" class="btn btn-primary">Pagar</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->

<div class="modal fade" id="modalMostrarLaLibreta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div style="background: #ffffffa6;" class="modal-content">
    
      <div class="modal-body">
        <div id="libreta" class="row">
            
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->
<!-- /////MODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODALMODAL//// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- Modal -->
<div class="modal fade" id="historialModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-center">
      <div class="modal-header" style="color: white;background: #4285f4;">
        <h5 class="modal-title" id="exampleModalLabel">Historial de libreta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div id="listarHistorial" class="col">

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
<!--         <button type="button" class="btn btn-primary">Save changes</button>
 -->      </div>
    </div> 
  </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script> 
<script src="../mdb/js/all.min.js"></script>
<script src="../lib/toastr.min.js"></script>
<script src="js/libreta.js?capiti=capiti"></script>
<script src="../localstorage/localstorage.js?pancholo=pancholo"></script>

</html>  