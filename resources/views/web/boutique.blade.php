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
        <div class="products">
            <div class="container">
                <div class="row products_container my-4">
                    <div class="col-md-6 col-lg-4 mb-5 my-4" v-for="item in listaProductos" :key="item.id_productoservicio">
                        <div class="product_grid">
                            <div class="product">
                                <div class="product_image">
                                    <img :src="'web/images/img_productos/' + item.imagen" alt="">
                                </div>
                                <div class="rating rating_4" data-rating="4">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product_content clearfix d-flex">
                                    <div class="product_info col">
                                        <div class="product_name">@{{item.nombre_productoservicio}}</div>
                                        <div class="product_price">@{{item.precio + '.00'}}</div>
                                    </div>
                                    <div class="col d-flex justify-content-end">
                                        <a href="https://linktr.ee/bambumassage" target="_blank" ><button class="button_update cart_button_2 ml-md-auto">COMPRAR</button></a>
                                    </div>
                                </div>
                            </div>
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
            $(".main_nav #boutique").addClass("active");
        });

        const productos = <?php echo $productoservicio; ?>;
    </script>

    <script>
        const libApp = {
            data() {
                return {
                    listaProductos: productos,
                }
            },
            mounted() {
                $("#modal-carga").modal("toggle");
            }
        }

        Vue.createApp(libApp).mount('#appgg')
    </script>
</body>

</html>
