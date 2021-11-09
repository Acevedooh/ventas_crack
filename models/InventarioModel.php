<?php

require_once "Conection.php";


class InventarioModel
{
  static public function getInventarios()
  {
    $data = Conection::connect()->prepare(
      "SELECT 
            a.idAlmacen,
            a.descripcion AS nombre,
            p.descripcion AS provincia,
            c.descripcion  AS ciudad,
            d.sector,
            d.direccion,
            a.creado_en,
            pr.nombre AS creado_por,
            a.activo
          FROM almacen a
          INNER JOIN User u ON u.idUsuario = a.creado_por
          INNER JOIN persona pr ON u.idPersona = pr.idPersona
          LEFT JOIN direccion d ON a.idTercero = d.idTercero
          LEFT JOIN ciudad c ON d.idCiudad = c.idCiudad
          LEFT JOIN provincia p ON d.idProvincia = p.idProvincia"
    );
    // $data->bindParam(":usuario", $item, PDO::PARAM_STR);
    $data->execute();
    return $data->fetchAll();
  }

  static public function registrarAlmacen($data)
  {

    $stm = Conection::connect();
    $stm->beginTransaction();
    $idInventario = 0;
    try {

      $dbh = $stm->prepare("INSERT INTO tercero VALUES()");
      $dbh->execute();
      $idTercero = $stm->lastInsertId();

      // if (strlen(trim($data['provincia'])) || strlen(trim($data['ciudad'])) > 0 || strlen(trim($data['sector'])) > 0 || strlen(trim($data['direccion'])) > 0) {

      //   $dbh = $stm->prepare("INSERT INTO direccion(idTercero, idProvincia, idCiudad, sector, direccion)
      //     VALUES(:idTercero, :provincia, :ciudad, :sector, :direccion)");
      //   $dbh->bindParam(":idTercero", $idTercero, PDO::PARAM_INT);
      //   $dbh->bindParam(":provincia", $data['provincia'], PDO::PARAM_INT);
      //   $dbh->bindParam(":ciudad", $data['ciudad'], PDO::PARAM_INT);
      //   $dbh->bindParam(":sector", $data['sector'], PDO::PARAM_STR);
      //   $dbh->bindParam(":direccion", $data['direccion'], PDO::PARAM_STR);
      //   $dbh->execute();
      // }


      if (isset($datos["provincia"]) && !empty($datos["provincia"])) {
        $stm->exec("INSERT INTO provincia(provincia)
        VALUES('" . $datos["provincia"] . "')");
        $idProvincia = $stm->lastInsertId();

        $stm->exec("INSERT INTO ciudad(idProvincia, ciudad)
        VALUES('" . $datos["ciudad"] . "')");
        $idCiudad = $stm->lastInsertId();

        $stm->exec("INSERT INTO direccion(idProvincia, idCiudad)
          VALUES($idProvincia, $idCiudad)");
        $idDireccion = $stm->lastInsertId();

        $stm->exec("INSERT INTO tercero_direccion(idTercero, idDireccion)
        VALUES($idTercero, $idDireccion)");
      }





      $dbh = $stm->prepare("INSERT INTO almacen(idTercero, descripcion, creado_por, activo) VALUES(:idTercero, :nombre, :creado_por, :estado)");
      $dbh->bindParam(":idTercero", $idTercero, PDO::PARAM_STR);
      $dbh->bindParam(":nombre", $data['nombre'], PDO::PARAM_STR);
      $dbh->bindParam(":creado_por", $data['creado_por'], PDO::PARAM_INT);
      $dbh->bindParam(":estado", $data['estado'], PDO::PARAM_BOOL);
      $dbh->execute();
      $idInventario = $stm->lastInsertId();

      $stm->commit();

      return $idInventario;
    } catch (PDOException $ex) {
      $stm->rollBack();
      print "Error!!" . $ex->getMessage();
      return 0;
    }
    return 0;
  }

  static public function eliminar($idUnidad)
  {
    $stmp = Conection::connect()->prepare("DELETE FROM unidad WHERE idUnidad = :idUnidad");
    $stmp->bindParam(":idUnidad", $idUnidad, PDO::PARAM_INT);
    $stmp->execute();

    return $stmp->rowCount();
  }

  static public function actualizarAlmacen($datos)
  {
    $stmp = Conection::connect()->prepare(
      "UPDATE unidad u set 
                u.descripcion = :unidad,
                u.abreviatura = :abreviatura,
                u.activo = :estado, 
                u.actualizado_en = CURRENT_TIMESTAMP(), 
                u.actualizado_por = :actualizado_por 
            WHERE u.idUnidad = :idUnidad"
    );

    $stmp->bindParam(":idUnidad", $datos['idUnidad'], PDO::PARAM_INT);
    $stmp->bindParam(":unidad", $datos['unidad'], PDO::PARAM_STR);
    $stmp->bindParam(":abreviatura", $datos['abreviatura'], PDO::PARAM_STR);
    $stmp->bindParam(":estado", $datos['estado'], PDO::PARAM_BOOL);
    $stmp->bindParam(":actualizado_por", $datos['actualizado_por'], PDO::PARAM_INT);
    $stmp->execute();
    return $stmp->rowCount();
  }
}
