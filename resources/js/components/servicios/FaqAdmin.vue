<template>
    <div>
        <div class="px-3 mt-3">
            <!-- <h2 class="text-center sub-titulos mb-4" style="font-size: 30px;">
                ADMINISTRAR PREGUNTAS FRECUENTES (CHAT)
            </h2> -->

            <!-- FORMULARIO -->
            <div class="card">
                <div class="card-body">
                    <form class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <div class="row gx-2 my-2">
                            <div class="col-md-3">
                                <label>Categoría de la pregunta:</label>
                                <select v-model="form.id_categoria" class="form-control mt-1"
                                    :class="[[null, ''].includes(form.id_categoria) ? 'is-invalid' : 'is-valid']">
                                    <option :value="null">Seleccione</option>
                                    <option v-for="item in faqsCategoria" :key="item.id" :value="item.id"
                                        v-html="item.descripcion" />
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>Sub categoría de la pregunta:</label>
                                <select v-model="form.id_subcategoria" class="form-control mt-1"
                                    :class="[[null, ''].includes(form.id_subcategoria) ? 'is-invalid' : 'is-valid']"
                                    :disabled="!form.id_categoria">
                                    <option :value="null">Seleccione</option>
                                    <option v-for="item in subcategoriasDelFormulario" :key="item.id" :value="item.id"
                                        v-html="item.descripcion" />
                                </select>
                            </div>
                            <div class="col-md-3" style="align-self: self-end;">
                                <button type="button" class="btn btn-primary w-100 mt-1"
                                    @click.prevent="modal_categoria">
                                    <i class="uil-eye"></i> 👁 Ver / agregar categoría
                                </button>
                            </div>
                            <div class="col-md-3" style="align-self: self-end;">
                                <button type="button" class="btn btn-primary w-100 mt-1"
                                    @click.prevent="modal_subCategoria">
                                    <i class="uil-eye"></i> 👁 Ver / agregar subcategoría
                                </button>
                            </div>
                        </div>

                        <div class="row gx-2 mb-2 mt-3">
                            <div class="col-md-6">
                                <label>Pregunta:</label>
                                <!-- <textarea v-model="form.pregunta" class="form-control mt-1" placeholder="Pregunta"
                                    :class="[['', null].includes(form.pregunta) ? 'is-invalid' : 'is-valid']" /> -->
                                <quill-editor v-model="form.pregunta" :options="editorOptions"
                                    class="mt-1"></quill-editor>
                            </div>
                            <div class="col-md-6">
                                <label>Respuesta:</label>
                                <!-- <textarea v-model="form.respuesta" class="form-control mt-1"
                                    placeholder="Respuesta predefinida"
                                    :class="[['', null].includes(form.respuesta) ? 'is-invalid' : 'is-valid']" /> -->
                                <quill-editor v-model="form.respuesta" :options="editorOptions"
                                    class="mt-1"></quill-editor>
                            </div>
                        </div>
                        <div class="col-span-full d-flex mt-3" style="justify-content: center;">
                            <button class="btn btn-success" @click.prevent="guardarFaq()">
                                <i :class="form.id ? 'uil-sync' : 'uil-weight'"></i> 🖫
                                {{ form.id ? 'Actualizar registro' : 'Registrar' }}
                            </button>
                            <button type="button" class="btn btn-danger mx-1"
                                @click.prevent.prevent="resetForm">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4" />
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Filtrar por categoría principal:</label>
                            <select v-model="filtroCategoriaPrincipal" class="form-control mt-1">
                                <option :value="null">-- Todas las categorías --</option>
                                <option v-for="cat in faqsCategoria" :key="cat.id" :value="cat.id">
                                    {{ cat.descripcion }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Filtrar por subcategoría:</label>
                            <select v-model="filtroCategoria" class="form-control mt-1">
                                <option :value="null">-- Todas las subcategorías --</option>
                                <option v-for="subcat in subcategoriasFiltradas" :key="subcat.id" :value="subcat.id">
                                    {{ subcat.descripcion }}
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2" style="align-content: end">
                            <button type="button" class="btn btn-secondary w-100" @click.prevent="quitarFiltros"> <i
                                    class="uil-brush-alt"></i>
                                🧹 Limpiar filtros</button>
                        </div>
                        <div class="col-md-2" style="align-content: end">
                            <button type="button" class="btn btn-primary w-100" @click.prevent="modal_sugerencias"><i
                                    class="uil-eye"></i> 👁 Ver sugerencias</button>
                        </div>
                    </div>

                    <div class="mt-4">
                        <table class="table dt-responsive w-100" id="tabla-preguntas">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th>#</th>
                                    <th>Pregunta</th>
                                    <th>Subcategoría</th>
                                    <th>Categoría</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(faq, index) in faqsFiltrados" :key="faq.id">
                                    <td class="text-wrap" style="width: 5%;">{{ index + 1 }}</td>
                                    <td class="text-wrap" style="width: 45%;" v-html="faq.pregunta"></td>
                                    <td class="text-wrap" style="width: 20%;">{{ faq.subcategoria?.descripcion || '-' }}
                                    </td>
                                    <td class="text-wrap" style="width: 20%;"> {{
                                        faq.subcategoria?.categoria?.descripcion || faq.categoria?.descripcion || '-' }}
                                    </td>
                                    <td class="text-wrap text-center" style="width: 10%;">
                                        <a class="btn badge btn-primary w-100" style="font-size: 12px; color: white;"
                                            @click.prevent="editarFaq(faq)">
                                            <i class="mdi mdi-square-edit-outline"></i>
                                            Editar
                                        </a>
                                        <a class="btn badge btn-danger w-100 mt-1"
                                            style="font-size: 12px; color: white;" @click.prevent="eliminarFaq(faq.id)">
                                            <i class="mdi mdi-delete"></i>
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <!---------------------------------- MODAL REGISTRO CATEGORIAS -------------------------------->

        <div class="modal fade" id="modal-categoria" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Registro categoría de preguntas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-2 ">
                            <div :class="formCategoria.id ? 'col-md-9 mt-1' : 'col-md-10 mt-1'">
                                <label for="input" class="form-label">Categoría: </label>
                                <textarea class="form-control" :class="[['', null].includes(
                                    formCategoria.descripcion
                                )
                                    ? 'is-invalid'
                                    : 'is-valid',
                                ]" v-model="formCategoria.descripcion"></textarea>
                            </div>
                            <div class="d-flex align-items-end gap-1"> <!-- Botones en fila -->
                                <button type="button" :class="formCategoria.id ? 'btn btn-info' : 'btn btn-success'"
                                    @click.prevent="guardar_categoria">
                                    {{ formCategoria.id ? '⟳' : '➕' }}
                                </button>
                                <button type="button" v-if="formCategoria.id" class="btn btn-warning ml-1"
                                    @click.prevent="limpiar_modal">
                                    ✖
                                </button>
                            </div>
                        </div>
                        <div class="row gx-2 mt-3">
                            <div class="px-3" style="min-width: -webkit-fill-available;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="padding: 0.95rem 0.95rem">#</th>
                                            <th>CATEGORIA</th>
                                            <th>OPCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>r
                                        <tr v-for="(item, index) in faqsCategoria" :key="index">
                                            <td style="padding: 0.95rem 0.95rem; font-size: 11pt;">{{ index + 1 }}</td>
                                            <td style="font-size: 11pt;">{{ item.descripcion }}</td>
                                            <td>
                                                <a class="btn badge btn-primary w-70"
                                                    style="font-size: 8pt; color: white;"
                                                    @click="editarCategoria(item)">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                    Editar
                                                </a>
                                                <a class="btn badge btn-danger w-70 mx-1"
                                                    style="font-size: 8pt; color: white;"
                                                    @click="eliminarCategoriaFaq(item.id)">
                                                    <i class="mdi mdi-delete"></i>
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"
                            @click.prevent="limpiar_modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!---------------------------------- MODAL REGISTRO SUB CATEGORIAS -------------------------------->

        <div class="modal fade" id="modal-subcategoria" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Registro subcategoría de preguntas
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-2 ">
                            <div class="col-md-6 mt-2">
                                <label for="input" class="form-label">Sub categoría: </label>
                                <textarea class="form-control" :class="[['', null].includes(
                                    formSubCategoria.descripcion
                                )
                                    ? 'is-invalid'
                                    : 'is-valid',
                                ]" v-model="formSubCategoria.descripcion"></textarea>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label>Categoría a la que pertenece:</label>
                                <select v-model="formSubCategoria.id_categoria" class="form-control mt-1"
                                    :class="[[null, ''].includes(formSubCategoria.id_categoria) ? 'is-invalid' : 'is-valid']">
                                    <option :value="null">Seleccione</option>
                                    <option v-for="item in faqsCategoria" :key="item.id" :value="item.id"
                                        v-html="item.descripcion" />
                                </select>
                            </div>
                            <div class="d-flex align-items-end gap-1"> <!-- Botones en fila -->
                                <button type="button" :class="formSubCategoria.id ? 'btn btn-info' : 'btn btn-success'"
                                    @click.prevent="guardar_subcategoria">
                                    {{ formSubCategoria.id ? '⟳' : '➕' }}
                                </button>
                                <button type="button" v-if="formSubCategoria.id" class="btn btn-warning ml-1"
                                    @click.prevent="limpiar_modal_subcategoria">
                                    ✖
                                </button>
                            </div>
                        </div>
                        <div class="row gx-2 mt-3">
                            <div class="px-3" style="min-width: -webkit-fill-available;">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="padding: 0.95rem 0.95rem">#</th>
                                            <th>SUBCATEGORIA</th>
                                            <th>CATEGORIA</th>
                                            <th>OPCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in faqsSubCategoria" :key="index">
                                            <td style="padding: 0.95rem 0.95rem; font-size: 11pt;">{{ index + 1 }}</td>
                                            <td style="font-size: 11pt;">{{ item.descripcion }}</td>
                                            <td style="font-size: 11pt;">{{ item.categoria.descripcion }}</td>
                                            <td>
                                                <a class="btn badge btn-primary w-70"
                                                    style="font-size: 8pt; color: white;"
                                                    @click="editarSubCategoria(item)">
                                                    <i class="mdi mdi-square-edit-outline"></i>
                                                    Editar
                                                </a>
                                                <a class="btn badge btn-danger w-70 mx-1"
                                                    style="font-size: 8pt; color: white;"
                                                    @click="eliminarSubCategoriaFaq(item.id)">
                                                    <i class="mdi mdi-delete"></i>
                                                    Eliminar
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal"
                            @click.prevent="limpiar_modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>


        <!---------------------------------- MODAL SUGERENCIAS PREGUNTAS USERS -------------------------------->

        <div class="modal" id="modal-sugerencias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Sugerencia / Preguntas realizadas por
                            usuarios
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
                                aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row gx-2 w-100">
                            <div class="px-3" style="min-width: -webkit-fill-available;">

                                <table class="table table-striped" id="tabla-sugerencias">
                                    <thead>
                                        <tr>
                                            <th style="padding: 0.95rem 0.95rem">#</th>
                                            <th>PREGUNTA</th>
                                            <th>ESTADO</th>
                                            <th>OPCIÓN</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, index) in Sugerenciasfaqs" :key="index">
                                            <td style="padding: 0.95rem 0.95rem; font-size: 11pt;">{{ index + 1 }}</td>
                                            <td style="font-size: 11pt;">{{ item.pregunta }}</td>
                                            <td style="font-size: 11pt;"
                                                :class="item.estado === true ? 'text-success' : (item.estado === false ? 'text-danger' : 'text-warning')">
                                                {{ item.estado === true ? 'Tomado en cuenta' : (item.estado === false ?
                                                    'Rechazado' : 'Sin atender') }}
                                            </td>
                                            <td>
                                                <a class="" style="font-size: 16pt; color: green; cursor: pointer;"
                                                    @click.prevent="verificar_pregunta(item.id, 1)">
                                                    <i class="mdi mdi-check-circle"></i>
                                                </a>
                                                <a class="mx-1" style="font-size: 16pt; color: red; cursor: pointer;"
                                                    @click.prevent="verificar_pregunta(item.id, 0)">
                                                    <i class="mdi mdi-close-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <FaqChat />
    </div>
</template>

<script>
import axios from 'axios';
import FaqChat from './FaqChat.vue'
export default {
    components: {
        FaqChat
    },
    name: "FaqAdmin",
    data() {
        return {
            faqs: [],
            faqsCategoria: [],
            faqsSubCategoria: [],
            filtroCategoria: null,
            form: {
                id: null,
                pregunta: '',
                respuesta: '',
                categoria: '',
                id_categoria: null,
                id_subcategoria: null,
            },
            dataTableInstancia: null,
            formCategoria: {
                descripcion: '',
            },
            formSubCategoria: {
                id_categoria: null,
                descripcion: '',
            },
            ejecutado: false,
            filtroCategoriaPrincipal: null,
            Sugerenciasfaqs: [],
            editorOptions: {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        [{ color: [] }, { background: [] }], // 🎨 Colores de texto y fondo
                        [{ header: [1, 2, 3, false] }],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        ['link', 'image']
                    ]
                }
            }
        }
    },

    created() {
        this.cargarFaqs();
        this.cargarCategoriaFaqs();
        this.cargarSubCategoriaFaqs();
        this.cargarSugerenciasFaqs();
    },

    watch: {
        'form.id_categoria'(nuevoValor) {
            this.form.id_subcategoria = null;
        }
    },

    computed: {
        subcategoriasDelFormulario() {
            if (this.form.id_categoria) {
                return this.faqsSubCategoria.filter(
                    subcat => subcat.id_categoria === this.form.id_categoria
                );
            }
            return [];
        },

        subcategoriasFiltradas() {
            if (this.filtroCategoriaPrincipal) {
                return this.faqsSubCategoria.filter(
                    subcat => subcat.id_categoria === this.filtroCategoriaPrincipal
                );
            }
            return this.faqsSubCategoria;
        },

        faqsFiltrados() {
            if (this.ejecutado) {
                let filtrados = this.faqs;

                // Filtro por subcategoría (más específico)
                if (this.filtroCategoria) {
                    filtrados = filtrados.filter(faq => faq.id_subcategoria === this.filtroCategoria);
                }

                // Filtro por categoría (si no hay subcategoría aplicada)
                else if (this.filtroCategoriaPrincipal) {
                    filtrados = filtrados.filter(faq => {
                        // Caso 1: FAQ asociada directamente a categoría
                        if (faq.id_categoria && faq.id_categoria === this.filtroCategoriaPrincipal) {
                            return true;
                        }

                        // Caso 2: FAQ asociada a subcategoría de la categoría seleccionada
                        if (faq.id_subcategoria) {
                            const subcat = this.faqsSubCategoria.find(sc => sc.id === faq.id_subcategoria);
                            return subcat && subcat.id_categoria === this.filtroCategoriaPrincipal;
                        }

                        return false;
                    });
                }

                // Actualiza DataTable
                $("#tabla-preguntas").DataTable().destroy();
                this.$nextTick(() => {
                    $("#tabla-preguntas").DataTable();
                });

                // Alerta si no hay resultados
                if (filtrados.length === 0) {
                    this.alert_val("error", "Sin preguntas registradas");
                }

                return filtrados;
            }
        }
    },


    methods: {
        async cargarFaqs() {
            try {
                const res = await axios.get('api/faqs')
                this.faqs = res.data
                this.ejecutado = true;
            } catch (error) {
                console.error("Error al cargar FAQs:", error)
            }
        },

        async cargarSugerenciasFaqs() {
            try {
                const res = await axios.get('api/chatbot/indexConsultaSinRespuesta')
                this.Sugerenciasfaqs = res.data.consultas;
                this.$nextTick(() => {
                    $("#tabla-sugerencias").DataTable();
                });
            } catch (error) {
                console.error("Error al cargar Sugerencias FAQs:", error)
            }
        },

        async cargarCategoriaFaqs() {
            try {
                const res = await axios.get('api/faq/index_cat_faqs')
                this.faqsCategoria = res.data
            } catch (error) {
                console.error("Error al cargar categorías:", error)
            }
        },

        async cargarSubCategoriaFaqs() {
            try {
                const res = await axios.get('api/subcategorias')
                this.faqsSubCategoria = res.data
            } catch (error) {
                console.error("Error al cargar categorías:", error)
            }
        },

        async guardarFaq() {
            try {
                if (this.form.id) {
                    await axios.put(`api/faqs/${this.form.id}`, this.form)
                } else {
                    await axios.post('api/faqs', this.form)
                }
                this.resetForm();
                await this.alert_val("success", "Se guardó correctamente");
                await this.cargarFaqs()
            } catch (error) {
                console.error("Error al guardar FAQ:", error)
            }
        },

        editarFaq(faq) {
            this.form = { ...faq };
            this.form.id_subcategoria = this.form.subcategoria.id;
            this.formSubCategoria.id_categoria = this.form.subcategoria.id_categoria;
            window.scrollTo({
                top: 0,
                behavior: 'smooth' // hace que el scroll sea suave
            });
        },

        async eliminarFaq(id) {
            try {
                await axios.delete('api/faqs/' + id);
                await this.cargarFaqs();

                // Si usas un modal Bootstrap, ciérralo manualmente si es necesario
                $('#mdl-Inscritos').modal('hide');

                // Opcional: notificación al usuario
                this.alert_val('success', 'El FAQ ha sido eliminado');
            } catch (error) {
                console.error('Error eliminando el FAQ:', error);
                this.alert_val('error', 'No se pudo eliminar el FAQ');
            }
        },

        resetForm() {
            this.form = {
                id: null,
                pregunta: '',
                respuesta: '',
                categoria: '',
                id_categoria: null,
            }
        },

        quitarFiltros() {
            this.filtroCategoria = null;
            this.filtroCategoriaPrincipal = null;
        },


        limpiar_modal() {
            this.formCategoria = {
                descripcion: null
            }
        },

        limpiar_modal_subcategoria() {
            this.formSubCategoria = {
                id_categoria: null,
                descripcion: null,
                id_subcategoria: null,
            }
        },

        async guardar_categoria() {
            let resp;
            if (this.formCategoria.id) {
                resp = await axios.post(`api/update_categoria_pregunta/${this.formCategoria.id}`, this.formCategoria);
            } else {
                resp = await axios.post('api/store_categoria_pregunta', this.formCategoria);
            }
            if (resp.data.verificado) {
                await this.alert_val("success", "Se guardó correctamente");
                await this.cargarCategoriaFaqs();
                this.limpiar_modal();
            } else {
                await this.alert_val("error", "Error al guardar");
            }
        },

        async guardar_subcategoria() {
            let resp;
            if (this.formSubCategoria.id) {
                resp = await axios.put(`api/subcategorias/${this.formSubCategoria.id}`, this.formSubCategoria);
            } else {
                resp = await axios.post('api/subcategorias', this.formSubCategoria);
            }
            if (resp.data.verificado) {
                await this.alert_val("success", "Se guardó correctamente");
                await this.cargarSubCategoriaFaqs();
                this.limpiar_modal_subcategoria();
            } else {
                await this.alert_val("error", "Error al guardar");
            }
        },

        async eliminarCategoriaFaq(id) {
            try {
                let url = "api/destroy_categoria_pregunta/" + id;
                await axios.delete(url);
                await this.cargarCategoriaFaqs();
                this.alert_val("success", "Categoría eliminada correctamente");
            } catch (error) {
                console.error("Error al eliminar categoría:", error);
                this.alert_val("error", "No se pudo eliminar la categoría");
            }
        },

        async eliminarSubCategoriaFaq(id) {
            try {
                let url = "api/subcategorias/" + id;
                await axios.delete(url);
                await this.cargarSubCategoriaFaqs();
                this.alert_val("success", "Subcategoría eliminada correctamente");
            } catch (error) {
                console.error("Error al eliminar subcategoría:", error);
                this.alert_val("error", "No se pudo eliminar la subcategoría");
            }
        },

        editarCategoria(item) {
            this.formCategoria = { ...item }
        },

        editarSubCategoria(item) {
            this.formSubCategoria = { ...item }
        },

        async verificar_pregunta(id, estado) {
            let response = await axios.post(`api/update_preguntaSinRespuesta/${id}`, {
                estado: estado
            });
            if (response.data.ok) {
                await this.alert_val("success", "Se guardó correctamente");
                await this.cargarSugerenciasFaqs();
            } else {
                await this.alert_val("error", "Error al guardar");
            }
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

        modal_categoria() {
            /* this.limpiar_modal(); */
            $('#modal-categoria').modal('toggle');
        },

        modal_subCategoria() {
            /* this.limpiar_modal_subcategoria(); */
            $('#modal-subcategoria').modal('toggle');
        },

        modal_sugerencias() {
            $('#modal-sugerencias').modal('toggle');
        },
    }
}
</script>
