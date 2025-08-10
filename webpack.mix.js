const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/faqchat.js", "public/js") // Línea separada
    .postCss("resources/css/app.css", "public/css", [])
    .vue();
