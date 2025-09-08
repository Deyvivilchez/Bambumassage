// resources/js/faqchat.js

require("./bootstrap");
import Vue from "vue";
import FaqChat from "./components/servicios/FaqChat.vue";
import '@mdi/font/css/materialdesignicons.min.css'; // ✅ Iconos MDI

Vue.component("faq-chat", FaqChat);

new Vue({
    el: "#faq-chat-app",
});
