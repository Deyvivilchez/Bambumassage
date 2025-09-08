<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Panel Administrable web</title>
    <!-- Favicon icon -->
    <link rel="icon" type="adm_web/image/png" sizes="16x16" href="adm_web/images/logo/logo_login.png" />
    <!-- Pignose Calender -->
    <link href="adm_web/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet" />
    <!-- Chartist -->
    <link rel="stylesheet" href="adm_web/plugins/chartist/css/chartist.min.css" />
    <link rel="stylesheet" href="adm_web/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css" />
    <!-- Custom Stylesheet -->
    <link href="adm_web/css/style.css" rel="stylesheet" />
</head>

<body>
    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <b class="logo-abbr">
                    <img style="display: block; margin: auto" src="adm_web/images/logo/logo-blanco.png"
                        width="60%" />
                </b>
                <span class="logo-compact">
                    <img style="display: block; margin: auto" src="adm_web/images/logo/logo-blanco.png"
                        width="80%" />
                </span>
                <span class="brand-title">
                    <img style="display: block; margin: auto" src="adm_web/images/logo/logo-blanco.png"
                        width="68%" />
                </span>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content clearfix">
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>
                <div class="header-right">
                    <ul class="clearfix">
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative" data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="adm_web/images/user/1.png" height="40" width="40" alt="" />
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="app-profile.html"><i class="icon-user"></i>
                                                <span>Profile</span></a>
                                        </li>
                                        <li>
                                            <a href="salir"><i class="icon-key"></i> <span>salir</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="app">
        </div>
        <div class="">
            <div class="footer">
                <div class="copyright">
                    <p>
                        Copyright &copy;Bambumassage-desarrollado por
                        <a href="https://www.facebook.com/PhuyuSystem" target="_blank">Phuyu System</a>
                        2021
                    </p>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}" type="text/javascript"></script>

    <script src="adm_web/plugins/common/common.min.js"></script>
    <script src="adm_web/js/custom.min.js"></script>
    <script src="adm_web/js/settings.js"></script>
    <script src="adm_web/js/gleek.js"></script>
    <script src="adm_web/js/styleSwitcher.js"></script>

    <!-- Chartjs -->

    <script src="adm_web/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="adm_web/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="adm_web/plugins/d3v3/index.js"></script>
    <script src="adm_web/plugins/topojson/topojson.min.js"></script>
    <!-- <script src="adm_web/plugins/datamaps/datamaps.world.min.js"></script> -->
    <!-- Morrisjs -->
    <script src="adm_web/plugins/raphael/raphael.min.js"></script>
    <script src="adm_web/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="adm_web/plugins/moment/moment.min.js"></script>
    <script src="adm_web/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    {{-- <script src="adm_web/plugins/chartist/js/chartist.min.js"></script>
  <script src="adm_web/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script> --}}

    <script src="adm_web/plugins/tables/js/jquery.dataTables.min.js"></script>
    {{--  <script src="adm_web/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
  <script src="adm_web/plugins/tables/js/datatable-init/datatable-basic.min.js"></script> --}}
    <!-- <script src="adm_web/js/dashboard/dashboard-1.js"></script> -->
    <!-- personalizado/carousel-09/ -->

</body>

</html>
