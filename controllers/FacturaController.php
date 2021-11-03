<?php

// require_once "models/FacturaModel.php";s

class FacturaController
{


  public static function registrar()
  {


    // print_r($_SESSION);
    // echo "hola";
    // $datos = json_decode($_POST);
    // print_r($_GET);
    // print_r($_POST);
    // die;
    $datos = json_decode($_POST['json_string']);
    print_r($datos);
    // // echo $_POST->tipoFacturas;
    // die;

    $data = array(
      "tipoFactura" => $datos->tipoFactura,
      "pagoEfectivo" => $datos->pagoEfectivo,
      "pagoTransferencia" => $datos->pagoTransferencia,
      "credito" => $datos->credito,
      "credito" => $datos->credito,
      "cliente" => $datos->cliente,
      "nota" => $datos->nota,
      "productos" => $datos->productos,
      "creado_por" => $_SESSION['idUsuario']
    );

    $resultados = FacturaModel::registrar($data);
    echo json_encode($resultados);
  }
}
