<template>
    <div class="container-fluid mt-3">
        <div class="row m-2">
            <button class="btn btn-success" v-on:click="limpiarModal()"> Registrar Eventos</button>
        </div>
        <div class="row">
            <div class="col-lg-3 col-sm-6" v-for="(evento, index) in listaEventos.data" :key="index">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img :src="'web/images/eventos/' + evento.flayer" class="w-100" />
                            <h3 class="m-3 mb-1 p-1" v-text="evento.titulo_evento"></h3>
                            <button type="button" class="btn mb-1 btn-outline-warning"
                                v-on:click="Inscritos(evento)">Inscritos</button>
                            <button type="button" class="btn mb-1 btn-outline-info"
                                v-on:click="EditarEvento(evento, index)">Editar</button>
                            <button type="button" class="btn mb-1 btn-outline-danger"
                                v-on:click="eliminarEvento(evento.id_evento)">Eliminar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
            <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li> -->
            <template v-for="(pagina, paginaIndex) in listaEventos.links">
                <li class="page-item" v-if="pagina.url !== null"   :class="[[true].includes(pagina.active) ? 'active' : 'inactive',]">
                    <a class="page-link"  v-html="pagina.label" @click="GetEventos(pagina.url)"></a>
                </li>
            </template>
            </ul>
        </nav>




        <!-- Modal -->
        <div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-success" v-if="btnEditar == false">
                        <h5 class="modal-title text-white " id="exampleModalLabel">Registo de Eventos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-header bg-primary" v-else>
                        <h5 class="modal-title text-white " id="exampleModalLabel">Editar de Eventos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="recipient-name" class="col-form-label">Nombre Evento</label>
                                <input type="text" class="form-control" v-model="formEventos.nombre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Fecha Evento</label>
                                <input type="date" class="form-control" v-model="formEventos.fechaEvento">
                            </div>
                            <div class="col-6">
                                <label for="recipient-name" class="col-form-label">Limite Inscripcion</label>
                                <input type="date" class="form-control" v-model="formEventos.fechaLimite">
                            </div>
                            <div class="col">
                                <label for="recipient-name" class="col-form-label">Banner</label>
                                <input type="file" class="form-control" @change="Banner">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secundary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" v-on:click="RegistroEvento"
                            v-if="btnEditar == false">Registrar</button>
                        <button type="button" class="btn btn-primary" v-on:click="UpdateEvento" v-else>Actualizar</button>

                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bd-example-modal-lg" id="mdl-Inscritos" tabindex="-1" role="dialog"
            aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white " id="exampleModalLabel">Registo de Inscritos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <table class="table table-hover w-100"  id="tabla-inscritos">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Nombres y Apellidos</th>
                                                <th scope="col">Celular</th>
                                                <th scope="col">Correo</th>
                                            </tr>
                                        </thead>
                                        <tbody style="">
                                            <tr v-for="(persona,index) in listaInscritos" :key="index">
                                                <th scope="row">1</th>
                                                <td v-text="persona.nombres + persona.apellido_paterno +persona.apellido_materno"></td>
                                                <td v-text="persona.celular"></td>
                                                <td v-text="persona.correo"></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>
<style>

.page-item.active .page-link {
    z-index: 1;
    color: #477b67;
    background-color: #cde9dd;
    border-color: #a0bfb0;
}
</style>
<script>
import axios from 'axios';

// import axios from 'axios';

export default {
    name: "portada_bambu",
    data() {
        return {
            listaEventos: [],
            formEventos: {
                nombre: null,
                fechaEvento: null,
                fechaLimite: null,
                banner: null,
            },
            btnEditar: false,
            listaInscritos:null,
        };
    },
    created() {
        this.GetEventos('api/eventos');
        $("#tabla-inscritos").DataTable();
    },
    methods: {
        async GetEventos(url) {
            let get = await axios.get(url);
            this.listaEventos = get.data;
   
        },
        limpiarModal() {
            $('#modalEventos').modal('toggle');
            this.btnEditar = false;
            this.formEventos = { nombre: null, fechaEvento: null, fechaLimite: null, banner: null, }
        },
        Banner(event) {
            var imagen = event.target.files[0];
            this.formEventos.banner = imagen;
        },
        async RegistroEvento() {
            if (!this.formEventos.nombre) {
                this.alert_val('error', 'Digitar Nombre Evento'); return false
            }
            if (!this.formEventos.fechaEvento) {
                this.alert_val('error', 'Ingrese Fecha Evento'); return false
            }
            if (!this.formEventos.fechaLimite) {
                this.alert_val('error', 'Ingrese Fecha Limite Inscripcion'); return false
            }
            if (!this.formEventos.banner) {
                this.alert_val('error', 'Cargar Imagen'); return false
            }
            let data = new FormData();
            data.append("nombre", this.formEventos.nombre);
            data.append("fechaEvento", this.formEventos.fechaEvento);
            data.append("fechaLimite", this.formEventos.fechaLimite);
            data.append("banner", this.formEventos.banner);
            let response = await axios.post('api/eventos', data);
            if (response.data.verificado) {
                this.GetEventos();
                this.alert_val('success', 'El Evento fue Registrado');
                $('#modalEventos').modal('toggle');
                return false;
            }
        },
        async EditarEvento(item, index) {
            this.formEventos = {};
            this.formEventos.nombre = item.titulo_evento;
            this.formEventos.fechaEvento = item.fecha_evento;
            this.formEventos.fechaLimite = item.limite_inscripcion;
            this.formEventos.banner = item.flayer;
            this.formEventos.id_evento = item.id_evento;
           // console.log(this.formEventos.index);
            this.btnEditar = true;
            this.index = index;
            $('#modalEventos').modal('toggle');

        },
        async UpdateEvento() {

            if (!this.formEventos.nombre) { this.alert_val('error', 'Digitar Nombre Evento'); return false }
            if (!this.formEventos.fechaEvento) { this.alert_val('error', 'Ingrese Fecha Evento'); return false }
            if (!this.formEventos.fechaLimite) { this.alert_val('error', 'Ingrese Fecha Limite Inscripcion'); return false }

            let data = new FormData();
            data.append("nombre", this.formEventos.nombre);
            data.append("fechaEvento", this.formEventos.fechaEvento);
            data.append("fechaLimite", this.formEventos.fechaLimite);
            data.append("banner", this.formEventos.banner);
            data.append("id_evento", this.formEventos.id_evento);

            let url = 'api/UpdateEventos';
            let response = await axios.post(url, data);
          
            if (response.data.verificado === true) {
             //   listaEventos.data
                this.listaEventos.data[this.index] = response.data.evento;

                this.alert_val('success', 'Evento Actualizado');

                await $('#modalEventos').modal('toggle'); this.formEventos = {};
            }

        },
        async eliminarEvento(id) {
            Swal.fire({
                title: "¿Está seguro?",
                text: "¡No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, Borrar!",
                cancelButtonText: "Cancelar",
            }).then(async (result) => {
                if (result.isConfirmed) {
                    let url = '/api/eventos/' + id;
                    let respuesta = await axios.delete(url);
                    console.log(respuesta.data);
                    if (respuesta.data.verificado) {
                        this.GetEventos();
                        this.alert_val('success', 'El Evento fue eliminado');
                        return false;
                    }
                }
                if (!result.isConfirmed) {
                    this.alert_val('info', 'La Operación se cancelo'); return false
                }
            });
        },
        alert_val(icono, mensaje) {

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
       async  Inscritos(item) {
            $("#tabla-inscritos").DataTable().destroy(); 
            this.listaInscritos = item.inscritos;
            await  $('#mdl-Inscritos').modal('toggle');
             await  $("#tabla-inscritos").DataTable();
        },
        

    }
}



</script>

