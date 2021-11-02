<?php



class ContactoController
{

  public static function getContacto($parame)
  {
    $resutado = ContactoModel::getContacto($parame);
    return $resutado;
  }


  public static function getIdTipoComprobante()
  {

    $respuesta = ContactoModel::getIdTipoComprobante();
    return $respuesta;
  }


  static public function registrarContacto()
  {
    $datos = array(
      "nombre" => $_POST['nombre'],
      "esCliente" => isset($_POST['esCliente']) ? $_POST['esCliente'] : 0,
      "esProveedor" => isset($_POST['esProveedor']) ? $_POST['esProveedor'] : 0,
      "razonSocial" => $_POST['razonSocial'],
      "idTipoIdentificacion" => $_POST['idTipoIdentificacion'],
      "identificacion" => $_POST['identificacion'],
      "idTipoComprobante" => $_POST['idTipoComprobante'],
      "correo" => $_POST['correo'],
      "telefono" => $_POST['telefono'],
      "estado" => $_POST['estado'],
    );
    $contacto = new ContactoModel();
    $resultado = $contacto->registrarContacto($datos);
    // print_r($_POST);
    // die;
    if ($resultado == 0) {
      echo json_encode(
        array(
          "error" => true,
          "exec" => "registro",
          "msg" => "Ah ocurrido un error",
        )
      );
    } else {
      echo json_encode(
        array(
          "ssucess" => true,
          "exec" => "registro",
          "msg" => "Se ha registrado de forma correcta",
        )
      );
    }
  }

  static public function eliminarContacto()
  {
    // echo "prueba";
    // print_r($_GET);
    // print_r($_POST);

    if (preg_match('/^[0-9]+$/', $_POST['idContacto'])) {

      $idContacto = $_POST['idContacto'];
      // echo "idContacto; " . $idContacto;
      // die;
      $respuesta  = ContactoModel::eliminarContacto($idContacto);

      echo json_encode(array(
        "msg" => $respuesta > 0 ? "Se ha borrado de forma correcta !!" : "Ah ocurrido un error !!",
        "success" => $respuesta > 0 ? true : false
      ));
    } else {
      echo json_encode(array(
        "msg" => "Solo se admiten numeros",
        "success" => false
      ));
    }
  }

  public function actualizandoContacto()
  {

    $datos = array(
      "idContacto" => $_POST["idContacto"],
      "nombre" => $_POST['nombre'],
      "esCliente" => isset($_POST['esCliente']) ? $_POST['esCliente'] : 0,
      "esProveedor" => isset($_POST['esProveedor']) ? $_POST['esProveedor'] : 0,
      "razonSocial" => $_POST['razonSocial'],
      "idTipoIdentificacion" => $_POST['idTipoIdentificacion'],
      "identificacion" => $_POST['identificacion'],
      "idTipoComprobante" => $_POST['idTipoComprobante'],
      "correo" => $_POST['correo'],
      "telefono" => $_POST['telefono'],
      "estado" => $_POST['estado'],
    );


    $respuesta  = ContactoModel::actualizarContacto($datos);

    // print_r($respuesta);die;
    // echo "registrado";
    echo json_encode($respuesta);
  }
}
