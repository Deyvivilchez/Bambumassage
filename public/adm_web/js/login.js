$(document).ready(function(e) {
    $(document).on('click', '#btnlogin', function(e) {
        e.preventDefault();

        var parametros = {
            "usuario": $('#usuario').val(),
            "clave": $('#clave').val()
        };
        $.ajax({
            url: 'logeo',
            headers: { 'X-CSRF-Token': $('meta[name=csrf-token').attr('content') },
            type: 'post',
            data: parametros,
            success: function(respuesta) {
                if (respuesta == 1) {
                    location.href = "administracion";
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'USUARIO O CONTRASEÑA INCORRECTA!',
                        footer: '<a href>VUELVA A INTENTARLO</a>'
                    })
                }
            }
        });


    });
});