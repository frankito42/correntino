<nav class="mb-1 navbar navbar-expand-lg navbar-dark navBarXd">
        <a class="navbar-brand" href="#"><?php echo $local["nombre"]?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link waves-effect waves-light" href="index.php">inicio
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li id="stockOcultar" class="nav-item dropdown <?php echo (isset($_GET['stock']))?$_GET['stock']:""?>">
                  <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos
                  </a>
                  <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-5">
                  <a class="dropdown-item waves-effect waves-light" href="moduloStock/stock.php?stock=active">Stock</a>
                  <a class="dropdown-item waves-effect waves-light" href="moduloCategorias/categorias.php?stock=active">Categorias</a>
                  <!-- <a class="dropdown-item waves-effect waves-light" href="#">Something else here</a> -->
                  </div>
              </li>
            <li id="comprasOcultar" class="nav-item <?php echo (isset($_GET['compras']))?$_GET['compras']:""?>">
                <a class="nav-link waves-effect waves-light" href="moduloCompras/compras.php?compras=active">Compras</a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['v']))?$_GET['v']:""?>">
                <a class="nav-link waves-effect waves-light" href="moduloVentas/ventas.php?v=active">Ventas</a>
            </li>
            <li class="nav-item <?php echo (isset($_GET['lib']))?$_GET['lib']:""?>">
                <a class="nav-link waves-effect waves-light" href="moduloLibreta/libreta.php?lib=active">Libreta</a>
              </li>
            <li id="cajaOcultar" class="nav-item dropdown <?php echo (isset($_GET['admin']))?$_GET['admin']:""?>">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Admin
                </a>
                <div class="dropdown-menu dropdown-default" aria-labelledby="navbarDropdownMenuLink-3">
                  <a class="dropdown-item waves-effect waves-light" href="moduloProvedor/provedor.php?admin=active">Proveedores</a>
                 <!--  <a class="dropdown-item waves-effect waves-light" href="moduloLaboratorios/laboratorios.php?admin=active">Laboratorios</a> -->   
                  <a class="dropdown-item waves-effect waves-light" href="moduloClientes/clientes.php?admin=active">Clientes</a>
                  <a class="dropdown-item waves-effect waves-light" href="moduloGastos/gastos.php?admin=active">Gastos</a>
               <a class="dropdown-item waves-effect waves-light" href="moduloVentasDetalle/todasLasVentas.php?admin=active">Caja</a>
                </div>
            </li>
            </ul>
            <ul class="navbar-nav ml-auto">
           <!--  <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="#">
                <i class="fas fa-envelope"></i> Contacto
                <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light" href="#">
                <i class="fas fa-gear"></i> Configuraciones</a>
            </li> -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light" id="navbarDropdownMenuLink-4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i> <span id="userNameID"></span> </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-info" aria-labelledby="navbarDropdownMenuLink-4">
                <!-- <a class="dropdown-item waves-effect waves-light" href="#">My account</a> -->
                <a class="dropdown-item waves-effect waves-light" id="cerrarSession">Cerrar sesion</a>
                </div>
            </li>
            </ul>
        </div>
        </nav>