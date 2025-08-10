<!DOCTYPE html>
<html lang="en">

@include('web.componentes_web.head')

<body>
    <div class="super_container" id="appgg">
        @include('web.componentes_web.nav')
        <div class="row">
            <div class="col" style="padding-top: 100px">
                <img src="{{url('')}}/portadas/{{ $portada[0]->portada_imagen }}" alt="" class="w-100">
            </div>
        </div>
        <!--fin home-->
        <div class="promo">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="section_title_container text-center">
                            <div class="section_title">Nuestras Sedes</div>
                            {{-- <div class="section_subtitle">Lima</div> --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($sedes as $sede)
                        <div class="col-sm-12 col-12 col-md-6 col-lg-4  col-xl-4 p-2 ">
                            <div class="card">
                                <div class="card-header justify-content-center"
                                    style="background-color:#42af89; color:aliceblue">
                                    <h4 class="card-title d-flex justify-content-center">{{ $sede->sede }}</h4>
                                </div>
                                <div class="card-body">

                                    <div class="promo_image">
                                        <iframe class="p-0" src="{{ $sede->mapa }}" width="100%"
                                            style="border:0; pading:0;" allowfullscreen="" loading="lazy">
                                        </iframe>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <ul>
                                        <li>
                                            <div class="contact_info_icon" style="color:rgb(6, 120, 110)">
                                               <h3> <i class="fa fa-map-marker" aria-hidden="true"></i></h3>
                                            </div>
                                            <div class="contact_info_text h-3">
                                                <h4><b>{{ $sede->direccion }}</b></h4>
                                            </div>
                                        </li>
                                        <li class="h-3" >
                                            <div class="contact_info_icon" style="color:rgb(6, 120, 110)">
                                                <h3><i class="fa fa-whatsapp " aria-hidden="true"></i></h3>
                                            </div>

                                            <div class="contact_info_text h-3" >
                                                <a href="{{$sede->link_w}}" target="_blank" class="a-contacto" >
                                                     {{ $sede->telefono1}}
                                                </a>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>



        <div class="newsletter mb-4">
            <div class="newsletter_content">
                <div class="newsletter_image" style="background-image:url(web/images/masajes_1.jpg)"></div>
                <div class="container">
                    <div class="row newsletter_row">
                        <div class="col">
                            <div class="section_title_container text-center">
                                <div class="section_title" style="color: #66ab92;">Bambu Massage</div>
                                <!-- <div class="section_title section_subtitle">SUSCRÍBETE PARA UN 20% DE DESCUENTO</div> -->
                            </div>
                        </div>
                    </div>
                    <div class="row newsletter_container">
                        <div class="col-lg-10 offset-lg-1">
                            <div class="newsletter_form_container">
                                <form action="#">
                                    <!-- <input type="email" class="newsletter_input" required="required" placeholder="Enviar un correo electrónico">
                                    <button type="submit" class="newsletter_button">suscribir</button> -->
                                </form>
                            </div>
                            <!-- <div class="newsletter_text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Consequuntur dolorem ullam fugit. Accusamus, laudantium perspiciatis harum doloribus iusto libero rem, assumenda officia unde odit a neque eius. Vitae, voluptas fugit.</div> -->
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

    @include('web.componentes_web.footer')
    <!-- </div> -->
    @include('web.componentes_web.script')

    <script>
        $(document).ready(function() {
            $("#modal-carga").modal("toggle");
            $(".main_nav #contacto").addClass("active");
        });
    </script>

    <script>
        const libApp = {
            mounted() {
                $("#modal-carga").modal("toggle");
            }
        }

        Vue.createApp(libApp).mount('#appgg')
    </script> 
    <style>
        .a-contacto{
            color:#1f2020
        }
        .a-contacto:hover{
            color:#42af89
        }

    </style>
</body>

</html>
