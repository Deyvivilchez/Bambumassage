<template>
  <div class="container-fluid mt-3">
    <div class="row">
      <div
        class="col-lg-4 col-sm-6"
        v-for="slider in slider_inicio"
        :key="slider.id_slider_inicio"
      >
        <div class="card">
          <div class="card-body">
            <div class="text-center">
              <img
                v-bind:src="`web/images/inicio/${slider.imagen}`"
                style="width: 100%"
              />

              <h5 class="mt-3 mb-1">{{ slider.descripcion }}</h5>

              <button
                type="button"
                data-toggle="modal"
                data-target="#sliderinicio"
                class="btn mb-1 btn-primary"
                @click="editarSlider(slider)"
              >
                Actualizar
              </button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="sliderinicio">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title text-white">Imagenes Portada Slider</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <h4 class="card-title">Selecione imagen</h4>
                <div class="basic-form">
                  <form>
                    <div class="form-group">
                      <input
                        type="file"
                        class="form-control-file"
                        @change="obtenerImagenSlider"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secundary" data-dismiss="modal">
                Cancelar
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="actualizarImgSlider"
              >
                Actualizar Imagen
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4>EXPERIENCIAS</h4>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>Comentario</th>
                    <th>Autor</th>
                    <th>foto</th>
                    <th>opcion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="lista in listaComentarios"
                    :key="lista.id_slider_inicio"
                  >
                    <td>
                      {{ lista.comentario }}
                    </td>
                    <td>{{ lista.autor }}</td>
                    <td>
                      <img
                        v-bind:src="`web/images/img_comentarios/${lista.imagen}`"
                        width="100px"
                      />
                    </td>
                    <td>
                      <span
                        data-toggle="modal"
                        data-target="#opiniones"
                        class="badge badge-primary px-2"
                        @click="CargarModalEditComentarios(lista)"
                        >Editar</span
                      >
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!--slider opiniones-->
      <div class="modal fade" id="opiniones">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 class="modal-title text-white">Editar Compentarios</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <div class="basic-form">
                  <form>
                    <div class="form-group">
                      <textarea
                        class="form-control"
                        id="exampleFormControlTextarea1"
                        rows="3"
                        v-model="formComentarios.comentarios"
                      ></textarea>
                    </div>
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control input-default"
                        placeholder="Autor"
                        v-model="formComentarios.autor"
                      />
                    </div>
                    <div class="form-group">
                      <input type="file" @change="obtenerImagenComentario" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secundary" data-dismiss="modal">
                Close
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="actualizarComentarios"
              >
                Actualizar Comentario
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--fin slider opiniones--->
      <!-- /# column -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4>CONOCIENDONOS</h4>
            </div>
            <div class="table-responsive">
              <div
                class="card-body"
                v-for="lista in conociendonos"
                :key="lista.id_slider_inicio"
              >
                <div class="text-left col-lg-3">
                  <img
                    v-bind:src="`web/images/inicio/${lista.imagen}`"
                    width="100px"
                    alt=""
                  />
                </div>

                <p style="text-align: justify">
                  {{ lista.descripcion }}
                </p>
                <p style="text-align: justify">
                  {{ lista.autor }}
                </p>
                <a
                  class="btn btn-sm btn-primary text-white"
                  data-toggle="modal"
                  data-target="#ModalConociendonos"
                  @click="CargarModalConociendonos(lista)"
                  >Actualizar</a
                >
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--MOdal Conociendonos-->
      <div class="modal fade" id="ModalConociendonos">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-primary text-white">
              <h5 class="modal-title  text-white">Conociendonos</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <h4 class="card-title">Selecione Imagen</h4>
                <div class="basic-form">
                  <form>
                    <div class="form-group">
                      <input
                        type="file"
                        class="form-control-file"
                        @change="obtenerImagenConociendonos"
                      />
                    </div>
                    <div class="form-group">
                      <textarea
                      rows="8"
                        class="form-control"
                        v-model="formConociendonos.descripcion"
                      ></textarea>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secundary" data-dismiss="modal">
                Cancelar
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="actualizarConociendonos"
              >
                Actualizar
              </button>
            </div>
          </div>
        </div>
      </div>
      <!--FIn MOdal COnociendonos-->
      <!-- <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="card-title">
              <h4>Promociones</h4>
            </div>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>foto</th>
                    <th>opcion</th>
                  </tr>
                </thead>
                <tbody>
                  <tr
                    v-for="listapromociones in promociones"
                    :key="listapromociones.id_promocion"
                  >
                    <td>
                      {{ listapromociones.id_promocion }}
                    </td>
                    <td>{{ listapromociones.nombre }}</td>
                    <td>
                      <img
                        v-bind:src="`web/images/${listapromociones.imagen}`"
                        width="100px"
                        alt=""
                      />
                    </td>
                    <td>
                      <button
                        type="button"
                        data-toggle="modal"
                        data-target="#Promociones"
                        class="btn mb-1 btn-outline-info"
                        @click="modalPromociones(listapromociones)"
                      >
                        Editar
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div> -->
      <!--Promociones modal-->
      <!-- <div class="modal fade" id="Promociones">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Editar Promociones</h5>
              <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="card-body">
                <div class="basic-form">
                  <form>
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control input-default"
                        placeholder="Nombre"
                        v-model="formPromocion.nombre"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="file"
                        class="form-control-file"
                        @change="obtenerImagenPromocion"
                      />
                    </div>
                    <div class="form-group">
                      <input
                        type="text"
                        class="form-control input-default"
                        placeholder="link"
                        v-model="formPromocion.link"
                      />
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Cancelar
              </button>
              <button
                type="button"
                class="btn btn-primary"
                @click="ActualizarPromocion"
              >
                Guardar
              </button>
            </div>
          </div>
        </div>
      </div> -->


    </div>
  </div>
</template>
<script>

export default {
  name: "inicio_bambu",
  data() {
    return {
      slider_inicio: [],
      formSlider: [],
      listaComentarios: [],
      conociendonos: [],
      promociones: [],
      formComentarios: {
        id_comentario: "",
        comentarios: "",
        autor: "",
        imagen: "",
      },
      formConociendonos: {
        id_conociendonos: "",
        descripcion: "",
        imagen: "",
      },
      formPromocion: {
        id_promocion: "",
        nombre: "",
        imagen: "",
        link: "",
      },
    };
  },
  mounted() {
    this.mostrarSlider();
    this.mostrarlistaComentarios();
    this.mostrarConociendonos();
    this.mostrarPromociones();
  },
  methods: {
    async mostrarSlider() {
      await this.axios
        .get("/api/admInicioController")
        .then((response) => {
          this.slider_inicio = response.data.sliderInicio;
          //  console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
          // this.categorias = [];
        });
    },
    async mostrarConociendonos() {
    let get=  await this.axios.get("/api/admConociendonos");
                this.conociendonos = get.data.conociendonos;
    },
    async obtenerImagenSlider(event) {
      var imagen = event.target.files[0];
      this.formSlider.imagen = imagen;
     
    },
    async editarSlider(dato) {
      this.formSlider.id = dato.id_slider_inicio;
    },
    async actualizarImgSlider() {
      var data = new FormData();
      data.append("id_slider", this.formSlider.id);
      data.append("slider_img", this.formSlider.imagen);
      let response= await axios.post(`actualizarImgSlider`, data);
          if( response.data.valor){
            $("#sliderinicio").modal("hide");
            Swal.fire("En hora buena!", 'Registrado con exito', "success");
            this.mostrarSlider();
          }else{
            Swal.fire("", 'no se puedo realizar el registro', "error");
          }
    },
    async mostrarlistaComentarios() {
       let response = await axios.get('api/admComentarios');
        if(response.data.comentarios){ this.listaComentarios = response.data.comentarios;} 
    },
    async CargarModalEditComentarios(datos) {
      this.formComentarios.id_comentario = datos.id_comentario;
      this.formComentarios.comentarios = datos.comentario;
      this.formComentarios.autor = datos.autor;
      this.formComentarios.imagen = 0;
      
    },
    obtenerImagenComentario(event) {
      //Asignamos la imagen a  nuestra data
      var imagen = event.target.files[0];
      this.formComentarios.imagen = imagen;
    },
    async actualizarComentarios() {
      var data = new FormData();
      data.append("id_comentario", this.formComentarios.id_comentario);
      data.append("comentario", this.formComentarios.comentarios);
      data.append("autor", this.formComentarios.autor);
      data.append("imagen", this.formComentarios.imagen);
      let update= await axios.post(`actualizarComentario`, data);
          if(update.data.valor){
                $("#opiniones").modal("hide");
                Swal.fire("muy Bien!", "Actualizo Correctamente!", "success");
                this.mostrarlistaComentarios();
          }else{
            Swal.fire("", 'no se puedo realizar el registro', "error");
          }
    },
    async obtenerImagenConociendonos(event) {
      var imagen = event.target.files[0];
      this.formConociendonos.imagen = imagen;
    },
    async CargarModalConociendonos(datos) {
      this.formConociendonos.id_conociendonos = datos.id_conociendonos;
      this.formConociendonos.descripcion = datos.descripcion;
      this.formConociendonos.imagen = 0;
    },
    async actualizarConociendonos() {
      var data = new FormData();
      data.append("id", this.formConociendonos.id_conociendonos);
      data.append("descripcion", this.formConociendonos.descripcion);
      data.append("imagen", this.formConociendonos.imagen);

      await this.axios
        .post(`actualizarConociendonos`, data)
        .then((response) => {
          console.log(response.data.mensaje);
          Swal.fire("En hora buena!", `${response.data.mensaje}`, "success");
          //   Swal.fire("muy Bien!", "Actualizo Correctamente!", "success");
          $("#ModalConociendonos").modal("hide");
          this.mostrarConociendonos();
        })
        .catch((error) => {
          console.log(error);
          // this.categorias = [];
        });
    },
    async mostrarPromociones() {
      await this.axios
        .post("listaPromociones")
        .then((response) => {
          this.promociones = response.data.promociones;

          console.log(response.data);
        })
        .catch((error) => {
          console.log(error);
          // this.categorias = [];
        });
    },
    async obtenerImagenPromocion(event) {
      var imagen = event.target.files[0];
      this.formPromocion.imagen = imagen;
    },
    async modalPromociones(datos) {
      this.formPromocion.id_promocion = datos.id_promocion;
      this.formPromocion.nombre = datos.nombre;
      this.formPromocion.link = datos.link;
      this.formPromocion.imagen = 0;
    },
    async ActualizarPromocion() {

      var data = new FormData();
      data.append("id_promocion", this.formPromocion.id_promocion);
      data.append("descripcion", this.formPromocion.nombre);
      data.append("link", this.formPromocion.link);
      data.append("img", this.formPromocion.imagen);
      let update = await this.axios.post(`actualizarPromociones`, data);
          if(update.data.respuesta){
            Swal.fire("muy Bien!", "Actualizo Correctamente!", "success");
            $("#ModalConociendonos").modal("hide");
            this.mostrarConociendonos();
          }else{
            Swal.fire("", 'no se puedo realizar el registro', "error");
          }
      
        // .then((response) => {
        //   console.log(response.data.mensaje);
        //   Swal.fire("En hora buena!", `${response.data.mensaje}`, "success");
        //   //   Swal.fire("muy Bien!", "Actualizo Correctamente!", "success");
        //   // $("#ModalConociendonos").modal("hide");
        //   //this.mostrarConociendonos();
        // })
        // .catch((error) => {
        //   console.log(error);
        //   // this.categorias = [];
        // });
    },
  },
};
</script>

