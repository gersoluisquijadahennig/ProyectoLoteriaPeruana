function realizaProceso(valor1, valor2, valor3, valor4){

        if( $('#consecutivo').prop('checked') ) {
                valor4 = 1;
        }else{
                valor4 =  null;
        }

        var parametros = {
                "numero" : valor1,
                "inicio" : valor2,
                "excluir" : valor3,
                "consecutivo" : valor4
        };
        $.ajax({
                data:  parametros,
                url:   'ejemplo6.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}

function mostrarArchivotxt(valor1,valor2){
        var parametros = {
                "archivo" : valor1,
                "numero" : valor2
        };
        $.ajax({
                data:  parametros,
                url:   'mostrarArchivo.php',
                type:  'post',
                beforeSend: function () {
                        $("#resultado").html("Procesando, espere por favor...");
                },
                success:  function (response) {
                        $("#resultado").html(response);
                }
        });
}
