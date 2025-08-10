<div id="app">

    <footer class="footer py-0 mt-0">
        <div class="container">
            <div class="row align-items-stretch">
                <div class="col-2 logo-footer p-2">
                    <a class="text-white text-center" href="{{ url('libro-reclamacion') }}">
                        {{-- <img src="{{url('')}}/adm_web/images/logo/logo-blanco.png" alt="" style="width: 120px;"> --}}
                        <img src="/web/images/libroReclamacion.png" style="width: 110px;">
                        <p class="text-white"> LIBRO RECLAMACIONES</p>
                    </a>
                </div>
                <div class="col nav-footer">
                    <ul class="nav  nav-fill d-none d-sm-none d-lg-flex d-md-flex">
                        <li class="nav-item"><a href="{{ url('') }}" class="active">INICIO</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle servicios_footer" data-toggle="dropdown" href="#"
                                role="button" aria-expanded="false" id="servicios">SERVICIOS</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item nav_dropdown " style="color:#61b194;font-weight: normal;"
                                    href="{{ url('') }}/servicios/1">Rituales</a>
                                <a class="dropdown-item nav_dropdown" style="color:#61b194;font-weight: normal;"
                                    href="{{ url('') }}/servicios/2">Masajes</a>
                                <a class="dropdown-item nav_dropdown" style="color:#61b194;font-weight: normal;"
                                    href="{{ url('') }}/servicios/3">Faciales</a>
                            </div>
                        </li>
                        <li class="nav-item"><a href="{{ url('') }}/gif-card">GIFT</a></li>
                        <li class="nav-item"><a href="{{ url('') }}/boutique">BOUTIQUE</a></li>
                        <li class="nav-item"><a href="https://linktr.ee/bambumassage" target="_blank">CONTACTO</a></li>
                    </ul>
                </div>
                <div class="col-2 redes-footer">
                    <div class="redes-sociales">
                        <div class="marca-footer mr-1">
                            <a target="_blank" href="https://www.facebook.com/BambuMassage1">
                                <i class="fa fa-facebook fa-fw" aria-hidden="true"
                                    style="margin-top: 8px;margin-left: 5px;"></i>
                            </a>
                        </div>
                        <div class="marca-footer mx-1">
                            <a target="_blank" href="https://bit.ly/3rIAlAC">
                                <i class="fa fa-instagram fa-fw" aria-hidden="true"
                                    style=" margin-top: 8px; margin-left: 5px;"></i>
                            </a>
                        </div>
                        <div class="marca-footer ml-1">
                            <a target="_blank" href="https://linktr.ee/bambumassage">
                                <i class="fa fa-whatsapp fa-fw" aria-hidden="true"
                                    style="
                            margin-top: 8px;
                            margin-left: 5px;
                        "></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col pt-3 pb-4 copyright-footer">
                    Copyright © 2023 Todos los derechos reservados a BambuMassage | diseñado por Phuyu-System
                </div>
            </div>
        </div>
        <a href="#" class="btn-flotante top-arrow">
            <i class="fa fa-angle-double-up fa-fw" aria-hidden="true" style="margin-left: 5px;"></i>
        </a>
        <a href="https://linktr.ee/bambumassage" target="_blank" class="btn-flotante whatsapp-msg">
            <i class="fa fa-whatsapp fa-fw" aria-hidden="true" style="margin-left: 5px;"></i>
        </a>
        <div id="faq-chat-app">
            <faq-chat></faq-chat>
        </div>
    </footer>

</div>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WGFKV8K4" height="0" width="0"
        style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<script src="{{ mix('js/faqchat.js') }}"></script>
