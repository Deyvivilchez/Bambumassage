<!DOCTYPE html>
<html lang="en">
@include('web.componentes_web.head')
<body>
    <div class="super_container" id="bambu_app">
        @include('web.componentes_web.nav')
            <div class="container">
                <div class="row ">
                    <div class="col" style="padding-top: 100px">
                        <img src="{{url('web/images/eventos/'.$evento->flayer)}}" alt="" class="w-100">
                    </div>
                </div>
            </div>

        <div class="">

            <div class="container" >
                <div class="row">
                    <div class="w-100  p-1">
                        <div class="col">
                            <p class="text-justify  ">
                                <div class="titulosSeccionCorporativa" > FORMULARIO DE INSCRIPCION </div>
                            </p>
                        </div>
                        <br>
                        <div class="col d-flex justify-content-sm-center mb-4 w-100" style="text-align: justify; color: rgb(141, 157, 153); font-size: 1.5rem;">

                            <div class="container mb-4 w-100">
                                <div  class="card d-flex justify-content-sm-center" style="background: #61b1942b ">
                                    <div class="card-body p-4 ">
                                        <div class="row">
                                            <div class="col-xl-6 col-md-6 col-sd-12 ">
                                                <label for="exampleFormControlInput1"><strong>DNI</strong></label>
                                                <div class="input-group mb-3">
                                                   
                                                    <div class="input-group-prepend">
                                                      <button class="btn btn-outline-secondary btn-reniec"  type="button" @click="consultaRuc">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                                                            <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                                                            <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                                                            <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                                                            <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                                                            <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                                                          </svg>

                                                      </button>
                                                    </div>
                                                    <input type="number" class="form-control" 
                                                        :class="[
                                                                  ['', null].includes(formInscripcion.dni) ? 'is-invalid' : 'is-valid',
                                                                ]"
                                                        placeholder="20304050" 
                                                        v-model="formInscripcion.dni">
                                                  </div>
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-sd-12 ">
                                                <label for="exampleFormControlInput1"><strong>Nombres</strong></label>
                                                 <input type="text" class="form-control" 
                                                  placeholder="Andrea Noemi" 
                                                  :class="[['', null].includes(formInscripcion.nombres) ? 'is-invalid' : 'is-valid',]"
                                                  v-model="formInscripcion.nombres">
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-4 col-md-4 col-sd-12 ">
                                                <label for="exampleFormControlInput1"><strong>Apellido Paterno</strong></label>
                                                 <input type="text" class="form-control"  placeholder="CHAVEZ"
                                                 :class="[['', null].includes(formInscripcion.apellidop) ? 'is-invalid' : 'is-valid',]"
                                                 v-model="formInscripcion.apellidop">
                                            </div>
                                            <div class="col-xl-4 col-md-4 col-sd-12  ">
                                                <label for="exampleFormControlInput1"><strong>Apellido Materno</strong></label>
                                                 <input type="text" class="form-control"  placeholder="SANCHEZ"
                                                 :class="[['', null].includes(formInscripcion.apellidom) ? 'is-invalid' : 'is-valid',]"
                                                 v-model="formInscripcion.apellidom">
                                            </div>
                                          
                                            <div class="col-xl-4 col-md-4 col-sd-12  ">
                                                <label for="exampleFormControlInput1"><strong>Selecione una Sede</strong></label>
                                                <select class="form-control" 
                                                :class="[['', null].includes(formInscripcion.sede) ? 'is-invalid' : 'is-valid',]"
                                                v-model="formInscripcion.sede">
                                                    <option :value="null" >Selecione Opcion</option>
                                                    <option v-for="(sede, index) in listasSedesBambu" :value="sede.id_sede" v-text="sede.sede"></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-xl-6 col-md-6 col-sd-12 ">
                                                <label for="exampleFormControlInput1"><strong>Telefono</strong></label>
                                                 <input type="number" class="form-control"  placeholder="999999999"
                                                 :class="[['', null].includes(formInscripcion.telefono) ? 'is-invalid' : 'is-valid',]"
                                                 v-model="formInscripcion.telefono">
                                            </div>
                                            <div class="col-xl-6 col-md-6 col-sd-12 ">
                                                <label for="exampleFormControlInput1"><strong>Correro</strong></label>
                                                 <input type="email" class="form-control"  placeholder="Andrea.c.s@gmail.com"
                                                 :class="[['', null].includes(formInscripcion.correo) ? 'is-invalid' : 'is-valid',]"
                                                 v-model="formInscripcion.correo">
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-xl-12   ventas_corporativas d-flex justify-content-end ">
                                                <div class="content_ventas_contacto" style=" font-size:20px;">
                                                    <a >
                                                        <button v-on:click="RegistroInscripcion"  class="btn-registro">REGISTRAR</button>
                                                    </a>
                        
                                                </div>
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
                    <img  src="{{url('personalizado/icons8-spinner.gif')}}"  style="width: 50px; height: 50px;">
                </div>
            </div>
    

        </div>
    </div>
    @include('web.componentes_web.footer')
    @include('web.componentes_web.script')
    <style>
        .form-control {
                color: #219778;
        }
        .form-control.is-invalid{
            border-color: #e5aaaf;
        }
    </style>
    <script>
            $(document).ready(function() {
                $("#modal-carga").modal("toggle");                    
            });


          const eventos = <?php echo $evento  ?>;

          const sedes = <?php echo $sedes  ?>;

    </script>
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="module">
    const { createApp } = Vue
    createApp({
        data() {
            return {
                formInscripcion:{
                    dni:null,
                    nombres:null,
                    apellidop:null,
                    apellidom:null,
                    telefono:null,
                    correo:null,
                    sede:null,

                },
                eventos : eventos,
                listasSedesBambu:[],
           
                
            }
        },
        created() {
            this.formInscripcion.id_evento=eventos.id_evento;
            this.listarSedes();
           
        },
        mounted() {
            $("#modal-carga").modal("toggle");
        },
        methods: {
        async   listarSedes(){let temp =  await axios.get('/api/listaSedes'); this.listasSedesBambu = temp.data.sedes;},
         async  consultaRuc(){
                $(".btn-reniec").html(` <img src="{{url('personalizado/icons8-spinner.gif')}}" style="width: 25px; height: 25px;">`)
                .attr("disabled", true);
                if (this.formInscripcion.dni) {
                    let resp = await axios.post('/api/consultaReniec',this.formInscripcion);
                    this.formInscripcion.nombres = resp.data.nombres; 
                    this.formInscripcion.apellidop = resp.data.apellidoPaterno; 
                    this.formInscripcion.apellidom = resp.data.apellidoMaterno;
                    if(resp.data.error){ this.alert_val('error',resp.data.error);}
                    if(!resp.data.error){ this.alert_val('success',"Respuesta RENIC con exito");}
                    $(".btn-reniec").html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                                    <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                                    </svg>`).removeAttr("disabled");
                }else {
                    this.alert_val('error',"INGRESE DNI");
                    $(".btn-reniec").html(`<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-fingerprint" viewBox="0 0 16 16">
                    <path d="M8.06 6.5a.5.5 0 0 1 .5.5v.776a11.5 11.5 0 0 1-.552 3.519l-1.331 4.14a.5.5 0 0 1-.952-.305l1.33-4.141a10.5 10.5 0 0 0 .504-3.213V7a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M6.06 7a2 2 0 1 1 4 0 .5.5 0 1 1-1 0 1 1 0 1 0-2 0v.332c0 .409-.022.816-.066 1.221A.5.5 0 0 1 6 8.447c.04-.37.06-.742.06-1.115zm3.509 1a.5.5 0 0 1 .487.513 11.5 11.5 0 0 1-.587 3.339l-1.266 3.8a.5.5 0 0 1-.949-.317l1.267-3.8a10.5 10.5 0 0 0 .535-3.048A.5.5 0 0 1 9.569 8Zm-3.356 2.115a.5.5 0 0 1 .33.626L5.24 14.939a.5.5 0 1 1-.955-.296l1.303-4.199a.5.5 0 0 1 .625-.329Z"/>
                    <path d="M4.759 5.833A3.501 3.501 0 0 1 11.559 7a.5.5 0 0 1-1 0 2.5 2.5 0 0 0-4.857-.833.5.5 0 1 1-.943-.334Zm.3 1.67a.5.5 0 0 1 .449.546 10.72 10.72 0 0 1-.4 2.031l-1.222 4.072a.5.5 0 1 1-.958-.287L4.15 9.793a9.72 9.72 0 0 0 .363-1.842.5.5 0 0 1 .546-.449Zm6 .647a.5.5 0 0 1 .5.5c0 1.28-.213 2.552-.632 3.762l-1.09 3.145a.5.5 0 0 1-.944-.327l1.089-3.145c.382-1.105.578-2.266.578-3.435a.5.5 0 0 1 .5-.5Z"/>
                    <path d="M3.902 4.222a4.996 4.996 0 0 1 5.202-2.113.5.5 0 0 1-.208.979 3.996 3.996 0 0 0-4.163 1.69.5.5 0 0 1-.831-.556Zm6.72-.955a.5.5 0 0 1 .705-.052A4.99 4.99 0 0 1 13.059 7v1.5a.5.5 0 1 1-1 0V7a3.99 3.99 0 0 0-1.386-3.028.5.5 0 0 1-.051-.705ZM3.68 5.842a.5.5 0 0 1 .422.568c-.029.192-.044.39-.044.59 0 .71-.1 1.417-.298 2.1l-1.14 3.923a.5.5 0 1 1-.96-.279L2.8 8.821A6.531 6.531 0 0 0 3.058 7c0-.25.019-.496.054-.736a.5.5 0 0 1 .568-.422Zm8.882 3.66a.5.5 0 0 1 .456.54c-.084 1-.298 1.986-.64 2.934l-.744 2.068a.5.5 0 0 1-.941-.338l.745-2.07a10.51 10.51 0 0 0 .584-2.678.5.5 0 0 1 .54-.456Z"/>
                    <path d="M4.81 1.37A6.5 6.5 0 0 1 14.56 7a.5.5 0 1 1-1 0 5.5 5.5 0 0 0-8.25-4.765.5.5 0 0 1-.5-.865Zm-.89 1.257a.5.5 0 0 1 .04.706A5.478 5.478 0 0 0 2.56 7a.5.5 0 0 1-1 0c0-1.664.626-3.184 1.655-4.333a.5.5 0 0 1 .706-.04ZM1.915 8.02a.5.5 0 0 1 .346.616l-.779 2.767a.5.5 0 1 1-.962-.27l.778-2.767a.5.5 0 0 1 .617-.346Zm12.15.481a.5.5 0 0 1 .49.51c-.03 1.499-.161 3.025-.727 4.533l-.07.187a.5.5 0 0 1-.936-.351l.07-.187c.506-1.35.634-2.74.663-4.202a.5.5 0 0 1 .51-.49"/>
                    </svg>`) .removeAttr("disabled");
                }
            },
            alert_val(icono, mensaje) {
                const Toast = Swal.mixin({ 
                  toast: true, position: "top-end", showConfirmButton: false, timer: 3000,
                  timerProgressBar: true, didOpen: (toast) => { toast.onmouseenter = Swal.stopTimer; toast.onmouseleave = Swal.resumeTimer;}}
                );Toast.fire({ icon: icono, title: mensaje});
            },
           async RegistroInscripcion(){
                if (!this.formInscripcion.dni) {
                    this.alert_val('error', 'Ingrese su  DNI'); return false
                }
                if (!this.formInscripcion.nombres) {
                    this.alert_val('error', 'Ingrese su nombre en el formulario'); return false
                }
                if (!this.formInscripcion.apellidop) {
                    this.alert_val('error', 'Digitar su Apellido Paterno'); return false
                }
                if (!this.formInscripcion.apellidom) {
                    this.alert_val('error', 'Digitar su Apellido Materno'); return false
                }
                if (!this.formInscripcion.telefono) {
                    this.alert_val('error', 'Debe ingresar un numero de telefono referencial'); return false
                }
                if (!this.formInscripcion.sede) {
                    this.alert_val('error', 'Debe ingresar un numero de telefono referencial'); return false
                }
                
                
                $(".btn-registro").html(`<img src="{{url('personalizado/icons8-spinner.gif')}}"  style="width: 25px; height: 25px;">`).attr("disabled", true);
                console.log(this.formInscripcion);
                let registro = await axios.post('/api/inscripcion',this.formInscripcion);
                if(registro.data.verificado){
                    Swal.fire({
                            title: "Good job!",
                            text: this.formInscripcion.nombres + ' : ' + '   SU REGISTRO SE HA REALIZO CON ÉXITO',
                            icon: "success"
                            });
                            $(".btn-registro").html(`<span>REGISTRAR</span>`) .removeAttr("disabled");

                    this.formInscripcion={dni:null,nombres:null, apellidop:null,apellidom:null,telefono:null,correo:null,sede:null};       
                }
                
            }
        },
        
    }).mount('#bambu_app')
</script>
</body>
</html>

