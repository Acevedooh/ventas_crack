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



                <!-- 
                <div class="col-md-3">
           
                  <div class="form-group">
                    <label>Codigo de Barra</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="codigo" id="codigo" value="crack2" placeholder="Ingrese el codigo" autocomplete="off">
                    </div>
    
                  </div>
                </div> -->


                <input type="hidden" name="idEmpleado" id="idEmpleado" value="0">
                <div class="col-md-4">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Descripcion</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="descripcion" id="descripcion" value="crack2" placeholder="Ingrese el descripcion" autocomplete="off" disabled>
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
                      <input type="text" class="form-control" name="codigo" id="codigo" value="crack2" placeholder="Precio Compra" autocomplete="off" disabled>
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




              </div>


              <!-- TABLA DE PRODUCTO -->
              <div class="row">
                <div class="card-body table-responsive p-0" style="height: 200px;">
                  <table class="table table-light-fixed text-nowrap">
                    <thead class="thead-dark">
                      <tr scope="row">
                        <th scope=" col">ID</th>
                        <th scope=" col">Codigo</th>
                        <th scope=" col">Descripcion</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Sub Total</th>

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


<!-- MODAL REGISTRAR EMPLEADO-->


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
<script src="views/assets/js/empleado.js"></script>
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