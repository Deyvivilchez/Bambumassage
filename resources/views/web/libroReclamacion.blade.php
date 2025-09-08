<!DOCTYPE html>
<html lang="es">
@include('web.componentes_web.head')

<body>
    <div class="super_container" id="bambu_app">
        @include('web.componentes_web.nav')

        <!-- Banner de Portada -->
        <div class="container ">
            <div class="row">
                <div class="col" style="padding-top: 100px;">
                    <img src="http://127.0.0.1:8000/portadas/portada-gift-card-01jpg-may-3-2023-4-42-pm.jpg"
                        alt="Portada" class="w-100 rounded shadow">
                </div>
            </div>
        </div>

        <!-- Formulario de Consultas -->
        <div class="container mt-4 my-4">
            <div class="row justify-content-center mt-4">
                <!-- Tarjeta para consulta de reclamo -->
                <div class="col-6" v-on:click="modalReclamo()">
                    <div class="card shadow-lg border-custom rounded-lg">
                        <div class="card-header text-white text-center custom-header">
                            <h4 class="mb-0">📌 CONSULTA TU RECLAMO</h4>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta para realizar o cancelar reclamo -->
                <div class="col-6">
                    <div class="card shadow-lg border-custom rounded-lg" @click="reclamo = !reclamo"
                        :class="reclamo ? 'bg-danger-reclamo' : 'bg-primary-reclamo'">

                        <!-- Estado cuando no hay reclamo -->
                        <div class="card-header text-white text-center custom-header" v-if="!reclamo">
                            <h4 class="mb-0">📝 REALIZA TU RECLAMO</h4>
                        </div>

                        <!-- Estado cuando el reclamo está activo -->
                        <div class="card-header text-white text-center custom-header"
                            :style="{
                                background: reclamo ? 'rgb(199 157 123)' : '',
                                color: '#E9F1DF',
                                border: reclamo ?
                                    '1px solid rgb(232 228 226)' : ''
                            }"
                            v-else>
                            <h4 class="mb-0">Cancelar Reclamo</h4>
                        </div>
                    </div>
                </div>

            </div>
        </div>




        <!-- Formulario en Card con Nuevo Estilo -->
        <div class="container mt-4 mb-4">
            <div class="row justify-content-center mt-4" v-if="reclamo == true">
                <div class="col-md-8">
                    <div class="card shadow-lg border-custom rounded-lg">
                        <div class="card-header text-white text-center custom-header">
                            <h4 class="mb-0">📖 Formulario de Reclamaciones</h4>
                        </div>
                        <div class="card-body custom-bg">
                            <form @submit.prevent="enviarFormulario">
                                <div class="form-group ">
                                    <label>📄 DNI o RUC:</label>
                                    <div class="input-group mb-3">

                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary btn-reniec" type="button"
                                                @click="consultaRuc">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z" />
                                                    <path
                                                        d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z" />
                                                    <path
                                                        d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z" />
                                                    <path
                                                        d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z" />
                                                    <path
                                                        d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49" />
                                                </svg>

                                            </button>
                                        </div>
                                        <input type="number" class="form-control" v-model="form.dni_ruc" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>👤 Nombre Completo:</label>
                                    <input type="text" class="form-control" v-model="form.nombre" required>
                                </div>
                                <div class="form-group">
                                    <label>📞 Teléfono:</label>
                                    <input type="text" class="form-control" v-model="form.telefono" required>
                                </div>

                                <div class="form-group">
                                    <label>✉️ Correo Electrónico:</label>
                                    <input type="email" class="form-control" v-model="form.email" required>
                                </div>

                                <div class="form-group">
                                    <label>🏠 Dirección:</label>
                                    <input type="text" class="form-control" v-model="form.direccion" required>
                                </div>
                                <div class="form-group">
                                    <label>Producto/Servicio:</label>
                                    <select class="form-control" v-model="form.prod_serv" required>
                                        <option value="PRODUCTO">Producto</option>
                                        <option value="SERVICIO">Servicio</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>⚖️ Tipo de Solicitud:</label>
                                    <select class="form-control" v-model="form.tipo" required>
                                        <option value="Reclamo">Reclamo</option>
                                        <option value="Queja">Queja</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>📝 Detalle del Reclamo:</label>
                                    <textarea class="form-control" v-model="form.detalle" rows="4" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label>📜 Código de Compra (Boleta/Factura):</label>
                                    <input type="text" class="form-control" v-model="form.codigo_compra" required>
                                </div>

                                <button type="submit" class="btn btn-custom btn-block">📩 Enviar Reclamo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal" tabindex="-1" role="dialog" id="modal-consultas">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ingrese codigo de reclamo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Input de búsqueda -->
                        <input type="text" class="form-control mb-3" placeholder="🔍 Buscar reclamo..."
                            v-model="codbusqueda">

                        <!-- Resultados filtrados -->

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" @click="BuscarReclamo">Buscar</button>

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
















    </div>












    @include('web.componentes_web.footer')
    @include('web.componentes_web.script')

    <style>
        /* Color personalizado para la card */
        .border-custom {
            border-color: #61b194 !important;
        }

        /* Encabezado con color principal */
        .custom-header {
            background-color: #61b194;
        }

        /* Fondo suave dentro de la card */
        .custom-bg {
            background-color: #E9F1DF;
        }

        /* Efecto de alto relieve en la card */
        .card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Botón con color verde oscuro */
        .btn-custom {
            background-color: #438971;
            color: white;
        }

        .btn-custom:hover {
            background-color: #366F5D;
        }

        .form-control {
            color: #438971;
        }

        .form-control.is-invalid {
            border-color: #e5aaaf;
        }

        .bg-danger-reclamo {
            background-color: red !important;
            color: white !important;
        }

        .bg-primary-reclamo {
            background-color: blue !important;
            color: white !important;
        }
    </style>

    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script type="module">
        const {
            createApp
        } = Vue;
        createApp({
            data() {
                return {

                    formInscripcion: {
                        dni: ''
                    },
                    form: {
                        nombre: '',
                        solo_nombres: '',
                        ap_paterno: '',
                        ap_materno: '',
                        dni_ruc: '',
                        telefono: '',
                        email: '',
                        direccion: '',
                        tipo: 'Reclamo',
                        detalle: '',
                        codigo_compra: '',
                        prod_serv: 'SERVICIO'
                    },

                    consulta: {},
                    reclamo: false,
                    codbusqueda: null,
                };
            },
            methods: {

                alert_val(icono, mensaje) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: icono,
                        title: mensaje
                    });
                },
                async consultaRuc() {
                    $(".btn-reniec").html(
                        ` <img src="{{ url('personalizado/icons8-spinner.gif') }}" style="width: 25px; height: 25px;">`
                    ).attr("disabled", true);
                    this.formInscripcion.dni = this.form.dni_ruc;

                    if (this.formInscripcion.dni) {
                        let resp = await axios.post('api/consultaReniec', this.formInscripcion);

                        if (resp.data.error) {
                            this.alert_val('error', resp.data.error);
                        }
                        if (!resp.data.error) {
                            this.alert_val('success', "Respuesta RENIC con exito");
                            this.form.nombre = resp.data.nombres + " " + resp.data.apellidoPaterno + " " + resp
                                .data.apellidoMaterno;
                            this.form.solo_nombres = resp.data.nombres;
                            this.form.ap_paterno = resp.data.apellidoPaterno;
                            this.form.ap_materno = resp.data.apellidoMaterno;
                        }
                        $(".btn-reniec").html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                                    </svg>`).removeAttr("disabled");
                    } else {
                        this.alert_val('error', "INGRESE DNI");
                        $(".btn-reniec").html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                    </svg>`).removeAttr("disabled");
                    }
                },
                async enviarFormulario() {
                    try {
                        let response = await axios.post('api/reclamaciones', this.form);
                        Swal.fire('Éxito', 'Reclamo enviado correctamente', 'success');
                        this.form = {
                            nombre: '',
                            dni_ruc: '',
                            telefono: '',
                            email: '',
                            direccion: '',
                            tipo: 'Reclamo',
                            detalle: '',
                            codigo_compra: ''
                        };
                    } catch (error) {
                        Swal.fire('Error', 'Hubo un problema al enviar el reclamo', 'error');
                    }
                },
                async modalReclamo() {

                    $("#modal-consultas").modal('toggle');
                },
                async BuscarReclamo() {
                   
                    try {
                        const response = await axios.get(`api/reclamaciones/${this.codbusqueda}`);

                        if (response.data && response.data.existe) {
                            // Redirigir a la página de detalles del reclamo
                            window.location.href = `/libro-reclamaciones/${this.codbusqueda}`;
                        } else {
                            this.resultadoReclamo = null;
                            alert("❌ El código ingresado no existe. Inténtelo nuevamente.");
                        }
                    } catch (error) {
                        console.error("Error en la búsqueda:", error);
                        alert("❌ Ocurrió un error al buscar el reclamo. Inténtelo más tarde.");
                    }
                }


            }
        }).mount('#bambu_app');
    </script>

</body>

</html>
