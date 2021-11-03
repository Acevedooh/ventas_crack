        <!-- Main Sidebar Container -->
        <aside class="main-sidebar main-sidebar-custom sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="views/assets/index3.html" class="brand-link">
                <img src="views/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Ventas - CRACKS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">



                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="/ventas_crack/index.php?route=escritorio" <?php if ($_GET['route'] == "escritorio") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                <i class="far fa-circle nav-icon"></i>
                                <p>ESCRITORIO</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    MANTENIMIENTO
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=adminEmpleado" <?php if ($_GET['route'] == "adminEmpleado") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Empleados</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=clientes" <?php if ($_GET['route'] == "clientes") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin. Clientes</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=comprobante" <?php if ($_GET['route'] == "comprobante") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Comprobante</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=provedores" <?php if ($_GET['route'] == "provedores") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin. Provedores</p>
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=administracionProductos" <?php if ($_GET['route'] == "administracionProductos") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Admin. Productos</p>
                                    </a>
                                </li> -->


















                            </ul>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    CONTACTOS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=contactos" <?php if ($_GET['route'] == "adminEmpleado") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Todos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=contactos&type=cliente" <?php if ($_GET['route'] == "clientes") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Cliente</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=contactos&type=proveedor" <?php if ($_GET['route'] == "proveedores") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Provedor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=provedores" <?php if ($_GET['route'] == "provedores") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Solicitudes</p>
                                    </a>
                                </li>

                            </ul>
                        </li>


                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    INVENTARIO
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=almacen" <?php if ($_GET['route'] == "almacen") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Almace</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=productos" <?php if ($_GET['route'] == "productos") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Producto</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=unidad" <?php if ($_GET['route'] == "clientes") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Unidad</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=categoria" <?php if ($_GET['route'] == "categoria") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Categoria</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=administracionProductos" <?php if ($_GET['route'] == "administracionProductos") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p> Sub Categoria</p>
                                    </a>
                                </li>
                            </ul>
                        </li>







                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    COMPRAS
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=compras" <?php if ($_GET['route'] == "ventas") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Administracion de Compra</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=adminCompra" <?php if ($_GET['route'] == "facturacion") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compra</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=administracionProductos" <?php if ($_GET['route'] == "facturacion") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Compra</p>
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    VENTAS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>

                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=ventas" <?php if ($_GET['route'] == "ventas") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Administracion de Ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=facturacion" <?php if ($_GET['route'] == "facturacion") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Venta</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=administracionProductos" <?php if ($_GET['route'] == "facturacion") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Reporte de Ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="/ventas_crack/index.php?route=ventas2" <?php if ($_GET['route'] == "facturacion") { ?> class="nav-link active" <?php } else { ?> class="nav-link" <?php } ?>>
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Prueba de Ventas</p>
                                    </a>
                                </li>

                            </ul>





                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->

            <div class="sidebar-custom">
                <a href="#" class="btn btn-link"><i class="fas fa-cogs"></i></a>
                <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a>
            </div>
            <!-- /.sidebar-custom -->
        </aside>