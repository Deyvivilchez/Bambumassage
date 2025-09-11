<template>
    <div>

        <div class="container-fluid mt-3">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-12">
                         <h3>Reclamos</h3>
                        <div class="card">
                            <div>
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <!-- Contenedor para el ícono de filtro y el selector de cantidad de registros -->
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-filter mr-2"></i>
                                        <select class="custom-select w-auto"
                                            aria-label="Cantidad de registros a mostrar" v-model="cantidadRegistros">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>

                                    <!-- Campo de búsqueda con indicador de carga -->
                                    <input type="text" class="form-control w-auto" placeholder="Buscar..."
                                        aria-label="Buscar" v-model="inputBuscar">
                                </div>

                                <div class="card-body">
                                    <div v-if="cargando" class="text-center my-3">
                                        <div class="spinner-border avatar-lg text-primary" role="status"></div>
                                        <br> Cargando...
                                    </div>

                                    <div v-else class="table-responsive">
                                        <table class="table table-hover table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>COD</th>
                                                    <th>DNI</th>
                                                    <th>NOMB</th>
                                                    <th>TIPO</th>
                                                    <th>DESC</th>
                                                    <th>FECHA</th>
                                                    <th>OPCIONES</th>
                                                </tr>
                                            </thead>

                                            <!-- Cuando hay datos -->
                                            <tbody v-if="listClaims && listClaims.length">
                                                <tr v-for="(item, index) in listClaims" :key="index">
                                                    <td v-text="index + 1"></td>
                                                    <td v-text="item.codigo_reclamo"></td>
                                                    <td v-text="item.num_documento"></td>
                                                    <td
                                                        v-text="item.nombres + ' ' + item.apellido_paterno + ' ' + item.apellido_materno">
                                                    </td>
                                                    <td v-text="item.tipo_reclamo"></td>
                                                    <td >
                                                        <button class="btn btn-info" v-on:click="verDetalle(item)" >ver detalle</button>
                                                    </td>
                                                    <td v-text="item.fecha_reclamo"></td>
                                                    <td>
                                                        <button v-if="item.estado == 'PRESENTADO'"
                                                            class="btn btn-success" @click="openModal(item, 'tramitar',index)"
                                                            data-toggle="modal" data-target="#tramitarModal">
                                                            Tramitar
                                                        </button>
                                                        <button v-if="item.estado == 'REVISADO'" class="btn btn-primary"
                                                            @click="openModal(item, 'resolver',index)" data-toggle="modal"
                                                            data-target="#resolverModal">
                                                            Resolver
                                                        </button>
                                                        <a class="btn btn-warning"
                                                            :href="'/comprobante/' + item.codigo_reclamo"
                                                            target="_blank">🖨️ Imprimir</a>
                                                    </td>
                                                </tr>
                                            </tbody>

                                            <!-- Sin datos: mantiene altura agradable -->
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="8" class="text-center text-muted py-4">
                                                        No hay resultados para mostrar.
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card-footer text-center">
                                    <paginacion :urlInicial="urlClaims" @listadoDatos="RenderTabla"></paginacion>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Modal Tramitar (BS4) -->
        <div class="modal fade" id="tramitarModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title">Tramitar Reclamo</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Código de Reclamo:</strong> {{ selectedClaim.codigo_reclamo }}</p>
                        <div class="mb-3">
                            <label class="form-label"><strong>Fecha:</strong></label>
                            <input type="date" v-model="formData.fecha" class="form-control" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Respuesta:</strong></label>
                            <textarea v-model="formData.respuesta" class="form-control" rows="4"
                                placeholder="Escribe tu respuesta..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success" @click="sendResponse">Enviar Respuesta</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Resolver (BS4) -->
        <div class="modal fade" id="resolverModal" tabindex="-1" aria-labelledby="resolverModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Resolver Reclamo</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Código de Reclamo:</strong> {{ selectedClaim.codigo_reclamo }}</p>
                        <div class="mb-3">
                            <label class="form-label"><strong>Fecha de Finalización:</strong></label>
                            <input type="date" v-model="formData.fechaFinalizacion" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><strong>Acuerdo Final:</strong></label>
                            <textarea v-model="formData.acuerdoFinal" class="form-control" rows="4"
                                placeholder="Describe el acuerdo final..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" @click="resolveClaim">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>


 <div class="modal fade" id="detalleModal" tabindex="-1" role="dialog"
     aria-labelledby="detalleModalTitle" aria-hidden="true"
     data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="detalleModalTitle">Detalle del reclamo</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <!-- Sección: Detalle del reclamo -->
        <div class="mb-3">
          <h6 class="text-uppercase small text-muted mb-2">Detalle del reclamo</h6>
          <div class="border rounded p-3 bg-light">
            <!-- 'pre-line' respeta saltos de línea del texto -->
            <p class="mb-0 lead" style="white-space: pre-line;"
               v-text="detalleModalinfo.detalle"></p>
          </div>
        </div>

        <!-- Sección: Pedido del reclamo -->
        <div>
          <h6 class="text-uppercase small text-muted mb-2">Pedido del reclamo</h6>
          <div class="border rounded p-3">
            <p class="mb-0" style="white-space: pre-line;"
               v-text="detalleModalinfo.pedido"></p>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <!-- Solo un botón para cerrar -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>




    </div>
</template>

<script>

export default {
    name: 'Reclamaciones',
    data() {
        return {
            urlClaims: 'api/reclamaciones',
            listClaims: [],
            selectedClaim: {},
            formData: {
                fecha: new Date().toISOString().substr(0, 10),
                respuesta: "",
                fechaFinalizacion: new Date().toISOString().substr(0, 10),
                acuerdoFinal: ""
            },
            modalType: "",
            inputBuscar: '',
            cantidadRegistros: 10,
            cargando: false,
            detalleModalinfo:{},
            indexReclamo:null,
        };
    },
    created() {
        // this.getClaims();
    },
    methods: {

        RenderTabla(data) {
            this.listClaims = data;
        },
        // async getClaims() {
        //     try {
        //         let response = await axios.get('api/reclamaciones');
        //         this.listClaims = response.data;
        //     } catch (error) {
        //         console.error("Error al obtener reclamos:", error);
        //     }
        // },
        openModal(item, type,index) {
            this.indexReclamo = index;
            this.selectedClaim = item;
            this.modalType = type;
            if (type === 'tramitar') {
                this.formData.respuesta = "";
                $("#tramitarModal").modal("toggle");

            } else if (type === 'resolver') {
                this.formData.fechaFinalizacion = new Date().toISOString().substr(0, 10);
                this.formData.acuerdoFinal = "";
                $("#resolverModal").modal("toggle");
            }
        },
        CancelarModal() {
            if (this.modalType === 'tramitar') {
                $("#tramitarModal").modal("toggle");
            } else if (this.modalType === 'resolver') {
                $("#resolverModal").modal("toggle");
            }

        },
        async sendResponse() {
            if (!this.formData.respuesta.trim()) {
                // alert("Por favor ingresa una respuesta.");
                Swal.fire("error", "Error!", "Por favor ingresa una respuesta");
                return;
            }
            try {
               let post =  await axios.post('api/respoder_reclamo', {
                    id_reclamo: this.selectedClaim.id_reclamo,
                    codigo_reclamo: this.selectedClaim.codigo_reclamo,
                    fecha: this.formData.fecha,
                    respuesta: this.formData.respuesta
                });
                if(post.data.response){
                     //  alert("Respuesta enviada correctamente.");
                  //  Swal.fire("success", "Exelente!", "Respuesta enviada correctamente.");
                    //document.querySelector("#tramitarModal .btn-close").click();
                    $('#tramitarModal').modal('toggle');
                    this.listClaims[this.indexReclamo].estado = post.data.reclamo.estado;
                    Swal.fire({
                        title: "Good job!",
                        text: "You clicked the button!",
                        icon: "success"
                        });
                }


            } catch (error) {
                console.error("Error al enviar la respuesta:", error);
                // alert("Hubo un error al enviar la respuesta.");
                Swal.fire("error", "Error!", "Hubo un error al enviar la respuesta");
            }
        },
        // async resolveClaim() {
        //     if (!this.formData.acuerdoFinal.trim()) {  Swal.fire("error", "Error!", "Por favor ingresa el acuerdo final");  return;  }
        //     try {
        //         // const data ={   id_reclamo: this.selectedClaim.id_reclamo, codigo_reclamo: this.selectedClaim.codigo_reclamo,
        //         //                 fechaFinalizacion: this.formData.fechaFinalizacion,
        //         //                 acuerdoFinal: this.formData.acuerdoFinal}
        //         let response = await axios.post('api/resolver_reclamo',this.selectedClaim );
        //             if(response.data.response){
        //                 Swal.fire("success", "Exelente!", "Reclamo resuelto correctamente");
        //                 $("##resolverModal").modal("toggle");

        //                  //this.listClaims[this.indexReclamo].estado = 'REVISADO';
        //             }

        //     } catch (error) {
        //         console.error("Error al resolver el reclamo:", error);
        //         //alert("Hubo un error al resolver el reclamo.");
        //         Swal.fire("error", "Error!", "Hubo un error al resolver el reclamo.");
        //     }
        // },
        async resolveClaim(){

            const data ={   id_reclamo: this.selectedClaim.id_reclamo, codigo_reclamo: this.selectedClaim.codigo_reclamo,
                                fechaFinalizacion: this.formData.fechaFinalizacion,
                                acuerdoFinal: this.formData.acuerdoFinal}
            let post = await axios.post('api/resolver_reclamo',data);
            if(post.data.response){

                $('#resolverModal').modal('toggle');
                this.listClaims[this.indexReclamo].estado = post.data.reclamo.estado;
               // Swal.fire("success", "Exelente!", "Reclamo resuelto correctamente");
                Swal.fire({
                    title: "En hora buena!",
                    text: "Reclamo resuelto correctamente",
                    icon: "success"
                    });

                return false
            }
            Swal.fire("error", "Error!", post.data.message);

        },
        verDetalle(item){

            this.detalleModalinfo = item;
            $("#detalleModal").modal("toggle");

        }
    },
    watch: {
        async inputBuscar() {
            this.cargando = true;  // Activar el indicador de carga

            try {
                const busqueda = this.inputBuscar.trim();
                if (busqueda) {
                    // Actualiza la URL para que el componente reactive la búsqueda

                    this.urlClaims = `api/buscarReclamos/${encodeURIComponent(busqueda)}/${this.cantidadRegistros}`;

                } else {
                    this.urlClaims = 'api/get_Personas';
                }
            } catch (error) {
                console.error('Error al buscar:', error);
            } finally {
                // Desactivar el indicador de carga después de un breve tiempo para mejor UX
                setTimeout(() => { this.cargando = false; }, 500);
            }
        },


    },
};
</script>
