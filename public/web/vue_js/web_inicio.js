var inicio = new Vue({
    el: '#inicio',
    data: {
        titulo: "HOLA MUNDO",
        slider_inicio: [],

    },
    mounted() {
        this.mostrarSlider();
    },
    methods: {
        async mostrarSlider() {
            await axios.get("/api/admInicioController").then((response) => {
                    this.slider_inicio = response.data.sliderInicio;
                    console.log(this.slider_inicio);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    }
});
