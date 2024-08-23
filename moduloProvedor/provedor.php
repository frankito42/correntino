<?php 
session_start();
$local="";
require "../conn/conn.php";
/* if(!isset($_SESSION['user'])){
    header("location:../Login/index.php");
} */
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
    <title>Proveedores</title>
</head>
<body>
    <section>
      <?php require "../navBar/navCarpeta.php";?>
    </section>
    <div class="container">
    <div style="margin-bottom: 1%;" class="row">
            <button class="btn btn-blue btn-lg" data-toggle="modal" data-target="#centralModalSuccess">Agregar proveedor</button>
        </div>
    </div>
    <div id="proveedores" class="container text-center text-white">
    
    </div>
</body>
<style>
.grey-bg {  
    background-color: #F5F7FA;
}
</style>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="centralModalSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div style="margin: 5.75rem auto !important;" class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div style="margin-left: 5%;margin-right: 5%;margin-top: -5%;box-shadow: 0px 0px 20px 0px #00000073;" class="modal-header">
         <p style="padding: 3%;" class="heading lead">Añadir un proveedor</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>
      <form>
       <!--Body-->
       <div class="modal-body">
          
          <div class="md-form">
            <input required type="text" name="nombreProveedor" id="nombreProveedor" value="" class="form-control">
            <label for="nombreProveedor">Nombre</label>
          </div>
          <div class="md-form">
            <input required type="text" name="direccionProveedor" id="direccionProveedor" value="" class="form-control">
            <label for="direccionProveedor">Direccion</label>
          </div>
          <div class="md-form">
            <input required type="number" name="telefonoProveedor" id="telefonoProveedor" value="" class="form-control">
            <label for="telefonoProveedor">Telefono</label>
          </div>
          <div class="md-form">
            <textarea required name="informacionExtra" id="informacionExtra" value="" class="md-textarea form-control" cols="30" rows="3"></textarea>
            <label for="informacionExtra">Informacion Extra</label>
          </div>

         </div>
       

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
         <a id="addNewproveedor" class="btn btn-success">Guardar</a>
       </div>
       </form>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
 <!-- Central Modal Medium Success -->
 <div class="modal fade" id="exito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-success" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p class="heading lead">Completado.</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-check fa-4x mb-3 animated rotateIn"></i>
           <p>Se añadio un proveedor correctamente.</p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer">
         <a type="button" class="btn btn-success waves-effect" data-dismiss="modal">Cerrar</a>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Success-->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
   aria-hidden="true">
   <div class="modal-dialog modal-notify modal-danger" role="document">
     <!--Content-->
     <div class="modal-content">
       <!--Header-->
       <div class="modal-header">
         <p id="tituloEliminarP" class="heading lead">Modal Danger</p>

         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true" class="white-text">&times;</span>
         </button>
       </div>

       <!--Body-->
       <div class="modal-body">
         <div class="text-center">
           <i class="fas fa-times fa-6x animated rotateIn"></i>
           <p>¿Esta seguro que desea eliminar este proveedor?</p>
         </div>
       </div>

       <!--Footer-->
       <div class="modal-footer justify-content-center">
         <a type="button" class="btn btn-blue" data-dismiss="modal">Cancelar</a>
         <div id="cambiarBoton">
         <a type="button" class="btn btn-danger">Eliminar</a>
         </div>
       </div>
     </div>
     <!--/.Content-->
   </div>
 </div>
 <!-- Central Modal Medium Danger-->
 <style>

input[type="text"]{
    text-transform:capitalize;
}
 </style>
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<!-- ////////////////////////////////////MODAL MODAL MODAL MODAL//////////////////////////////// -->
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="js/proveedor.js?pancholo=pancholo"></script>
<script src="../localstorage/localstorage.js?pancholo=pancholo"></script>
</html>