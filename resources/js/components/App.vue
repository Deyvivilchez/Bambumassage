<template>
  <main>
    <div class="nk-sidebar">
      <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
          <li class="nav-label">Modulos</li>
          <li>
            <a class="has-arrow" href="javascript:void()" aria-expanded="false">
              <i class="icon-speedometer menu-icon"></i><span class="nav-text">Panel Administracion</span>
            </a>
            <ul aria-expanded="false">
              <li>
                <router-link exact-active-class="active" to="/inicio" class="nav-link">Inicio</router-link>
              </li>
              <li>
                <router-link exact-active-class="active" to="/categoria_bambu" class="nav-link">Categorias</router-link>
              </li>
              <li>
                <router-link exact-active-class="active" to="/productoservicios" class="nav-link">Producto Servicios</router-link>
              </li>
              <li>
                <router-link exact-active-class="active" to="/portadaSlider" class="nav-link">Portada Sedes</router-link>
              </li>
              <li>
                <router-link exact-active-class="active" to="/Eventos" class="nav-link">Eventos</router-link>
              </li>
              <li>
                <router-link exact-active-class="active" to="/FaqAdmin" class="nav-link">Chatbot (FAQs)</router-link>
              </li>
              <li>
                 <router-link exact-active-class="active" to="/Reclamaciones" class="nav-link"> Reclamos/Quejas</router-link>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>

    <div class="content-body">
      <router-view> </router-view>
    </div>
  </main>
</template>

