<template>
    <div class="card-footer text-center">
      <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
          <!-- Botón "Anterior" -->
          <li class="page-item" :class="{ 'disabled': !DatosPaginacion.prev_page_url }">
            <a class="page-link" @click.prevent="CargarPagina(DatosPaginacion.prev_page_url)">
              Anterior
            </a>
          </li>

          <!-- Mostrar los enlaces de página dinámicamente -->
          <template v-for="pagina in paginasMostradas">
            <li class="page-item" :class="{ 'active': pagina === DatosPaginacion.current_page }">
              <a class="page-link" @click.prevent="CargarPagina(getUrlPagina(pagina))" >
                {{ pagina }}
              </a>
            </li>
          </template>

          <!-- Botón "Siguiente" -->
          <li class="page-item" :class="{ 'disabled': !DatosPaginacion.next_page_url }">
            <a class="page-link" @click.prevent="CargarPagina(DatosPaginacion.next_page_url)">
              Siguiente
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </template>

  <script>
  export default {
    emits: ['listadoDatos'],
    props: {
      urlInicial: String // Propiedad para recibir la URL de la primera página de datos
    },
    data() {
      return {
        DatosPaginacion: {},
        paginasMostradas: []
      };
    },
    created() {
     this.CargarPagina(this.urlInicial);
    },
    methods: {
      async CargarPagina(url) {
        try {
          const response = await axios.get(url);
          this.DatosPaginacion = response.data;
          this.generarPaginasMostradas();
          let datosRetorno = response.data.data;
          this.$emit('listadoDatos', datosRetorno);
        } catch (error) {
          console.error('Error al cargar la página:', error);
        }
      },
      // async Paginar(url) {
      //   this.CargarPagina(url);
      // },
      getUrlPagina(numeroPagina) {
        return this.DatosPaginacion.path + '?page=' + numeroPagina;
      },
      generarPaginasMostradas() {
        let currentPage = this.DatosPaginacion.current_page;
        let lastPage = this.DatosPaginacion.last_page;
        let startPage = Math.max(currentPage - 1, 1);
        let endPage = Math.min(currentPage + 1, lastPage);

        if (endPage - startPage < 2) {
          if (currentPage - startPage > 0) {
            startPage = Math.max(startPage - 1, 1);
          } else {
            endPage = Math.min(endPage + 1, lastPage);
          }
        }

        this.paginasMostradas = Array.from({ length: (endPage - startPage) + 1 }, (_, i) => startPage + i);
      },
    recargarPagina(url) {
      this.CargarPagina(url);
    }
    },
    watch:{
      urlInicial(){
        this.CargarPagina(this.urlInicial)
      }
    }

  }
  </script>
