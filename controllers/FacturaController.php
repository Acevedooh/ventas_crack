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
    // print_r($datos);
    // // echo $_POST->tipoFacturas;
    // die;

    $data = array(
      "tipoFactura" => $datos->tipoFactura,
      "formaPago" => $datos->formaPago,
      "cliente" => $datos->cliente,

      "tipoVenta" => $datos->tipoVenta, //Creito o al contado 
      "nota" => $datos->nota,
      "productos" => $datos->productos,
      "creado_por" => $_SESSION['idUser']
    );


    $resultados = FacturaModel::registrar($data);
    echo $resultados['numeroFactura'] . "fasdf";
    if (isset($resultados['numeroFactura']) && $resultados['numeroFactura'] > 0) {
      $resultados['html'] = FacturaController::getfacturaHTML($resultados['numeroFactura']);
    }

    echo json_encode($resultados);
  }

  public static function getfacturaHTML($numfactura)
  {
    $resultados = FacturaModel::getFactura($numfactura);
    print_r($resultados);

    $html = 'hOLA MUNDO';
    return $html;
  }
}
