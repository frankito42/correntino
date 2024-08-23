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
    <title>Clientes</title>
    <link rel="stylesheet" href="../mdb/css/bootstrap.min.css">
    <link rel="stylesheet" href="../mdb/css/mdb.min.css">
    <link rel="stylesheet" href="../mdb/css/all.min.css">
</head>
<body>
    <section>
        <?php require "../navBar/navCarpeta.php";?>
    </section>
    <div class="container">
    <button data-toggle="modal" data-target="#addnewFamily" class="btn btn-blue btn-lg">Nuevo cliente</button>
    <table class="table">
        <thead style="background: #1976d2;color: white;">
            <tr>
                <th>Libretas</th>
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
<div class="modal fade right" id="addnewFamily" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content text-white">
                <form id="newFamilia">
                <div style="background: #ea5aaa;" class="modal-header">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Ingresa el nombre de la familia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div style="background: white;" class="modal-body animated">
                        <div class="md-form">
                            <input type="text" required id="nombreCliente" name="nombreCliente" class="form-control validate">
                            <label for="nombreCliente">Nombre de la familia</label>
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
<div class="modal fade right" id="integrantes" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                
                <div style="background: #ea5aaa;" class="modal-header text-white">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Integrantes flia <span id="nombreFamilu">Cargando...</span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <form id="integranteNew">
                        <div class="row">
                            <div class="col-8">
                                <div class="md-form">
                                    <input style="display:none;" id="idFami" name="idFami" class="form-control">
                                    <input type="text" required id="n" name="n" class="form-control validate">
                                    <label for="n">Ingresa el nombre del integrante</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="md-form">
                                    <button type="submit" class="btn btn-blue">guardar</button>
                                </div>
                            </div>
                        </div>
                        </form> 
                        <hr>
                        <h3 class="text-center">Integrantes</h3>
                        <hr>
                        <div class="row text-center">
                            <div id="listaIntegrantes" class="col">
                                <h3>Cargando...</h3>
                            </div>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" style="background:#ea5aaa !important;" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<div class="modal fade right" id="editFamiliaName" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                
                <form id="fromEditName">
                <div style="background: #ea5aaa;" class="modal-header text-white">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Editar nombre de familia</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="md-form">
                                    <input style="display:none;" id="editNameFamiId" name="editNameFamiId" class="form-control">
                                    <input type="text" required id="editName" name="editName" class="form-control validate">
                                    <label for="editName" id="editNameLabel">Nombre de la famila</label>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="background:#ea5aaa !important;" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-blue">guardar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////// -->
    <!-- ////////////////////////////////////////////////////////// -->
<div class="modal fade right" id="editaNameModalInte" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                
                <form id="fromEditNameInte">
                <div style="background: #ea5aaa;" class="modal-header text-white">
                    <h5 class="modal-title" id="exampleModalPreviewLabel">Editar nombre de integrante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="md-form">
                                    <input style="display:none;" id="idInte" name="idInte" class="form-control">
                                    <input type="text" required id="editNameInte" name="editNameInte" class="form-control validate">
                                    <label for="editNameInte" id="editNameLabelInte">Nombre del integrante</label>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" style="background:#ea5aaa !important;" class="btn btn-blue" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-blue">guardar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////7 -->
<script src="../mdb/js/jquery.min.js"></script>
<script src="../mdb/js/bootstrap.min.js"></script>
<script src="../mdb/js/mdb.min.js"></script>
<script src="../mdb/js/all.min.js"></script>
<script src="js/clientes.js?pancholo=pancholo"></script>
<script src="../localstorage/localstorage.js?pancholo=pancholo"></script>
</html>






    
  


