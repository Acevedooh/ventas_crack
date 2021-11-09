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
      // $('#descripcion').val(data.nombrePro);

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
       
            <td>
              <button type="button" class="btn btn-danger btn-sm eliminar" id><i class="fa fa-trash"></i></button>
            </td>
          <tr>`;
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

    //Recalcular total

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








});
