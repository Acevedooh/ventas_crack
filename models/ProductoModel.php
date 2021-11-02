<?php

require_once "Conection.php";

class ProductoModel
{






  static public function getConsultaProducto($buscar)
  {


    try {
      //code...
      $stmp = Conection::connect()->prepare("
          SELECT 
            DISTINCT
              p.idProducto,
              p.codigoPro,
              p.nombrePro , 
              p.descripcion,
              p.stock,
              pc.precio AS precioCompra,
              pv.precion AS precioVenta,
              CASE WHEN p.estado IS TRUE  THEN 'Activo' ELSE 'Inactivo' END AS estado
          FROM producto p
          INNER JOIN precio_compra pc ON p.idProducto = pc.idProducto
          INNER JOIN precio_venta pv ON p.idProducto = pc.idProducto
          WHERE LOWER(CONCAT(p.codigoPro, p.nombrePro, p.descripcion)) LIKE LOWER(TRIM('%$buscar%'));
      ");
      // $stmp->bindParam(":busqueda", $buscar, PDO::PARAM_STR);

      $stmp->execute();
      return $stmp->fetchAll();
    } catch (PDOException $ex) {
      print "Error: " . $ex->getMessage();
      //throw $th;
    }
  }


  static public function getProducto()
  {
    $respuesta = Conection::connect()->prepare("
    SELECT 
    p.idProducto,
    p.codigoPro,
    p.nombrePro , 
    p.descripcion,
    p.stock,
    pc.precio AS precioCompra,
    pv.precion AS precioVenta,
    CASE WHEN p.estado IS TRUE  THEN 'Activo' ELSE 'Inactivo' END AS estado
  
    FROM producto p
    INNER JOIN precio_compra pc ON p.idProducto = pc.idProducto
    INNER JOIN precio_venta pv ON p.idProducto = pc.idProducto
            ");

    $respuesta->execute();
    return $respuesta->fetchAll();
  }


  static public function getCategoria()
  {
    $respuesta = Conection::connect()->prepare("SELECT c.idCategoria,  c.descripcion AS categoria FROM categoria c");
    $respuesta->execute();
    return $respuesta->fetchAll();
  }

  static public function getSubCategoria()
  {
    $respuesta = Conection::connect()->prepare("SELECT sc.idSubCategoria, sc.descripcion FROM subcategoria sc");
    $respuesta->execute();
    return $respuesta->fetchAll();
  }

  static public function getMarca()
  {
    $respuesta = Conection::connect()->prepare("SELECT m.idMarca, m.marca FROM marca m");
    $respuesta->execute();
    return $respuesta->fetchAll();
  }

  static public function getUnidad()
  {
    $respuesta = Conection::connect()->prepare("SELECT u.idUnidad, u.descripcion AS unidad FROM unidad u");
    $respuesta->execute();
    return $respuesta->fetchAll();
  }









  // static public function getSexo()
  // {
  //   $respuesta = Conection::connect()->prepare("SELECT s.idSexo, S.sexo FROM sexo S");
  //   $respuesta->execute();
  //   return $respuesta->fetchAll();
  // }

  static public function registrarProducto($datos)
  {

    // if(isset($datos["idEmpleado"]) && $datos["idEmpleado"] > 0) {
    //   echo "existe";
    // } else {
    //   echo "no existe";
    // }
    // echo "hola mundo;";
    // die;

    if (isset($datos["idProducto"]) && $datos["idProducto"] > 0) { /// NUEVO EMPLEADO
      echo "hola mundo registrar";
      // print_r($datos);
      // die;
      $respuesta = Conection::connect()->prepare("CALL addProducto (NULL,?,?,?,NULL,?,?,?,?,?,?,?,?,?,?)");
      // $respuesta->bindParam("1", $datos["idProducto"], PDO::PARAM_INT);
      $respuesta->bindParam("1", $datos["codigo"], PDO::PARAM_STR);
      $respuesta->bindParam("2", $datos["nombre"], PDO::PARAM_STR);
      $respuesta->bindParam("3", $datos["categoria"], PDO::PARAM_INT);
      $respuesta->bindParam("4", $datos["marca"], PDO::PARAM_INT);
      $respuesta->bindParam("5", $datos["unidad"], PDO::PARAM_INT);
      $respuesta->bindParam("6", $datos["descripcion"], PDO::PARAM_STR);
      $respuesta->bindParam("7", $datos["stockIni"], PDO::PARAM_INT);
      $respuesta->bindParam("8", $datos["stockMini"], PDO::PARAM_BOOL);
      $respuesta->bindParam("9", $datos["reorden"], PDO::PARAM_STR);
      $respuesta->bindParam("10", $datos["itbis"], PDO::PARAM_STR);
      $respuesta->bindParam("11", $datos["precioCompra"], PDO::PARAM_STR);
      $respuesta->bindParam("12", $datos["precioVenta"], PDO::PARAM_STR);
      $respuesta->bindParam("13", $datos["creado_por"], PDO::PARAM_INT);
      $respuesta->bindParam("14", $datos["estado"], PDO::PARAM_STR);


      $respuesta->execute();
      return $respuesta->fetch();
    } else { /// EDITAR EMPLEADO
      // echo "hola";
      // print_r($datos);
      // die;
      $respuesta = Conection::connect()->prepare("CALL addProducto (NULL,?,?,?,NULL,?,?,?,?,?,?,?,?,?,?,?)");
      // $respuesta->bindParam("1", $datos["idProducto"], PDO::PARAM_INT);
      $respuesta->bindParam("1", $datos["codigo"], PDO::PARAM_STR);
      $respuesta->bindParam("2", $datos["nombre"], PDO::PARAM_STR);
      $respuesta->bindParam("3", $datos["categoria"], PDO::PARAM_INT);
      $respuesta->bindParam("4", $datos["marca"], PDO::PARAM_INT);
      $respuesta->bindParam("5", $datos["unidad"], PDO::PARAM_INT);
      $respuesta->bindParam("6", $datos["descripcion"], PDO::PARAM_STR);
      $respuesta->bindParam("7", $datos["stockIni"], PDO::PARAM_INT);
      $respuesta->bindParam("8", $datos["stockMini"], PDO::PARAM_INT);
      $respuesta->bindParam("9", $datos["reorden"], PDO::PARAM_INT);
      $respuesta->bindParam("10", $datos["itbis"], PDO::PARAM_INT);
      $respuesta->bindParam("11", $datos["precioCompra"], PDO::PARAM_INT);
      $respuesta->bindParam("12", $datos["precioVenta"], PDO::PARAM_INT);
      $respuesta->bindParam("13", $datos["creado_por"], PDO::PARAM_INT);
      $respuesta->bindParam("14", $datos["estado"], PDO::PARAM_INT);
      $respuesta->execute();
      return $respuesta->fetch();
    }
  }

  // static public function getProducto($item, $value)
  // {
  //   if ($item != null) {
  //     $data = Conection::connect()->prepare("
  //     SELECT 
  //     p.idProducto,
  //     p.nombrePro , 
  //     p.descripcion,
  //     pc.precio,
  //     pv.precion,
  //     CASE WHEN p.estado IS TRUE  THEN 'Activo' ELSE 'Inactivo' END AS estado

  //     FROM producto p
  //     INNER JOIN precio_compra pc ON p.idProducto = pc.idProducto
  //     INNER JOIN precio_venta pv ON p.idProducto = pc.idProducto
  //               WHERE $item = :$item");
  //     $data->bindParam(":" . $item, $value, PDO::PARAM_INT);
  //     $data->execute();
  //     return $data->fetch();
  //   } else {
  //     $data = Conection::connect()->prepare("
  //     SELECT * FROM empleado_v");
  //     $data->execute();
  //     return $data->fetchAll();
  //   }
  // }


  // static public function getEmpleado($ID)
  // {
  //   // echo "hola prueba" . $ID;
  //   // die;
  //   $data = Conection::connect()->prepare("
  //       SELECT * FROM empleado_v
  //       WHERE idUser = $ID");

  //   $data->execute();
  //   return $data->fetch();
  // }

  static public function eliminarProducto($ID)
  {
    // echo "hola prueba";die;
    $data = Conection::connect()->prepare("CALL eliminarProducto ($ID)");

    $data->execute();
    return $data->fetch();
  }
}
