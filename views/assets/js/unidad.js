$(function () {

  //VALIDACION
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert("Form successful submitted!");
      },
    });

    $("#formUnidad").validate({
      rules: {

        nombre: {
          required: true,
          minlength: 2,
        },
        estado: {
          required: true,
        },
      },
      messages: {
        terms: "Please accept our terms",
      },
      errorElement: "span",
      errorPlacement: function (error, element) {
        error.addClass("invalid-feedback");
        element.closest(".form-group").append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass("is-invalid");
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass("is-invalid");
      },

      submitHandler: function (e) {
        // console.log('evento: ', e);
        const dato = new FormData();
        let idUnidad = 0;
        idUnidad = Number($('#idUnidad').val());

        if (idUnidad > 0) {
          dato.append("exec", 'actualizandoUnidad');
          dato.append("idUnidad", Number($('#idUnidad').val()));
          console.log('actualizandoEmpleado');
        } else {
          dato.append("exec", 'registrarUnidad');
          console.log('registrarUnidad');
        }

        //return;
        // dato.append("exec", 'registrarEmpleado');
        dato.append("nombre", $("#nombre").val());
        dato.append("estado", $("#estado").val());

        console.log('daara: ', dato);
        $.ajax({
          url: "ajax/UnidadAjax.php",
          method: "POST",
          data: dato,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            console.log('respuesta: ', respuesta);
            // return;
            if (respuesta == true) {
              Swal.fire("Ok!", `${idUnidad > 0 ? 'Se ha actualizado correctamente!' : 'Se ha guardado correctamente!'}`, "success").then((result) => {
                location.reload();
              });
            } else {
              Swal.fire("Ok!", "Ah ocurrido un error!", "error").then((result) => {
                location.reload();
              });
            }

            // console.log(respuesta.status);
            $(".form-control").val("");
            $("#close").click();

            $("#idUnidad").val("0");
            $("#nombre").val("");
            $("#estado").val(1);
          },
        });
      },
    });
  });

  //SETEA EL CAMPO DE idUnidad que esta oculto
  $('#registrarUnidad').click(function () {
    $('#idUnidad').val(0);
    $("#nombre").val("");
    $("#estado").val(1);
    console.log('click');
  });

  //ELIMINAR UNIDAD
  $("#empleados").on("click", ".btn-eliminar", function () {
    const idEmpleado = $(this).attr("idEmpleado");
    console.log('idEmpleado: ', idEmpleado);
    Swal.fire({
      title: 'Estas seguro?',
      text: "Desea eliminar este empleado!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminarlo !',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        const data = new FormData();
        data.append("exec", 'eliminarEmpleado');
        data.append("idEmpleado", idEmpleado);

        $.ajax({
          url: "ajax/EmpleadoAjax.php",
          method: "POST",
          data: data,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function (respuesta) {
            if (Number(respuesta.status) == 200) {
              Swal.fire(
                'Eliminado!',
                'El empleado ha sido eliminado de forma correcta.',
                'success'
              ).then((result) => {
                location.reload();
              })
            } else {
              Swal.fire("Ok!", "Ah ocurrido un error!", "error").then((result) => {
                location.reload();
              });
            }
          },
        });
      }
    });
  });



  //EDITAR EMPLEADOS
  $("#empleados").on("click", ".btn-editar", function () {
    console.log($(".form-control").val());

    const idUnidad = $(this).attr("idUnidad");
    console.log('idUnidad: ', idUnidad);
    $('#idUnidad').val(idUnidad);

    const data = new FormData();
    data.append("exec", 'getUnidad');
    data.append("idUnidad", idUnidad);

    $.ajax({
      url: "ajax/UnidadAjax.php",
      method: "POST",
      data: data,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        console.log('editarRespuesta: ', respuesta);


        $("#idCategoria").val(respuesta["idUnidad"]);
        $("#nombre").val(respuesta["unidad"]);
        // $("#apellido").val(respuesta["apellido"]);
        // $("#sexo").val(Number(respuesta["idSexo"]));
        // $("#identificacion").val(respuesta["identificacion"]);
        // $("#usuario").val(respuesta["usuario"]);
        // $("#clave").val(respuesta["clave"]);
        // $("#tipoUsuario").val(Number(respuesta["idTipoUsuario"]));
        // $("#telefono").val(respuesta["telefono"]);
        // $("#Correo").val(respuesta["Correo"]);
        // $("#fechaNacimiento").val(respuesta["fechaNacimiento"]);
        $("#estado").val(respuesta["estado"]);
      },
    });
  });
});