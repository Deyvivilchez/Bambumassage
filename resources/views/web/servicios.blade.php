<!DOCTYPE html>

<html lang="en">


@include('web.componentes_web.head')

<body>

    <div class="super_container" id="appgg">

        @include('web.componentes_web.nav')
 @foreach ($servicios as $servicio)
        <div class="row">

            <div class="col" style="padding-top: 100px">

                <img src="{{ url('') }}/web/images/img_servicios/{{  $servicio->portadaServ}}" alt="" class="w-100">

            </div>

        </div>

       
            <div class="row ">

                <div class="col ">
                    <div class="w-100 " style="background-color:{{ $servicio->color }}">
                        <div
                            class="container
                                    swiper-container
                                    swiper-container-initialized
                                    swiper-container-horizontal
                                    swiper-container-android">
                            <div class="row  px-2">

                                <div class="">

                                    <div class="row   w-100 mt-4">

                                        <div class="col-auto">

                                            <h2 style="color: #fff; font-weight: bold;">
                                                {{ $servicio->nombre_categoria }} 
                                            </h2>

                                        </div>

                                        <div class="col d-flex">

                                            <div class=" my-auto rating {{ $servicio->calificacion }}"
                                                onclick="abrirCalificacion({{ $servicio }})"
                                                style="cursor: pointer">

                                                <i class="fa fa-star" style="font-size: 1rem"></i>

                                                <i class="fa fa-star" style="font-size: 1rem"></i>

                                                <i class="fa fa-star" style="font-size: 1rem"></i>

                                                <i class="fa fa-star" style="font-size: 1rem"></i>

                                                <i class="fa fa-star" style="font-size: 1rem"></i>

                                            </div>

                                        </div>

                                    </div>



                                    <p class=" p-3" style="text-align: justify; color: white">

                                        {{ $servicio->descripcion }}

                                    </p>

                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="cardsmodule__base my-4">
                        <div class="container swiper-container swiper-container-initialized swiper-container-horizontal swiper-container-android py-4">

                            <div class="div p-0">
                                @foreach ($servicio->subservicios as $k => $subser)
                                    <div class="row bg-white  w-100  my-5 p-0">
                                        <div
                                            class="col-sm-12 col-md-6 p-3 d-flex justify-content-center
                                            <?php if (($k + 1) % 2 == 0) {
                                                echo 'order-sm-1 order-md-2';
                                            } ?>">
                                            <img src="{{ url('') }}/web/images/img_productos/{{ $subser->imagen }}"
                                                style="height: 500px">
                                        </div>
                                        <div class="col-sm-12 col-md-6 p-3 d-flex justify-content-center p-0">
                                            <div class="col p-0">
                                                <h2 style="color: #62b19f; font-weight: bold;">
                                                    {{$subser->nombre_productoservicio }}
                                                </h2>

                                                <p class="" style="text-align: justify; color: #62b19f">
                                                    {{ $subser->descripcion }}

                                                </p>
                                                <div class="col d-flex">
                                                    <a class="btn btn-lg font-weight-bold px-4 btn-servicios" href="https://linktr.ee/bambumassage" target="_blank">
                                                        RESERVAR
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        @endforeach


    </div>



    <div class="modal fade" id="modal-calificacion" tabindex="-1" aria-labelledby="staticBackdropLabel"
        aria-hidden="true">

        <div class="modal-dialog modal-sm">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title text-uppercase text-dark" id="exampleModalLabel">Califica nuestros <span
                            id="nombre-servicio"></span></h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                        <span aria-hidden="true">&times;</span>

                    </button>

                </div>

                <div class="modal-body">

                    <div class="rating my-3 d-flex justify-content-center" style="cursor: pointer;">

                        <i class="fa fa-star" style="font-size: 2rem" onclick="calificar(1)"
                            onmouseover="mHover(this, 'rating_1')" onmouseout="mOut(this, 'rating_1')"></i>

                        <i class="fa fa-star" style="font-size: 2rem" onclick="calificar(2)"
                            onmouseover="mHover(this, 'rating_2')" onmouseout="mOut(this, 'rating_2')"></i>

                        <i class="fa fa-star" style="font-size: 2rem" onclick="calificar(3)"
                            onmouseover="mHover(this, 'rating_3')" onmouseout="mOut(this, 'rating_3')"></i>

                        <i class="fa fa-star" style="font-size: 2rem" onclick="calificar(4)"
                            onmouseover="mHover(this, 'rating_4')" onmouseout="mOut(this, 'rating_4')"></i>

                        <i class="fa fa-star" style="font-size: 2rem" onclick="calificar(5)"
                            onmouseover="mHover(this, 'rating_5')" onmouseout="mOut(this, 'rating_5')"></i>

                    </div>

                </div>

                <div class="modal-footer text-secondary" style="display: none;" id="modal-footer">

                    ¡Gracias por tu preferencia!

                </div>

            </div>

        </div>

    </div>
    
    <div class="modal bg-white" id="modal-carga" data-backdrop="static" data-keyboard="true">
        <div class="d-flex align-items-center justify-content-center h-100">
            <img src="{{ url('personalizado/icons8-spinner.gif') }}" style="width: 50px; height: 50px;">
        </div>
    </div>



    @include('web.componentes_web.footer')

    <!-- </div> -->

    @include('web.componentes_web.script')



    <script>
        $(document).ready(function() {
            $("#modal-carga").modal("toggle");
            $(".main_nav #servicios").addClass("active");

        })
    </script>
    
    <script>
        const libApp = {
            mounted() {
                $("#modal-carga").modal("toggle");
            }
        }

        Vue.createApp(libApp).mount('#appgg')
    </script> 



    <script>
        var categoriaSeleccionada = undefined;



        function abrirCalificacion(categoria) {

            let servicio = document.getElementById('nombre-servicio');

            servicio.innerHTML = categoria.nombre_categoria;

            categoriaSeleccionada = categoria.id_categoria;

            $('#modal-calificacion').modal('show');

        }



        async function calificar(calificacion) {

            let response = await fetch('api/categorias/votacion', {

                method: 'POST',

                headers: {

                    'Content-Type': 'application/json'

                },

                body: JSON.stringify({

                    id_categoria: categoriaSeleccionada,

                    calificacion: calificacion

                })

            });

            let reponseData = await response.json();

            let footer = document.getElementById('modal-footer');

            footer.style.display = 'block';

            setTimeout(() => {

                $('#modal-calificacion').modal('hide');

                footer.style.display = 'none';

            }, 1000);

        }



        function mHover(elemento, clase_calificacion) {

            elemento.parentNode.classList.add(clase_calificacion);

        }



        function mOut(elemento, clase_calificacion) {

            elemento.parentNode.classList.remove(clase_calificacion);

        }
    </script>

</body>



</html>
