<?php

$producto = ProductoController::getProducto(null, null);
$categoria = ProductoController::getCategoria(null, null);
$subCategoria = ProductoController::getSubCategoria(null, null);
$marca = ProductoController::getMarca(null, null);
$unidad = ProductoController::getUnidad(null, null);
?>





<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Adminiscación de Compras</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Layout</a></li>
          <li class="breadcrumb-item active">Fixed Layout</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card card-info card-outline">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-edit"></i>
              Registro de Compras
            </h3>
          </div>
          <div class="card-body">


            <form>
              <div class="row">

                <!-- ////////////////
          VENDEDOR/COMPRADOR
          ////////////////////// -->
                <div class="col-md-2">
                  <div class="form-group">
                    <label>Comprador</label>

                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>

                      <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"] ?>" readonly>
                    </div>
                  </div>
                </div>

                <!-- 
            /////////////////////////
              PROVEDOOR
              //////////////////// -->
                <div class="col-md-4">
                  <div class="form-group">
                    <label>Provedoor</label>

                    <div class="input-group">
                      <select class="form-control" name="ciudad" id="ciudad">
                        <option value='' disabled selected>Seleccione el Cliente</option>
                        <?php
                        $cliente = ConsultasController::getDatos('contacto', 'esProveedor', true);

                        foreach ($cliente as $index => $key) {
                          echo "<option value='" . $key['idContacto'] . "'>" . $key['nombre'] . "</option>";
                        }
                        ?>
                      </select>
                      <span class="input-group-addon"> <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalContactoRegister" id="registroContacto">
                          <i class="icon-database-add"></i> +
                        </button></span>
                    </div>
                  </div>


                </div>


                <!-- /////////////////////////////
            BUSCAR PRODUCTO
          //////////////////////////////                   -->

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="consultaProducto">Producto</label>
                    <div class="input-group">
                      <select class="form-control select2" name="consultaProducto" id="consultaProducto">
                        <option value='' disabled selected>Seleccione un Producto</option>
                      </select>
                      <span class="input-group-addon"> <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalContactoRegister" id="registroContacto">
                          <i class="icon-database-add"></i> +
                        </button></span>
                    </div>
                  </div>


                </div>






                <input type="hidden" name="idEmpleado" id="idEmpleado" value="0">
                <div class="col-md-4">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Descripcion</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="descripcion" id="descripcion" value="" placeholder="Ingrese el descripcion" autocomplete="off" disabled>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-md-2">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Cant</label>
                    <div class="input-group">
                      <input type="number" class="form-control" name="cantidad" id="cantidad" value="crack2" placeholder="Ingrese el cantidad" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-md-2">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Precio</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="precio" id="precio" value="crack2" placeholder="Precio Compra" autocomplete="off" disabled>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>




                <div class="col-md-2">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Sub Total</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="subTotal" id="subTotal" value="0.00" placeholder="Sub Total" autocomplete="off" disabled>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>

                <div class="col-1" style="padding-top: 30px;">
                  <button type="button" id="btnAgregarProducto" type="button" class="btn btn-primary">Agregar</button>
                </div>

              </div>

          </div>




        </div>


        <!-- TABLA DE PRODUCTO -->
        <div class="row">
          <div class="card-body table-responsive p-0" style="height: 200px;">
            <table class="table table-light-fixed text-nowrap">
              <thead class="thead-dark">
                <tr scope="row">
                  <!-- <th scope=" col">ID</th>
                  <th scope=" col">Codigo</th> -->
                  <th scope=" col">Descripcion</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio</th>
                  <!-- <th scope="col">Sub Total</th> -->

                  <th scope="col">Acción</th>
                </tr>
              </thead>
              <tbody id="bodyProductos">
              </tbody>

            </table>
          </div>
          <!-- /.col -->
        </div>


        <!-- TABLA DE TOTALES ETC -->
        <div class="row">
          <!-- accepted payments column -->
          <!-- <div class="col-6">
                  <p class="lead">Metodo De Pago:</p>
                  <img src="views/assets/img/credit/visa.png" alt="Visa">
                  <img src="views/assets/img/credit/mastercard.png" alt="Mastercard">
                  <img src="views/assets/img/credit/american-express.png" alt="American Express">
                  <img src="views/assets/img/credit/paypal2.png" alt="Paypal">

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                  </p>
                </div> -->
          <!-- /.col -->
          <div class="col-6">

            <div class="table-responsive">
              <!-- <div class="card card-info card-outline"></div> -->

              <div class="card-body">
                <p class="lead">Monto Adeudado 2/22/2014</p>

                <table class="table">
                  <tbody id="bodyProductos">
                    <tr>
                      <th>Productos:</th>

                      <td id="totalCantidad" align="center" colspan="2">0.00</td>
                    </tr>
                    <tr>
                      <th style="width:50%">Subtotal:</th>

                      <td id="subTotal" align="center" colspan="2">0.00</td>
                    </tr>
                    <tr>
                      <th>Itbis 18%</th>

                      <td id="totalItbis" align="center" colspan="2">0.00</td>
                    </tr>
                    <th>Total:</th>

                    <td id="totalImporte" align="center" colspan="2">0.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- </div> -->

            </div>
          </div>
          <!-- /.col -->
        </div>
        <div class="modal-footer justify-content-between">
          <!-- <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button> -->
          <button type="submit" class="btn btn-info">Generar Compra</button>
        </div>

      </div>
    </div>

  </div>

  </form>










  </div>
  </div>
  <!-- /.card -->
  </div>
  </div>
  </div>
</section>




<!-- MODAL REGISTRAR PROVEDOR-->

<div class="modal fade" id="modalContactoRegister" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formContacto">
        <div class="modal-header bg-info">
          <h4 class="modal-title">Register Contacto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card hovercard">
            <div class="card-body">
              <div class="row">
                <input type="hidden" name="idContacto" id="idContacto" value="0">


                <div class="col-12">
                  <label for="">Referencia</label>
                  <br>

                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="esProveedor" id="esProveedor" value="1">
                    <label class="form-check-label" for="esProveedor">Proveedor</label>
                  </div>
                </div>



                <div class="col-6-lg col-xl-6 col-sm-12">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Nombre</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="nombre" id="nombre" value="Tobi" placeholder="Ingrese el nombre" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>







                <div class="col-6-lg col-xl-6 col-sm-12">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Razon Social</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="razonSocial" id="razonSocial" value="sdsdf" placeholder="Ingrese  la Razon Social" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>


                <div class="col-6-lg col-xl-6 col-sm-12">
                  <div class="form-group">
                    <label for="idTipoIdentificacion">Tipo de indentificacion</label>
                    <select id="idTipoIdentificacion" class="form-control" name="idTipoIdentificacion" required>
                      <option value="1" selected>CEDULA</option>
                      <option value="2">RNC</option>
                      <option value="3" selected>PASSPORT</option>
                      <option value="4">Inactivo</option>
                    </select>
                  </div>
                </div>


                <div class="col-6-lg col-xl-6 col-sm-12">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>identificacion</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="identificacion" id="identificacion" value="123213123" placeholder="Ingrese  la identificacion" autocomplete="off">
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>







                <div class="col-6-lg col-xl-6 col-sm-12">
                  <div class="form-group">
                    <label>Correo</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                      </div>
                      <input type="email" class="form-control" name="correo" id="correo" value="fras@fsd.com" autocomplete="off">
                    </div>
                  </div>
                </div>


                <div class="col-6-lg col-xl-6 col-sm-12">
                  <div class="form-group">
                    <label>Telefono</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                      <input type="text" class="form-control" name="telefono" id="telefono" value="849-565-2312" autocomplete="off">
                    </div>
                  </div>
                </div>





                <div class="col-6-lg col-xl-6 col-sm-12">
                  <div class="form-group">
                    <label>Tipo Comprobante</label>
                    <select class="form-control" name="idTipoComprobante" id="idTipoComprobante">
                      <option value="0" disabled selected>Seleccione una opción</option>
                      <?php foreach ($idTipoComprobante as $key) {
                        echo '<option value="' . $key['idTipoComprobante'] . '">' . $key['tipoComprobante'] . '</option>';
                      }  ?>
                    </select>
                  </div>
                </div>



                <div class="col-6-lg col-xl-6 col-sm-12">
                  <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" class="form-control" name="estado" required>
                      <option value="1" selected>Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-info">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->
</div>

<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- MODAL REGISTRAR EDITAR-->


<!-- /.modal-dialog -->
</div>

<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/compra.js"></script>
<!-- DataTables  & Plugins -->

<link rel="stylesheet" href="views/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="views/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="views/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<script src="views/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="views/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="views/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="views/assets/plugins/jszip/jszip.min.js"></script>
<script src="views/assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="views/assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="views/assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="views/assets/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- jquery-validation -->
<script src="views/assets/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="views/assets/plugins/jquery-validation/additional-methods.min.js"></script>
<!-- sweetalert2 -->

<script src="views/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- sweetalert2-theme-bootstrap-4 -->
<link rel="stylesheet" href="views/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

<!-- Page specific script -->
<script>
  $(function() {
    $("#empleados").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "info": true,
      "paging": true,
      "pageLength": 7,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#empleados_wrapper  .col-md-6:eq(0)');
  });
</script>