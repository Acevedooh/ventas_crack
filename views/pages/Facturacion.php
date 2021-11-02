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
                    <div class="col-6-lg col-xl-6 col-sm-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                          </div>

                          <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"] ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="col-6-lg col-xl-6 col-sm-12">
                      <div class="form-group">
                      </div>
                    </div>
                    <div class="col-6-lg col-xl-6 col-sm-12">
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

                    <div class="col-6-lg col-xl-6 col-sm-12">
                      <div class="form-group">
                        <!-- <label for="estado">Estado</label> -->
                        <select id="tipoVenta" class="form-control" name="tipoVenta" required>
                          <option value="0" disabled selected>Seleccione Tipo Venta</option>

                          <option value="contado">Contado</option>
                          <option value="credito">Credito</option>
                          <option value="compuesto">Compuesto</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-6-lg col-xl-6 col-sm-12">
                      <div class="form-group">
                        <div class="input-group">
                          <select class="form-control" name="ciudad" id="ciudad">
                            <option value='' disabled selected>Seleccione el Cliente</option>
                            <?php
                            $cliente = ConsultasController::getDatos('contacto', 'esCliente', true);

                            foreach ($cliente as $index => $key) {
                              echo "<option value='" . $key['idContacto'] . "'>" . $key['nombre'] . "</option>";
                            }
                            ?>
                          </select>
                          <span class="input-group-addon"> <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalContactoRegister" id="registroContacto">
                              <i class="icon-database-add"></i> Agregar Nuevo
                            </button></span>
                        </div>
                      </div>
                    </div>

                    <div class="w-100"></div>
                    <div class="col-md-3 col-sm-12">
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
  <div class="row">
    <div class="card-body table-responsive p-0" style="height: 300px;">
      <table class="table table-head-fixed text-nowrap">
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
        <!-- <tfoot>
          <tr>
            <th>Productos:</th>
   
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
        </tfoot> -->
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  <div class="row">
    <!-- accepted payments column -->
    <div class="col-6">
      <p class="lead">Metodo De Pago:</p>
      <img src="../../dist/img/credit/visa.png" alt="Visa">
      <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
      <img src="../../dist/img/credit/american-express.png" alt="American Express">
      <img src="../../dist/img/credit/paypal2.png" alt="Paypal">

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
          <tr>
            <th>Productos:</th>

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
      <button type="submit" id="btnFacturar" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Facturar
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