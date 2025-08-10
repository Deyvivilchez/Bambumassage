<!DOCTYPE html>
<html lang="en">
@include('web.componentes_web.head')
<body>
    <div class="super_container" id="appgg">
        @include('web.componentes_web.nav')
        <div class="row">
            <div class="col" style="padding-top: 100px">
                <img src="{{ url('') }}/portadas/{{ $portada[0]->portada_imagen }}" alt="" class="w-100">
            </div>
        </div>
        <div class="cart_container">
            <div class="container">
                <div class="row">
                    <div class="titulosSeccion" style="color: #5b8676; font-weight: bold; ">Lista GIFT CARD</div>
                </div>
                <div class="row my-4">
                    <table class="table resposive" id="table-gifcard">
                        <thead>
                            <tr style="background-color: #4cb38f94;" class="text-white">
                                <th scope="col"></th>
                                <th scope="col">GIFT CARD</th>
                                <th scope="col">DESCRIPCIÓN</th>
                                <th scope="col">PRECIO</th>
                                <th scope="col">-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $cat)
                                @foreach ($productoservicio as $prod)
                                    @if ($cat->id_categoria == $prod->id_categoria)
                                        <tr>
                                            <th><img style="width: 200px;"
                                                    src="web/images/img_productos/{{ $prod->imagen }}" alt="">
                                            </th>
                                            <td style="width: 20%; padding-top: 5%">{{ $prod->nombre_productoservicio }}
                                            </td>
                                            <td style="width: 60%; padding-top: 5%">{{ $prod->descripcion }}</td>
                                            <td style="width: 60%; padding-top: 5%">{{ $prod->precio }}</td>
                                            <td style="width: 60%; padding-top: 5%">
                                                <a href="https://linktr.ee/bambumassage" target="_blank">
                                                    <button
                                                        class="button_update cart_button_2 ml-md-auto">RESERVAR</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('web.componentes_web.footer')
    @include('web.componentes_web.script')
    <script src="adm_web/plugins/tables/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".main_nav #gift").addClass("active");
            $('#table-gifcard').DataTable({
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                searching: false,
                lengthChange: false,
                lengthMenu: false,
            });
        });
    </script>
</body>
</html>
