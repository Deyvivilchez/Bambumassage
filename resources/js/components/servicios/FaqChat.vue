<template>
    <div class="chatbot-container">
        <button class="toggle-btn " @click="toggleChat"><i class="mdi mdi-message-outline"></i></button>

        <div v-if="open" class="chat-box shadow-lg">
            <div class="chat-header text-center">
                <span class="chat-title">🌴 Bambú Asistente </span>
                <button @click="limpiarChat" class="btn-limpiar" title="Limpiar chat">
                    <i class="mdi mdi-delete"></i>
                </button>
            </div>

            <div class="chat-messages" ref="chatScroll">
                <!-- Mensaje de bienvenida inicial -->
                <div v-if="messages.length === 0" class="message assistant">
                    <strong class="letras-color">Bambú Bot: </strong>
                    <span class="letras-color">
                        ¡Hola! 🌿 Bienvenid@ a Bambú Massage, tu espacio de desconexión y bienestar.
                        ¿En qué podemos ayudarte hoy?
                        <ul class="mt-1 list-disc list-inside">
                            <li v-for="(cat, i) in sugerencias" :key="'cat-' + i">
                                <a @click="seleccionarCategoria(cat)"
                                    class="sugerencia-btn btn btn-link p-0 align-baseline">
                                    {{ cat.descripcion }}
                                </a>
                            </li>
                        </ul>
                    </span>
                </div>

                <!-- Historial de mensajes -->
                <div v-for="(msg, index) in messages" :key="index" :class="['message', msg.role]">
                    <template v-if="msg.tipo === 'categorias'">
                        <strong class="letras-color">Bambú Bot: </strong>
                        <span class="letras-color">
                            ¡Hola nuevamente!.
                            ¿En qué podemos ayudarte?
                            <ul class="mt-1 list-disc list-inside">
                                <li v-for="(cat, i) in sugerencias" :key="'cat-' + i">
                                    <a @click="seleccionarCategoria(cat)"
                                        class="sugerencia-btn btn btn-link p-0 align-baseline">
                                        {{ cat.descripcion }}
                                    </a>
                                </li>
                            </ul>
                        </span>
                    </template>

                    <template v-else-if="msg.tipo === 'subcategorias'">
                        <strong class="letras-color">Bambú Bot: </strong>
                        <span class="letras-color">Opciones disponibles:</span>
                        <ul class="mt-1 list-disc list-inside">
                            <li v-for="(sub, i) in subcategoriasVisibles" :key="'subcat-' + i">
                                <a @click="seleccionarSubcategoria(sub)" class="sugerencia-btn letras-color ">
                                    {{ sub.descripcion }}
                                </a>
                            </li>
                        </ul>
                    </template>

                    <template v-else-if="msg.tipo === 'preguntas'">
                        <strong class="letras-color">Bambú Bot: </strong>
                        <!-- <span>Preguntas disponibles:</span> -->
                        <ul class="mt-1 list-disc list-inside text-start">
                            <li v-for="(p, i) in preguntasVisibles" :key="'preg-' + i" class="text-start">
                                <a @click="seleccionarPregunta(p)" class="sugerencia-btn letras-color"
                                    v-html="p.pregunta">
                                </a>
                            </li>
                        </ul>
                    </template>

                    <template v-else-if="msg.tipo === 'verCategorias'">
                        <strong class="letras-color">Bambú Bot: </strong>
                        <span class="letras-color">
                            ¿Deseas volver al menú principal?
                            <a @click="mostrarCategoriasDesdeBot" class="btn btn-link p-0 align-baseline"
                                style="color: #61b194 !important;">
                                Click aquí!
                            </a>
                        </span>
                    </template>

                    <template v-else>
                        <strong class="letras-color">{{ msg.role === 'user' ? 'Tú' : 'Bambú Bot' }}:</strong>
                        <span v-html="msg.content" class="mensaje-asistente contenido-html letras-color"></span>
                    </template>
                </div>
            </div>

            <!-- Formulario de entrada -->
            <form @submit.prevent="sendMessage" class="input-box">
                <input v-model="input" placeholder="Escribe tu pregunta..." class="form-control" />
                <button type="submit" class="btn" style="background-color: #61b194; color: white;">
                    <i class="mdi mdi-send"></i>
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch, nextTick } from 'vue'
import axios from 'axios'

const open = ref(false)
const input = ref('')
const messages = ref([])

const sugerencias = ref([])
const subcategoriasVisibles = ref([])
const preguntasVisibles = ref([])
const categoriaSeleccionada = ref(null)
const subcategoriaSeleccionada = ref(null)
const ultimaPreguntaSeleccionada = ref(null)
const preguntasPendientes = ref([])

onMounted(async () => {
    try {
        const res = await axios.get('/api/faq/sugerencias')
        sugerencias.value = res.data
    } catch (e) {
        console.error('Error al cargar sugerencias', e)
    }
})


const registrarEvento = async (evento, datos = {}) => {
    try {
        await axios.post('/api/chatbot/evento', {
            evento,
            datos,
            fecha: new Date().toISOString(),
            navegador: navigator.userAgent,
        })
    } catch (e) {
        console.error('Error al registrar evento:', evento, e)
    }
}

const toggleChat = () => {
    open.value = !open.value
    if (open.value) registrarEvento('abrir_chat')
}

const pedirVerCategorias = () => {
    messages.value.push({
        role: 'user',
        content: ' Quiero ver las categorías disponibles'
    })
    mostrarCategoriasDesdeBot()
}

const mostrarCategoriasDesdeBot = () => {
    messages.value.push({
        role: 'assistant',
        tipo: 'categorias',
        content: ''
    })
    hacerScrollAbajo()
    registrarEvento('ver_categorias')
}

const seleccionarCategoria = (categoria) => {
    categoriaSeleccionada.value = categoria
    subcategoriasVisibles.value = categoria.subcategorias || []
    messages.value.push({
        role: 'user',
        content: `Elegiste: ${categoria.descripcion}`
    })
    if (subcategoriasVisibles.value.length > 0) {
        // Mismo comportamiento anterior
        messages.value.push({
            role: 'assistant',
            tipo: 'subcategorias',
            content: ''
        })
        registrarEvento('click_categoria', { categoria: categoria.descripcion })
    } else if ((categoria.faqs_directos || []).length > 0) {
        // NUEVO: Mostrar preguntas directamente si no hay subcategorías
        preguntasVisibles.value = categoria.faqs_directos
        preguntasPendientes.value = categoria.faqs_directos || []

        messages.value.push({
            role: 'assistant',
            tipo: 'preguntas',
            content: ''
        })
        registrarEvento('click_categoria_sin_subcategorias', { categoria: categoria.descripcion })
    } else {
        // No hay ni subcategorías ni preguntas
        messages.value.push({
            role: 'assistant',
            content: '❌ La opción seleccionada no tiene contenido disponible aún.'
        })
        registrarEvento('click_categoria_vacia', { categoria: categoria.descripcion })
        sugerirCategorias()

    }
    hacerScrollAbajo()
}


const seleccionarSubcategoria = (subcategoria) => {
    subcategoriaSeleccionada.value = subcategoria
    preguntasVisibles.value = subcategoria.faqs || []
    preguntasPendientes.value = subcategoria.faqs || []

    messages.value.push({
        role: 'user',
        content: ` Elegiste: ${subcategoria.descripcion}`
    })

    messages.value.push({
        role: 'assistant',
        tipo: 'preguntas',
        content: ''
    })

    hacerScrollAbajo()
    registrarEvento('click_subcategoria', { subcategoria: subcategoria.descripcion })
}

const seleccionarPregunta = (pregunta) => {
    /* messages.value.push({
        role: 'user',
        content: 'Sí'
    }) */
    ultimaPreguntaSeleccionada.value = pregunta // guardamos la pregunta
    preguntasPendientes.value = [] // ya no hay lista pendiente porque eligió una

    /* messages.value.push({
        role: 'assistant',
        content: `¿Quieres que te responda sobre: "${pregunta.pregunta}"?`
    }) */

    messages.value.push({
        role: 'assistant',
        content: `💡 ${pregunta.respuesta}`
    })

    /* preguntasVisibles.value = [] */
    sugerirCategorias()

    registrarEvento('click_pregunta', { pregunta: pregunta.pregunta })
}

const sendMessage = async () => {
    const pregunta = input.value.trim()
    if (!pregunta) return

    messages.value.push({ role: 'user', content: pregunta })
    input.value = ''

    // 💡 Si el usuario dice "si", "sí" o similar
    const textoLower = pregunta.toLowerCase()
    const afirmativos = ["si", "sí", "si por favor", "sí por favor", "claro", "por supuesto"]
    if (afirmativos.includes(textoLower)) {
        if (ultimaPreguntaSeleccionada.value) {
            messages.value.push({
                role: 'assistant',
                content: `💡 ${ultimaPreguntaSeleccionada.value.respuesta}`
            })
            ultimaPreguntaSeleccionada.value = null
            preguntasPendientes.value = []
            sugerirCategorias()
            return
        } else if (preguntasPendientes.value.length > 0) {
            const primera = preguntasPendientes.value[0]
            messages.value.push({
                role: 'assistant',
                content: `💡 ${primera.respuesta}`
            })
            preguntasPendientes.value = []
            sugerirCategorias()
            return
        } else {
            messages.value.push({
                role: 'assistant',
                content: 'Por favor, selecciona una pregunta primero para que pueda responderte.'
            })
            return
        }
    }

    // ❗ Si no es afirmativo, seguimos con la búsqueda normal
    preguntasVisibles.value = []
    subcategoriasVisibles.value = []

    await registrarEvento('pregunta_enviada', { pregunta })

    try {
        const res = await axios.post('/api/faq/buscar', { pregunta })
        const resultados = res.data.resultados

        if (resultados.length > 0) {
            resultados.forEach(respuesta => {
                messages.value.push({
                    role: 'assistant',
                    content: `💡 ${respuesta.respuesta}`
                })
            })
        } else {
            messages.value.push({
                role: 'assistant',
                content: '❌ Lo siento, no encontré una respuesta a tu pregunta.'
            })
            const fechaFormateada = new Date().toISOString().replace('T', ' ').replace(/\.\d+Z$/, '');
            await axios.post('/api/chatbot/no_respuesta', {
                pregunta,
                fecha: fechaFormateada,
                navegador: navigator.userAgent
            })

            await registrarEvento('respuesta_no_encontrada', { pregunta })
        }

        sugerirCategorias()
    } catch (err) {
        messages.value.push({
            role: 'assistant',
            content: '⚠️ Hubo un error al procesar tu pregunta. Intenta más tarde.'
        })

        sugerirCategorias()
    }
}

const sugerirCategorias = () => {
    messages.value.push({
        role: 'assistant',
        tipo: 'verCategorias',
        content: ''
    })
    hacerScrollAbajo()
}

const chatScroll = ref(null)

const hacerScrollAbajo = () => {
    nextTick(() => {
        if (chatScroll.value) {
            chatScroll.value.scrollTop = chatScroll.value.scrollHeight
        }
    })
}

const limpiarChat = () => {
    if (confirm('¿Estás seguro de que quieres limpiar la conversación?')) {
        messages.value = []
        preguntasVisibles.value = []
        subcategoriasVisibles.value = []
        registrarEvento('chat_limpiado')

        // Restablecer mensaje inicial solo si el chat está abierto
        if (open.value) {
            nextTick(() => {
                hacerScrollAbajo()
            })
        }
    }
}



watch(messages, () => {
    hacerScrollAbajo()
})
</script>

<style scoped>
.chatbot-container {
    position: fixed;
    bottom: 140px;
    right: 14px;
    z-index: 999;
    display: flex;
    flex-direction: column-reverse;
    align-items: flex-end;
}

.toggle-btn {
    background: #61b194;
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    width: 55px;
    height: 55px;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.toggle-btn:focus {
    outline: none;
    box-shadow: none;
}

.chat-box {
    width: 400px;
    height: 500px;
    background: white;
    border-radius: 12px;
    padding: 12px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.15);
    margin-bottom: 10px;
}

.chat-messages {
    overflow-y: auto;
    flex-grow: 1;
    margin-bottom: 10px;
    padding-right: 5px;
    display: flex;
    flex-direction: column;
}

.message {
    margin: 6px 0;
    padding: 8px 12px;
    border-radius: 8px;
    word-wrap: break-word;
    max-width: 85%;
    width: fit-content;
    box-sizing: border-box;
}

.message.user {
    background-color: #dbeafe;
    align-self: flex-end;
    text-align: right;
}

.message.assistant {
    background-color: #f3f4f6;
    align-self: flex-start;
    text-align: left;
}

.input-box {
    display: flex;
    gap: 8px;
}

input.form-control {
    flex-grow: 1;
    border-radius: 8px;
    padding: 8px;
    border: 1px solid #ccc;
}

button.btn {
    border-radius: 8px;
}

a.btn {
    color: black;
    text-decoration: auto;
    font-size: 0.95rem;
    cursor: pointer;
    transition: color 0.2s ease-in-out;
}

a.btn:hover {
    color: #61b194;
}

.sugerencia-btn {
    display: inline;
    background: transparent;
    border: none;
    padding: 0;
    margin: 0;
    cursor: pointer;
    font-size: 0.95rem;
    text-align: left;
    line-height: 1.3;
    vertical-align: baseline;
}

.sugerencia-btn:hover {
    text-decoration: underline;
}

.chat-header {
    background: #61b194;
    color: white;
    padding: 12px 16px;
    font-size: 1rem;
    font-weight: bold;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-right: -12px;
    margin-left: -12px;
    margin-top: -12px;
}

.chat-title {
    display: inline-block;
}

ul {
    margin-top: 4px;
    margin-bottom: 4px;
    padding-left: 20px;
}

li {
    margin-bottom: 2px;
}

.btn-limpiar {
    background: transparent;
    border: none;
    color: white;
    cursor: pointer;
    padding: 4px;
    margin-left: 10px;
    font-size: 16px;
    transition: all 0.3s ease;
}

.btn-limpiar:hover {
    color: #ffeb3b;
    transform: scale(1.1);
}

.chat-header {
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

/* Ajustamos el título para que quede centrado */
.chat-title {
    flex-grow: 1;
    text-align: center;
}

.contenido-html {
    color: #333;
    /* o el mismo que usas en el resto */
    font-size: 14px;
    font-family: inherit;
    line-height: 1.5;
}

.contenido-html a {
    color: #007bff;
    /* color de los enlaces */
    text-decoration: none;
}

.contenido-html a:hover {
    text-decoration: underline;
}

.letras-color {
    color: black !important;
}

.letras-color a:hover {
    color: #61b194 !important;
}
</style>