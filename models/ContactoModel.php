
<?php

require_once "Conection.php";



class ContactoModel
{
  public static function getContacto($parame)
  {
    $condicion = '';
    ////////////////////////////////////////////////////
    //Condicion para saber si es cliente o provedor
    if ($parame->todo === false) {
      # code...
      if ($parame->esCliente) {
        # code...
        $condicion = " AND c.esCliente IS TRUE";
      } elseif ($parame->esProvedor) {
        # code...
        $condicion = " AND c.esProvedor";
      }
    }
    ///////////////////////////////////////////////////////


    $respuesta = Conection::connect()->prepare("
      
    SELECT 
        c.idContacto, 
        c.nombre, 
        c.razonSocial AS razon_social, 
        CASE WHEN c.esCliente IS TRUE THEN 1 ELSE 0 END esCliente,
        CASE WHEN c.esProveedor IS TRUE THEN 1 ELSE 0 END esProveedor,
        c1.descripcion AS correo,
        t.descripcion AS telefono,
        c.idTipoIdentificacion AS idTipoIdentificacion,
        c.identificacion AS identificacion,
        c2.encabezado AS tipoComprobante,
    CASE WHEN c.estado IS TRUE THEN 1 ELSE 0 END estado 
    FROM contacto c 
    LEFT JOIN comprobante c2  ON c2.idTipoComprobante = c.idTipoComprobante
    LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
    LEFT JOIN correo c1 ON tc.idCorreo = c1.idCorreo
    LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
    LEFT JOIN telefono t ON tt.idTelefono = t.idTelefono
        WHERE 1 = 1 $condicion
    
 
 
 
 ");
    $respuesta->execute();
    return $respuesta->fetchAll();
  }


  static public function getIdTipoComprobante()
  {
    $respuesta = Conection::connect()->prepare("SELECT c.idTipoComprobante, c.encabezado AS tipoComprobante FROM comprobante c ");

    $respuesta->execute();
    return $respuesta->fetchAll();
  }






  static public function registrarContacto($datos)
  {
    $exec = Conection::connect();

    try {
      //code...

      $exec->beginTransaction();
      $exec->exec("INSERT INTO tercero VALUES()");
      $idTercero =  $exec->lastInsertId();

      $stmt = $exec->prepare("INSERT INTO contacto(idTercero, esCliente, esProveedor, nombre, razonSocial, idTipoIdentificacion, identificacion , idTipoComprobante, estado)
         VALUES(:idTercero, :esCliente, :esProveedor, :nombre, :razonSocial, :idTipoIdentificacion, :identificacion, :idTipoComprobante, :estado)");
      // print_r($_POST);
      $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
      $stmt->bindParam(":esCliente", $datos['esCliente'], PDO::PARAM_BOOL);
      $stmt->bindParam(":esProveedor", $datos['esProveedor'], PDO::PARAM_BOOL);
      $stmt->bindParam(":nombre", $datos['nombre'], PDO::PARAM_STR);
      $stmt->bindParam(":razonSocial", $datos['razonSocial'], PDO::PARAM_STR);
      $stmt->bindParam(":idTipoIdentificacion", $datos['idTipoIdentificacion'], PDO::PARAM_INT);
      $stmt->bindParam(":identificacion", $datos['identificacion'], PDO::PARAM_STR);
      $stmt->bindParam(":idTipoComprobante", $datos['idTipoComprobante'], PDO::PARAM_INT);
      $stmt->bindParam(":estado", $datos['estado'], PDO::PARAM_BOOL);
      $stmt->execute();
      $idContacto = $exec->lastInsertId();


      // $stmt = $exec->prepare("INSERT INTO identificacion(idTercero, idTipoIdentificacion, Identificacion)
      // VALUES(:idTercero, :tipoIdentificacion, :identificacion)");
      //  $stmt->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
      //  $stmt->bindParam(":tipoIdentificacion", $datos['tipoIdentificacion'], PDO::PARAM_INT);
      //  $stmt->bindParam(":identificacion", $datos['identificacion'], PDO::PARAM_INT);
      // $stmt->execute();

      if (isset($datos["telefono"]) && !empty($datos["telefono"])) {
        $exec->exec("INSERT INTO telefono(descripcion)
            VALUES('" . $datos["telefono"] . "')");
        $idTelefono = $exec->lastInsertId();

        $exec->exec("INSERT INTO tercero_telefono(idTercero, idTelefono)
            VALUES($idTercero, $idTelefono)");
      }

      if (isset($datos["correo"]) && !empty($datos["correo"])) {
        $exec->exec("INSERT INTO correo(descripcion)
            VALUES('" . $datos["correo"] . "')");
        $idCorreo = $exec->lastInsertId();

        $exec->exec("INSERT INTO tercero_correo(idTercero, idCorreo)
            VALUES($idTercero, $idCorreo)");
      }

      $exec->commit();
      return  $idContacto;
    } catch (PDOException $e) {
      //throw $th;
      $exec->rollBack();
      echo "Ah ocurrido un error: " . $e->getMessage();
      throw new Exception('internal-database-error');
    }
  }


  static public function actualizarContacto($datos)
  {


    $respuesta = Conection::connect()->prepare("
    SELECT 
    c.idContacto,
    c.idTercero,
    COALESCE(tt.idTelefono,0) AS idTelefono,
    COALESCE(tc.idCorreo,0) AS idCorreo
    FROM contacto c 
    INNER JOIN tercero t ON t.idTercero = c.idTercero
    LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
    LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
    WHERE c.idContacto = " . $datos['idContacto'] . "
    LIMIT 1");
    $respuesta->execute();
    $records = $respuesta->fetchAll();

    $idTercero = $records[0]['idTercero'];
    $idTelefono = $records[0]['idTelefono'];
    $idCorreo = $records[0]['idCorreo'];
    // $idIdentificacion = $records[0]['idIdentificacion'];

    if (count($records) > 0) {


      if ($records[0]['idTelefono'] > 0) {
        Conection::connect()->prepare("UPDATE telefono SET descripcion = '" . $datos['telefono'] . "' WHERE idTelefono = " . $idTelefono . "")->execute();
      } else {
        $stmt = Conection::connect();
        $respuesta = $stmt->prepare("INSERT INTO telefono(descripcion)
            VALUES('" . $datos["telefono"] . "')")->execute();
        $idTelefono = $stmt->lastInsertId();

        $stmt->prepare("INSERT INTO tercero_telefono(idTercero, idTelefono)
            VALUES($idTercero, $idTelefono)")->execute();
      }


      if ($records[0]['idCorreo'] > 0) {
        Conection::connect()->prepare("UPDATE correo SET descripcion = '" . $datos['correo'] . "' WHERE idCorreo = " . $idCorreo . "")->execute();
      } else {
        $stmt = Conection::connect();
        $respuesta = $stmt->prepare("INSERT INTO correo(descripcion)
            VALUES('" . $datos["correo"] . "')")->execute();
        $idCorreo = $stmt->lastInsertId();

        $stmt->prepare("INSERT INTO tercero_correo(idTercero, idCorreo)
            VALUES($idTercero, $idCorreo)")->execute();
      }


      $data = Conection::connect()->prepare("UPDATE contacto u SET c.esCliente = " . $datos['esCliente'] . ", c.esProveedor = '" . $datos['esProveedor'] . "', c.nombre = '" . $datos['nombre'] . "', c.razonSocial = " . $datos['razonSocial'] . "', c.idTipoIdentificacion = " . $datos['idTipoIdentificacion'] . "', c.identificacion = " . $datos['identificacion'] .  "', c.idTipoComprobante = " . $datos['idTipoComprobante'] . "', c.activo = " . $datos['estado'] . " 
       WHERE c.idContacto = " . $datos['idContacto'] . "")->execute();

      return $data;
    }
  }



  static public function eliminarContacto($idContacto)
  {
    $respuesta = Conection::connect()->prepare("
    SELECT 
    c.idContacto,
    c.idTercero,
    COALESCE(tt.idTelefono,0) AS idTelefono,
    COALESCE(tc.idCorreo,0) AS idCorreo
    FROM contacto c 
    INNER JOIN tercero t ON t.idTercero = c.idTercero
    LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
    LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
      WHERE c.idContacto = " . $idContacto . "
      LIMIT 1");
    $respuesta->execute();
    $records = $respuesta->fetchAll();

    $idContacto = $records[0]['idContacto'];
    // $idPersona = $records[0]['idPersona'];
    $idTercero = $records[0]['idTercero'];
    $idTelefono = $records[0]['idTelefono'];
    $idCorreo = $records[0]['idCorreo'];

    if (count($records) > 0) {
      if ($idTelefono > 0) {
        Conection::connect()->prepare("DELETE FROM tercero_telefono WHERE idTelefono = $idTelefono")->execute();
        Conection::connect()->prepare("DELETE FROM telefono WHERE idTelefono = $idTelefono")->execute();
      }
      if ($idCorreo > 0) {
        Conection::connect()->prepare("DELETE FROM tercero_correo WHERE idCorreo = $idCorreo")->execute();
        Conection::connect()->prepare("DELETE FROM correo WHERE idCorreo = $idCorreo")->execute();
      }

      Conection::connect()->prepare("DELETE FROM tercero WHERE idTercero = $idTercero")->execute();
      // Conection::connect()->prepare("DELETE FROM persona WHERE idPersona = $idPersona")->execute();
      Conection::connect()->prepare("DELETE FROM contacto WHERE idContacto = $idContacto")->execute();
    }

    return (count($records) > 0) ? true : false;
  }
}
