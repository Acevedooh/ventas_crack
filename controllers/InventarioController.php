<?php

require_once "models/InventarioModel.php";

class InventarioController
{

  public static function getInventarios($json = true)
  {
    $resultados = InventarioModel::getInventarios();

    if ($json) {
      echo json_encode($resultados);
      return;
    } else {

      return $resultados;
    }
  }

  public static function registrarAlmacen()
  {

    // print_r($_SESSION);
    $data = array(
      "nombre" => $_POST['nombre'],
      "provincia" => isset($_POST['provincia']) ? $_POST['provincia'] : null,
      "ciudad" => isset($_POST['ciudad']) ? $_POST['ciudad'] : null,
      "sector" => isset($_POST['sector']) ? $_POST['sector'] : null,
      "direccion" => isset($_POST['direccion']) ? $_POST['direccion'] : null,
      "creado_por" => $_SESSION['idUser'],
      "estado" => isset($_POST['estado']) ? ($_POST['estado'] === 'on' ? 1 : 0) : 0,
    );

    // print_r($data);
    // die;
    $resultados = InventarioModel::registrarAlmacen($data);
    echo json_encode(
      array(
        "success" => $resultados > 0 ? true : false,
        "msg" => $resultados > 0 ? "Se ha registrado de forma correcta!!" : "Ah ocurrido un error!!",
      )
    );
  }

  public static function actualizarAlmacen()
  {
    // $data = array(
    //   "idUnidad" => $_POST['idUnidad'],
    //   "unidad" => $_POST['unidad'],
    //   "abreviatura" => $_POST['abreviatura'],
    //   "estado" => isset($_POST['estado']) ? ($_POST['estado'] === 'on' ? 1 : 0) : 0,
    //   "actualizado_por" => $_SESSION['idUsuario'],
    // );


    // $resultados = InventarioModel::actualizarAlmacen($data);
    // echo json_encode(
    //   array(
    //     "success" => $resultados > 0 ? true : false,
    //     "msg" => $resultados > 0 ? "Se ha actualizado de forma correcta!!" : "Ah ocurrido un error!!",
    //   )
    // );
  }

  public static function eliminar()
  {
    $idUnidad = $_POST['idUnidad'];
    $resultado = InventarioModel::eliminar($idUnidad);

    echo json_encode(
      array(
        "success" => $resultado > 0 ? true : false,
        "msg" => $resultado > 0 ? "Se ha eliminado de forma correcta!!" : "Ah ocurrido un error!!",
      )
    );
  }

  static public function getInventario()
  {
    // $idUnidad = $_GET['idAlmacen'];
    // $resultado = ConsultasController::getDatos('almacen', 'idAlmacen', $idUnidad);

    // if (count($resultado) > 0) {
    //   echo  json_encode([array(
    //     "idUnidad" => $resultado[0]['idUnidad'],
    //     "nombre" => $resultado[0]['descripcion'],
    //     "abreviatura" => $resultado[0]['abreviatura'],
    //     "estado" => $resultado[0]['activo'] === "1" ? true : false,
    //   )]);
    // } else {
    //   echo  json_encode([]);
    // }
  }
}
