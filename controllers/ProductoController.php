<?php

class ProductoController
{
  static public function getProducto($item, $value)
  {
    $respuesta = ProductoModel::getProducto($item, $value);
    return $respuesta;
  }

  static public function getCategoria()
  {
    $respuesta = ProductoModel::getCategoria();
    return $respuesta;
  }

  static public function getSubCategoria()
  {
    $respuesta = ProductoModel::getSubCategoria();
    return $respuesta;
  }

  static public function getMarca()
  {
    $respuesta = ProductoModel::getMarca();
    return $respuesta;
  }

  static public function getUnidad()
  {
    $respuesta = ProductoModel::getUnidad();
    return $respuesta;
  }




  //   static public function getSexo()
  //   {
  //     $respuesta = EmpleadoModel::getSexo();
  //     return $respuesta;
  //   }

  //   static public function getTipoUsuario()
  //   {
  //     $respuesta = EmpleadoModel::getTipoUsuario();
  //     return $respuesta;
  //   }

  static public function registrarProducto()
  {
    $datos = array(
      "codigo" => $_POST["codigo"],
      "nombre" => $_POST["nombre"],
      "categoria" => $_POST["categoria"],
      "subcategoria" => $_POST["subcategoria"],
      "marca" => $_POST["marca"],
      "unidad" => $_POST["unidad"],
      "descripcion" => $_POST["descripcion"],
      "stockIni" => $_POST["stockIni"],
      "stockMini" => $_POST["stockMini"],
      "precioCompra" => $_POST["precioCompra"],
      "precioVenta" => $_POST["precioVenta"],
      "estado" => $_POST["estado"]

      //   "estado" => $_POST["estado"],

    );

    // print_r($datos);
    // die;

    $respuesta = ProductoModel::registrarProducto($datos);
    // print_r($respuesta);
    // echo "status" . $respuesta["status"];
    if ($respuesta["status"] == 200) {
      echo "<script> 
          

          Swal.fire(
            'Good job!',
            'You clicked the button!',
            'success'
          )
       </script>";
    } else {

      echo "<script> 
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href>Why do I have this issue?</a>'
              })
        </script>";
    }
    // print_r($respuesta);

    return;
  }

  static public function getConsultaProducto()
  {
    $busqueda = isset($_GET['buscar']) ? $_GET['buscar'] : '..';


    $resultados = ProductoModel::getConsultaProducto($busqueda);
    // print_r($resultados);
    echo json_encode($resultados);
  }
}
