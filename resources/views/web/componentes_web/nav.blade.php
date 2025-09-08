
        <header class="header my-0" id="app"  style="box-shadow: 0 0 11px #9ea5a2d8;">
            <div class="cardsmodule__base p-0 m-0 my-3">
                <div class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">

                    <div class="header_inner d-flex flex-row align-items-center justify-content-between" >

                        <a href="{{ url('') }}" class="p-0 d-lg-flex justify-content-center">
                            <img  class="h-75"

                            src="{{ url('') }}/web/images/LOGO.PNG"
                            style="width: 150px; height:auto;"

                                class="logo p-2 h-75" >
                            </a>

                        <nav class="main_nav w-100 p-0 d-lg-flex justify-content-center" >

                            <ul>

                                <li><a href="{{ url('') }}/" id="inicio">Inicio</a></li>

                                <li class="nav-item dropdown">

                                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"

                                        aria-expanded="false" id="servicios">Servicios</a>

                                    <div class="dropdown-menu">

                                        <a class="dropdown-item nav_dropdown"  href="{{ url('') }}/servicios/1">Rituales</a>

                                        <a class="dropdown-item nav_dropdown" href="{{ url('') }}/servicios/2">Masajes</a>

                                        <a class="dropdown-item nav_dropdown" href="{{ url('') }}/servicios/3">Faciales</a>

                                    </div>

                                </li>

                                <li><a href="{{ url('') }}/gif-card" id="gift">Gift - Card</a></li>

                                <li><a href="{{ url('') }}/boutique" id="boutique">Boutique</a></li>

                                {{-- <li><a href="{{ url('') }}/contacto" id="contacto">Contacto</a></li> --}}

                            </ul>

                        </nav>

                        <div  class="burger_container d-flex flex-column align-items-center justify-content-around menu_mm boton-menu">

                            <div></div>

                            <div></div>

                            <div></div>

                        </div>

                        <div class="redes-sociales ms-auto">

                            <div class="marca mx-1">

                                    <a target="_blank" href="https://www.facebook.com/BambuMassage1" style="color : #FFFF;" >

                                        <i href="" class="fa fa-facebook fa-fw" aria-hidden="true"
                                        style="margin-left: 5px; margin-top: 8px;"></i>

                                    </a>
                            </div>

                            <div class="marca mx-1">

                                <a target="_blank" href="https://bit.ly/3rIAlAC" style="color : #FFFF;">

                                <i class="fa fa-instagram fa-fw" aria-hidden="true" style="margin-left: 5px; margin-top: 8px;"></i>


                                </a>

                            </div>

                            <div class="marca ml-1">

                                <a target="_blank" href="https://linktr.ee/bambumassage" style="color : #FFFF;">

                                <i class="fa fa-whatsapp fa-fw" aria-hidden="true" style="margin-left: 5px; margin-top: 8px;"></i>

                                </a>

                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </header>
        <div class="menu d-flex flex-column align-items-end justify-content-start text-right menu_mm trans_400">

            <div class="menu_close_container">

                <div class="menu_close">

                    <div></div>

                    <div></div>

                </div>

            </div>

            <a href="index.html"><img src="{{ url('') }}/web/images/LOGO.PNG" style="width: 230px;" /></a>

            <nav class="menu_nav">

                <ul class="menu_mm">

                    <li><a href="{{ url('') }}">Inicio</a></li>

                    <li class="nav-item dropdown">

                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"

                            aria-expanded="false">Servicios</a>

                        <div class="dropdown-menu">

                            <a class="dropdown-item" href="{{ url('') }}/servicios/1">Rituales</a>

                            <a class="dropdown-item" href="{{ url('') }}/servicios/2">Masajes</a>

                            <a class="dropdown-item" href="{{ url('') }}/servicios/3">Faciales</a>

                        </div>

                    </li>

                    <li><a href="{{ url('') }}/gif-card">Gif Card</a></li>

                    <li><a href="{{ url('') }}/boutique">Boutique</a></li>

                    {{-- <li><a href="{{ url('') }}/contacto">Contacto</a></li> --}}

                </ul>

            </nav>

        </div>








