<template>
  <div class="container-fluid mt-3">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Lista de Productos</h4>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="inputState">Selecione Tipo</label>
                  <select id="inputState" class="form-control" v-model="id_tipo" @change="traerCategorias()">
                    <option value="">Selecione Tipo</option>
                    <option v-for="option in opciones_tipo" :key="option.value" :value="option.value">
                      {{ option.text }}
                    </option>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputState">Elegia la Categoria para mostrar</label>
                  <select class="form-control" v-model="selecioCategoria" @change="traerProductoCategoria()">
                    <option value="">SELECCIONE CATEGORIA</option>
                    <option v-for="categoria in lista_categorias" :key="categoria.id_categoria"
                      :value="categoria.id_categoria">
                      {{ categoria.nombre_categoria }}
                    </option>
                  </select>

                  <!-- <select class="form-control" id="codfamilia" v-model="campos.codfamilia">
									<option value="">SELECCIONE FAMILIA</option>
									<option v-for="dato in familias" v-bind:value="dato.codfamilia"> {{dato.descripcion}} </option>
								</select> -->
                </div>
              </div>

              <div class="form-group mb-2 col-lg-6">
                <button type="button" class="btn mb-1 btn-success" data-toggle="modal"
                  data-target="#ModalProductoServicio" @click="limpiarFormulario()">
                  Registrar Prooducto / Servicio
                </button>
              </div>
              <div class="table-responsive">
                <table class="table header-border table-hover verticle-middle" id="tblProductos">
                  <thead>
                    <!-- colorTabla   -->
                    <tr :style="'background-color:' + colorTabla" class="color-white">
                      <th scope="col">#</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Img</th>
                      <th scope="col">Precio</th>
                      <th scope="col">Opcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, index) in produtoporcategoria" :key="index">
                      <td>{{ index +1 }}</td>
                      <td>{{ item.nombre_categoria }}</td>
                      <td>{{ item.nombre_productoservicio }}</td>
                      <td>{{ item.descripcion }}</td>
                      <!-- <td>{{ listproducto.imagen }}</td> -->
                      <th>
                        <img v-bind:src="`web/images/img_productos/${item.imagen}`" v-bind:alt="item.imagen"
                          style=" width: 150px;" />
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ModalEditarImagen"
                          @click="editarImagenProductoServicio(item)">Editar Imagen</button>
                      </th>
                      <td>S/{{ item.precio }}</td>
                      <td>
                        <span><a data-placement="top" title="Editar" @click="editarProductoServicio(item)"><i
                              class="fa fa-pencil color-muted m-r-5"></i> </a><a data-toggle="tooltip"
                            data-placement="top" title="Eliminar" @click="
                              BorrarProductoservicio(
                                item.id_productoservicio
                              )
                            ">
                            <i class="fa fa-close color-danger"></i></a></span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!--MOdal para Serivio-->
        <div class="modal fade" id="ModalProductoServicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary " v-if="formProductos.id_productoservicio > 0">
                <h5 class="modal-title text-white" id="exampleModalLabel">
                  Actualizar Producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header bg-success " v-else>
                <h5 class="modal-title text-white" id="exampleModalLabel">
                  Nuevo Producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="formRegistroProducto" name="formRegistroProducto" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Nombre producto/Servicio</label>
                    <input type="text" class="form-control" id="nombreProducto" name="nombreProducto"
                      v-model="formProductos.nombre" />
                  </div>

                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Selecione Tipo</label>
                    <select id="selectIdTipo" name="selectIdTipo" class="form-control" v-model="formProductos.tipo"
                      @change="traerCategoriasform()">
                      <option value="">Selecione Tipo</option>
                      <option v-for="option in opciones_tipo" :key="option.value" :value="option.value">
                        {{ option.text }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Selecione Categoria</label>
                    <select id="selectCategoria" class="form-control" v-model="formProductos.categoria">
                      <option value="">SELECCIONE CATEGORIA</option>
                      <option v-for="categoria in lista_categorias" :key="categoria.id_categoria"
                        :value="categoria.id_categoria">
                        {{ categoria.nombre_categoria }}
                      </option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">
                      Precio Prod/Servicio
                    </label>
                    <input 
                    type="number" 
                    class="form-control" 
                    v-model="formProductos.precio" />

                  </div>
                  <div class="form-group" v-if="editimg == 0">
                    <label for="exampleFormControlFile1">Seleciones Imagen</label>
                    <input type="file" @change="obtenerImagenProducto" />
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Descripcion:</label>
                    <textarea class="form-control" id="descripcion" name="descripcion"
                      v-model="formProductos.descripcion"></textarea>
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secundary" data-dismiss="modal">
                  Cancelar
                </button>
                <button type="button" class="btn btn-primary" v-if="formProductos.id_productoservicio > 0"
                  @click="actualizarDatosProctoServicio()">
                  actualizar
                </button>
                <button type="button" class="btn btn-success" v-else @click="registrarProducto()">
                  Guardar
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--FIn de modal Para Servicio-->
        <!-- Modal editar Imagen -->
        <div class="modal fade" id="ModalEditarImagen" tabindex="-1" role="dialog"
          aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">
                  Actualizar Imagen Producto
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="exampleFormControlFile1">Seleciones Imagen</label>
                    <input type="file" @change="obtenerImagenProducto" />
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                  Close
                </button>
                <button type="button" class="btn btn-warning" @click="ActualizarImagen();">
                  Actualizar Imagen
                </button>
              </div>
            </div>
          </div>
        </div>
        <!--  fin Modal editar Imagen -->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "productobambu",
  data() {
    return {
      id_tipo: "",
      lista_categorias: {},
      selecioCategoria: "",
      produtoporcategoria: {},
      opciones_tipo: [
        { text: "Servicio", value: "1" },
        { text: "Boutique", value: "2" },
        { text: "Gif-Card", value: "3" },
      ],
      formProductos: {
        nombre: "",
        tipo: "",
        categoria: "",
        descripcion: "",
        imagen: "",
        precio: "",
      },
      lista_categorias_form: {},
      editimg: "",
      colorTabla: null,
    };
  },
  mounted() {

  },
  methods: {
    obtenerImagenProducto(event) {
      //Asignamos la imagen a  nuestra data
      var imagen = event.target.files[0];
      this.formProductos.imagen = imagen; //asignamos  el valos a el objeto
      //   console.log(this.formProductos.imagen);
    },
    async traerCategorias() {
      //  id_categoria = this.id_tipo;
      await this.axios
        .post(`listaCategorias`, { id: this.id_tipo })
        .then((response) => {
          this.lista_categorias = response.data.categorias;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async traerCategoriasform() {
      await this.axios
        .post(`listaCategorias`, { id: this.formProductos.tipo })
        .then((response) => {
          this.lista_categorias_form = response.data.categorias;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    async traerProductoCategoria(id) {

      if (id) {
        this.selecioCategoria = id;
        console.log(id);
      }

      // await this.axios.post(`listProductos`, { id: this.selecioCategoria })
      //   .then(async (response) => {
      //     this.produtoporcategoria = response.data.lisproductos; 
      //     this.colorTabla = response.data.color.color;
      //     await this.$nextTick(() => { $("#tblProductos").DataTable(); });

      //   })
      //   .catch((error) => {
      //     console.log(error);
      //   });

        let response = await axios.post(`listProductos`, { id: this.selecioCategoria });
        this.produtoporcategoria = response.data.lisproductos; 
        this.colorTabla = response.data.color.color;
        this.$nextTick(() => { $("#tblProductos").DataTable(); });
      
      console.log(response)




    },
    async registrarProducto() {

      if (this.formProductos.nombre == "") {
        this.bambu_alert("Nombre", "error")
        return false;
      }
      if (this.formProductos.tipo == "") {
        this.bambu_alert("Tipo", "error")
        return false;
      }
      if (this.formProductos.categoria == "") {
        this.bambu_alert("Categoria", "error")
        return false;
      }
      if (this.formProductos.descripcion == "") {
        this.bambu_alert("Descripcion", "error")
        return false;
      }
      if (this.formProductos.precio == "") {
        this.bambu_alert("Precio", "error")
        return false;
      }
      if (this.formProductos.imagen == "") {
        this.bambu_alert("Cargar Imagen", "error")
        return false;
      }

      //Creamos el formData
      var data = new FormData();
      //Añadimos la imagen seleccionada
      data.append("nombre", this.formProductos.nombre);
      data.append("tipo", this.formProductos.tipo);
      data.append("categoria", this.formProductos.categoria);
      data.append("descripcion", this.formProductos.descripcion);
      data.append("imagen", this.formProductos.imagen);
      data.append("precio", this.formProductos.precio);

      let guardarProducto = await axios.post("CrearProducto", data);

      if (guardarProducto.data.create_respuesta) {

        this.bambu_alert("Registro Creado con exito", "success");
        await $("#ModalProductoServicio").modal("hide");
      //  await $("#tblProductos").DataTable().destroy();
        this.traerProductoCategoria(this.formProductos.categoria);
      
      } else {
        this.bambu_alert("No se realizo el Registro", "error");
      }

    },
    limpiarFormulario() {
      this.editimg = 0;
      this.formProductos.nombre = "";
      this.formProductos.id_productoservicio = null;
      // this.formProductos.tipo= "",
      this.formProductos.categoria = "";
      this.formProductos.descripcion = "";
      this.formProductos.imagen = "";
      this.formProductos.precio = "";
    },
    async editarProductoServicio(producto) {
      // await this.traerCategoriasform();
      this.editimg = 1;
      // this.formProductos.tipo = producto.id_categoria;
      this.formProductos.nombre = producto.nombre_productoservicio;
      this.formProductos.tipo = this.id_tipo;
      this.formProductos.categoria = this.selecioCategoria;
      this.formProductos.descripcion = producto.descripcion;
      this.formProductos.id_productoservicio = producto.id_productoservicio;
      this.formProductos.precio = producto.precio;
      console.log(this.formProductos);
      $("#ModalProductoServicio").modal('show');
    },
    async actualizarDatosProctoServicio() {
      var data = new FormData();
      //Añadimos la imagen seleccionada
      data.append("nombre", this.formProductos.nombre);
      data.append("tipo", this.formProductos.tipo);
      data.append("categoria", this.formProductos.categoria);
      data.append("descripcion", this.formProductos.descripcion);
      data.append("imagen", this.formProductos.imagen);
      data.append("idprod", this.formProductos.id_productoservicio);
      data.append("precio", this.formProductos.precio);
      let update_prod = await axios.post('actualizarProducto', data);
      console.log(update_prod.data.update_respuesta);
      if (update_prod.data.update_respuesta) {
        this.bambu_alert("Registro Creado con exito", "success");
        $("#ModalProductoServicio").modal("hide");
        this.traerProductoCategoria(this.formProductos.categoria);
      } else {

        this.bambu_alert("Error en el Registro", "error");
      }
    },
    editarImagenProductoServicio(prod) {

      //   $('#ModalEditarImagen').modal(toggle)
      this.formProductos.id_productoservicio = prod.id_productoservicio;
    },
    ActualizarImagen() {
      //Creamos el formData
      var data = new FormData();
      //Añadimos la imagen seleccionada
      data.append("idproducto", this.formProductos.id_productoservicio);
      data.append("imagen", this.formProductos.imagen);
      axios.post(`actualizarProductoImagen`, data)
        .then((response) => {
          console.log(response.data);
          $("#ModalEditarImagen").modal("hide");

          Swal.fire("En hora buena!", `${response.data}`, "success");
          this.traerProductoCategoria();
        })
        .catch((error) => {
          console.log(error);
        });

    },
    async bambu_alert(texto, icono) {
      //Swal.fire("En Hora buena", ` ${text}`, `${tipo}`);
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      })
      Toast.fire({
        icon: icono,
        title: texto
      })
    },
    BorrarProductoservicio(id) {
      // this.categoria.id_categoria = id;
      //  console.log(id);
      Swal.fire({
        title: "¿Está seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, Borrar!",
        cancelButtonText: "Cancelar",
      }).then((result) => {
        if (result.isConfirmed) {
          //
          this.axios
            .delete(`/api/producto/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", `${response.data.mensaje}`, "success");
              //  this.mostrarCategorias();
              this.traerProductoCategoria();
            })
            .catch((error) => {
              console.log(error);
            });
        }
      });
    },
  },
};
</script>
