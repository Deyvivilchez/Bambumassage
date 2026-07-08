<!DOCTYPE html>

<html lang="en">
@include('web.componentes_web.head')

<body data-bs-spy="scroll" data-bs-target="#navbar">
    <div class="super_container" id="appgg">
        @include('web.componentes_web.nav')
        <div class="home_slider_container content-slider">
            <div class="owl-carousel owl-theme home_slider promociones_card" id="home_slider">
                @foreach ($sliderIni as $sliderIni)
                    <div class="owl-item">
                        {{-- <div class="home_slider_background bg-danger" 
                            style="background-image:url(web/images/inicio/{{ $sliderIni->imagen }})">
                                <img style="web/images/inicio/{{ $sliderIni->imagen }}" style="background: #FFF">
                            </div> --}}
                        <img src="web/images/inicio/{{ $sliderIni->imagen }}">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="cardsmodule__base p-0 m-0 bmb-section-menu">
            <div
                class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">
                <div class="row m-0 bmb-section-menu-row">
                    <div class="col-12	col-sm-4	col-md-4	col-lg-4	col-xl-4 inicio-submenu py-1"
                        style="background-color: #6FB596;">

                        <a href="#quienes-somos" class="sub_header">QUIENES SOMOS</a>

                    </div>
                    <div class="
                               col-12
                                col-sm-4
                                col-md-4
                                col-lg-4
                                inicio-submenu py-1"
                        style="background-color: #D0DFBA; ">

                        <a href="#experiencias" class="sub_header">
                            EXPERIENCIAS
                        </a>

                    </div>

                    <div class="col-12	col-sm-4	col-md-4	col-lg-4 inicio-submenu py-1"
                        style="background-color: #C5DED6;">

                        <a href="#nuestras-salas" class="sub_header">NUESTRAS SALAS</a>

                    </div>

                </div>
            </div>
        </div>
        {{-- quines somos inicio  --}}
        <div class="cardsmodule__base background--100 bmb-about-luxe" id="quienes-somos">
            <div class="bmb-bamboo-deco bmb-bamboo-deco-left"></div>
            <div class="bmb-bamboo-deco bmb-bamboo-deco-right"></div>
            <div
                class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">
                <div class="row m-0 p-0 align-items-center bmb-about-grid">
                    <div class="col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="bmb-about-photo-wrap">
                            <div class="bmb-about-photo">
                                <img src="web/images/inicio/{{ $conociendonos[0]->imagen }}" alt="{{ $conociendonos[0]->autor }}">
                                <div class="bmb-about-name">
                                    <span>{{ $conociendonos[0]->autor }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="my-sm-2 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                        <div class="bmb-about-copy">
                            <span class="bmb-about-kicker">Bambú Massage</span>
                            <h2>Quienes somos</h2>
                            <div class="bmb-about-line"></div>
                            <p>
                                {{ $conociendonos[0]->descripcion }}
                            </p>
                            <div class="bmb-about-tags">
                                <span>Bienestar</span>
                                <span>Calidad</span>
                                <span>Atención personalizada</span>
                            </div>
                            <div class="bmb-about-signature">
                                <span></span>
                                <strong>Relajación con esencia natural</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- quienes somo fin --}}

        <div class="bmb-section-divider">
            <span></span>
        </div>


        {{-- nuestros serv inicio --}}

        <div class="cardsmodule__base background--100 bmb-services-start">
            <div
                class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">
                <div class="row bmb-services-heading">

                    <div class="col d-flex justify-content-center">

                        <div class="titulosSeccion">Nuestros servicios</div>

                    </div>

                </div>
                <div class="flex-wrap w-100 d-inline-flex d-flex justify-content-center bmb-services-grid">
                    @foreach ($servicios as $key => $serv)
                        <div class="col-sm-6 col-lg-4 bmb-service-card">
                            <a href="{{ $serv->link_redireccion }}" target="_blank" class="bmb-service-link">
                                <div class="col-lg-12 p-0">
                                    <div class="img-area">
                                        <img src="web/images/img_servicios/{{ $serv->imagen }}" alt="{{ $serv->nombre_categoria }}">
                                        <div class="img-text">
                                            <h4 class="">{{ $serv->nombre_categoria }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        {{-- <div class="row px-5 pt-5  mb-5 mb-4 d-flex justify-content-center my-2">
            <div class=" flex-wrap  w-75 d-inline-flex">
                @foreach ($servicios as $key => $serv)
                    <div class="col-lg-4 mt-5 rounded">
                        <div class="col-lg-12 ">
                            <div class="img-area">
                                <img src="web/images/img_servicios/{{ $serv->imagen }}" alt=""
                                    style="width: 100%; height: 100%;">

                                <div class="img-text">

                                    <h4 class="">{{ $serv->nombre_categoria }}</h4>

                                </div>

                            </div>

                        </div>

                    </div>
                @endforeach
            </div>
        </div> --}}
        {{-- nuestors servisios fin --}}

        <div class="cardsmodule__base background--100 my-2 bmb-corporate-section">
            <div
                class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">


                <div class="w-100 p-1 bmb-corporate-content">
                    <div class="bmb-corporate-copy">
                        <span class="bmb-corporate-kicker">Empresas y equipos</span>
                        <div class="titulosSeccionCorporativa">
                            Ventas corporativas
                        </div>
                        <p>
                            Brindamos una opción diferente a empresas públicas o privadas que deseen premiar, motivar y
                            fidelizar a sus colaboradores, clientes fuerza de ventas o proveedores; ofreciendo una amplia
                            galeria de terapias relajantes y descontracturantes junto a una asesoría personalizada,
                            garantizando nuestra excelente calidad de servicio y sus altos estandares.
                        </p>
                    </div>
                    <div class="ventas_corporativas bmb-corporate-action">
                        <div class="content_ventas_contacto">
                            <a href="https://wa.me/51997508484" target="_blank">
                                <button>Contactar</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        {{-- venta copororativa --}}


        {{-- fin venta corporativa --}}


        {{-- nuestras salas inicio --}}
        <div class="cardsmodule__base background--100 my-2 bmb-rooms-polish" id="nuestras-salas">
            <div
                class="container swiper-container swiper-container-initialized
                        swiper-container-horizontal swiper-container-android text-center">

                <div class="titulosSeccion">Nuestras Salas</div>

                <section id="portfolio" class="portfolio m-0 p-0 bmb-rooms-gallery">
                    <div class="container" data-aos="fade-up">
                        <div class="row" data-aos="fade-up" data-aos-delay="100">
                            <div class="col-lg-12 d-flex justify-content-center my-2 bmb-room-filter-wrap">
                                <ul id="portfolio-flters">
                                    {{-- <li data-filter="*" class="filter-active" style="font-size: 2vw;" >All</li> --}}
                                    @foreach ($sedes as $sede)
                                        <li data-filter=".sede-{{ $sede->id_sede }}"
                                            id="sede-{{ $sede->id_sede }}" class="<?php if ($sede->id_sede == 1) {
                                                echo 'filter-active';
                                            } ?>"
                                            @click="filtrar(<?php echo $sede->id_sede; ?>)">
                                            {{ $sede->sede }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="scrollbar-personalizado px-2 bmb-room-scroll">

                            <div class="row portfolio-container  justify-content-center ">
                                @foreach ($salas as $ks => $sala)
                                    <div class="col-6 col-sm-6 col-md-4  portfolio-item sede-{{ $sala->id_sede }}"
                                        v-on:click="abrirModalGaleria(<?php echo $sala->id_foto; ?>)">
                                        <div class="portfolio-wrap">
                                            <img src="salas/{{ $sala->imagen }}" class="img-fluid">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </section>
            </div>  
        </div>

        {{-- nuestras salas fin --}}
        {{-- inicio experiencias style="background-color: #FFFF;"  style="background-color: #FFFF;" style="background-image: url('web/images/inicio/degradado-seccion.jpg')" --}}
        <div class="cardsmodule__base background-100 my-2 bmb-experience-section" id="experiencias">
            <div
                class="container 
                        swiper-container 
                        swiper-container-initialized 
                        swiper-container-horizontal 
                        swiper-container-android 
                        text-center mt-4 bmb-experience-container">
                <div class="titulosSeccion">Experiencias</div>
                <div class="experienciaCarrusel owl-carousel owl-theme wiper-wrapper swiper-smooth ">
                    @foreach ($comentarios as $key => $exp)
                        <div class="ol-12 swiper-wrapper swiper-smooth ">
                            <div class="m-1 card bmb-experience-card">
                                <Transition duration="550" name="nested">
                                    <div class="experiencia" v-if="showComment[{{ $exp->id_comentario }}]">
                                        {{ $exp->comentario }}
                                    </div>
                                </Transition>
                                <div class="m-2 bmb-experience-img-wrap">
                                    <img src="web/images/img_comentarios/{{ $exp->imagen }}" class="card-img-top">
                                </div>
                                <div class="card-body font-weight-bold bmb-experience-author">
                                    {{ $exp->autor }}
                                    <i class="fa fa-eye fa-1x" aria-hidden="true"
                                        @mouseover="showComment[{{ $exp->id_comentario }}] = true"
                                        @mouseleave="showComment[{{ $exp->id_comentario }}] = false"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- fin experiencias --}}
        <div class="cardsmodule__base background-100 " style="background: #FFF;">
            <div
                class="container 
                    swiper-container 
                    swiper-container-initialized 
                    swiper-container-horizontal 
                    swiper-container-android">
                <div class="col d-flex justify-content-center ">
                    <div class="titulosSeccion">
                        Contáctanos
                        <i class="fa fa-whatsapp fa-fw" aria-hidden="true" style="fill:#5b8676">
                        </i>


                    </div>

                </div>
                <div class="row  d-flex justify-content-center">
                    <div class="w-100  px-4 ">
                        <p class="text-justify px-4" style="  font-size: 1.02rem;">
                            Escríbenos y reserva tu cita con nosotras, atendemos en horarios de lunes a sábado de 10am a
                            9pm y domingos o feriados de 11am a 7pm.
                        </p>
                    </div>
                </div>
                <div class="contactanosCarrusel owl-carousel owl-theme">

                    @foreach ($sedes as $key => $sede)
                        <a href="{{ $sede->link_w }}" class="contaxto_text" target="_blank">

                            <div class="m-1 card  card-contactanos">
                                <div class="m-2 ">
                                    <img class="w-100" src="web/images/img_sedes/{{ $sede->imagen }}"
                                        class="card-img-top">
                                </div>
                                <div class="card-body pt-1" style="color: #5b8676;">
                                    <h6 class="card-title font-weight-bold">
                                        <i class="fa fa-whatsapp fa-fw " aria-hidden="true"> </i>{{ $sede->sede }}

                                    </h6>
                                    <h6>
                                        <span class="card-text" style="">{{ $sede->direccion }}</span>
                                    </h6>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        {{-- contactanos fin --}}

        <!-- Modal Galeria -->

        <div class="modal fade bd-example-modal-lg" id="modalgaleria" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="background: #fff0; border:none;  ">
                    <div class="modal-header" style="box-shadow:none; border-bottom: 1px solid #e9ecef00;">

                        <button type="button text-white" class="close" data-dismiss="modal" aria-label="Close"
                            @click="reiniciarModalGaleria">
                            <span aria-hidden="true" style="color:#FFF">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container ">
                            <div class="row">
                                <div class="col-12">
                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner text-center">
                                            <div class="carousel-item f-flex justify-content-center grupo-galeria"
                                                v-for="(item,index) in listaSalasFiltrada" :key="index"
                                                :class="[
                                                    [imagenInicial].includes(item.id_foto) ? 'active' : '',
                                                ]">


                                                <img class="d-block w-75" :src="'salas/' + item.imagen"
                                                    alt="First slide">

                                            </div>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleControls"
                                            role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleControls"
                                            role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="cardsmodule__base background--100  " style="background-color: #e2ebe0;">
        <div
            class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android">
            <div class="container w-100  p-1">
                <div class="row">
                    <div class="col">
                        <p class="text-justify  inicio-submenu">
                        <div class="titulosSeccionCorporativa">
                            Trabaja con nosotros
                        </div>
                        </p>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-10">
                        <div class="d-flex " style=" color: rgb(141, 157, 153); font-size: 1.02rem;">
                            Estamos buscando personas con tus habilidades, si deseas ser parte de nuestro equipo haz
                            click en el botón
                        </div>
                    </div>
                    <div class="col-md-2 mt-2 mt-md-0">
                        <div class="content_ventas_contacto" style=" font-size:20px;">
                            <a href="https://wa.me/51997508484" target="_blank">
                                <button>Contactar</button>
                            </a>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal bg-white" id="modal-carga" data-backdrop="static" data-keyboard="true">
        <div class="d-flex align-items-center justify-content-center h-100">
            <img src="personalizado/icons8-spinner.gif" style="width: 50px; height: 50px;">
        </div>
    </div>

    @if (sizeof($lisevento) > 0)
    <div class="modal fade bd-example-modal-lg"  
            id="modal-flayer" 
            tabindex="-1" role="dialog" 
            aria-labelledby="myLargeModalLabel" 
            aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                <div >
                    <div class="row">
                        <a  href="inscripcion/{{$lisevento[0]->id_evento}}" >
                            <img src="web/images/eventos/{{ $lisevento[0]->flayer }}"  class="w-100">
                        </a>
                    </div>     
                </div>
          </div>
        </div>
    </div>
        {{-- <div class="modal fade bd-example-modal-lg" 
            style="top: 200px;" 
            id="modal-flayer" tabindex="-1"
            role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="container " class="w-100">
                <div class="row">
                    <a href="inscripcion/{{ $lisevento[0]->id_evento }}">
                        <img src="web/images/eventos/{{ $lisevento[0]->flayer }}" style="width: 100%">
                    </a>
                </div>
            </div>
        </div> --}}
    @endif
    @include('web.componentes_web.footer')
    @include('web.componentes_web.script')
        <style>
        @media (min-width: 992px) {
            .modal-lg {
                max-width:1200px;
            }
        }

        .modal-content {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            pointer-events: auto;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.2);
            border-radius: 0.3rem;
            outline: 0;
            margin-top: 200px;
        }
        </style>

    <script>
        $(document).ready(function() {
            $("#modal-carga").modal("toggle");
            $(".main_nav #inicio").addClass("active");

        });

        const servicios = <?php echo $servicios; ?>


        const sedes = <?php echo $sedes; ?>



        const experiencias = <?php echo $comentarios; ?>



        const salas = <?php echo $salas; ?>


        const lisevento = <?php echo $lisevento; ?>
    </script>



    <script>
        const libApp = {
            data() {
                return {
                    experiencias: experiencias,
                    listaExperiencias: [],
                    showComment: [],
                    listaSalasFiltrada: [],
                    salas: salas,
                    listaFiltrada: [],
                    imagenInicial: null,
                    lisevento: lisevento,
                }
            },
            created() {
                this.experiencias.forEach(
                    (exp) => {
                        this.showComment[exp.id_comentario] = false;
                    }
                );
                this.filtrar(1);
            },
            mounted() {
                $("#modal-carga").modal("toggle");
                console.log(this.lisevento);
                if (this.lisevento.length > 0) {
                    $("#modal-flayer").modal("toggle");
                }
            },
            methods: {
                filtrar(id) {
                    this.listaSalasFiltrada = this.salas.filter(s => s.id_sede == id);
                },
                abrirModalGaleria(idFoto) {
                    console.log(idFoto);
                    this.imagenInicial = idFoto;
                    $("#modalgaleria").modal('show');
                },
                reiniciarModalGaleria() {
                    $('.grupo-galeria').removeClass('active')
                }
            },

        }

        Vue.createApp(libApp).mount('#appgg')
    </script>

    <script>
        window.addEventListener('load', function() {
            let item = document.getElementById('sede-1');
            item.click();
        });
    </script>

</body>



</html>
