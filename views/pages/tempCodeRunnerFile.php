<?php
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