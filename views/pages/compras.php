<?php
$unidad = UnidadController::getUnidad();
?>

<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Administración de Ventas</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
          <li class="breadcrumb-item active">Administración de Compras</li>
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
              Registro de Ventas
            </h3>

          </div>
          <div class="card-body">
            <div class="">
              <a href="facturacion">
                <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalUnidad" id="registrarUnidad">
                  <strong> + </strong> Compras
                </button>
              </a>
            </div>
            <table id="unidades" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th>#</th>
                  <th>CodigoFactura</th>
                  <th>Cliente</th>
                  <th>Vendedor</th>
                  <th>Forma de pago </th>
                  <th>Neto</th>
                  <th>Total</th>
                  <th>Fecha</th>



                  <th>Acción</th>
                </tr>
              </thead>
              <tbody>
                <?php
                // foreach ($unidad as $index => $value) {
                //   $estado = null;
                //   if ($value["estado"] == 'Activo') {
                //     $estado = "<span class='badge badge-primary'>" . $value["estado"] . "</span>";
                //   } else {
                //     $estado = "<span class='badge badge-danger'>" . $value["estado"] . "</span>";
                //   }
                //   echo '<tr>';
                //   echo '<td>' . ($index + 1) . '</td>';
                //   echo '<td>' . $value["unidad"] . '</td>';
                //   echo '<td>' . $value["creado_por"] . '</td>';
                //   echo '<td>' . $estado  . '</td>';
                //   echo '<td>
                //                         <div class="btn-group" role="group" aria-label="Basic example">
                //                         <button type="button" class="btn btn-primary btn-editar" data-toggle="modal" data-target="#modalUnidad" idUnidad="' . $value["idUnidad"] . '">Editar</button>
                //                         <button type="button" class="btn btn-danger btn-eliminar"  idUnidad="' . $value["idUnidad"] . '">Eliminar</button>
                //                     </div>
                //                         </td>';
                //   echo '</tr>';
                // }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>


<!-- MODAL REGISTRAR unidad-->
<div class="modal fade" id="modalUnidad" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="formUnidad">
        <div class="modal-header bg-info">
          <h4 class="modal-title" id="tituloModal">Registro de Unidad</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="card hovercard">
            <div class="card-body">
              <div class="row">
                <input type="hidden" name="idUnidad" id="idUnidad" value="0">
                <div class="col-6-lg col-xl-6 col-sm-12">
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Nombre</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="nombre" id="nombre" value="crack2" placeholder="Ingrese el nombre" autocomplete="off">
                    </div>
                    <!-- /.input group -->
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

<!-- END MODAL REGISTRAR EMPLEADO-->

<!-- SCRIPT PERSONAL -->
<script src="views/assets/js/compras.js"></script>
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
    $("#unidades").DataTable({
      "responsive": true,
      "lengthChange": false,
      "autoWidth": false,
      "info": true,
      "paging": true,
      "pageLength": 7,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
    }).buttons().container().appendTo('#unidades_wrapper  .col-md-6:eq(0)');
  });
</script>