<div class="page-heading">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Administración de Almacen</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
            <li class="breadcrumb-item active">Administración de Almacen</li>
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
                Registro de Almacen
              </h3>

            </div>
            <div class="card-body">
              <div class="">
                <button class="btn btn-info mb-3" data-toggle="modal" data-target="#modalRegistroAlmacen" id="btnRegistrar">
                  <strong> + </strong> Almacen
                </button>
              </div>
              <table id="table1" class="table table-bordered table-striped table-hover">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Provincia</th>
                    <th>Ciudad</th>
                    <th>Creado en</th>
                    <th>Creado por</th>
                    <th>Estado</th>
                    <th>Acción</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $almacen = InventarioController::getInventarios(false);

                  $echo = "<tbody>";
                  foreach ($almacen as $index => $key) {
                    $estado = ($key['activo'] == 1) ? ('<span class="badge bg-success">Activo</span>') : ('<span class="badge bg-danger">Inactive</span>');
                    echo "
                                <tr>
                                    <td>" . 1 + $index . "</td>
                                    <td>" . $key['nombre'] . "</td>
                                    <td>" . $key['provincia'] . "</td>
                                    <td>" . $key['ciudad'] . "</td>
                                    <td>" . $key['creado_en'] . "</td>
                                    <td>" . $key['creado_por'] . "</td>
                                    <td>$estado</td>
                                    <td>
                                        <div class='btn-group btn-group-sm' role='group' aria-label='Acciones'>
                                            <button type='button' class='btn btn-primary actualizarAlmacen' idAlmacen='" . $key['idAlmacen'] . "' data-bs-toggle='modal' data-bs-target='#modalRegistroAlmacen'><span class='fa-fw select-all fas'></span></button>
                                            <button type='button' class='btn btn-danger eliminarAlmacen' idAlmacen='" . $key['idAlmacen'] . "'><span class='fa-fw select-all fas'></span></button>
                                        </div>
                                        <!--
                                        <a class='btn btn-outline-primary rounded-circle btn-sm actualizarAlmacen' idAlmacen='" . $key['idAlmacen'] . "' data-bs-toggle='modal' data-bs-target='#modalRegistroUnidad'><span class='fa-fw select-all fas'></span></a>
                                        <a class='btn btn-danger rounded-circle btn-sm eliminarAlmacen' idAlmacen='" . $key['idAlmacen'] . "'><span class='fa-fw select-all fas'></span></a>
                                        -->
                                    </td> 
                                </tr>";
                  }
                  $echo .= "</tbody>";
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





</div>

<!-- MODAL REGISTRAR Almacen-->
<div class="modal fade text-left" id="modalRegistroAlmacen" style="display: none; padding-right: 17px;" aria-modal="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">


      <form id="registroInventario">

        <div class="modal-header bg-info">
          <h4 class="modal-title" id="tituloModal">Registro de Almacen </h4>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <!-- <i data-feather="x"><span class="fa-fw select-all fas"></span></i> -->
            <span aria-hidden="true">×</span>
          </button>
        </div>



        <div class="modal-body">
          <div class="card hovercard">
            <div class="card-body">

              <div class="row">
                <div class="col-12">
                  <label>Nombre <span style="color: red; font-size: 15px;">*</span> </label>
                  <input type="hidden" name="idInventario" value="0" id="idInventario">
                  <div class="form-group">
                    <input type="text" placeholder="Ingrese el nombre del Almacen" class="form-control" name="nombre" value="Ingenio Arriba" id="nombre" autocomplete="off" required>
                  </div>
                </div>

                <div class="col-6-lg col-xl-6 col-sm-12">
                  <label for="provincia">Provincia</label>
                  <div class="form-group">
                    <select class="form-control" name="provincia" id="provincia">
                      <?php
                      $provincia = ConsultasController::getDatos('provincia', null, null);
                      echo "<option value='' disabled selected>Seleccione una opcion</option>";

                      foreach ($provincia as $index => $key) {
                        echo "<option value='" . $key['idProvincia'] . "'>" . $key['provincia'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <div class="col-6-lg col-xl-6 col-sm-12">
                  <label for="ciudad">Ciudad</label>
                  <div class="form-group">
                    <select class="form-control" name="ciudad" id="ciudad">
                      <option value='' disabled selected>Seleccione una opcion</option>
                      <?php
                      $ciudad = ConsultasController::getDatos('ciudad', null, null);

                      foreach ($ciudad as $index => $key) {
                        echo "<option value='" . $key['idCiudad'] . "'>" . $key['ciudad'] . "</option>";
                      }
                      ?>
                    </select>
                  </div>
                </div>







                <div class="col-12">
                  <label>Sector </label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="sector" id="sector" autocomplete="off" value="Cienfuegos">
                  </div>
                </div>
                <div class="col-12">
                  <label>Dirección </label>
                  <div class="form-group">
                    <input type="text" class="form-control" name="direccion" id="direccion" autocomplete="off" value="Calle alegrio ">
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

            </div> -->



          </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
      <button type="button" class="btn btn-default" id="close" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-info">Save changes</button>
    </div>
    </form>

  </div>
</div>
</div>




<link rel="stylesheet" href="public/assets/vendors/fontawesome/all.min.css">
<script src="public/assets/vendors/fontawesome/all.min.js"></script>
<!-- JS PERSONAL -->
<script src="public/js/almacen.js"></script>
<!-- FIN JS PERSONAL -->
<script src="public/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!-- <script src="public/assets/js/bootstrap.bundle.min.js"></script> -->

<script src="public/assets/vendors/simple-datatables/simple-datatables.js"></script>
<!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->
<script>
  // Simple Datatable
  let table1 = document.querySelector('#table1');
  let dataTable = new simpleDatatables.DataTable(table1);
</script>

<!-- <script src="public/assets/js/main.js"></script> -->