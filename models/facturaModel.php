<?php

require_once "Conection.php";

class FacturaModel
{

  static public function getFactura($numFactura)
  {
    // echo $numFactura;

    $data = Conection::connect()->prepare(
      "SELECT 
              f.idFactura,
              f.NCF,
              f.contado,
              f.credito,
              f.fecha,
              c.nombre AS cliente,
              COALESCE(t.descripcion,' - ') AS telefono,
              COALESCE(cr.descripcion,' - ') AS correo,
              ci.descripcion AS ciudad,
              d.sector,
              d.direccion,
              f.montoContado,
              f.montoTransferencia,
              f.montoCredito,
              p.idProducto,
              p.codigo,
              p.nombre,
              fd.cantidad,
              fd.precio,
              fd.itbis,
              ROUND((fd.cantidad * fd.precio)+fd.itbis,2) AS importe
            FROM factura f
            INNER JOIN contacto c ON f.idCliente = c.idContacto
            INNER JOIN factura_detalle fd ON fd.idFactura = f.idFactura
            INNER JOIN producto p ON fd.idProducto = p.idProducto
            LEFT JOIN tercero_telefono tt ON tt.idTercero = c.idTercero
            LEFT JOIN telefono t ON t.idTelefono = tt.idTelefono
            LEFT JOIN tercero_correo tc ON tc.idTercero = c.idTercero
            LEFT JOIN correo cr ON tc.idCorreo = cr.idCorreo
            LEFT JOIN direccion d ON d.idTercero = c.idTercero
            LEFT JOIN ciudad ci ON d.idCiudad = ci.idCiudad
          WHERE f.idFactura = :numFactura"
    );
    $data->bindParam(":numFactura", $numFactura, PDO::PARAM_INT);
    $data->execute();
    return $data->fetchAll();
  }

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
          INNER JOIN usuario u ON u.idUsuario = a.creado_por
          INNER JOIN persona pr ON u.idPersona = pr.idPersona
          LEFT JOIN direccion d ON a.idTercero = d.idTercero
          LEFT JOIN ciudad c ON d.idCiudad = c.idCiudad
          LEFT JOIN provincia p ON d.idProvincia = p.idProvincia"
    );
    // $data->bindParam(":usuario", $item, PDO::PARAM_STR);
    $data->execute();
    return $data->fetchAll();
  }

  static public function registrar($data)
  {

    $stm = Conection::connect();
    $stm->beginTransaction();
    try {

      $contado = $data['pagoEfectivo'] > 0 ? TRUE : FALSE;
      $credito = $data['credito'] > 0 ? TRUE : FALSE;

      $dbh = $stm->prepare("INSERT INTO factura(NCF, contado, credito, idCliente, montoContado, montoTransferencia, montoCredito, nota, creado_por) 
                VALUES(:NCF, :contado, :credito, :idCliente, :montoContado, :montoTransferencia, :montoCredito, :nota, :creado_por)");
      $dbh->bindParam(":NCF", $data['cliente'], PDO::PARAM_STR);
      $dbh->bindParam(":contado", $contado, PDO::PARAM_BOOL);
      $dbh->bindParam(":credito", $credito, PDO::PARAM_BOOL);
      $dbh->bindParam(":idCliente", $data['cliente'], PDO::PARAM_INT);
      $dbh->bindParam(":montoContado", $data['pagoEfectivo'], PDO::PARAM_INT);
      $dbh->bindParam(":montoTransferencia", $data['pagoTransferencia'], PDO::PARAM_INT);
      $dbh->bindParam(":montoCredito", $data['credito'], PDO::PARAM_INT);
      $dbh->bindParam(":nota", $data['nota'], PDO::PARAM_STR);
      $dbh->bindParam(":creado_por", $data['creado_por'], PDO::PARAM_INT);
      $dbh->execute();
      $idFactura = $stm->lastInsertId();

      foreach ($data['productos'] as $key) {
        // print_r($key);
        $dbh = $stm->prepare("INSERT INTO factura_detalle(idFactura, idProducto, cantidad, precio, itbis) 
                        SELECT 
                          :idFactura,
                          :idProducto1,
                          :cantidad,
                          (SELECT pp.precioVenta 
                          FROM precio_producto pp WHERE pp.idProducto = p.idProducto 
                          ORDER BY pp.fecha DESC LIMIT 1 ) AS precioVenta,
                          :itbis
                        FROM producto p WHERE p.idProducto = :idProducto2");

        $cantidad = number_format($key->cantidad, 2);
        $itbis = number_format($key->itbis, 2);
        $dbh->bindParam(":idFactura", $idFactura, PDO::PARAM_INT);
        $dbh->bindParam(":idProducto1", $key->idProducto, PDO::PARAM_INT);
        $dbh->bindParam(":idProducto2", $key->idProducto, PDO::PARAM_INT);
        $dbh->bindParam(":cantidad", $cantidad, PDO::PARAM_STR);
        $dbh->bindParam(":itbis", $itbis, PDO::PARAM_STR);
        $dbh->execute();
        // $idFactura = $stm->lastInsertId();
      }

      $stm->commit();

      return array("numFactura" => $idFactura, "success" => true, "msg" => "Se ha registrado de forma correacta");
    } catch (PDOException $ex) {
      $stm->rollBack();
      print "Error!!" . $ex->getMessage();
      return array("numFactura" => 0, "success" => false, "msg" => "Ah ocurrido un error interno");
    }
    return array("numFactura" => 0, "success" => false, "msg" => "Ah ocurrido un error interno");
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
