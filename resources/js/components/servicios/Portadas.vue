<template>
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-lg-3 col-sm-6" v-for="slider in slider_inicio" :key="slider.portada_nombre">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img v-bind:src="`portadas/${slider.portada_imagen}`" style="width: 100%" />

                            <h5 class="mt-3 mb-1">{{ slider.portada_nombre}}</h5>

                            <button type="button" data-toggle="modal" data-target="#portadaModal"
                                class="btn mb-1 btn-outline-info" @click="editarPortada(slider)">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="portadaModal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white">Cambiar Portada</h5>
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
                                            <input type="file" class="form-control-file"
                                                @change="obtenerImagenPortada" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secundary" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="button" class="btn btn-primary" @click="actualizarPortada()">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="portadaimgSede">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Cambiar Img Sede</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body">
                                <h4 class="card-title">Selecione imagen</h4>

                                <div class="form-group" >

                                    <input type="file" class="form-control-file" @change="obtenerImagenSede" />

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="button" class="btn btn-primary" @click="actualizarimgSede()">
                                Actualizar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <!-- <h4>lista sedes</h4> -->
                    </div>
                    <div class="form-group mb-2 col-lg-6">
                            <button type="button" data-toggle="modal"
                            data-target="#mdl-sede"
                            class="btn mb-1 btn-success text-white"
                            @click="limpiarformularioSede()">
                            Nueva Sede
                        </button></div>
                    <div class="table-responsive">
                        <table class="table" id="table-sedes">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>DIRECCION</th>
                                    <th>NUMERO</th>
                                    <!-- <th>linck Whatsapp</th> -->
                                    <th>IMAGENES</th>

                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="listaSedes in listaSedes" :key="listaSedes.id_sede">
                                    <td>{{ listaSedes.id_sede }}</td>
                                    <td>{{ listaSedes.sede}} </td>
                                    <td>{{ listaSedes.direccion}}</td>
                                    <td>{{ listaSedes.telefono1}}
                                    </td>
                                    <!-- <td>{{ listaSedes.link_w }}</td> -->

                                    <td>

                                        <img v-bind:src="`web/images/img_sedes/${listaSedes.imagen}`" width="100px" />
                                        <button type="button" class="btn mb-1 btn-outline-success"
                                        data-toggle="modal" data-target="#portadaimgSede"
                                        @click=" id_img_sede_update=listaSedes.id_sede"

                                        >Actualizar</button>
                                    </td>
                                    <td>
                                        <button class="btn btn-info" 
                                        @click="editarSede(listaSedes)" 
                                        data-toggle="modal" 
                                        data-target="#mdl-sede">Editar
                                    </button>
                                        <button class="btn btn-danger" 
                                        @click="eliminarSede(listaSedes.id_sede)"
                                        >Eliminar</button>
                                        <button class="btn mb-1 btn-info"
                                        data-toggle="modal" data-target="#mdl-salas"
                                         @click="ver_salas(listaSedes)" >Salas
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="mdl-sede" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success" v-if="estadoModal">
                            <h5 class="modal-title " id="exampleModalLabel" style="color: #FFF;">Formulario Nueva Sedes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-header bg-primary" v-else>
                            <h5 class="modal-title " id="exampleModalLabel" style="color: #FFF;">Formulario Editar Sedes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row my-2">
                                <div class="col-6">
                                    <label class="col-form-label" for="val-username">
                                        Nombre Sede </label>
                                    <!--  <span class="text-danger">*</span> -->

                                    <input type="text" placeholder="Nombre Sede" class="form-control"
                                        v-model="formularioSede.sede_nombre">
                                        <span class="text-danger" v-if=" formularioSede.sede_nombre=='' ||formularioSede.sede_nombre==null" >* llenar</span>
                                </div>
                                <div class="col-6 ">
                                    <label class="col-form-label" for="val-username">
                                        Direccion </label>
                                    <input type="text" placeholder="jr.Ejemplo 123" class="form-control"
                                        v-model="formularioSede.direccion">
                                    <span class="text-danger" v-if=" formularioSede.direccion=='' ||formularioSede.direccion==null " >* llenar</span>
                                </div>

                            </div>
                            <div class="row my-2">
                                <div class="col-6">
                                    <label class="col-form-label" for="val-username">
                                        Celular </label>
                                    <input type="text" placeholder="999999999" class="form-control "
                                        v-model="formularioSede.celular">
                                    <span class="text-danger" v-if=" formularioSede.celular=='' ||formularioSede.celular==null" >* llenar</span>
                                </div>
                                <div class="col-6 ">
                                    <label class="col-form-label" for="val-username">
                                        link W</label>
                                    <input type="text" placeholder="link whatsapp" class="form-control"
                                        v-model="formularioSede.link">
                                     <span class="text-danger" v-if=" formularioSede.link=='' ||formularioSede.link==null" >* llenar</span>
                                </div>

                            </div>
                            <div class="basic-form">
                                <div class="form-group" v-if="img_vl==true">
                                    <label class="col-form-label" for="val-username">
                                        Imagen Sedes</label>
                                    <input type="file" class="form-control-file" @change="obtenerImagenSede" />
                                    <span class="text-danger" v-if=" formularioSede.imagen=='' ||formularioSede.imagen==null" >* llenar</span>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label" for="val-username">
                                        Mapa
                                    </label>
                                    <textarea id="exampleFormControlTextarea1" rows="4"
                                        placeholder="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3900.997194702316!2d-76.99325598509753!3d-12.112344146421941!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c7ec6fdb1693%3A0x6b67cdc8138e738a!2sC.%20Monte%20Rosa%20168%2C%20Santiago%20de%20Surco%2015038!5e0!3m2!1ses!2spe!4v1632508683185!5m2!1ses!2spe"
                                        class="form-control" v-model="formularioSede.mapa">
                                    </textarea>
                                    <span class="text-danger" v-if=" formularioSede.mapa=='' ||formularioSede.mapa==null" >* llenar</span>
                                </div>
                                <!-- <div class="form-group">
                                       <input type="text" placeholder="Autor" class="form-control input-default">
                                     </div> -->


                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secundary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" @click="validar_for" v-if="estadoModal">Guardar</button>
                            <button type="button" class="btn btn-primary" @click="validar_for" v-else>Actualizar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal  Sede-->
            <!---Modal  Salas inicio-->

            <div class="modal fade" id="mdl-salas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title " id="exampleModalLabel" style="color: #FFF;">{{titulo_sede}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div class="card-body">
                                <div class="card-head">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="val-username" class="col-form-label">Imagen Sala</label>
                                                <input type="file" class="form-control-file" @change="obtenerImagenSalon">
                                                <span class="text-danger" v-if=" formularioSala.imagen=='' ||formularioSala.imagen==null" >* llenar</span>
                                            </div>
                                            <div class="col-4">
                                                <label for="val-username" class="col-form-label">click para Agregar</label>
                                                <button class="btn btn-success" @click="agregarSala()">+</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-title">
                                    <h4>

                                        Lista Salas
                                          <hr class="bg-info">
                                    </h4>
                                </div>
                                <div class="table-responsive">

                                    <table class="table" id="tableSalon">
                                        <thead>
                                            <tr>
                                                <th>IMAGENES</th>
                                                <th class="text-center">OPCIONES</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="sala in listaSalas" >
                                                 <img v-bind:src="`/salas/${sala.imagen}`" style="width: 100px" />

                                                <td class="text-center">
                                               
                                                            <h4>
                                                            <i class="fa fa-trash font-18 
                                                            align-middle mr-2 text-danger"
                                                            @click="eliminarSala(sala)"  ></i>
                                                        </h4>
                                                        
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
             <!---Modal  Salas fin-->

        </div>
    </div>
</template>
<script>
export default {
    name: "portada_bambu",
    data() {
        return {
            slider_inicio: [],
            formPortada: {
                id_portada: "",
                imagen_portada: "",
            },
            listaSedes:[],
            formularioSede:{
                nombre:null,
                direccion:null,
                celular:null,
                link:null,
                mapa:null,
            },
            error:[],
            img_vl:true,
            id_img_sede_update:null,
            listaSalas:[],
            formularioSala:{
                imagen:[]
            },
            titulo_sede:"",
            estadoModal:true,

        };
    },
    mounted() {
        this.mostarPortadas();
        this.traerLitaSedes();
    },
    methods: {
        async mostarPortadas() {
            await this.axios
                .get("/api/portadas")
                .then((response) => {

                    this.slider_inicio = response.data.portada_slider;
                    // console.log(response.data);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        async obtenerImagenPortada(event) {
            //Asignamos la imagen a  nuestra data
            var imagen = event.target.files[0];
            this.formPortada.imagen_portada = imagen;
        },

        async editarPortada(dato) {

            this.formPortada.id_portada = dato.portada_id;
         //   console.log(dato);
        },
        async actualizarPortada() {
            var data = new FormData();
            data.append("id_portada", this.formPortada.id_portada);
            data.append("imagen_portada", this.formPortada.imagen_portada);
         //   console.log(this.formPortada);

            axios.post('actualizar_sliderPortada', data).then((response) => {
                $("#portadaModal").modal("hide");
                Swal.fire("En hora buena!", `${response.data}`, "success");
                this.mostarPortadas();
                //  console.log(response);
            })
                .catch((error) => {
                    console.log(error);
                });
        },
        async traerLitaSedes() {
            axios.get('api/listaSedes').then((response) => {
                this.listaSedes = response.data.sedes;
                this.$nextTick(() => {

                        $("#table-sedes").DataTable();
                    });
              //  console.log(this.listaSedes);
            });

        },
        validar_for(){

            let errors = [];
            if (!this.formularioSede.mapa) { errors.push( "El mapa es obligatorio");}
            if (!this.formularioSede.link) { errors.push( "El link es obligatorio");}
            if (!this.formularioSede.celular) { errors.push( "El celular es obligatorio");}
            if (!this.formularioSede.direccion) { errors.push( "El direccion es obligatorio");}
            if (!this.formularioSede.sede_nombre) { errors.push( "El nombre es obligatorio");}

            if (this.formularioSede.id_sede){

                        if(errors.length>0){
                            for (let i = 0; i < errors.length; i++) {
                                this.alert_val('error',errors[i]);
                            }
                        }else{
                             //Actualizar
                           // console.log(this.formularioSede.id_sede);
                            this.actualizarSede();
                            $("#mdl-sede").modal('hide');//ocultamos el modal
                        };


            }else{

                if (!this.formularioSede.imagen) { errors.push( "El imagen es obligatorio");}
                 //Registro nuevo
                if(errors.length>0){
                    for (let i = 0; i < errors.length; i++) {
                         this.alert_val('error',errors[i]);
                    }
                }else{
                  this.registroSede();
                  $("#mdl-sede").modal('hide');//ocultamos el modal
                };


            }

        },
        alert_val(icono,mensaje){

           // Swal.fire({ position: 'top-end', icon: 'error', title: `${men}`, timer: 1000 });
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
                    title: mensaje
                })

        },
        obtenerImagenSede(event) {
            //Asignamos la imagen a  nuestra data
            let imagen = event.target.files[0];
            this.formularioSede.imagen = imagen;
            // console.log(this.formularioSede.imagen )

        },
        registroSede() {

            // console.log(this.formularioSede);
            var data = new FormData();
                //Añadimos la imagen seleccionada
                data.append("nombre", this.formularioSede.sede_nombre);
                data.append("direccion", this.formularioSede.direccion);
                data.append("celular", this.formularioSede.celular);
                data.append("link", this.formularioSede.link);
                data.append("mapa", this.formularioSede.mapa);
                data.append("imagen", this.formularioSede.imagen);

            axios.post('api/sedes',data)
                    .then((response) =>{
                      // console.log(response);
                      Swal.fire( 'Good job!',`Registro Exitoso`, 'success')
                      this.traerLitaSedes();
                      this.limpiarformularioSede();

            }).catch((error) =>{
                console.log(error);

            });
        },
        eliminarSede(id){


            Swal.fire({
                title: 'Seguro de Eliminar ?',
                text: "Recuerde esto ya no podra ser revertido",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,Eliminar!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('api/eliminar_sede',{'id_sede':id}).then((response)=>{

                        console.log(response);

                        Swal.fire( 'Good job!','Registro Eliminado', 'success')
                        this.traerLitaSedes();
                        this.limpiarformularioSede();


                        }).catch((error)=>{

                            Swal.fire( 'Good job!','error ', 'error')
                        })

                }
                })



        },
        editarSede(data){
           // this.formularioSede=data;
           // console.log(this.formularioSede);
            this.formularioSede.mapa=data.mapa;
            this.formularioSede.link=data.link_w;
            this.formularioSede.celular=data.telefono1;
            this.formularioSede.direccion=data.direccion;
            this.formularioSede.sede_nombre=data.sede;
            this.formularioSede.id_sede=data.id_sede;
            this.img_vl=false;
            this.estadoModal=false;
        },
        limpiarformularioSede(){

            this.formularioSede.mapa=null;
            this.formularioSede.link=null;
            this.formularioSede.celular=null;
            this.formularioSede.direccion=null;
            this.formularioSede.sede_nombre=null;
            this.formularioSede.imagen=null;
            this.formularioSede.id_sede=null;
            this.img_vl=true;
            this.estadoModal=true;

        },
        actualizarSede(){

            axios.post('api/editar_sede',this.formularioSede)
            .then((response)=>{

                //console.log(response);
                Swal.fire( 'Good job!',`${response.data}`, 'success')
                this.traerLitaSedes();
                this.limpiarformularioSede();

            })
            .catch((response)=>{console.log(response)});

        },
        actualizarimgSede() {
            var data = new FormData();

            data.append("id_sede", this.id_img_sede_update);
            data.append("imagen_sede", this.formularioSede.imagen);

         //   console.log(this.formPortada);

            axios.post('api/actualizar_img_sede', data).then((response) => {

                $("#portadaimgSede").modal("hide");
                 Swal.fire("En hora buena!", `${response.data}`, "success");
                this.traerLitaSedes();
                this.formularioSede.imagen=null;
            })
                .catch((error) => {
                    console.log(error);
                });
        },
        
       async agregarSala(){

            if (!this.formularioSala.imagen) {
                Swal.fire("Error!", 'Selecione Imagen', "error");
            }else{
                var data = new FormData();
                data.append('imagen',this.formularioSala.imagen);
                data.append('id_sede',this.formularioSala.id_sede);
                //data.append('sede', this.titulo_sede);
                let add_sala = await axios.post('api/salon',data);
                let datosSede={
                    id_sede: this.formularioSala.id_sede,  
                    sede:this.titulo_sede,
                }; 
                console.log(add_sala.data);
                if(add_sala.data.create_sala){
                    this.bambu_alert('Sala Registrada','success');
                //  this.formularioSala.imagen=[];
                    this.ver_salas(datosSede);
                    
                }else{
                    this.bambu_alert('No se puedo realizar el registro','success');
                }

            }

        },
        ver_salas(data){
            console.log(data);
            this.titulo_sede=data.sede;
            axios.post('api/list_salon_sede',data)
            .then((response)=>{
               this.listaSalas=response.data.list_salones;
               this.formularioSala.id_sede=data.id_sede;

            }).catch((error)=>{
                console.log(error);
            });
        },
        obtenerImagenSalon(event){
            let imagen = event.target.files[0];
            this.formularioSala.imagen = imagen;
            // this.formularioSala.id_sede = imagen;

        },
    async bambu_alert(texto, icono) {
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
        eliminarSala(data){
                Swal.fire({
                title: 'Seguro de Eliminar ?',
                text: "Recuerde esto ya no podra ser revertido",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,Eliminar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.post('api/eliminar_Sala',data).then((r)=>{
                        Swal.fire("En Hora buena!", 'Imagen Eliminada', "success");
                        this.ver_salas(data);
                    }).catch((e)=>{
                    console.log(e);
                    }) 
                }
                })
        }
    }
}



</script>

