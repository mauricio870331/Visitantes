$( document ).ready(function() {

    $("#cedula").blur(function () {

        var campos = {"cedula": $("#cedula").val(), "opc":$("#opc").val()};
        $.ajax({
            data: campos,
            url: 'proc.php',
            type: 'post',
            beforeSend: function () {
                // $("#loading").css("display", "block");
            },
            success: function (response) {
                // $("#loading").css("display", "none");
                 if (response.codigo === "ok") {
                    // console.log(JSON.stringify(response));
                     $("#nombre").val(response.nombre);
                     $("#apellido").val(response.apellido);
                     $("#hora_ingreso").val(response.hora_ingreso);


                 }

            }
        });


    });

    $("#consultar").click(function () {

        var campos = {'documento':$('input:radio[name=opc1]:checked').val(),"fecha_ini": $("#fecha_ini").val(), "fecha_final":$("#fecha_final").val(),"identificacion":$("#identificacion").val(),"tipo_vehiculo":$("#selec_vehiculo").val()}


        $.ajax({
            data: campos,
            url: 'realiza_informe.php',
            type: 'post',
            beforeSend: function () {
                $("#carga").css("display", "block");
            },
            success: function (response) {
                $("#carga").css("display", "none");
                $("#resultado").css("display", "block");

                    // console.log(JSON.stringify(response));
                    $("#resultado").html(response);

            }
        });
    });
});