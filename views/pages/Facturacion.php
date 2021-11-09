<?php

$comprobante = ComprobanteModel::getComprobante(null, null);
$idTipoComprobante = ContactoController::getIdTipoComprobante(null, null);

$tipoComprobante = ComprobanteModel::getTipoComprobante(null, null);
$producto = ProductoController::getProducto(null, null);

?>


<section class="content">

  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card card-info card-outline">
          <div class="card-header">
            <h4>
              <i class="fas fa-globe"></i> Ventas Crack, Inc.
              <!-- <small class="float-right">Date: 2/10/2014</small> -->
            </h4>
          </div>
          <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-12 invoice-col">

            <div class="card hovercard">
              <div class="card-body">
                <!-- <div class="box-body"> -->
                <form role="form" method="POST">
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>

                          <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"] ?>" readonly>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <!-- <label>Tipo Comprobante</label> -->
                        <select class="form-control" name="idTipoComprobante" id="idTipoComprobante">
                          <option value="0" disabled selected>Seleccione Tipo Comprobante</option>
                          <?php
                          foreach ($tipoComprobante as $key) {
                            echo '<option value="' . $key['idTipoComprobante'] . '">' . $key['tipoComprobante'] . '</option>';
                          }

                          ?>
                        </select>
                      </div>
                    </div>




                    <div class="col-md-3">
                      <div class="form-group">
                        <div class="input-group">
                          <select class="form-control" name="cliente" id="cliente">
                            <option value='' disabled selected>Seleccione el Cliente</option>
                            <?php
                            $cliente = ConsultasController::getDatos('contacto', 'esCliente', true);

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





                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="input-group">
                          <!-- <label for="estado">Estado</label> -->
                          <select id="tipoVenta" class="form-control" name="tipoVenta" required>
                            <option value="0" disabled selected>Seleccione Tipo Venta</option>

                            <?php
                            $cliente = ConsultasController::getDatos('tipo_venta', null, null);

                            foreach ($cliente as $index => $key) {
                              echo "<option value='" . $key['idTipoVenta'] . "'>" . $key['descripcion'] . "</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>


                    <div class="w-100"></div>
                    <div class="col-md-5 col-sm-12">
                      <div class="form-group">
                        <label for="consultaProducto">Producto</label>
                        <div class="input-group">
                          <select class="form-control select2" name="consultaProducto" id="consultaProducto">
                            <option value='' disabled selected>Seleccione un Producto</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" value="1" min="1" class="form-control" placeholder="" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="">Precio</label>
                        <input type="text" name="precio" id="precio" class="form-control" disabled readonly>
                      </div>
                    </div>
                    <div class="col-1" style="padding-top: 30px;">
                      <button type="button" id="btnAgregarProducto" type="button" class="btn btn-primary">Agregar</button>
                    </div>
                  </div>





                  <div class="row">
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                      <table class="table table-head-fixed      text-nowrap">
                        <thead>
                          <tr scope="row">
                            <th scope=" col">Descripcion</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Itbis</th>
                            <th scope="col">Importe</th>
                            <th scope="col">Acción</th>
                          </tr>
                        </thead>
                        <tbody id="bodyProductos">
                        </tbody>

                      </table>
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-6">
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
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                      <p class="lead">Monto Adeudado 2/22/2014</p>

                      <div class="table-responsive">
                        <table class="table">
                          <tbody>
                            <tr>
                              <th>Productos:</th>
                              <span class="badge bg-primary rounded-pill" id="cantidadProductoModal">0.00</span>
                              <td id="totalCantidad" align="center" colspan="2">0</td>
                            </tr>
                            <tr>
                              <th style="width:50%">Subtotal:</th>

                              <td id="subTotal" align="center" colspan="2">0</td>
                            </tr>
                            <tr>
                              <th>Itbis 18%</th>

                              <td id="totalItbis" align="center" colspan="2">0</td>
                            </tr>
                            <th>Total:</th>

                            <td id="totalImporte" align="center" colspan="2">0</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.col -->
                  </div>
                  <div class="row">
                    <!-- accepted payments column -->
                    <!-- /.col -->
                    <div class="col-6">
                    </div>
                    <div class="col-6"> <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                      <button type="button" id="btnFacturar" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Facturar
                      </button>
                      <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Generate PDF
                      </button>
                      <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                        <i class="fas fa-download"></i> Cancelar
                      </button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->












  <!--Registro de pago form Modal -->
  <div class="modal fade text-left" id="modalRegistroFactura" tabindex="-1" role="dialog" aria-labelledby="tituloModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="tituloModal">Agregar pago </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <i data-feather="x"></i>
          </button>
        </div>
        <div class="modal-body">

          <form id="formularioRegistrarFactura">
            <div class="row">
              <div class="col-md-12 col-lg-6">
                <div class="row">
                  <input type="hidden" name="idMarca" value="0" id="id">
                  <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                      <label>Total apagar</label>
                      <input type="text" placeholder="Ingrese la cantidad" class="form-control" name="montoApagar" id="montoApagar" readonly>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-6">
                    <div class="form-group">
                      <label>Cantidad a devolver </label>
                      <input type="number" class="form-control pagar" name="cantidadDevolver" id="cantidadDevolver" readonly>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label>Cantidad recibida </label>
                      <input type="number" class="form-control pagar" name="pagoEfectivo" id="pagoEfectivo" min="0" placeholder="Efectivo" required>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-6">
                    <div class="form-group">
                      <label>Credito </label>
                      <input type="number" class="form-control pagar" name="credito" id="credito" min="0" placeholder="Monto en credito">
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label>Transferencia </label>
                      <input type="number" class="form-control pagar" name="transferencia" id="transferencia" min="0" placeholder="Monto en transferencia">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <ol class="list-group list-group-numbered">
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Productos totales</div>
                    </div>
                    <span class="badge bg-primary rounded-pill" id="cantidadProductoModal">0.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Impuesto total %18</div>
                    </div>
                    <span class="badge bg-primary rounded-pill" id="itbisTotalModal">0.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Descuento</div>
                    </div>
                    <span class="badge bg-primary rounded-pill">0.00</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                      <div class="fw-bold">Total</div>
                    </div>
                    <span class="badge bg-primary rounded-pill" id="totalModal">0.00</span>
                  </li>
                </ol>
              </div>
              <div class="col-12 mt-3">
                <div class="mb-3">
                  <textarea class="form-control" name="nota" id="nota" rows="3" placeholder="Notas"></textarea>
                </div>
              </div>

              <div class="col-12">
                <div class="modal-footer">
                  <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Cerrar</span>
                  </button>
                  <button type="submit" class="btn btn-primary ml-1" id="btnRegistrarPago" disabled>
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Procesar</span>
                  </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- FIN REGISTRAR PAGO MODAL -->




  <!-- MODAL REGISTRAR Cliente-->
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
                      <input class="form-check-input" type="checkbox" name="esCliente" id="esCliente" value="1" <?php if ($_GET['type'] == "cliente") {
                                                                                                                  echo "checked='checked'";
                                                                                                                } ?>>
                      <label class="form-check-label" for="esCliente">Cliente</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="checkbox" name="esProveedor" id="esProveedor" value="1" <?php if ($_GET['type'] == "proveedor") {
                                                                                                                      echo "checked='checked'";
                                                                                                                    } ?>>
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





  <!-- /.row -->

  <!-- this row will not appear when printing -->
  <div class="row no-print">

  </div>

  <!-- /.invoice -->
  </div><!-- /.col -->
  </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</section>


<!-- jQuery -->
<script src="views/assets/js/factura.js"></script>

<!-- Select2 -->
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-css/1.4.6/select2-bootstrap.min.css" integrity="sha512-3//o69LmXw00/DZikLz19AetZYntf4thXiGYJP6L49nziMIhp6DVrwhkaQ9ppMSy8NWXfocBwI3E8ixzHcpRzw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->

<!-- SELECT2 -->

<script>
  $(function() {
    // $("#producto").DataTable({
    //   "responsive": true,
    //   "lengthChange": false,
    //   "autoWidth": false,
    //   "info": true,
    //   "paging": true,
    //   "pageLength": 7,
    //   "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    // }).buttons().container().appendTo('#producto_wrapper  .col-md-6:eq(0)');

    //Inicializar select2
    // `ajax/index.php?c=Contacto&m=registrarContacto`,


  });
</script>