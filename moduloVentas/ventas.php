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
    <link rel="stylesheet" href="lib/toastr.min.css">
    <title>Inicio</title>
        <style>
        /* Estilo para el modal */
.modal.right .modal-dialog {
    position: fixed;
    right: 0;
    margin: auto;
    width: 400px;
    height: 100%;
    -webkit-transform: translate3d(0%, 0, 0);
    -ms-transform: translate3d(0%, 0, 0);
    transform: translate3d(0%, 0, 0);
}

/* Estilo para la transici贸n del modal */
.modal.right .modal-content {
    height: 100%;
    /* overflow-y: auto; */
}

/* Estilo para el bot贸n de cierre del modal */
.modal.right .modal-header .close {
    margin-top: 0;
}

.hoverProduct{
  cursor: pointer;
}
.hoverProduct:hover{
    background: #2db6e8;
    color: white;
}
#circulo {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 700px;
      height: 700px;
      background-color: blue;
      border-radius: 100%;
      display:none;
      opacity: 0;
      z-index: 9999;
      transition: all 0.5s ease-in-out;
    }
    #circulo.activo {
      width: 150%;
      height: 150%;
      opacity: 1;
    }
    #texto {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 300%;
      text-align: center;
      background: #0000d6;
      padding: 1%;
      border-radius: 10px;
    }
#circuloPago {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 700px;
      height: 700px;
      background-color: #3fbb3f;
      border-radius: 100%;
      display:none;
      opacity: 0;
      z-index: 9999;
      transition: all 0.5s ease-in-out;
    }
    #circuloPago.activo {
      width: 150%;
      height: 150%;
      opacity: 1;
    }
    #textoPago {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      font-size: 300%;
      text-align: center;
      background: #2f9d2f;
      padding: 1%;
      border-radius: 77px;
    }
    .inputVenta{
      width: 100%;
      border: 2px solid;
      outline: none;
      text-align: center;
      padding: 2%;
      border-radius: 5px;
      border-color: #32cfd7;
    }
    .subTotalTable{
      display: flex;
      justify-content: center;
      align-items: center;
      height: 60px;
    }
    th div{
      background: #0092a5;
      border-radius: 5px;
      color: #ffffff;
      padding: 5px;
    }
    thead{
      background: #00bcd4;
    }
    tr th:first-child {
    border-radius: 6px 0px 0px 0px;
}
tr th:last-child {
    border-radius: 0px 6px 0px 0px;
}
.modal-dialog {
    max-width: 650px;
    margin: 1.75rem auto;
}
.disbledDescuento{
    
}
    </style>
</head>
<body id="enterSi">
  <div id="circulo">
    <div id="texto">
      <i class="fa-solid fa-qrcode"></i>
      <span>Esperando pago...</span>
      <br>
      <span>Total <span id="totalQR"></span></span>
      <br>
      <button onclick="cerrarDiv()" class="btn btn-blue" style="text-align: center;border-radius: 5px;border: 0px;">Cancelar</button>
    </div>
  </div>
  <div id="circuloPago">
    <div id="textoPago">
      <i class="fa-solid fa-qrcode"></i>
      <span>Pago Exitoso!</span>
    </div>
  </div>
    <section>
        <?php require "../navBar/navCarpeta.php";?>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <button class="btn btn-blue" id="abrirModalBuscarProductoBtn">Buscar por nombre</button>
                </div>
                <div class="col-sm-3">
                    
                    
                    
                      <button class="btn btn-cyan btn-sm" id="montoExtra" href="#">Monto extra</button>
                      <button class="btn btn-cyan btn-sm" id="extraPorciento5" href="#">Tarjeta</button>
                   
 
                </div>
                <div style="background: #00ff89;border-radius: 5px;padding: 0.5%;box-shadow: 0px 0px 20px 3px #00000014;" class="col-sm-6 text-center">
                    <h2 style="color:white;text-shadow: 1px 1px 1px darkslategrey;">$<span id="segundoTotal" style="color: white;text-shadow: 1px 1px 1px darkslategrey;">0</span></h2>
                </div>
            </div>
            
            <br>
            <div class="row">
                    <div class="col-8">
                        <div class="md-form md-outline input-with-pre-icon">
                        <!-- <i class="fas fa-envelope  input-prefix"></i> -->
                        <i class="fas fa-barcode input-prefix"></i>
                        <input autofocus style="font-size: 125%;" type="number" id="codigoDeBarra" class="form-control">
                        <label for="codigoDeBarra">Codigo de barra</label>
                        </div> 
                    </div>
                    <div style="display: flex;align-items: center;" class="col">
                        <button id="btnEscanear" class="btn btn-blue btn-sm"><i class="fas fa-camera fa-3x"></i></button>  
                    </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-sm table-hover">
                    <thead>
                        <th class="font-weight-bold"><div style="width: 100%;">Nombre</div></th>
                        <th class="font-weight-bold text-center"><div style="width: 100%;">Cantidad</div></th>
                        <th class="font-weight-bold text-center"><div style="width: 100%;">Precio</div></th>
                        <th class="font-weight-bold text-center"><div style="width: 100%;">Descuento</div></th>
                        <th class="font-weight-bold text-center"><div style="width: 100%;">subTotal</div></th>
                        <th class="font-weight-bold text-center"><div style="width: 100%;">accion</div></th>
                    </thead>
                    <tbody id="ProductosVender"> 
                        
                    </tbody>
                    <tfoot>
                        <td class="font-weight-bold" colspan="4">TOTAL $</td>
                        <td class="text-center"><h4 id="total">0</h4></td>
                        <td></td>
                    </tfoot>
                </table>
            </div> 
            <button id="btnGuardarVenta" class="btn btn-blue">Cobrar</button>
          
        </div>
    </section>
    
    <section>
    <!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="pregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Desea terminar la operacion?</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body text-center">
        <div class="row">
          <div class="col">
            <h2>Total $<span id="totalDescont"></span></h2>
            <div class="md-form form-group">
                      <input style="text-align: center;font-size: 200%;" type="text" id="cobro" class="form-control validate">
                      <label style="font-size: 200%;" for="cobro" class="">Monto</label>
              </div>
            <h2 id="vuelto"></h2>
          </div>
        </div>
         
         <!-- <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
      
         </div> -->
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
         <button class="btn btn-success waves-effect" id="imprimeTicket">Cobrar</button>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->


<div class="modal fade" id="mostarProductElegir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div style="background: #2db6e8;color: white;" class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="background: #01d4ff;
    padding: 1%;
    border-radius: 5px;">Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div id="eligeProductoNombre" class="modal-body">
                 <div style="margin: -2%;" class="md-form form-group">
                    <i class="fa fa-search prefix"></i>
                    <input type="text" id="filtroProductos" class="form-control validate">
                    <label for="filtroProductos" >Nombre del producto</label>
                </div>
                <table id="mytable" class="table table-sm">
                    <thead style="background: #2db6e8;color: #005776;">
                        <tr> 
                        <th style="font-weight: bold;" scope="col">Nombre</th>
<!--                         <th scope="col">Precio en pesos</th> -->
                        <th style="font-weight: bold;" scope="col">Cantidad</th>
                        
                        <th style="font-weight: bold;" scope="col">Precio</th>
                        </tr>
                    </thead>
                    <tbody id="aquiMostrarTodo">
                        
                    </tbody>
                    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<div class="modal fade" id="metodoDePago" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-info" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p style="background: #01d4ff;
    padding: 1%;
    border-radius: 5px;" class="heading lead">Seleccionar el metodo de pago</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
        
              <div  class="row text-center">
                <div onclick="numeroClick('1')" style="display:relative;" class="col-6 mb-4">
                  <h4 class="waves-effect waves-ligh" style="background-image: linear-gradient(to left bottom, #0ebe08, #10c110, #03ab07, #33c339, #12eb21);color: white;border-radius: 5px;padding: 10%;box-shadow: 0px 0px 20px 0px #00000078;">Efectivo</h4>
                  <div class="waves-effect waves-ligh" style="background-image: linear-gradient(to left bottom, #0ebe08, #10c110, #03ab07, #33c339, #12eb21);box-shadow: 0px 0px 3px 0px #00000078;border-radius: 5px;color: white;">Nro 1</div>
                </div>
                <div onclick="numeroClick('2')" style="display:relative;" class="col-6 mb-4">
                  <h4 class="waves-effect waves-ligh aqua-gradient" style="color: white;border-radius: 5px;padding: 10%;box-shadow: 0px 0px 20px 0px #00000078;">Libreta</h4>
                  <div class="waves-effect waves-ligh aqua-gradient" style="box-shadow: 0px 0px 3px 0px #00000078;border-radius: 5px;color: white;">Nro 2</div>
                </div>
                <div onclick="numeroClick('3')" style="display:relative;" class="col-6 mb-4">
                  <h4 class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;color: white;border-radius: 5px;padding: 10%;box-shadow: 0px 0px 20px 0px #00000078;">MP/Tarjeta etc.</h4>
                  <div class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;box-shadow: 0px 0px 3px 0px #00000078;border-radius: 5px;color: white;">Nro 3</div>
                </div>
                <div onclick="numeroClick('4')" style="display:none;" class="col-6 mb-4">
                  <h4 class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;color: white;border-radius: 5px;padding: 10%;box-shadow: 0px 0px 20px 0px #00000078;"><i class="fa-solid fa-qrcode"></i></h4>
                  <div class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;box-shadow: 0px 0px 3px 0px #00000078;border-radius: 5px;color: white;">Nro 4</div>
                </div>
                <div onclick="numeroClick('5')" style="display:relative;" class="col-6 mb-4">
                  <h4 class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;color: white;border-radius: 5px;padding: 10%;box-shadow: 0px 0px 20px 0px #00000078;"><i class="fa-solid fa-qrcode"></i></h4>
                  <div class="waves-effect waves-ligh blue-gradient" style="background: #33cce5;box-shadow: 0px 0px 3px 0px #00000078;border-radius: 5px;color: white;">Nro 5</div>
                </div>
              </div>
        
       </div>

       <!--Footer-->
       <!-- <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
         <button class="btn btn-success waves-effect" >Cobrar</button>
       </div> -->
     </div>
     <!--/.Content-->
   </div>
 </div>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->









<div class="modal fade" id="modalPagoDoble" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <form id="formPagoDoble">
       <div class="modal-header">
         <p style="background: #4ed584;
    padding: 1%;
    border-radius: 5px;" class="heading lead">Pago efectivo y transferencia</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
        
            <div class="row">
              <div class="col-12 text-center">
                <h2 style="background: #dbdbdb52;padding: 1%;border-radius: 5px;">Total: $<span id="totalPagoDoble"></span></h2>
              </div>
              <div class="col-12 text-center">
                <div class="md-form form-group">
                    <input onkeyup="efectAtranferencia()" style="text-align: center;font-size: 200%;" type="text" id="cobroEfectivo" class="form-control validate">
                    <label style="font-size: 200%;" for="cobroEfectivo" class="active">Monto Efectivo</label>
                </div>
              </div>
              <div class="col-12 text-center">
                <div class="md-form form-group">
                    <input style="text-align: center;font-size: 200%;" type="text" value="0" id="cobroTransferencia" class="form-control validate">
                    <label style="font-size: 200%;" for="cobroTransferencia" class="active">Monto Transferencia</label>
                </div>
              </div>
            </div>
        
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
         <button type="submit" class="btn btn-success waves-effect" >Guardar venta</button>
        </div>
      </div>
    </form>
     <!--/.Content-->
   </div>
 </div>


<div class="modal fade" id="libreta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <form id="addLibretaIntegranteProducto">
       <div class="modal-header">
         <p style="background: #4ed584;
    padding: 1%;
    border-radius: 5px;" class="heading lead">Seleccionar el cliente</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
       <!--Body-->
       <div class="modal-body">
        
            <div class="row">
              <div class="col text-center">
                <h3>Total $<span id="totalLibreta">Cargando...</span></h3>
              </div>
            </div>
            <div class="row">
              <div class="col text-center">
                <select required id="listarIntegrantes" name="idDeInteGra" class="browser-default custom-select">
                </select>
              </div>
            </div>
        
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
         <button id="addLibretaBtnInte" class="btn btn-success waves-effect" >Agregar a su libreta</button>
         </form>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>





<div class="loader">
  <div class="spinner"></div>
</div>


<div style="position: fixed;bottom: 1%;right: 1%;">
    <button id="printFacturaX" class="btn" style="background:#19c9d2e3;"><i class="fa-solid fa-file-invoice-dollar fa-2x"></i></button>
    
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#MiCajaOnline">
  Ver Mi Caja
</button>
    
    </div>





<style>
    .loader {
  position: fixed;
  z-index: 9999;
  background-color: rgba(0, 0, 0, 0.5);
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}

.spinner {
  border: 4px solid rgba(255, 255, 255, 0.3);
  border-top: 4px solid #ffffff;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
@keyframes shrink {
    from { width: 100%; }
    to { width: 5%; }
}

@keyframes disappear {
    from { transform: translateX(0); opacity: 1; }
    to { transform: translateX(-100%); opacity: 0; }
}

#noWifi {
    animation-name: shrink;
    animation-duration: 3s;
}

#noWifi.disappear {
    animation-name: disappear;
    animation-duration: 2s;
}


</style>

<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// --> 
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
    </section> 
     
     
   <!-- 
        if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js')
            .then(function(registration) {
              console.log('Service Worker registrado con éxito:', registration);
            })
            .catch(function(error) {
              console.log('Error al registrar el Service Worker:', error);
            });
        }
    -->
   <script> 
    
    if ('serviceWorker' in navigator) {
          navigator.serviceWorker.register('sw.js')
            .then(function(registration) {
              console.log('Service Worker registrado con éxito:', registration);
            })
            .catch(function(error) {
              console.log('Error al registrar el Service Worker:', error);
            });
        }
   
    </script>
    







  <img id="noWifi" style="display:none;position: fixed;bottom: 1%;left: 1%;width: 5%;" src="no-wifi.png">  
</body>









<!-- Modal -->
<div class="modal fade right" id="MiCajaOnline" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div style="background: #33b5e5;color: white;" class="modal-header">
        <h5 class="modal-title" style="    background: #01d4ff;border-radius: 5px;padding: 1%;" id="exampleModalLabel">Mi Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div style="height: 0% !important" class="modal-body" id="cajaVenta">

      </div>
      <div style="display: flex;justify-content: space-around;">
        <button type="button" class="btn btn-blue btn-sm">Total Ventas <span id="totalVEntasModalCaja"></span></button>
        <button type="button" class="btn btn-danger btn-sm" id="subirOfflinesAll">offLine <span id="totalVEntasModalCajaOffLine"></span></button>
        <a id="exportar" class="btn btn-secondary btn-sm">Exp. excel</a> 
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Minimizar</button>
      </div>
    </div>
  </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalCreditos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header purple-gradient">
        <h5 class="modal-title" id="exampleModalLabel">Creditos-Cuotas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <div class="md-form form-group mt-5">
              <input style="font-size: 200%;font-weight: bold;text-align: center;" type="number" class="form-control" id="entregaCredito" placeholder="">
              <label for="entregaCredito">Entrega</label>
            </div>
          </div>
          <div class="col-12">
              <!-- Group of default radios - option 1 -->
              <div class="custom-control custom-radio">
                <input onchange="chequeado(2)" type="radio" class="custom-control-input" id="defaultGroupExample1" name="groupOfDefaultRadios">
                <label class="custom-control-label" for="defaultGroupExample1">En 2 cuotas</label>
              </div>

              <!-- Group of default radios - option 2 -->
              <div class="custom-control custom-radio">
                <input onchange="chequeado(3)" type="radio" class="custom-control-input" id="defaultGroupExample2" name="groupOfDefaultRadios" checked>
                <label class="custom-control-label" for="defaultGroupExample2">En 3 cuotas</label>
              </div>

              <!-- Group of default radios - option 3 -->
              <div class="custom-control custom-radio">
                <input onchange="chequeado(4)" type="radio" class="custom-control-input" id="defaultGroupExample3" name="groupOfDefaultRadios">
                <label class="custom-control-label" for="defaultGroupExample3">En 4 cuotas</label>
              </div>
              <!-- Group of default radios - option 3 -->
              <div class="custom-control custom-radio">
                <input onchange="chequeado(5)" type="radio" class="custom-control-input" id="defaultGroupExample4" name="groupOfDefaultRadios">
                <label class="custom-control-label" for="defaultGroupExample4">En 5 cuotas</label>
              </div>
              <!-- Group of default radios - option 3 -->
              <div class="custom-control custom-radio">
                <input onchange="chequeado(6)" type="radio" class="custom-control-input" id="defaultGroupExample5" name="groupOfDefaultRadios">
                <label class="custom-control-label" for="defaultGroupExample5">En 6 cuotas</label>
              </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>








<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/popper.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="lib/toastr.min.js"></script>
<script src="../localstorage/localstorage.js"></script>
<script src="js/ventas.js"></script>
<script src="script.js"></script>

<style>
  .hoverCaja:hover{
  background:#bbbbbb !important;
}
</style>
</html>