<template>
  <div class="container-fluid mt-3">
    <div class="row">
      <div class="card" style="width: 18rem;">
          <img class="card-img-top" src=".../100px180/" alt="Card image cap">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
    </div>
  </div>
  <div class="container-fluid mt-3">
      <div class="row">
        <div class="card-header">
              <div class="row">
                    <div class="col-6">
                      <button   type="button" class="btn btn-success btn-sm ml-auto" data-toggle="modal" data-target="#ModalCategoria" v-on:click="limpiar" > Nueva Categoria</button>
                    
                    </div>
               </div>
            </div>
          <div class="card">
            
            <div class="card-body">
              <h4 class="card-title">Listado de categorias</h4>
              
                <table
                  class="table table-striped table-bordered"
                  id="tablaCategoria"
                >
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Categoria</th>
                      <th scope="col">Descripcion</th>
                      <th scope="col">Opcion</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(categoria, index) in categorias" 
                        :key="index"  >
                      <td>{{ categoria.id_categoria }}</td>
                      <td>{{ categoria.nombre_categoria }}</td>
                      <td>{{ categoria.descripcion }}</td>
                      <td>
                        <span>
                          <a
                            data-toggle="modal"
                            data-target="#ModalCategoria"
                            @click="llenarModal(categoria)"
                          >
                            <i class="fa fa-pencil color-muted m-r-5"></i>
                          </a>

                          <a
                            @click="borrarCategoria(categoria.id_categoria)"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="Close"
                          >
                            <i class="fa fa-close color-danger"></i>
                          </a>
                        </span>
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>
          </div>
       
      </div>
  </div>
   <!--MOdal para Categoria-->
   <div
          class="modal fade"
          id="ModalCategoria"
          tabindex="-1"
          role="dialog"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-primary"    v-if="categoria.id_categoria > 0">
                <h5 class="modal-title" id="exampleModalLabel">
                  Formulario Editar Categoria
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-header bg-success"   v-else>
                <h5 class="modal-title" id="exampleModalLabel">
                  Formulario Categoria
                </h5>
                <button
                  type="button"
                  class="close"
                  data-dismiss="modal"
                  aria-label="Close"
                >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <labe for="recipient-name" class="col-form-label"
                    >Nombre Categoria</labe
                  >
                  <input
                    type="text"
                    class="form-control"
                    v-model="categoria.nombre_categoria"
                    required
                  />
                </div>
                <div class="form-group">
                  <labe for="recipient-name" class="col-form-label"
                    >Color</labe
                  >
                  <input
                    type="color"
                    class="form-control"
                    v-model="categoria.color"
                    value="#2ec27d"
                    required
                  />
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Selecione Tipo </label>
                  <select  @change="onChange($event)"  class="form-control" v-model="categoria.tipo">
                    <option value="null">Seleccionar</option>
                    <option value="1">Servicio</option>
                    <option value="2">Producto</option>
                    <option value="3">Gif-Card</option>
                  </select>
                </div>
                <div v-if="flag_tipo_categoria"  class="form-group">
                  <label for="exampleFormControlSelect1">Imagen Inicio</label>
                   <div class="form-group">
                      <input
                        type="file"
                        class="form-control-file"
                        @change="obtenerImagenServicio"
                      />
                    </div>
                </div>
                <div v-else></div>
                <div v-if="flag_tipo_categoria"  class="form-group">
                  <label for="exampleFormControlSelect1">Imagen Portada </label>
                   <div class="form-group">
                      <input
                        type="file"
                        class="form-control-file"
                        @change="obtenerImagenPortadaCategoria"
                      />
                    </div>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label"
                    >Descripcion:</label
                  >
                  <textarea
                    class="form-control"
                    id="message-text"
                    v-model="categoria.descripcion"
                  ></textarea>
                </div>
                <div class="modal-footer">
                  <button
                    type="button"
                    class="btn btn-outline-secundary"
                    data-dismiss="modal"
                  >
                    Cancelar
                  </button>
                  <button
                    v-on:click="actualizar"
                    v-if="categoria.id_categoria > 0"
                    class="btn btn-primary"
                  >
                    Actualizar
                  </button>
                  <button v-on:click="crear" v-else class="btn btn-success">
                    Guardar
                  </button>

                  
                </div>
              </div>
            </div>
          </div>
        </div>
</template>
<script>
export default {
  name: "categoria_bambu",
  data() {
    return {
      flag_tipo_categoria:false,
      categorias: [],
      categoria: {
        nombre_categoria: "",
        descripcion: "",
        id_categoria: "",
        tipo: null,
        img:"",
        color:'#2ec27d'
      },
    };
  },
  mounted() {
    this.mostrarCategorias();
  },
  created(){
    //this.categoria.color="´#2ec27d´"
  },
  methods: {
    onChange(event) {
            console.log(event.target.value);
           if(event.target.value==1){
            this.categoria.img = "";
            this.flag_tipo_categoria=true;
           }else{
            this.categoria.img = "";
            this.flag_tipo_categoria=false;
           }
        },
    async limpiar() {
      this.categoria.nombre_categoria = "";
      this.categoria.descripcion = "";
      this.categoria.id_categoria = "";
      this.categoria.tipo = null;
      this.categoria.img = "";
      this.categoria.color="#2ec27d";
    },
    async mostrarCategorias() {

     let getCategorias = await this.axios .get("/api/categoria");
      if(getCategorias.data.categorias){
          this.categorias = getCategorias.data.categorias;
          this.$nextTick(() => {
            $("#tablaCategoria").DataTable();
          });
      }

    },
    async obtenerImagenServicio(event) {
      //Asignamos la imagen a  nuestra data
      console.log("ingreso imagen");
      var imagen = event.target.files[0];
      this.categoria.img = imagen;
      //asignamos  el valos a el objeto
      //   console.log(this.fomrProductos.imagen);
    },
    obtenerImagenPortadaCategoria(event){
      console.log("ingreso imagen");
      var imagenPortada = event.target.files[0];
      this.categoria.imagenPortada = imagenPortada;

    },
    async crear() {
      if(this.categoria.tipo==1){
          if(this.categoria.img==''){
            this.bambu_alert("El archivo de imagen es requerido",  "error")
            return false;
          }
          if(this.categoria.imagenPortada==''){
            this.bambu_alert("El archivo de imagen Portada es requerido",  "error")
            return false;
          }
      }
      if(this.categoria.nombre_categoria == ""){
            this.bambu_alert("Asignar Nombre",  "error");
            return false;
      }
      if(this.categoria.descripcion == ""){
            this.bambu_alert("Descripcion",  "error")
            return false;
      }
      if(this.categoria.tipo == null){
            this.bambu_alert("Selecionar Tipo",  "error")
            return false;
      }
      if(this.categoria.color.length == 0){
            this.bambu_alert("Asignar Color",  "error")
            return false;
      }
        var data = new FormData();
        data.append("nombre_categoria", this.categoria.nombre_categoria);
        data.append("descripcion", this.categoria.descripcion);
        data.append("id_categoria", this.categoria.id_categoria);
        data.append("tipo", this.categoria.tipo);
        data.append("img", this.categoria.img);
        data.append("color", this.categoria.color);  
        data.append("imgPortada", this.categoria.imagenPortada); 
        let Guardar =   await this.axios.post("/api/categoria",data);
          if(Guardar.data.respuesta){
            this.mostrarCategorias();
            $("#ModalCategoria").modal("hide");
            this.bambu_alert("Registro Exitoso", "success");
            return false
          }else{
            this.bambu_alert("No se puedo registrar", "error");
          }
    },
    async llenarModal(datos) {
      // console.log(datos);
      this.categoria.nombre_categoria = datos.nombre_categoria;
      this.categoria.descripcion = datos.descripcion;
      this.categoria.id_categoria = datos.id_categoria;
      this.categoria.tipo = datos.tipo;
      this.categoria.color=datos.color;

      if(this.categoria.tipo==1){
        this.flag_tipo_categoria=true;
        }else{
        this.flag_tipo_categoria=false;
        }
    },
    async actualizar() {

      var data = new FormData();
      data.append("_method", "PUT");
      data.append("nombre_categoria", this.categoria.nombre_categoria);
      data.append("descripcion", this.categoria.descripcion);
      data.append("id_categoria", this.categoria.id_categoria);
      data.append("tipo", this.categoria.tipo);
      data.append("img", this.categoria.img);
      data.append("color", this.categoria.color);
      data.append("imgPortada", this.categoria.imagenPortada); 

        let updateCategoria = await  axios.post(`/api/categoria/${this.categoria.id_categoria}`, data);
            if(updateCategoria.data.update_respuesta){
              this.bambu_alert("Actualizo Correctamente!",  "success");
              $("#tablaCategoria").DataTable().destroy();
              this.mostrarCategorias();
              $("#ModalCategoria").modal("hide");
            }
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
    borrarCategoria(id) {
      // this.categoria.id_categoria = id;
      // console.log(id);
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
          this.axios
            .delete(`/api/categoria/${id}`)
            .then((response) => {
              Swal.fire("Deleted!", `${response.data.mensaje}`, "success");
              this.mostrarCategorias();
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
<style>

.dataTables_filter input {
    background-color: #c1ddd6 !important;
    background-position: center bottom, center calc(100% - 1px);
    background-repeat: no-repeat;
    background-size: 0 2px, 100% 1px;
    border: 1px;
    border-radius: 10px;
    box-shadow: none;
    float: none;
    margin-left: 10px;
    transition: background 0s ease-out 0s;
}
</style>

