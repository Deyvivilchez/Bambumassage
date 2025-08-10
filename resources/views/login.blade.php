
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Bambu-Massage</title>
    <!-- Favicon icon -->
    <link rel="icon" type="adm_web/image/png" sizes="16x16" href="">
    <link href="adm_web/css/style.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="h-100">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <img  style="display:block; margin:auto;" src="adm_web/images/logo/logo_login.png" width="40%" >
                                <form class="mt-5 mb-5 login-input" id="form-login">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="usuario" name="usuario"
                                         placeholder="Usuario" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control"  id="clave" name="clave"
                                        placeholder="Contraseña" required>
                                    </div>
                                    <button class="btn login-form__btn submit w-100" id="btnlogin" name="btnlogin" >
                                        Ingresa
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--**********************************
        Scripts
    ***********************************-->
    <script src="adm_web/plugins/common/common.min.js"></script>
    <script src="adm_web/js/custom.min.js"></script>
    <script src="adm_web/js/settings.js"></script>
    <script src="adm_web/js/gleek.js"></script>
    <script src="adm_web/js/styleSwitcher.js"></script>
    <script src="adm_web/js/styleSwitcher.js"></script>
    <script src="adm_web/js/login.js"></script>
</body>
</html>





