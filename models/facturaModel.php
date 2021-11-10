<?php

require_once "Conection.php";

class FacturaModel
{

  static public function getFactura($numFactura)
  {
    // echo $numFactura;

    $data = Conection::connect()->prepare(
      "SELECT 
        f.numeroFactura,
        f.NFC,
        f.idCliente,
        df.*
      FROM factura f
      INNER JOIN detalle_factura df ON f.numeroFactura = df.numeroFactura
      WHERE f.numeroFactura = :numFactura"
    );
    $data->bindParam(":numFactura", $numFactura, PDO::PARAM_INT);
    $data->execute();
    return $data->fetchAll(PDO::FETCH_ASSOC);
  }


  static public function registrar($data)
  {

    $stm = Conection::connect();
    $stm->beginTransaction();

    try {

      /**
       * ESTADOS DE LAS FACTURAS
       * 1 PENDIENTE
       * 2 PAGADA
       * 3 CANCELADA
       * 4 PAGADA
       * 5 INCOBRABLE
       */
      $estado = 2;
      if($data['credito'] > 0) {
        $estado = 1; //FACTURA A CREDITO
      }

      // print_r($data);
      $dbh = $stm->prepare("INSERT INTO factura(idUser,idCliente, idTipoVenta, pagoEfectivo, pagoTransferencia, credito, idEstado) 
                VALUES(:creado_por, :cliente, :tipoFactura, :pagoEfectivo, :pagoTransferencia, :credito, :estado)");

      $dbh->bindParam(":cliente", $data['cliente'], PDO::PARAM_INT);
      $dbh->bindParam(":tipoFactura", $data['tipoFactura'], PDO::PARAM_INT);
      $dbh->bindParam(":pagoEfectivo", $data['pagoEfectivo'], PDO::PARAM_INT);
      $dbh->bindParam(":pagoTransferencia", $data['pagoTransferencia'], PDO::PARAM_INT);
      $dbh->bindParam(":credito", $data['credito'], PDO::PARAM_INT);
      $dbh->bindParam(":estado", $estado, PDO::PARAM_INT);
      $dbh->bindParam(":creado_por", $data['creado_por'], PDO::PARAM_INT);
      $dbh->execute();
      $numfactura = $stm->lastInsertId();

      // echo "factura: " . $numfactura;

      // $dbh->bindParam(":NCF", $data['cliente'], PDO::PARAM_STR);
      // $dbh->bindParam(":contado", $contado, PDO::PARAM_BOOL);
      // $dbh->bindParam(":credito", $credito, PDO::PARAM_BOOL);
      // $dbh->bindParam(":idCliente", $data['cliente'], PDO::PARAM_INT);
      // $dbh->bindParam(":montoContado", $data['pagoEfectivo'], PDO::PARAM_INT);
      // // $dbh->bindParam(":montoTransferencia", $data['pagoTransferencia'], PDO::PARAM_INT);
      // $dbh->bindParam(":montoCredito", $data['credito'], PDO::PARAM_INT);
      // $dbh->bindParam(":nota", $data['nota'], PDO::PARAM_STR);
      // $dbh->bindParam(":idUser", $data['creado_por'], PDO::PARAM_INT);
      // $dbh->execute();
      // $idFactura = $stm->lastInsertId();

      // print_r($data['productos']);
      foreach ($data['productos'] as $key) {
        $dbh = $stm->prepare("INSERT INTO detalle_factura(numeroFactura, idProducto, cantidad, precio, itbis) 
        SELECT 
                    :numFactura AS numFactura,
                    p.idProducto, 
                  :cantidad1 AS cantidad,
                  (SELECT pv.precion FROM precio_venta pv WHERE pv.idProducto = p.idProducto ORDER BY pv.fecha DESC LIMIT 1) AS precio,
                  :cantidad2 * 0.18 AS itbis
        FROM producto p WHERE p.idProducto = :idProducto");

        $cantidad = number_format($key->cantidad);
        // echo "[cantidad: $cantidad]";
        // $itbis = number_format($key->itbis, 2);
        $dbh->bindParam(":numFactura", $numfactura, PDO::PARAM_INT);
        $dbh->bindParam(":idProducto", $key->idProducto, PDO::PARAM_INT);
        $dbh->bindParam(":cantidad1", $key->cantidad, PDO::PARAM_INT);
        $dbh->bindParam(":cantidad2", $key->cantidad, PDO::PARAM_INT);
        // $dbh->bindParam(":itbis", $itbis, PDO::PARAM_STR);
        $dbh->execute();
        // $idFactura = $stm->count();


      }

      $stm->commit();

      return array("numeroFactura" => $numfactura, "success" => true, "msg" => "Se ha registrado de forma correacta");
    } catch (PDOException $ex) {
      $stm->rollBack();
      print "Error!!" . $ex->getMessage();
      return array("numeroFactura" => 0, "success" => false, "msg" => "Ah ocurrido un error interno");
    }
    return array("numeroFactura" => 0, "success" => false, "msg" => "Ah ocurrido un error interno");
  }
}
