$(function () {

  $('.select2').select2({
    theme: "bootstrap4",
    placeholder: "Select a option",
    minimumInputLength: 3,
    ajax: {
      url: 'ajax/index.php?c=Producto&m=getConsultaProducto',
      data: function (params) {
        var query = {
          buscar: params.term,
          type: 'public'
        }

        // Query parameters will be ?search=[term]&type=public
        return query;
      },
      dataType: "json",
      type: "GET",
      // delay: 250,
      processResults(data) {
        console.log("data: ", data);
        return {
          results: $.map(data, function (item) {
            return {
              text: item.nombrePro + ' (' + item.codigoPro + ')',
              id: item.idProducto,
              precio: item.precioVenta,
              codigoPro: item.codigoPro
            };
          }),
        };
      },
    },
    templateResult: function (data) {
      if (data.loading) {
        return "Cargando";
      }

      // $('#cantidad').focus().select();
      $('#precio').val(data.precio);
      console.log("data: ", data);
      var $contenedor = $(`<option value='${data.id}'>${data.text + '-'}</option>`);
      // const $contenedor = $(``);
      return $contenedor;
    },
    // templateSelection: function (dato) {
    //   //Agrega el precio del producto al input del precio
    //   $('#precio').val(dato.precio)
    //   return dato.nombre ? `${dato.nombre} (${dato.categoria})` : "";
    // },
  });

  $('#btnAgregarProducto').click(function () {
    const idProducto = $("#consultaProducto").val();

    //VERIFICAR SI EL PRODUCTO EXISTE EN LA TABLA
    if ($(`#bodyProductos tr[idProducto=${idProducto}]`).length === 0) {
      const nombre = $("#consultaProducto option:selected").text();
      const cantidad = $("#cantidad").val();
      const precio = $("#precio").val();
      const itbis = Number((Number(cantidad) * Number(precio)) * 0.18).toFixed(2);
      const importe = Number((Number(cantidad) * Number(precio)) + Number(itbis)).toFixed(2);
      // console.log('click');  
      const html =
        `<tr idProducto=${idProducto}>
            <td class='descripcion'>${nombre}</td>
            <td class='cantidad'>
              <input type='number' class='form-control cantidadTabla' style='width: auto' min='1' value='${cantidad}'>
            </td>
            <td class='precio'>
              ${precio}
            </td>
            <td class='itbis'>
              ${itbis}
            </td>
            <td class='importe'>
              ${importe}
            </td>
            <td>
              <button type="button" class="btn btn-danger btn-sm eliminar"><i class="fa fa-trash"></i></button>
            </td>
          </tr>`;
      $('#bodyProductos').append(html);
    } else {
      $(`#bodyProductos tr[idProducto=${idProducto}]`).each(function () {
        const cantidad = Number($(this).find('input.cantidadTabla').val());

        const precio = Number($(this).find('.precio').html());


        $(this).find('input.cantidadTabla').val(Number(cantidad) + Number($('#cantidad').val()));
        $(this).find('.importe').html(Number(precio) * Number(cantidad).toFixed(2));
      });

      //Actualizar el producto que se intenta agregar
      //Cantidad registrada actual

    }
    //Recalcular el total
    calcularTOTALES();
  });

  $('#bodyProductos').on('change', '.cantidadTabla', function () {


    console.log('input-cantidad', Number($(this).parent().parent().find('.precio').html()));
    const precio = Number($(this).parent().parent().find('.precio').html());
    const cantidad = Number($(this).parent().find('.cantidadTabla').val());

    const subtotal = precio * cantidad;
    const itbis = subtotal * 0.18;
    const importe = subtotal + itbis;

    $(this).parent().parent().find('.importe').html(importe.toFixed(2));
    $(this).parent().parent().find('.itbis').html(itbis.toFixed(2));

    console.log('input-cantidad');

    calcularTOTALES();
  });

  $('#bodyProductos').on('click', '.eliminar', function () {
    $(this).parent().parent().remove();
  });



  //  
  const agregarProductoAfacturar = (producto) => {
    if ($(`#bodyProductos tr[idProducto=${producto.idProducto}]`).length == 0) {
      if ($("#btnFacturar").prop("disabled")) {
        $("#btnFacturar").prop("disabled", false);
      }
      $("#bodyProductos").append(`
      <tr idProducto=${producto.idProducto} nombre=${producto.nombre
        } precio=${producto.precio} urlImagen=${producto.urlImagen
        } cantidad=${1}> 
        <td>
          <div class='d-flex align-items-center'>
            <div class='avatar avatar-lg'>
                <img src=${producto.urlImagen}>
            </div>
            <p class='font-bold ms-3 mb-0'>${producto.nombre}</p>
          </div>
        </td>
        <td class="cantidad"><input type="number" class="form-control input-cantidad" value="1" min="1"/></td>
        <td class="precio">${producto.precio}</td>
        <td class="itbis">${(producto.precio * 0.18).toFixed(2)}</td>
        <td class="importe">${(producto.precio * 1.18).toFixed(2)}</td>
        <td class="eliminar">
          <div class='btn-group btn-group-sm' role='group' aria-label='Acciones'>
            <button type='button' class='btn btn-danger btn-eliminarProducto' idProducto='${producto.idProducto
        }'><i class="bi bi-trash"></i>
            </button>
          </div>
        </td>
      </tr>
    `);
    } else {
      //Cambiar el precio de las tablas
      $(`#bodyProductos tr[idProducto=${producto.idProducto}]`).each(
        function () {
          // const precio = Number($(this).find(".precio").html());
          const cantidad = Number($(this).find(".input-cantidad").val()) + 1;
          const importe = Number(cantidad * producto.precio * 1.18).toFixed(2);
          const itbis = Number(cantidad * producto.precio * 0.18).toFixed(2);

          console.log("cantidad: ", $(this).find(".input-cantidad").val());

          $(this).find(".input-cantidad").val(cantidad);
          $(this).find(".importe").html(importe);
          $(this).find(".itbis").html(itbis);
          // console.log($(this).find('.cantidad').html())
        }
      );
    }

    //Recalculando cada vez que se modifique el arreglo de producto
    calcularTotalDOM();
  };





  //Calcular el total de la compra para mostrarlo en el DOM
  // const calcularTotalDOM = () => {
  //   let importe = 0;
  //   let cantidad = 0;
  //   let itbis = 0;
  //   $("#bodyProductos")
  //     .first()
  //     .find("tr")
  //     .each(function () {
  //       // console.log('valor: ', $(this).find('.cantidad').html());
  //       importe += Number($(this).find(".importe").html());
  //       cantidad += Number($(this).find(".input-cantidad").val());
  //       itbis += Number($(this).find(".itbis").html());
  //     });



  //   itbis = Number(itbis).toFixed(2);
  //   importe = Number(importe).toFixed(2);

  //   console.log("itbis: ", $(this).find(".itbis").html());
  //   console.log("importe: ", $(this).find(".importe").html());

  //   $("#totalCantidad").html(cantidad);
  //   $("#totalItbis").html(itbis);
  //   $("#totalImporte").html(Math.round(importe));
  // };


  $('#btnFacturar').click(function () {

    //Verficar si existe producto en la tabla
    if ($('#bodyProductos tr').length > 0) {
      const factura = {
        cliente: $('#ciudad').val(),
        tipoventa: $('#tipoVenta').val(),
        productos: [],
      };

      $('#bodyProductos tr').each(function () {
        const idProducto = $(this).attr('idproducto');
        const cantidad = Number($(this).find('input.cantidadTabla').val());
        factura.productos.push({
          idProducto: idProducto,
          cantidad: cantidad,
        });
        // $(this).html();
      });

      $.ajax({
        type: "POST",
        url: `ajax/index.php?c=Factura&m=registrar`,
        data: { json_string: JSON.stringify(factura) },
        beforeSend: function () {
          // $("#btnRegistrarPago").attr("disabled", true);
          // $("#formularioRegistrarFactura").css("opacity", ".5");
        },
        success: function (response) {
          console.log('facturar: ', response);
        },
      });


      console.log('producto: ', factura);
    }
  });

  const calcularTOTALES = () => {
    let itbis = 0;
    let importe = 0;
    let subtotal = 0;
    const cantidadproductos = $('#bodyProductos tr').length;

    $('#bodyProductos tr').each(function () {
      itbis += Number($(this).find('.itbis').html());
      importe += Number($(this).find('.importe').html());
      subtotal += Number($(this).find('input.cantidadTabla').val()) * Number($(this).find('.precio').html());;

    });


    $('#subTotal').html(subtotal);
    $('#totalItbis').html(itbis);
    $('#totalImporte').html(importe);
    $('#totalCantidad').html(cantidadproductos);
  }



  $("#facturacion").submit(function (event) {
    event.preventDefault();

    $("#modalRegistroFactura").modal("show");

    //Precargar los filtros de los componentes
    $("#tipoVenta").change();

    setTimeout(() => $("#pagoEfectivo").focus().select(), 1000);

    $("#itbisTotalModal").html($("#totalItbis").html());
    $("#totalModal").html($("#totalImporte").html());
    $("#cantidadProductoModal").html($("#totalCantidad").html());

    $("#montoApagar").val($("#totalImporte").html());

    console.log("Facturando...");
  });






  ///FACTURAR
  $("#btnFacturar").click(function () { });

  const formato = (n) => {
    return Number(n).toLocaleString("en-US", {
      style: "currency",
      currency: "USD",
      minimumFractionDigits: 2,
    });
  };

  $(".pagar").change(function () {
    let montoApagar = Number($("#totalImporte").html());
    const valores =
      Number($("#pagoEfectivo").val()) +
      Number($("#credito").val()) +
      Number($("#transferencia").val());
    montoApagar = Math.round(montoApagar - valores);
    $("#cantidadDevolver").val(valores > 0 ? Math.round(montoApagar) : 0);
    console.log("montoApagar", montoApagar);

    if (montoApagar == 0) {
      //Inabilitar el boton de guardar
      $("#btnRegistrarPago").prop("disabled", false);
      $("#cantidadDevolver").removeClass("is-invalid");
      $("#cantidadDevolver").addClass("is-valid");
    } else {
      $("#cantidadDevolver").removeClass("is-valid");
      $("#cantidadDevolver").addClass("is-invalid");
      $("#btnRegistrarPago").prop("disabled", true);
    }
  });

  $("#tipoVenta").change(function () {
    if ($(this).val() === "contado") {
      $("#credito").prop("disabled", true);
      $("#pagoEfectivo").prop("disabled", false);
      $("#transferencia").prop("disabled", false);

      $("#pagoEfectivo").val("");
      $("#transferencia").val("");
      $("#credito").val("");

      //CARGAR EL TOTAL EN EL REGISTRO DE CONTADO
      $("#pagoEfectivo")
        .val(Number($("#totalImporte").html()))
        .focus();
    } else if ($(this).val() === "credito") {
      $("#credito").prop("disabled", false).prop("readonly", true);
      $("#pagoEfectivo").prop("disabled", true);
      $("#transferencia").prop("disabled", true);

      $("#pagoEfectivo").val("");
      $("#transferencia").val("");

      //CARGAR EL TOTAL EN EL REGISTRO DE CONTADO
      $("#credito")
        .val(Number($("#totalImporte").html()))
        .focus();
    } else if ($(this).val() === "compuesto") {
      $("#pagoEfectivo").prop("disabled", false);
      $("#credito").prop("disabled", false).prop("readonly", false);
      $("#transferencia").prop("disabled", false);

      $("#pagoEfectivo").val("");
      $("#credito").val("");
      $("#transferencia").val("");

      $("#cantidadDevolver").val("0");
    }

    //ACTUALIZAR LOS INPUT DE LAS DEVOLUCIONES
    $(".pagar").change();
    // $('.pago').change();
  });

  $("#formularioRegistrarFactura").submit((e) => {
    e.preventDefault();

    // $("#modalRegistroFactura").modal("hide");
    $("#modalFactura").modal("show");

    const factura = {
      tipoFactura: $('#tipoVenta').val(),
      pagoEfectivo: Number($('#pagoEfectivo').val()),
      pagoTransferencia: Number($('#transferencia').val()),
      credito: Number($('#credito').val()),
      nota: $('#nota').val(),
      productos: []
    };


    //ITERAR SOBRE TODOS LOS PRODUCTOS AGREGADO AL CARRITO PARA FACTURAR
    $("#bodyProductos tr").each(function () {

      const idProducto = $(this).attr("idproducto");
      $(this).find(".input-cantidad").val();

      factura.productos.push({
        idProducto: Number(idProducto),
        cantidad: Number($(this).find(".input-cantidad").val()),
        precio: Number($(this).find(".precio").html()),
        itbis: Number($(this).find(".itbis").html()),
      });
    });

    console.log("cantidad: ", factura);

    $.ajax({
      type: "POST",
      url: `index.php?c=Factura&m=registrar`,
      data: { json_string: JSON.stringify(factura) },
      beforeSend: function () {
        // $("#btnRegistrarPago").attr("disabled", true);
        // $("#formularioRegistrarFactura").css("opacity", ".5");
      },
      success: function (response) {
        console.log("prueba: ", response);
        if (response.success) {
          Swal.fire("Bien!!", `${response.msg}!`, "success").then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
        } else {
          Swal.fire("Error!", `${response.msg}!`, "error");
        }
        $("#registroUsuario").css("opacity", "");
        $("#btnGuardar").removeAttr("disabled");
      },
    });
  });







});